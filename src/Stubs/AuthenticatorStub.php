<?php

namespace Arcoders\Stubs;

use Arcoders\AuthenticatorInterface;
use Arcoders\User;

class AuthenticatorStub implements AuthenticatorInterface
{

    /**
    * @var
    */
    private $logged;

    public function __construct($logged = true)
    {
        $this->logged = $logged;
    }

    public function check()
    {
        return $this->logged;
    }

    public function user()
    {
        return new User([
            'role' => 'admin'
        ]);
    }

}
