<?php
namespace App\Http\Classes;

class UserStatusActive
{
     /**
     *
     * Set Status User Session.
     *
     * @param null
     * @return null
     */
    public static function setUserStatusActive() {
        if (session()->has('active')) {
            $status = session('active');
            session()->forget('active');
            session(['active' => !$status]);
        } else {
            session(['active' => false]);
        }
    }

     /**
     * Get Status User.
     *
     * @param null
     * @return boolean
     */
    public static function getUserStatusActive() {
        if (session()->has('active')) {
            return session('active');
        }
        return true;
    }


    public static function changeStatus($user) {
        if($user->active === 1) {
            $user->active = 0;
        } else {
            $user->active = 1;
            self::setUserStatusActive();
        }
    }
}
