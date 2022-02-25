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
            session(['active' => true]);
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
}
