<?php

declare(strict_types=1);

namespace App\Http\Services\Chat;

use App\Events\Message as MessageEvent;
use App\Http\Requests\ChatMessageStoreRequest;
use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Resources\Api\ChatRoomResource;
use App\Http\Resources\ChatRoomResource as ResourcesChatRoomResource;
use App\Models\ChatMessages;
use App\Models\ChatRoom;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ChatService implements ChatServiceInterface {

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

            $newRoom = ChatRoom::create([
                "name" => $data["name"],
                "type" => $data["type"],
                "info" => $data["info"],
                "link" => $data["link"],
                "created_by" => $user["id"],
            ]);

            return ["data" => $newRoom, "message" => "success"];
        } catch (Exception $e) {
            return ["message" => $e->getMessage()];
        }
    }

    public function getChatWithLink($link)
    {
            $chat = ChatRoom::where("link", $link)->first();
            return $chat;
    }

    public function message() {

    }




}