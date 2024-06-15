<?php

declare(strict_types=1);

namespace App\Http\Services\Chat;

use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Resources\Api\ChatRoomResource;
use App\Models\Room;
use App\Models\UserRooms;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomService implements RoomServiceInterface {

    public function getChatWithId($id)
    {

    }

    public function getAllChats()
    {

    }

    public function createChatRoom(StoreChatRoomRequest $request) {
        try {
            $data = $request->validated();
            $user = $request->user();

            $chat = $this->getChatWithLink($data["link"]);

            if ($chat) {
                return response()->json([
                    "message" => "Chat with that link is alredy exist!"
                ], 422);
            }

            $newRoom = Room::create([
                "name" => $data["name"],
                "type" => $data["type"],
                "info" => $data["info"],
                "link" => $data["link"],
                "user_id" => $user["id"],
            ]);

            return ["data" => $newRoom, "message" => "success"];
        } catch (Exception $e) {
            return ["message" => $e->getMessage()];
        }
    }

    public function getChatWithLink($link)
    {
            $chat = Room::where("link", $link)->first();
            return $chat;
    }

    public function userIsExist($roomId, $userId) {
        $room = UserRooms::where('room_id', $roomId)
            ->where('user_id', $userId)
            ->first();

        return $room;
    }

    public function subscribed($userId) {
        $userRooms = UserRooms::with(["chat_room", "user"])->where('user_id', $userId)->paginate();

        return ChatRoomResource::collection($userRooms);
    }




}