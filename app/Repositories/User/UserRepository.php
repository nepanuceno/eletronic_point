<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsersActive($user_status_active, $pluck=false) {
        if ($pluck) {
            return User::where('active', $user_status_active)
            ->pluck('name', 'id');
        }
        return User::where('active', $user_status_active)->get();
    }

    public function getAllUsers($pagination, $user_status_active) {
       return User::where('active', $user_status_active)
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
