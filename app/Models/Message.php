<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ["message", "created_by", "room", "is_updated"];

    protected $casts = [
        'is_updated' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function room() {
        return $this->belongsTo(Room::class, "room");
    }

    public function created_by() {
        return $this->belongsTo(User::class, "created_by");
    }
}