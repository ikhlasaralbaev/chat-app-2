<?php

declare(strict_types=1);

namespace App\Http\Services\Chat;

use App\Events\ChatMessageEvent;
use App\Http\Requests\StoreChatMessageRequest;
use App\Http\Resources\Api\ChatMessageResource;
use App\Models\ChatMessage;

class ChatMessageService implements ChatMessageServiceInterface {

    public function getChatMessages($chat_room_id)
    {
        $messages = ChatMessage::with(["created_by", "chat_room_id"])->where("chat_room_id", $chat_room_id)->get();

        return ChatMessageResource::collection($messages);
    }

    public function createMessage(StoreChatMessageRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $message = ChatMessage::create([
            "message" => $data["message"],
            "chat_room_id" => $data["chat_room_id"],
            "created_by" => $user["id"]
        ]);

        // event for pusher, notification
        event(new ChatMessageEvent($data["message"], $data["chat_room_id"]));

        return ["message" => "success", "data" => $message];
    }

}