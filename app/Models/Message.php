<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "messages";

    protected $fillable = ["message", "createdBy", "room_id", "is_updated", "user_id", "replied_message_id", "file_id"];
    protected $hidden = ["user_id", "room_id"];

    protected $casts = [
        'is_updated' => 'boolean',
    ];

    public function room() {
        return $this->belongsTo(Room::class, "room_id");
    }

    public function createdBy() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function userRoom() {
        return $this->belongsTo(UserRooms::class, "user_room");
    }

    public function repliedMessage()
    {
        return $this->belongsTo(Message::class, 'replied_message_id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'replied_message_id');
    }

    public function file() {
        return $this->belongsTo(File::class, "file_id");
    }
}
