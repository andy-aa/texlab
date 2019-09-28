<?php

namespace Texlab\Framework\Controller;


use Texlab\Framework\Core\Auth;

trait AuthTrait
{
    public function actionLoginForm()
    {
        $this->render("loginform", [
            'loginURL' => '?t=' . $this->shortClassName() . '&a=login'
        ]);
    }

    public function actionLogin()
    {
        if (Auth::registerUser($_POST['user'], $_POST['pass'])) {
            $this->redirectToRoot();
        } else {
            $this->redirect('?a=loginform');
        }

    }

    public function actionLogout()
    {
        Auth::unRegisterUser();
        $this->redirectToRoot();
    }
}
