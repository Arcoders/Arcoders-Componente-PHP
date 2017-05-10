<?php

namespace Arcoders;

use Arcoders\Authenticator as Auth;

class AccessHandler
{
    /**
    * @var \Arcoders\Authenticator
    */

    protected $auth;

    /**
    * @param \Arcoders\Authenticator $auth
    */

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function check($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}
