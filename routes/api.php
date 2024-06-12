<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
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
        Route::post("/join/{room}", [UserController::class, "joinToChatRoom"]);
        Route::post("/left/{room}", [UserController::class, "leftFromRoom"]);
    });

    Route::prefix("/chats")->name("chat-rooms.")->group(function () {
        Route::get("/", [RoomController::class, "index"]);
        Route::post("/", [RoomController::class, "store"]);
        Route::get("/messages/{id}", [MessageController::class, "index"]);
        Route::post("/messages/{id}", [MessageController::class, "store"]);
        Route::put("/messages/{message}", [MessageController::class, "update"]);
        Route::delete("/messages/{message}", [MessageController::class, "destroy"]);
    });

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

});