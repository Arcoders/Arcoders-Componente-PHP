<?php

require(__DIR__.'/../vendor/autoload.php');

class_alias('Arcoders\AccessHandler', 'Access');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
