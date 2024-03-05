<?php

// run php -S localhost:8080 -t public

require_once __DIR__.'/../vendor/autoload.php';

use Kuri\Doctrine\Router;

session_start();

new Router();




