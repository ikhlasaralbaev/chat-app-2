<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Requests\UpdateChatRoomRequest;
use App\Http\Resources\Api\ChatRoomResource;
use App\Http\Services\Chat\RoomService;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{


    public function __construct(private readonly RoomService $chatService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::with(["createdBy"])->get();

        return ChatRoomResource::collection($data);
    }

    public function store(StoreChatRoomRequest $request)
    {
        return $this->chatService->createChatRoom($request);
    }


    public function subscribed(Request $request)
    {
        $userId = $request->user()->id;
        return $this->chatService->subscribed($userId);
    }
}