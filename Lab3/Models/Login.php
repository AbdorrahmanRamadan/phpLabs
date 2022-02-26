<?php

class Login
{
    static function check_login(): bool
    {
        if (isset($_SESSION["userid"]) && is_numeric($_SESSION["userid"])) {
            return true;
        } elseif (isset($_COOKIE["remember_me"]) && $_COOKIE["remember_me"] == correct_token) {
            $_SESSION["userid"] = rand(0, 1000);
            return true;
        } else {
            return false;
        }
    }

    static function authenticate($entered_username, $entered_password, $remember_me = true): bool
    {
        if ($entered_username == correct_username && $entered_password == correct_password) {
            if ($remember_me) self::Remember();
            return true;
        } else {
            return false;
        }

    }

    static function Remember()
    {
        setcookie("remember_me", "dcfsvcbncycvebnwjbyevteycbnwjxinbcyvvtewbnjxhbcyveybwnxucbgvryghnewiuygrvghnejwicgyvrhnejgyvrghnejwirgyvhnjwiuhcbegyvebn", 0);
    }
}