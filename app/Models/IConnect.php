<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:55 AM
 */
namespace Models;
Interface IConnect
{
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_NAME = "zeeblog";

    /**
     * @return mixed
     */
    public static function dbConnect();

}