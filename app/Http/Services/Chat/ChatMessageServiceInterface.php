<?php
declare(strict_types=1);
namespace App\Http\Services\Chat;

use App\Http\Requests\StoreChatMessageRequest;

interface ChatMessageServiceInterface {
    public function getChatMessages(string $groupId);
    public function createMessage(StoreChatMessageRequest $request);
}