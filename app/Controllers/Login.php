<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/24/2018
 * Time: 10:23 AM
 */
namespace Controllers;
class Login
{
    private $authenticator;

    /**
     * Login constructor.
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @return array
     */
    public function loginError()
    {
        return ['template'=>'loginerror.html.php','title'=>'Login Error'];
    }

    /**
     *
     */
    public function loginForm()
    {
        return ['template'=>'login.html.php','title'=>'Log In'];
    }

    public function processLogin()
    {
        if($this->authenticator->login($_POST['email'],$_POST['password']))
        {
            header('location:?route=user/dashboard');
            exit();
        }else{
            return ['template'=>'login.html.php','title'=>'Log In',
                'variables'=>[
                    'msg'=>'Invalid email or password',
                    'class'=>'warning'
                ]
            ];
        }
    }

    public function logout()
    {
        session_destroy();
        $_SESSION = [];
        return ['template'=>'home.html.php','title'=>'Zee Blog'];
    }
}