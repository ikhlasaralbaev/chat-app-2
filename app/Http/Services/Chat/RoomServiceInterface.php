<?php
declare(strict_types=1);
namespace App\Http\Services\Chat;

use App\Models\Room;

interface RoomServiceInterface {
    public function getAllChats();
    public function getChatWithId(Room $room);
    public function getChatWithLink($link);
}