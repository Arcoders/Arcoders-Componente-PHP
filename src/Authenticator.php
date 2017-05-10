<?php

namespace Arcoders;

use Arcoders\SessionManager as Session;

class Authenticator
{

    /**
    * @var \Arcoders\SessionManager
    */

    protected $session;

    protected $user;

    /**
    * @param \Arcoders\SessionManager $session
    */

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function check()
    {
        return $this->user() != null;
    }

    public function user()
    {
        if ($this->user != null) return $this->user;

        $data = $this->session->get('user_data');

        if (!is_null($data)) return $this->user = new User($data);

        return null;
    }

}
