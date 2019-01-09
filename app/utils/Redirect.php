<?php

namespace App\Utils;

class Redirect
{
    public static function route($path, $session = [])
    {
        if (count($session) > 0) {
            foreach ($session as $key => $value) {
                Session::setSession($key, $value);
            }
        }
        return header("location:$path");
    }
}