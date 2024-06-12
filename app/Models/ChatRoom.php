<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "info", "type", "created_by", "link"
    ];

    public function messages(): HasMany {
        return $this->hasMany(ChatMessage::class, "chat_room_id");
    }

    public function created_by() {
        return $this->belongsTo(User::class, "created_by");
    }
}