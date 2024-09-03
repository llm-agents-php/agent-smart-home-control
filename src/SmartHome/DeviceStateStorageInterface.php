<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl\SmartHome;

use LLM\Agents\Agent\SmartHomeControl\SmartHome\Devices\SmartDevice;

interface DeviceStateStorageInterface
{
    public function update(SmartDevice $device): void;
}
