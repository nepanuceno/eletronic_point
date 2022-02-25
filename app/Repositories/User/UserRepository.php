<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Interfaces\User\UserInterface;

class UserRepository implements UserInterface
{
    public function getAllUsers($pagination, $status_show_user) {
       return User::where('active', $status_show_user)
            ->orderBy('id','DESC')
            ->paginate($pagination);
    }

    public function getUser($user_id) {
        return User::find($user_id);
    }

    public function createUser($request) {
        return User::create($request);
    }

    public function updateUser($user, $request) {
        return $user->update($request);
    }

    public function editUser($user_id) {
        $user = User::find($user_id);
    }

    public function assignRole($user, $input_roles) {
        $user->assignRole($input_roles);
    }

}
