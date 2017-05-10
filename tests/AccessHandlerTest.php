<?php

use PHPUnit\Framework\TestCase;
use Arcoders\AccessHandler as Access;

class AccessHandlerTest extends TestCase
{

    public function test_grant_access()
    {
        $this->assertTrue(Access::check('admin'));
    }

    public function test_deny_access()
    {
        $this->assertFalse(Access::check('editor'));
    }

}
