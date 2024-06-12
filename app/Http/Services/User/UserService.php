<?php

declare(strict_types=1);

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserService implements UserServiceInterface {


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
}