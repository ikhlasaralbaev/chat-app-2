<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ["message", "created_by", "chat_room_id"];

    public function chat_room_id() {
        return $this->belongsTo(ChatRoom::class, "chat_room_id");
    }

    public function created_by() {
        return $this->belongsTo(User::class, "created_by");
    }
}