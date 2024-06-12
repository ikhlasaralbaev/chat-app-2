<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->name("auth.")->group(function() {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get("/profile", [AuthController::class, "getme"]);
    });
});


Route::middleware(['auth:sanctum', "role:admin"])->group(function () {
    Route::prefix('/users')->name("users.")->group(function() {
        Route::get("/", [UserController::class, "index"]);
        Route::post("/", [UserController::class, "store"]);
        Route::post("/profile/{id}", [UserController::class, "show"]);
        Route::delete("/{id}", [UserController::class, "destroy"]);
        Route::put("/{id}", [UserController::class, "update"]);
    });

    Route::prefix("/chats")->name("chat-rooms.")->group(function () {
        Route::get("/", [ChatRoomController::class, "index"]);
        Route::post("/", [ChatRoomController::class, "store"]);
        Route::get("/messages/{id}", [ChatMessageController::class, "index"]);
        Route::post("/messages/{id}", [ChatMessageController::class, "store"]);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

});