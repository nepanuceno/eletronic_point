<?php
namespace App\Repositories\User;

use App\Models\UserProfileImage;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\User\UserUpdatePictureRepositoryInterface;

class UserUpdatePictureRepository implements UserUpdatePictureRepositoryInterface
{
    private $userInterface;

    public function __construct(UserRepositoryInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    private function isOwnerPicture($user_id)
    {
        if (auth()->user()->id != $user_id) {
            return false;
        }
        return true;
    }

    private function getImageParts($image)
    {
        return explode(";base64,", $image);
    }

    private function imageDecode($image)
    {
        $image_parts = $this->getImageParts($image);
        return base64_decode($image_parts[1]);
    }

    private function namePicture()
    {
        return uniqid() . '.png';
    }

    private function makePathPicture($folderPath, $imageName)
    {
        return $folderPath.$imageName;
    }

    private function save($user_id, $imageName)
    {
        return UserProfileImage::updateOrCreate(
            ['user_id' => $user_id],
            ['name' => $imageName]
        );
    }

    private function deleteUserPicture($picturePath)
    {
        unlink($picturePath);
    }

    public function updateUserPicture($request)
    {
        if ($this->isOwnerPicture($request->user_id)) {
            $folderPath = public_path('storage/images/profiles_users_images/');
            $image_base64 = $this->imageDecode($request->image);
            $imageName = $this->namePicture();
            $imageFullPath = $this->makePathPicture($folderPath, $imageName);

            try {
                $user = $this->userInterface->getUser($request->user_id);
                $user_current_picture = $user->getProfilePicture;
                $this->save($request->user_id, $imageName);

                file_put_contents($imageFullPath, $image_base64);
                if ($user_current_picture) {
                    if (file_exists($folderPath.$user_current_picture->name)) {
                        $this->deleteUserPicture($folderPath.$user_current_picture->name);
                    }
                }
            } catch (\Throwable $th) {
                return response()->json(['status'=>'error', 'message'=> $th->getMessage()]);
            }

            return response()->json(['status'=>'success', 'message'=>__('users.succes_update_image')]);
        } else {
            return response()->json(['status'=>'error', 'message'=> __('app.unauthorize')]);
        }
    }
}
