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

    public function make($name, array $arguments = array())
    {
        if (isset ($this->shared[$name])) return $this->shared[$name];

        $resolver = (isset ($this->bindings[$name])) ? $this->bindings[$name]['resolver'] : $name;

        $object = ($resolver instanceof Closure) ? $resolver($this) : $this->build($resolver, $arguments);

        return $object;
    }

    public function build($name, array $arguments = array())
    {
        $reflection = new ReflectionClass($name);

        if(!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("$name is not instantiable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) return new $name;

        $constructorParameters = $constructor->getParameters();

        $dependencies = array();

        foreach ($constructorParameters as $constructorParameter) {

            $ParameterName = $constructorParameter->getName();

            if (isset ($arguments[$ParameterName])) {
                $dependencies[] = $arguments[$ParameterName];
                continue;
            }

            try {
                $parameterClass = $constructorParameter->getClass();
            } catch (ReflectionException $e) {
                throw new ContainerException("Unable to build [$name]: " . $e->getMessage(), null, $e);
            }

            if ($parameterClass != null) {
                $parameterClassName = $parameterClass->getName();
                $dependencies[] = $this->build($parameterClassName);
            } else {
                throw new ContainerException("Please provide the value of the parameter [$ParameterName]");
            }

        }

        return $reflection->newInstanceArgs($dependencies);

    }

}
