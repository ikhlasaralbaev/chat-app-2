<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRooms extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat_room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user_chat_rooms()
   {
       return $this->belongsToMany(Room::class, "user_chat_rooms");
   }
}