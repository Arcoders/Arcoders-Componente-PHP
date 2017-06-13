<?php

use PHPUnit\Framework\TestCase;
use Arcoders\{Container, ContainerException};

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

    /**
     * @expectedException Arcoders\ContainerException
     * @expectedExceptionMessage Unable to build [Asus]: Class Rog does not exist
     */
    public function test_expected_container_exeption_if_dependency_does_not_exist()
    {
        $container = new Container();

        $container->bind('asus', 'Asus');

        $container->make('asus');
    }

    public function test_container_make_with_arguments()
    {
        $container = new Container();

        $this->assertInstanceOf(
            MailServ::class,
            $container->make('MailServ', [
                'url' => 'arcoders.org',
                'key' => 'secret'
            ])
        );
    }

}

// ------------------------------------------------------------------
class MailServ {

    private $url;
    private $key;

    public function __construct($url, $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

}
// ------------------------------------------------------------------

class Arc
{

    public function __construct(Coders $coders, Meknas $meknas)
    {

    }

}

class Coders
{
    // ...
}

class Meknas
{
    // ...
}

class Asus
{

    public function __construct(Rog $Gamer)
    {

    }

}
