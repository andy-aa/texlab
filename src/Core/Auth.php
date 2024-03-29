<?php

namespace Texlab\Core;


class Auth
{

    static public function registerUser($login, $pass)
    {
        $table = new AuthModel('users', Database::Link());

        if (($userGroup = $table->getUserData($login, $pass)) !== null) {
            $_SESSION['user'] = $userGroup;
            return true;
        }

        return false;
    }

    static public function unRegisterUser()
    {
        unset($_SESSION['user']);
    }

    static public function findAllControllers()
    {
        $ret = [];
        foreach (scandir('controllers') as $file) {
            if (preg_match("/(.*Controller)\.php$/", $file, $match)
                && !preg_match("/^Abstract.*/", $file)) {
                $ret[] = $match[1];
            }
        }

        sort($ret);

        return $ret;
    }

    static public function checkControllerPermit($className)
    {
        $permits = json_decode(
            file_get_contents(
                dirname(__FILE__) .
                '/permits.json'
            ),
            true);

        return !in_array(
            strtolower($className),
            array_map(
                'strtolower',
                $permits[($_SESSION['user']['cod'] ?? 'dft')]
            )
        );

    }

    static public function currentUserInfo()
    {
        return isset($_SESSION['user']) ? "{$_SESSION['user']['name']} {$_SESSION['user']['surname']} ({$_SESSION['user']['description']})" : '';
    }
}
