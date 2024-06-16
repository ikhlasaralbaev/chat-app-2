<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class UserRooms extends Model
{
    use HasFactory;


    protected $connection = "mongodb";
    protected $collection = "user_rooms";

    protected $guarded = ['id'];
    protected $hidden = ["chat_room_id", "user_id", "room_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chat_room()
    {
        return $this->belongsTo(Room::class, "chat_room_id");
    }

    public function messages() {
        return $this->belongsTo(Message::class, "message_id");
    }

}