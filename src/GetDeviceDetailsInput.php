<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use Spiral\JsonSchemaGenerator\Attribute\Field;

final readonly class GetDeviceDetailsInput
{
    public function __construct(
        #[Field(title: 'Device ID', description: 'The unique identifier of the device')]
        public string $deviceId,
    ) {}
}
