<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use LLM\Agents\Agent\SmartHomeControl\SmartHome\SmartHomeSystem;
use LLM\Agents\Tool\PhpTool;

/**
 * @extends PhpTool<GetDeviceDetailsInput>
 */
final class GetDeviceDetailsTool extends PhpTool
{
    public const NAME = 'get_device_details';

    public function __construct(
        private readonly SmartHomeSystem $smartHome,
    ) {
        parent::__construct(
            name: self::NAME,
            inputSchema: GetDeviceDetailsInput::class,
            description: 'Retrieves detailed information about a specific device.',
        );
    }

    public function execute(object $input): string
    {
        $device = $this->smartHome->getDevice($input->deviceId);

        if (!$device) {
            return json_encode(['error' => 'Device not found']);
        }

        return json_encode([
            'id' => $device->id,
            'name' => $device->name,
            'room' => $device->room,
            'type' => get_class($device),
            'params' => $device->getDetails(),
            'controlSchema' => $device->getControlSchema(),
        ]);
    }
}
