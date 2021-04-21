<?php

require 'vendor/autoload.php';
use Src\app\routing\Dispatcher;

$segments = explode('/', $_SERVER['REQUEST_URI']);
(new Dispatcher())->dispatch($segments);