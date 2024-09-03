<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl\Integrations\Spiral;

use LLM\Agents\Agent\AgentRegistryInterface;
use LLM\Agents\Agent\SmartHomeControl\ControlDeviceTool;
use LLM\Agents\Agent\SmartHomeControl\GetDeviceDetailsTool;
use LLM\Agents\Agent\SmartHomeControl\ListRoomDevicesTool;
use LLM\Agents\Agent\SmartHomeControl\SmartHome\SmartHomeSystem;
use LLM\Agents\Agent\SmartHomeControl\SmartHomeControlAgent;
use LLM\Agents\Agent\SmartHomeControl\SmartHomeControlAgentFactory;
use LLM\Agents\Tool\ToolRegistryInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;

final class SmartHomeControlBootloader extends Bootloader
{
    public function boot(
        AgentRegistryInterface $agents,
        ToolRegistryInterface $tools,
        SmartHomeControlAgentFactory $siteStatusCheckerAgentFactory,
        EnvironmentInterface $env,
        SmartHomeSystem $smartHomeSystem,
    ): void {
        $agents->register(
            $siteStatusCheckerAgentFactory->create(
                $env->get('SMART_HOME_CONTROL_MODEL', SmartHomeControlAgent::DEFAULT_MODEL),
            ),
        );

        $tools->register(
            new ControlDeviceTool($smartHomeSystem),
            new GetDeviceDetailsTool($smartHomeSystem),
            new GetDeviceDetailsTool($smartHomeSystem),
            new ListRoomDevicesTool($smartHomeSystem),
        );
    }
}