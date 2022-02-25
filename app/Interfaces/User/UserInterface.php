<?php
namespace App\Interfaces\User;

interface UserInterface
{
    public function getAllUsers($pagination, $status_show_user);
    public function getUser($user_id);
    public function createUser($request);
    public function updateUser($user, $request);
    public function editUser($user_id);
    public function assignRole($user, $input_roles);
}
