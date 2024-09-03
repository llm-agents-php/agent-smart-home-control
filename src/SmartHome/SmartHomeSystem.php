<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl\SmartHome;

use LLM\Agents\Agent\SmartHomeControl\DeviceAction;
use LLM\Agents\Agent\SmartHomeControl\SmartHome\Devices\SmartDevice;
use Spiral\Core\Attribute\Singleton;

#[Singleton]
final class SmartHomeSystem
{
    /** @var array<string, SmartDevice> */
    private array $devices = [];

    public function __construct(
        private readonly DeviceStateStorageInterface $stateStorage,
        private readonly DeviceStateRepositoryInterface $stateRepository,
    ) {}

    public function addDevice(SmartDevice $device): void
    {
        $this->devices[$device->id] = $device;
    }

    public function getDevice(string $id): ?SmartDevice
    {
        return $this->stateRepository->getDevice($id) ?? $this->devices[$id] ?? null;
    }

    public function getRoomList(): array
    {
        $rooms = \array_unique(\array_map(fn($device) => $device->room, $this->devices));
        \sort($rooms);
        return $rooms;
    }

    public function getRoomDevices(string $room): array
    {
        return \array_filter($this->getCachedDevices(), static fn($device): bool => $device->room === $room);
    }

    private function getCachedDevices(): array
    {
        $devices = [];
        foreach ($this->devices as $id => $device) {
            $devices[$id] = $this->getDevice($id);
        }

        return \array_filter($devices);
    }

    public function controlDevice(string $id, DeviceAction $action, array $params = []): array
    {
        $device = $this->getDevice($id);
        if ($device === null) {
            return ['error' => 'Device not found'];
        }

        $this->stateStorage->update(
            $device->executeAction($action, $params),
        );

        return [
            'id' => $device->id,
            'name' => $device->name,
            'room' => $device->room,
            'type' => \get_class($device),
            'params' => $device->getDetails(),
        ];
    }
}
