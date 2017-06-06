<?php

use PHPUnit\Framework\TestCase;
use Arcoders\Container;

class ContainerTest extends TestCase
{

    public function test_bind_from_closure()
    {
        $container = new Container();

        $container->bind('key', function() {
            return 'Object';
        });

        $this->assertSame('Object', $container->make('key'));
    }

    public function test_bind_instance()
    {
        $container = new Container();

        $stdClass = new StdClass();

        $container->instance('key', $stdClass);

        $this->assertSame($stdClass, $container->make('key'));
    }

    public function test_bind_from_class_name()
    {
        $container = new Container();

        $container->bind('key', 'StdClass');

        $this->assertInstanceOf('StdClass', $container->make('key'));
    }

    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();

        $container->bind('arc', 'Arc');

        $this->assertInstanceOf('Arc', $container->make('arc'));
    }

}

// ------------------------------------------------------------------

class Arc
{

    public function __construct(Coders $coders)
    {

    }

}

class Coders
{
    // ...
}
