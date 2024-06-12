<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Requests\UpdateChatRoomRequest;
use App\Http\Resources\Api\ChatRoomResource;
use App\Http\Services\Chat\ChatService;
use App\Http\Services\Chat\RoomService;
use App\Models\ChatRoom;
use App\Models\Room;

class RoomController extends Controller
{


    public function __construct(private readonly RoomService $chatService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::with("created_by")->get();

        return ChatRoomResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRoomRequest $request)
    {
        return $this->chatService->createChatRoom($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $chatRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRoomRequest $request, Room $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $chatRoom)
    {
        //
    }
}