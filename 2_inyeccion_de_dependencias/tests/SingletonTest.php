<?php

use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase
{

    public function test_singleton_instance()
    {
        $this->assertInstanceOf(GreeterExp::class, GreeterExp::getInstance());
    }

    public function test_singleton_creates_only_one_instance()
    {
        $this->assertSame(
            GreeterExp::getInstance(),
            GreeterExp::getInstance()
        );
    }

    public function test_welcome_known_users()
    {
        $greeter = new GreeterExp('Arcoders');

        $this->assertSame('Bienvenido Arcoders', $greeter->welcome());
    }

    public function test_welcome_guest_users()
    {
        $greeter = new GreeterExp();

        $this->assertSame('Bienvenido Invitado', $greeter->welcome());
    }

}

// ------------------------------------------------------------------

class GreeterExp
{

    private static $instance;
    protected $name = 'Invitado';

    public function __construct($name = null)
    {
        if ($name != null) $this->name = $name;
    }

    public static function getInstance($name = null)
    {
        if (static::$instance == null) static::$instance = new GreeterExp($name);

        return static::$instance;
    }

    public function welcome()
    {
        return 'Bienvenido ' . $this->name;
    }

}
