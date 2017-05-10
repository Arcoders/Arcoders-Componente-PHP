<?php

namespace Arcoders;

class AccessHandler
{

    public static function check($role)
    {
        return 'admin' === $role;
    }

}
