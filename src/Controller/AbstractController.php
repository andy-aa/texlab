<?php

namespace Texlab\Framework\Controller;

use ReflectionClass;
use Texlab\Framework\View\ViewInterface;

abstract class AbstractController
{
    use AuthTrait;

    protected $view;
    protected $viewLayout;
    protected $viewPatternsPath;

    public function __construct(ViewInterface $view)
    {
        $this->view = $view;

//        echo $this->viewLayout;

//        if ($this->view instanceof View) {
        $this->view
            ->setLayout($this->viewLayout)
            ->setPatternsPath($this->viewPatternsPath);
//        }

    }

    public function render($viewName, $viewData = [])
    {
        $this->view->render($viewName, $viewData);
    }

    public function redirect($location)
    {
        header("Location: " . $location);
        exit();
    }

    public function accessDenied()
    {
        header('HTTP/1.0 403 Forbidden');
    }

    public function notFound()
    {
        header("HTTP/1.0 404 Not Found");
    }

    public function redirectToRoot()
    {
        $this->redirect(pathinfo($_SERVER['REQUEST_URI'])['dirname']);
    }

    public function shortClassName()
    {
        return strtolower(
            preg_replace(
                '/Controller$/',
                '',
                (new ReflectionClass($this))->getShortName()
            )
        );
    }

    public function shortCurrentActionName()
    {
        return strtolower(
            preg_replace(
                '/^action/',
                '',
                debug_backtrace()[1]['function']
            )
        );
    }

}
