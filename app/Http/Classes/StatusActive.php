<?php
namespace App\Http\Classes;

class StatusActive
{
    const ACTIVE=1;
    const DEACTIVE=0;

    /**
     * Set a newly status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return booblean 0|1
     */
    public static function setStatusActive(&$request){
        if (!isset($request->status) || $request->status==self::ACTIVE) {
            return $request=self::DEACTIVE;
        }
        else if ($request->status == self::DEACTIVE) {
            return $request=self::ACTIVE;
        }
    }
}
