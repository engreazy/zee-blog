<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:54 AM
 */
namespace Models;
class DatabaseConnect implements  IConnect
{
    private static $server = IConnect::DB_HOST;
    private static $dbName = IConnect::DB_NAME;
    private static $dbUser = IConnect::DB_USER;
    private static $dbPass = IConnect::DB_PASS;
    private static $dbc;

    /**
     * @return \PDO
     */
    public static function dbConnect()
    {
        // TODO: Implement dbConnect() method.
            try{
                $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
                self::$dbc = @new \PDO('mysql:host='.self::$server.';dbname='.self::$dbName.'',self::$dbUser,self::$dbPass,$pdo_options);
                return self::$dbc;
            }
            catch (\PDOException $e)
            {
                echo "<strong>Database Connection Failed</strong>".$e->getMessage()."<br/>";
                //uncomment for debugging purpose
                //echo <strong>On Line</strong>".$e->getLine()."<br/>";
                //echo <strong>In File</strong>".$e->getFile()."<br/>";
            }
    }
}