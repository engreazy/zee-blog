<?php
/**
 * All Database Management is handled by this class
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:56 AM
 */
namespace Models;
class DatabaseAlgorithm extends DatabaseQuery
{
    private $tableName;
    private $id;
    private $className;
    private $constructorArgs;

    /**
     * DatabaseAlgorithm constructor.
     * @param $tableName
     * @param $id
     * @param string $className
     * @param array $constructorArgs
     */
    public function __construct($tableName, $id, $className='\stdClass', Array $constructorArgs = [])
    {
        $this->tableName = $tableName;
        $this->id = $id;
        $this->className = $className;
        $this->constructorArgs = $constructorArgs;
    }

    /**
     * @return mixed
     */
    public function total()
    {
        $query = $this->query('SELECT COUNT(*) FROM `'.$this->tableName.'`');
        $row = $query->fetch();
        return $row[0];
    }

    /**
     * @param array $data
     */
    public function dataEntry(Array $data)
    {

        $sql = 'INSERT INTO `'.$this->tableName.'`(';
        foreach ($data as $key => $value){
            if ($key =='dateposted') {
                $data[$key] = date("Y/m/d");
            }
            $sql .='`'.$key.'`,';
        }
        $sql = rtrim($sql,',');
        $sql .= ') VALUES (';

        foreach ($data as $key => $value){
            $sql .= ':'.$key.',';
        }
        $sql = rtrim($sql,',');
        $sql .= ')';

        $this->query($sql,$data);
        return  $this->dbc->lastInsertId();
    }

    /**
     * @param null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function displayData($orderBy = null, $limit = null, $offset = null)
    {
        $sql = "SELECT *
                FROM $this->tableName";
        if($orderBy !== null){
            $sql .= ' ORDER BY '.$orderBy;
        }
        if($limit !== null){
            $sql .=' LIMIT '.$limit;
        }
        if ($offset !== null){
            $sql .=' OFFSET '.$offset;
        }

        $result = $this->query($sql);

        return  $result->fetchAll(\PDO::FETCH_CLASS,$this->className,$this->constructorArgs);

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function findDataById(Array $data)
    {
        $parameters = [':id'=>$data];
        $sql ="SELECT *
            FROM $this->tableName
            WHERE `".$this->id."` =:id";
        $result = $this->query($sql,$parameters[':id']);
        return $result->fetchObject($this->className,$this->constructorArgs);
    }

    /**
     * @param array $data
     * @param null $orderBy
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findData(Array $data, $orderBy = null, $limit = null, $offset = null)
    {
        $column = $data[0];
        $value = $data[1];

        $parameters = [':value'=>$value];
        $sql ="SELECT *
            FROM $this->tableName
            WHERE $column = :value";

        if ($orderBy !== null){
            $sql .=" ORDER BY ".$orderBy;
        }
        if($limit !== null){
            $sql .=" LIMIT ".$limit;
        }
        if($offset !==null ){
            $sql .=" OFFSET ".$offset;
        }

        $result = $this->query($sql,$parameters);
        return $result->fetchAll(\PDO::FETCH_CLASS,$this->className,$this->constructorArgs);

    }

    /**
     * @param array $data
     */
    public function removeData(Array $data)
    {
        $parameters = ['id'=>$data];
        $sql = "DELETE FROM `".$this->tableName."` WHERE `".$this->id."` = :id";
        $this->query($sql,$parameters['id']);
    }

    /**
     * @param array $data
     */
    public function updateData(Array $data)
    {
        foreach ($data as $key => $value)
        {
            if ($key =='dateposted') {
                $data[$key] = date("Y/m/d");
            }
        }
        $sql = ' UPDATE `'.$this->tableName.'` SET';
        foreach ($data as $key => $value) {
            $sql .='`'.$key.'` =:'.$key.',';
        }
        $sql = rtrim($sql,',');
        $sql .=' WHERE id ='.$data['id'];
        $this->query($sql,$data);
    }

    /**
     * handles insert/update action
     * @param $data
     */
    public function saveData($data)
    {
        if(!$data['id']){
            $data['id'] = null;
            $this->dataEntry($data);
        }else{
            $this->updateData($data);
        }
    }
}