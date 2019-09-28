<?php

namespace App\Controller;

use Texlab\Controller\AbstractController;

class  SiteController extends AbstractController
{
    protected $viewLayout = 'templates/_layouts/mainLayout.php';
    protected $viewPatternsPath = 'templates/site/';

    public function actionAbout()
    {
        $this->render("about", [
            'title' => "About",
            'about' => ""
        ]);
    }

    public function actionHome()
    {
        $this->render("home", [
            'title' => "Home"
        ]);
    }
}
