<?php

use TexLab\MyDB\DB;
use TexLab\MyDB\Table;
use Texlab\Route\Dispatcher;

session_start();

include_once "../vendor/autoload.php";

$obj = new  Table('table1',DB::Link([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'mydb'
]));

print_r($obj->get());

new Dispatcher([]);