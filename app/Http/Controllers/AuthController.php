<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\Api\UserResource;
use App\Http\Services\User\UserService as UserUserService;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    private $userService;

    public function __construct(private UserUserService $_userService) {
        $this->userService = $_userService;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function register(StoreUserRequest $request)
    {
        $data = $request->validated();

        $newUser = $this->userService->create($data['email'], $data['password'], $data['name'],
        );

        $token = $newUser->createToken($newUser['name'], ['user'])->plainTextToken;

        $newUser->assignRole("admin");

        return [
            'user' => $newUser,
            'token' => $token
        ];
    }

    /**
     * Display the specified resource.
     */
    public function login(LoginUserRequest $request)
    {
        $user = $this->userService->findByEmail($request->validated()["email"]);

        if (!$user or !Hash::check($request->validated()['password'], $user['password'])) {
            throw new UnauthorizedException('Not authorized', 401);
        }

        $token = $user->createToken($user->name, ["user"])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function getme(Request $request) {
        $user = $this->userService->findById($request->user()->id);

        return UserResource::make($user);
    }
}