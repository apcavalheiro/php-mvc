<?php

namespace App\Utils;

class Session
{
    public static function setSession($session, $value)
    {
        $_SESSION[$session] = $value;
    }

    public static function getSession($session)
    {
        if (isset($_SESSION[$session])) {
            return $_SESSION[$session];
        }
        return false;
    }

    public static function unsetSession($session)
    {
        if (is_array[$session]) {
            foreach ($session as $key) {
                unset($_SESSION[$key]);
            }
        }
        unset($_SESSION[$session]);
    }
}
