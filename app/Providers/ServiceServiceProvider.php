<?php

namespace App\Providers;

use App\Http\Services\Chat\ChatMessageService;
use App\Http\Services\Chat\ChatMessageServiceInterface;
use App\Http\Services\Chat\ChatService;
use App\Http\Services\Chat\ChatServiceInterface;
use App\Http\Services\Chat\FileService;
use App\Http\Services\Chat\FileServiceInterface;
use App\Http\Services\Chat\MessageService;
use App\Http\Services\Chat\MessageServiceInterface;
use App\Http\Services\Chat\RoomService;
use App\Http\Services\Chat\RoomServiceInterface;
use App\Http\Services\ChatMessage\ChatMessageService as ChatMessageChatMessageService;
use App\Http\Services\File\FileService as FileFileService;
use App\Http\Services\File\FileServiceInterface as FileFileServiceInterface;
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
            RoomServiceInterface::class,
            RoomService::class
        );
        $this->app->bind(
            MessageServiceInterface::class,
            MessageService::class,
        );
        $this->app->bind(
            FileFileServiceInterface::class,
            FileFileService::class,
        );
    }
}
