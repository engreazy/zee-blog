<?php
/**
 * This controller is responsible
 * for user management
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:55 PM
 */
namespace Controllers;
use Models\DatabaseAlgorithm;

class Register extends Validator
{
    private $usersTable;

    public function __construct(DatabaseAlgorithm $usersTable)
    {
        $this->usersTable = $usersTable;
    }

    /**
     * displays form for creating a new user
     */
    public function addUser()
    {
       $title = 'Add User';
       return ['template'=>'user.html.php','title'=>$title];
    }

    /**
     * adds/updates a user info
     * @return array
     */
    public function registerUser()
    {
        $userInfo = $_POST;
        $title = 'create an account';

        if (empty($this->formValidator($userInfo))){
            if (!$_POST['id']){
                //secure user password
                $userInfo['password'] = password_hash($userInfo['password'],PASSWORD_DEFAULT);
                $this->usersTable->dataEntry($userInfo);
                header('location:?route=account/success');
            }else{
                $this->editUser($userInfo);
            }
        }else{
            $userInfo['msg'] = $this->formValidator($userInfo).' cannot be blank';
            $userInfo['class'] = 'warning';
            return ['template'=>'user.html.php','title'=>$title,'variables'=>$userInfo];
        }

    }

    /**
     * displays success confirmation message on successful creation of a new user account
     * @return array
     */
    public function accountSuccess()
    {
        $title = 'Account Successful';
        return ['template'=>'account.html.php','title'=>$title];
    }

    /**
     * displays dashboard to the logged in user
     * @return array
     */
    public function dashBoard()
    {
        $title = 'Dashboard';
        return ['template'=>'dashboard.html.php','title'=>$title];
    }

    /**
     * displays the contact us page to blog visitors
     * @return array
     */
    public function sendMessage()
    {
        $title ='contact us';
        return ['template'=>'contact.html.php','title'=>$title];
    }

    /**
     * sends email to an admin of zee blog on enquiry made by a user
     * @return array
     */
    public function sendMail()
    {
        $mail = $_POST;
        $title ='contact us';
        if (empty($this->formValidator($mail))){

            $admin = 'admin@zeeblog.com';
            $subject = 'enquiry from zee blog';

            $emailSender = new EmailSender();
            $emailSender->send($admin,$subject,$mail['email'],$mail['message'],$mail['name']);
            $mail['msg'] = 'mail sent successfully';
            $mail['class'] = 'success';
            return ['template'=>'contact.html.php','title'=>$title,'variables'=>$mail];
        }else{
            $mail['msg'] = $this->formValidator($mail).' cannot be blank';
            $mail['class'] = 'warning';
            return ['template'=>'contact.html.php','title'=>$title,'variables'=>$mail];
        }

    }

    /**
     * displays list of all registered users
     * @return array
     */
    public function userList()
    {
        $page = isset($_GET['page'])?$_GET['page']:1;
        $offset =($page - 1)*10;//calculate the number of pages to offset

        $users = $this->usersTable->displayData(null,10,$offset);
        $totalUsers = $this->usersTable->total();
        //calculate the number of pages
        $numPages = ceil($totalUsers/10);
        return['template'=>'userlist.html.php','title'=>'User List',
            'variables'=>[
                'users'=>$users,
                'totalUsers'=>$totalUsers,
                'numPages'=>$numPages,
                'currentPage'=>$page
            ]
        ];
    }
    /**
     *deletes an user
     */
    public function removeUser()
    {
        $parameters = ['id'=>$_POST['id']];
        $this->usersTable->removeData($parameters);
        header("Location:?route=user/view");
    }

    /**
     *displays page for managing access control to admin
     */
    public function permissions()
    {
        $parameters = ['id'=>$_GET['id']];
        $user = $this->usersTable->findDataById($parameters);

        $reflected = new \ReflectionClass('\Models\Entity\User');
        $constants = $reflected->getConstants();

        return ['template'=>'permissions.html.php','title'=>'Edit Permissions',
            'variables'=>[
                'user'=>$user,
                'permissions'=>$constants
            ]
        ];

    }

    /**
     *updates a user permission
     */
    public function savePermissions()
    {
        $user = [
            'id'=>$_GET['id'],
            'permissions'=> array_sum($_POST['permissions']?$_POST['permissions']:[])
        ];
        $this->usersTable->saveData($user);
        header('location:?route=user/view');
    }
}