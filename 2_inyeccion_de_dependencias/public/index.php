<?php

require(__DIR__.'/../bootstrap/start.php');

$data = array(
    'user_data' => array(
        'name' => 'Ismael Haytam',
        'role' => 'teacher'
    )
);

$driver = new \Arcoders\SessionArrayDriver($data);
$session = new \Arcoders\SessionManager($driver);
$auth = new \Arcoders\Authenticator($session);
$access = new \Arcoders\AccessHandler($auth);

view('index', compact('access'));
