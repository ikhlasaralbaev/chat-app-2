<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text("message");
            $table->foreignId("created_by")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("room")->constrained("rooms")->onUpdate("cascade")->onDelete("cascade");
            $table->boolean("is_updated")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};