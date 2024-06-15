<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyMessageRequest;
use App\Http\Requests\StoreChatMessageRequest;
use App\Http\Requests\UpdateChatMessageRequest;
use App\Http\Services\Chat\MessageService;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    public function __construct(private readonly MessageService $chatMessageService) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index($chat_room)
    {
        return $this->chatMessageService->getChatMessages($chat_room);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Room $room, StoreChatMessageRequest $request)
    {
        return $this->chatMessageService->createMessage($request, $room);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Message $message, UpdateChatMessageRequest $request)
    {
        return $this->chatMessageService->updateMessage($message, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message, DestroyMessageRequest $request)
    {
        return $this->chatMessageService->deleteMessage($message, $request);
    }

}