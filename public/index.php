<?php

use Texlab\Framework\Core\Router;

session_start();

include_once "../vendor/autoload.php";




(new Router())->run();