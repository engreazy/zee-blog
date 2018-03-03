<?php
/**
 * This class validates users input
 * currently, only empty fields are checked
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 10:48 PM
 * This validator only checks for empty fields
 */
namespace Controllers;
class Validator
{
    /**
     * validates user's entry against empty fields
     * returns the name of all blank fields
     * @param array $fields
     * @return string
     */
    protected function formValidator($fields = [])
    {
        $errors = [];
        foreach ($fields as $fieldname => $value)
        {
            if(!isset($fieldname) || empty($value)){
                if($fieldname !== 'id' && $fieldname !== 'dateposted'){
                    $errors[] = $fieldname;
                }

            }
        }
        $errorFields = implode(', ',$errors);
        $errorFields = rtrim($errorFields);
        return $errorFields;
    }
}