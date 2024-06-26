<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
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
        Route::put("/profile", [AuthController::class, "update"]);
    });
});


Route::middleware(["auth:sanctum", "role:admin|user"])->group(function () {
    Route::prefix('/users')->name("users.")->group(function() {
        Route::get("/", [UserController::class, "index"]);
        Route::post("/", [UserController::class, "store"]);
        Route::post("/profile/{id}", [UserController::class, "show"]);
        Route::delete("/{id}", [UserController::class, "destroy"]);
        Route::put("/{id}", [UserController::class, "update"]);
        Route::post("/join/{room}", [UserController::class, "joinToChatRoom"]);
        Route::post("/left/{room}", [UserController::class, "leftFromRoom"]);
        Route::get("/subscribed-rooms", [RoomController::class, "subscribed"]);
    });

    Route::prefix("/chats")->name("chats.")->group(function () {
        Route::get("/search-rooms", [RoomController::class, "search"]);
        Route::get("/", [RoomController::class, "index"]);
        Route::get("/{room}", [RoomController::class, "show"]);
        Route::post("/", [RoomController::class, "store"]);
        Route::get("/messages/{id}", [MessageController::class, "index"]);
        Route::post("/messages/{room}", [MessageController::class, "store"]);
        Route::put("/messages/{message}", [MessageController::class, "update"]);
        Route::delete("/messages/{message}", [MessageController::class, "destroy"]);
    });


    Route::prefix("/files")->name("file.")->group(function () {
        Route::post("/upload", [FileController::class, "store"]);
        Route::get("/", [FileController::class, "index"]);
    });

});