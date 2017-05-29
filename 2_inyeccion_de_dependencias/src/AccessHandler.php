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

    public function check($roles)
    {
        if (!is_array($roles)) {
            $roles = explode('|', $roles);
        }
        return $this->auth->check() && in_array($this->auth->user()->role, $roles);
    }

}
