<?php

declare(strict_types=1);

namespace App\Http\Services\Chat;

use App\Events\ChatMessageEvent;
use App\Http\Requests\DestroyMessageRequest;
use App\Http\Requests\StoreChatMessageRequest;
use App\Http\Requests\UpdateChatMessageRequest;
use App\Http\Resources\Api\ChatMessageResource;
use App\Models\ChatMessage;
use App\Models\Message;
use App\Models\Room;
use Exception;

class MessageService implements MessageServiceInterface {

    public function __construct(private RoomService $roomService) {
    }

    public function getChatMessages($chat_room_id)
    {
        $messages = Message::with(["room", "createdBy"])->where("room_id", $chat_room_id)->get();


        return ChatMessageResource::collection($messages);
    }

    public function createMessage(StoreChatMessageRequest $request, Room $room)
    {
        $data = $request->validated();
        $user = $request->user();

        $userIsExistThisChat = $this->roomService->userIsExist($room->id, $user->id);

        if (!$userIsExistThisChat) {
            return response([
                "message" => "User is not exist in this room!",
            ], 422);
        }

        $message = Message::create([
            "message" => $data["message"],
            "room_id" => $room->id,
            "user_id" => $user->id
        ]);

        $message->load(["createdBy", "room"]);

        // event for pusher, notification
        event(new ChatMessageEvent($message, $room["id"], "create_message"));

        return ["message" => "success", "data" => $message];
    }

    public function deleteMessage(Message $message, DestroyMessageRequest $request) {

            $message->delete();

            // event for pusher, notification
        event(new ChatMessageEvent(
            $message->id,
       $request->validated()["room_id"],
             "delete_message"
            ));

            return response()->json(["message" => "success"]);

    }

    public function updateMessage(Message $message, UpdateChatMessageRequest $request) {

        $message["message"] = $request->validated()["message"];
        $message["is_updated"] = true;

            // event for pusher, notification
            event(new ChatMessageEvent(
                $message->$message,
           $message->room,
                 "update_message"
                ));

        return ["message" => "success", "data" => $message];
    }

}
