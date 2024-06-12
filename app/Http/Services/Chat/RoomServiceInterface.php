<?php
declare(strict_types=1);
namespace App\Http\Services\Chat;


interface RoomServiceInterface {
    public function getAllChats();
    public function getChatWithId($id);
    public function getChatWithLink($link);
}