<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "info", "type", "created_by", "link"
    ];

    public function messages(): HasMany {
        return $this->hasMany(Message::class, "chat_room_id");
    }

    public function created_by() {
        return $this->belongsTo(User::class, "created_by");
    }

    public function users() {
        return $this->belongsToMany(User::class, "user_chat_rooms");
    }
}