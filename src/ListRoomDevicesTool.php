<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use LLM\Agents\Agent\SmartHomeControl\SmartHome\SmartHomeSystem;
use LLM\Agents\Tool\PhpTool;

/**
 * @extends PhpTool<ListRoomDevicesInput>
 */
final class ListRoomDevicesTool extends PhpTool
{
    public const NAME = 'list_room_devices';

    public function __construct(
        private readonly SmartHomeSystem $smartHome,
    ) {
        parent::__construct(
            name: self::NAME,
            inputSchema: ListRoomDevicesInput::class,
            description: 'Lists all smart devices in a specified room.',
        );
    }

    public function execute(object $input): string
    {
        $devices = $this->smartHome->getRoomDevices($input->roomName);
        $deviceList = [];

        foreach ($devices as $device) {
            $deviceList[] = [
                'id' => $device->id,
                'name' => $device->name,
                'type' => get_class($device),
                'status' => $device->getStatus() ? 'on' : 'off',
                'params' => $device->getDetails(),
                'controlSchema' => $device->getControlSchema(),
            ];
        }

        return json_encode([
            'room' => $input->roomName,
            'devices' => $deviceList,
        ]);
    }
}
