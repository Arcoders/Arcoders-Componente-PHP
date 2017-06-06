<?php

namespace Arcoders;

use Closure;

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

        $object = ($resolver instanceof Closure) ? $resolver($this) : new $resolver;

        return $object;
    }

}
