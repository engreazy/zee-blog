<?php
/**
 * Created by PhpStorm.
 * User: engr easy
 * Date: 1/24/2018
 * Time: 2:34 AM
 */
namespace Controllers;
use Models\DatabaseAlgorithm;

class Authenticator
{
    private $user;
    private $email;
    private $password;

    /**
     * Authenticator constructor.
     * @param DatabaseAlgorithm $user
     * @param $email
     * @param $password
     */
    public function __construct(DatabaseAlgorithm $user, $email, $password)
    {
        session_start();
        $this->user = $user;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @param $userEmail
     * @param $userPassword
     * @return bool
     */
    public function login($userEmail, $userPassword)
    {
        $user = $this->getUserDetails($userEmail);

        if (!empty($user) && password_verify($userPassword,$user[0]->{$this->password})){
            //log user in
            $_SESSION['username'] = $userEmail;
            $_SESSION['password'] = $user[0]->{$this->password};
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return bool
     */
    public function checkAccess()
    {
        if(empty($_SESSION['username'])){
            return false;
        }
        $user = $this->getUserDetails($_SESSION['username']);
        $_SESSION['firstname'] = $user[0]->firstname;
        return !empty($user) && $user[0]->{$this->password} === $_SESSION['password'] ? true:false;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        if($this->checkAccess()){
            return $this->getUserDetails($_SESSION['username']);
        }
    }

    public function getUserDetails($username)
    {
        $email = [$this->email,strtolower($username)];
        return $this->user->findData($email);
    }
}