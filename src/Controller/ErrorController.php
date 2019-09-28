<?php

namespace Texlab\Framework\Controller;


class ErrorController extends AbstractController
{
    //public $viewLayout = Conf::DEFAULT_PLAIN_LAYOUT;

    public function forbiddenController()
    {
        $this->accessDenied();

        $this->render("error", [
            'text' => 'Access Denied'
        ]);

        exit();
    }

    public function notFoundError($text)
    {
        $this->notFound();

        $this->render("error", [
            'text' => $text
        ]);

        exit();

    }

}
