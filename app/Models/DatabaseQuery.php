<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 8:13 AM
 */
namespace Models;
abstract class DatabaseQuery
{
    protected $dbc;

    /**
     * @param $sql
     * @param array $parameters
     * @return \PDOStatement
     */
    protected function query($sql, $parameters = [])
    {
        $this->dbc = DatabaseConnect::dbConnect();
        $result = $this->dbc->prepare($sql);
        $result->execute($parameters);
        return $result;
    }
}