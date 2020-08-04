<?php
/**
 * This is the single entry point for the blog.
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:49 AM
 */
try{
    /**
     * @param $className
     */
    function autoloader($className)
    {
        $fileName = str_replace('\\','/',$className).'.php';
        /** @noinspection PhpIncludeInspection */
        include __DIR__.'/app/'.$fileName;
    }
    //spl_autoload_register('autoloader');
    require_once __DIR__ . "/vendor/autoload.php";
    $route = isset($_GET['route'])?$_GET['route']:'zee/home';

    $zeeRouter = new \Controllers\ZeeRouter($route,$_SERVER['REQUEST_METHOD'],new \Controllers\ZeeRoutes());
    $zeeRouter->run();
    //uncomment for debugging purpose
    //print_r($_REQUEST);
    //print_r($_SERVER['REQUEST_METHOD']);

}catch (Exception $exception)
{
    $title = 'An error has occured';
    $output = 'Error: '.$exception->getMessage().' in '.$exception->getFile().' : '.$exception->getLine();
}