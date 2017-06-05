<?php

use Arcoders\Container;

require(__DIR__.'/../bootstrap/start.php');

function studentController()
{
    $access = Container::getInstance()->access();

    if (! $access->check('students')) abort404();

    view('students', compact('access'));
}

return studentController();
