<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\Hash;

class NewUserPasswordCreate
{
    const LENGTH_PASSWORD = 6;
    const START = -6;

    public static function generate()
    {
        $str_partil_pass = uniqid();
        return substr($str_partil_pass, self::START, self::LENGTH_PASSWORD);
    }
}
