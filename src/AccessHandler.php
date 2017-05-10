<?php

namespace Arcoders;

use Arcoders\Authenticator as Auth;

class AccessHandler
{

    public static function check($role)
    {
        return Auth::check() && Auth::user()->role === $role;
    }

}
