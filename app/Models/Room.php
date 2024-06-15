<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $connection = "mongodb";
    protected $collection = "rooms";

    protected $fillable = [
        "name", "info", "type", "link", "avatar", "user_id"
    ];

    public function messages(): HasMany {
        return $this->hasMany(Message::class, "chat_room_id");
    }

    public function createdBy() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function users() {
        return $this->belongsToMany(User::class, "user_rooms");
    }


}