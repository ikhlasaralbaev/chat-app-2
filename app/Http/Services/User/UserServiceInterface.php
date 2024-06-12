<?php
declare(strict_types=1);
namespace App\Http\Services\User;

use App\Http\Resources\Api\UserResource;
use App\Models\User;

interface UserServiceInterface {

    /**
     *
     * @param $email (string)
     * @return User
     */

    public function findByEmail($email);

     /**
     * @return User
     */
    public function create($email, $password, $name);

    public function findById($id);

    public function findAll();
}