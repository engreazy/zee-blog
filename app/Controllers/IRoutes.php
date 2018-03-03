<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:55 AM
 */
namespace Controllers;
Interface IRoutes
{
    public function getRoutes();
    public function getAuthenticator();
    public function checkPermission($permission);
}