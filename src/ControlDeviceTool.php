<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use LLM\Agents\Agent\SmartHomeControl\SmartHome\SmartHomeSystem;

/**
 * @extends PhpTool<ControlDeviceInput>
 */
final class ControlDeviceTool extends PhpTool
{
    public const NAME = 'control_device';

    public function __construct(
        private readonly SmartHomeSystem $smartHome,
    ) {
        parent::__construct(
            name: self::NAME,
            inputSchema: ControlDeviceInput::class,
            description: 'Controls a specific device by performing the specified action with given parameters.',
        );
    }

    public function execute(object $input): string
    {
        try {
            $result = $this->smartHome->controlDevice($input->deviceId, $input->action, $input->params);

            return json_encode([
                'id' => $input->deviceId,
                'action' => $input->action->value,
                'result' => $result,
            ]);
        } catch (\InvalidArgumentException $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
