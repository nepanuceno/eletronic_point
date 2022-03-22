<?php
namespace App\Repositories\Interfaces\User;

interface UserUpdatePictureRepositoryInterface
{
    /**
     * Save User Profile Picture.
     *
     * @param  request
     * @return \Illuminate\Http\Response
     */
    public function userUpdatePicture($user_id);
}
