<?php

declare(strict_types=1);

namespace LLM\Agents\Agent\SmartHomeControl;

use LLM\Agents\Agent\SmartHomeControl\SmartHome\SmartHomeSystem;
use LLM\Agents\Tool\PhpTool;

/**
 * @extends PhpTool<GetRoomListInput>
 */
final class GetRoomListTool extends PhpTool
{
    public const NAME = 'get_room_list';

    public function __construct(
        private readonly SmartHomeSystem $smartHome,
    ) {
        parent::__construct(
            name: self::NAME,
            inputSchema: GetRoomListInput::class,
            description: 'Retrieves a list of all room names in the smart home system.',
        );
    }

    public function execute(object $input): string
    {
        $rooms = $this->smartHome->getRoomList();

        return \json_encode([
            'rooms' => $rooms,
        ]);
    }
}
