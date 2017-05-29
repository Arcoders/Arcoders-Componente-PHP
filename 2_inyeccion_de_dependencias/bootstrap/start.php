<?php

require(__DIR__.'/../vendor/autoload.php');

class_alias('Arcoders\AccessHandler', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

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
