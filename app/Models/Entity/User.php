<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/24/2018
 * Time: 1:34 AM
 */
namespace Models\Entity;
use Models\DatabaseAlgorithm;

class User
{
    const EDIT_POST = 1;
    const DELETE_POST = 2;
    const LIST_CATEGORIES = 4;
    const EDIT_CATEGORIES = 8;
    const REMOVE_CATEGORIES = 16;
    const EDIT_USER_ACCESS = 32;
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    private $postTable;
    private $permissions;

    /**
     * User constructor.
     * @param DatabaseAlgorithm $postTable
     */
    public function __construct(DatabaseAlgorithm $postTable)
    {
        $this->postTable = $postTable;
    }

    /**
     * @param $permission
     * @return int
     */
    public function hasPermission($permission){
        return $this->permissions & $permission;
    }

    /**
     * @param $post
     */
    public function addPost($post)
    {
        $post['userid'] = $this->id;
        $this->postTable->saveData($post);
    }

    public function getPost()
    {
        $postId = ['userid',$this->id];
        return  $this->postTable->findData($postId);
    }
}