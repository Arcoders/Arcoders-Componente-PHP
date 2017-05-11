<?php

use PHPUnit\Framework\TestCase;
use Arcoders\AccessHandler as Access;
use Arcoders\SessionArrayDriver;
use Arcoders\Stubs\AuthenticatorStub;

class AccessHandlerTest extends TestCase
{

    public function test_grant_access()
    {

        $auth = new AuthenticatorStub();
        $access = new Access($auth);

        $this->assertTrue($access->check('admin'));

    }

    public function test_deny_access()
    {

        $auth = new AuthenticatorStub();
        $access = new Access($auth);

        $this->assertFalse($access->check('editor'));

    }

}
