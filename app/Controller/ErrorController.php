<?php

namespace App\Controller;


class ErrorController extends \Texlab\Controller\ErrorController
{
    protected $viewLayout = 'templates/_layouts/plainLayout.php';
    protected $viewPatternsPath = 'templates/site/';
}