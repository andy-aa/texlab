<?php

namespace Texlab\Framework\View;

interface ViewInterface
{
    public function setLayout($layout): View;

    public function setPatternsPath($patternsPath): View;

    public function render($viewName, $viewData = []);

    public function body();
}