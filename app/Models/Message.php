<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "messages";

    protected $fillable = ["message", "createdBy", "room_id", "is_updated", "user_id"];
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

}