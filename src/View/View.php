<?php

namespace Texlab\View;

class  View implements ViewInterface
{
    public $viewName;
    public $viewData;
    public $layout;
    public $patternsPath;

    public function setLayout($layout): View
    {
        $this->layout = $layout;
        return $this;
    }

    public function setPatternsPath($patternsPath): View
    {
        $this->patternsPath = $patternsPath;
        return $this;
    }

    public function render($viewName, $viewData = [])
    {
        $this->viewName = $viewName;
        $this->viewData = $viewData;

        extract($this->viewData);
//        echo '123'.$this->layout;
//        var_dump($this);

        include __DIR__ . "/../../$this->layout";
    }

    public function body()
    {
        extract($this->viewData);
        include __DIR__ . "/../../{$this->patternsPath}{$this->viewName}.php";
    }
}
