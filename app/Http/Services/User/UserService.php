<?php

declare(strict_types=1);

namespace App\Http\Services\User;

use App\Http\Services\Chat\RoomService;
use App\Models\User;
use App\Models\UserRooms;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserService implements UserServiceInterface {

    public function __construct(private readonly RoomService $roomService) {
    }

    public function findByEmail($email)
    {
        return User::where(['email' => $email])->first();
    }

    public function findById($id)
    {
        if (!$id) {
            throw new BadRequestException("User id is required!");
        }
        return User::where('id', $id)->first();
    }

    public function findAll()
    {
        return  User::all();
    }

    public function create($email, $password, $name)
    {

        $user = $this->findByEmail($email);

        if ($user) {
            throw new ConflictHttpException('User with this email already exist!');
        }

        $newUser = User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'name' => $name
        ]);

        $newUser->save();

        return $newUser;
    }

    public function joinToChatRoom($room) {
        $oldJoin = $this->roomService->userIsExist($room, auth()->id());

        if ($oldJoin) {
            return response(["message" => "User is already exist in this room!"], 422);
        }

        $room = UserRooms::create([
            'user_id' => auth()->id(),
            'room_id' => $room,
        ]);

        return ["message" => "success", "data" => $room];
    }

    public function leftFromRoom($room) {
        $oldJoin = $this->roomService->userIsExist($room, auth()->id());

        if (!$oldJoin) {
            return response(["message" => "User is not exist in this room!"], 422);
        }

        $oldJoin->delete();

        return ["message" => "success"];
    }


}