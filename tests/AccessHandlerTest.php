<?php

use PHPUnit\Framework\TestCase;
use Arcoders\AccessHandler as Access;
use Arcoders\Authenticator as Auth;
use Arcoders\SessionManager as Session;
use Arcoders\SessionFileDriver;

class AccessHandlerTest extends TestCase
{

    public function test_grant_access()
    {
        $driver = new SessionFileDriver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertTrue($access->check('admin'));
    }

    public function test_deny_access()
    {
        $driver = new SessionFileDriver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);

        $this->assertFalse($access->check('editor'));
    }

}
