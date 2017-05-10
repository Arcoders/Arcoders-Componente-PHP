<?php

namespace Arcoders;

class SessionManager
{

    protected $data = array();
    protected $driver;

    public function __construct(SessionFileDriver $driver)
    {
        $this->driver = $driver;

        $this->load();
    }

    protected function load()
    {
        $this->data = $this->driver->load();
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }

}
