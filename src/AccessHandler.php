<?php

namespace Arcoders;

class AccessHandler
{
    /**
    * @var \Arcoders\AuthenticatorInterface
    */

    protected $auth;

    /**
    * @param \Arcoders\AuthenticatorInterface $auth
    */

    public function __construct(AuthenticatorInterface $auth)
    {
        $this->auth = $auth;
    }

    public function check($role)
    {
        return $this->auth->check() && $this->auth->user()->role === $role;
    }

}