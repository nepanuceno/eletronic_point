<?php
namespace App\Repositories\Interfaces\User;

interface UserRepositoryInterface
{
     /**
     * Get Active Users.
     * @param  boolean 0|1 $user_status_active
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersActive($user_status_active);

     /**
     * Get Active Users Paginate.
     *
     * @param  int|null $pagination
     * @param  boolean 0|1 $user_status_active
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers($pagination, $user_status_active);
    public function getUser($user_id);
    public function createUser($request);
    public function updateUser($user, $request);
    public function editUser($user_id);
    public function assignRole($user, $input_roles);
}
