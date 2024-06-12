<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\UserResource;
use App\Http\Services\User\UserService;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(private readonly UserService $userService) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $user = User::where("id", $id);

            $user->delete();

            return ["message" => "success"];
        } catch (Exception $e) {
            return ["message" => "Something went wrong! " . $e->getMessage()];
        }
    }

    public function joinToChatRoom(Room $room) {
        return $this->userService->joinToChatRoom($room->id);
    }


    public function leftFromRoom(Room $room) {
        return $this->userService->leftFromRoom($room->id);
    }


}