<?php

namespace Arcoders;

use Closure;
use ReflectionClass;
use ReflectionException;
use InvalidArgumentException;

class Container
{

    protected $bindings = [];
    protected $shared = [];

    public function bind($name, $resolver)
    {
        $this->bindings[$name] = [
            'resolver' => $resolver
        ];
    }

    public function instance($name, $object)
    {
        $this->shared[$name] = $object;
    }

    public function make($name)
    {
        if (isset ($this->shared[$name])) return $this->shared[$name];

        $resolver = $this->bindings[$name]['resolver'];

        $object = ($resolver instanceof Closure) ? $resolver($this) : $this->build($resolver);

        return $object;
    }

    public function build($name)
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("$name is not instantiable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) return new $name;

        $constructorParameters = $constructor->getParameters();

        $arguments = array();

        foreach ($constructorParameters as $constructorParameter) {

            try {
                $parameterClassName = $constructorParameter->getClass()->getName();
            } catch (ReflectionException $e) {
                throw new ContainerException("Unable to build [$name]: " . $e->getMessage(), null, $e);
            }

            $arguments[] = new $parameterClassName;
        }

        return $reflection->newInstanceArgs($arguments);

    }

}
