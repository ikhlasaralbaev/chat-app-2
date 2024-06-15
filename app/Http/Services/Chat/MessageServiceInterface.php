<?php
declare(strict_types=1);
namespace App\Http\Services\Chat;

use App\Http\Requests\StoreChatMessageRequest;
use App\Models\Room;

interface MessageServiceInterface {
    public function getChatMessages(Room $room);
    public function createMessage(StoreChatMessageRequest $request, Room $room);
}