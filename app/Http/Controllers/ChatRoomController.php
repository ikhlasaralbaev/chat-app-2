<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRoomRequest;
use App\Http\Requests\UpdateChatRoomRequest;
use App\Http\Resources\Api\ChatRoomResource;
use App\Http\Services\Chat\ChatService;
use App\Models\ChatRoom;

class ChatRoomController extends Controller
{

    private $chatService;

    public function __construct(ChatService $_chatService) {
        $this->chatService = $_chatService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ChatRoom::with("created_by")->get();

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
    public function show(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRoomRequest $request, ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatRoom $chatRoom)
    {
        //
    }
}