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

    public static function getFormSession($key)
    {
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function clearSession($session)
    {
        if (is_array([$session])) {
            foreach ($session as $key) {
                unset($_SESSION[$key]);
            }
        }
        unset($_SESSION['$session']);
    }
}