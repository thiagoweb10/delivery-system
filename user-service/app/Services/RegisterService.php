<?php

namespace App\Services;

use App\Models\User;

class RegisterService {

    public function register($data)
    {
        $user = User::create($data->toArray());

        $user->assignRole($data->role);

        return $user;
    }
}