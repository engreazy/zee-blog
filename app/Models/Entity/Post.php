<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 10:52 AM
 */
namespace Models\Entity;
use Models\DatabaseAlgorithm;

class Post
{
    public $id;
    public $categoryid;
    public $userid;
    public $title;
    public $content;
    public $dateposted;
    private $userTable;
    private $categoryTable;
    private $user;
    private $category;

    /**
     * Post constructor.
     * @param DatabaseAlgorithm $userTable
     * @internal param DatabaseAlgorithm $categoryTable
     */
    public function __construct(\Models\DatabaseAlgorithm $userTable,DatabaseAlgorithm $categoryTable)
    {
        $this->userTable = $userTable;
        $this->categoryTable = $categoryTable;
    }

    /**
     *
     */
    public function getUser()
    {
        $userId = ['id'=>$this->userid];
        if (empty($this->user)){
            $this->user = $this->userTable->findDataById($userId);
        }
        return $this->user;
    }

    /**
     *
     */
    public function getCategory()
    {
        $categoryId = ['id'=>$this->categoryid];
        if(empty($this->category)){
            $this->category = $this->categoryTable->findDataById($categoryId);
        }
        return $this->category;
    }

}