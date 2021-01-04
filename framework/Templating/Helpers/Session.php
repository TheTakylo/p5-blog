<?php

use Framework\Session\SessionManager;

class Session
{

    static function has($item)
    {
        return (new SessionManager())->has($item);
    }

    static function get($item)
    {
        return (new SessionManager())->get($item);
    }

    static function isLogged()
    {
        return self::has('user');
    }

    static function isAdmin()
    {
        return self::isLogged() && self::get('user')->getIs_admin() === 1;
    }

}
