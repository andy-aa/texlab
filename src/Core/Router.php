<?php

namespace Texlab\Framework\Core;

//use Texlab\Framework\Controller\ErrorController;
use App\Controller\ErrorController;
use Texlab\Framework\View\View;
use Texlab\Route\Dispatcher;

class Router
{
    public $controllerName;
    public $actionName;

    public $dispatcher;

    public $view;

    public $config;

    public function __construct()
    {
        $this->dispatcher = new Dispatcher([
            'one' => 'TableOne/ShowTable'
        ]);

        $this->view = new View();

        $this->config = [
            'DEFAULT_CONTROLLER' => 'Site',
            'DEFAULT_ACTION' => 'home'
        ];

    }

    public function decodeUri()
    {
        $decodeUri = $this->dispatcher->decodeUri($_SERVER['REQUEST_URI']);

        if ($decodeUri !== null) {
            $handler = explode('/', $decodeUri['handler']);
            $this->controllerName = $handler[0] . 'Controller';
            $this->actionName = 'action' . $handler[1];
            $_GET = array_merge($_GET, $decodeUri['vars']);
        } else //if (isset($_GET['a']))
        {
            $this->controllerName = ($_GET['t'] ?? $this->config['DEFAULT_CONTROLLER']) . 'Controller';
            $this->actionName = 'action' . ($_GET['a'] ?? $this->config['DEFAULT_ACTION']);
//            $this->actionName = 'action' . $_GET['a'];
        }
    }


    public function run()
    {
        $this->decodeUri();

//        if (Auth::checkControllerPermit($this->controllerName)) {

        $className = "App\\Controller\\{$this->controllerName}";

        if (class_exists($className)) {

            $Controller = new $className($this->view);

            if (method_exists($Controller, $this->actionName)) {

                $Controller->{$this->actionName}();

            } else {

                // echo "нет такого метода: $this->methodName";
                (new ErrorController($this->view))->notFoundError("Not Found Action: {$this->actionName}");

            }
        } else {

//            echo "нет такого класса: $this->controllerName ($className)";
            (new ErrorController($this->view))->notFoundError("Not Found Controller: {$this->controllerName}");

        }
//        } else {
//            // echo "ошибка доступа";
//            (new ErrorController())->forbiddenController();
//        }
    }
}
