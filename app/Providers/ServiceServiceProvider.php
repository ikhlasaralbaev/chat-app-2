<?php

namespace App\Providers;

use App\Http\Services\Chat\ChatMessageService;
use App\Http\Services\Chat\ChatMessageServiceInterface;
use App\Http\Services\Chat\ChatService;
use App\Http\Services\Chat\ChatServiceInterface;
use App\Http\Services\ChatMessage\ChatMessageService as ChatMessageChatMessageService;
use App\Http\Services\User\UserService;
use App\Http\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
        $this->app->bind(
            ChatServiceInterface::class,
            ChatService::class
        );
        $this->app->bind(
            ChatMessageServiceInterface::class,
            ChatMessageService::class,
        );
    }
}