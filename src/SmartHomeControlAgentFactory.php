<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use LLM\Agents\Agent\AgentFactoryInterface;
use LLM\Agents\Agent\AgentInterface;

final class SmartHomeControlAgentFactory implements AgentFactoryInterface
{
    public function create(string $model = SmartHomeControlAgent::DEFAULT_MODEL): AgentInterface
    {
        return SmartHomeControlAgent::create(model: $model);
    }
}
