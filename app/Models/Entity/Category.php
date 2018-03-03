<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/25/2018
 * Time: 10:45 AM
 */
namespace Models\Entity;
use Models\DatabaseAlgorithm;

class Category
{
    public $id;
    public $name;
    private  $postTable;


    /**
     * Category constructor.
     * @param DatabaseAlgorithm $postTable
     */
    public function __construct(DatabaseAlgorithm $postTable)
    {
        $this->postTable = $postTable;
    }

}