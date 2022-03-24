<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\User\UserUpdatePictureRepositoryInterface;

class UserProfileImageController extends Controller
{
    private $userPictureInterface;

    public function __construct(UserUpdatePictureRepositoryInterface $userPictureInterface)
    {
        $this->userPictureInterface = $userPictureInterface;
    }
    public function uploadCropImage(Request $request)
    {
        return $this->userPictureInterface->updateUserPicture($request);
    }
}
