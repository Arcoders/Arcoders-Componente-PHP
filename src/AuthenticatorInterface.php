<?php

namespace Arcoders;

interface AuthenticatorInterface
{


    /**
    * @return boolean
    */
    public function check();

    /**
    * @return \Arcoders\User
    */
    public function user();

}
