<?php

namespace App\Core;

class Form
{
    /**
    * This class is used to check form inputs
    */

    /**
    * Check if e-mail is set and valid
    * @return bool
    */
    public function verifyEmail(string $email): bool
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "" || empty($email) || !isset($email)) {
            return false;
        } else {
            return true;
        }
    }

    /**
    * Check if name is set and valid
    * @return bool
    */
    public function verifyName(string $name): bool 
    {
        if(!preg_match("/^\p{Latin}+$/u", $name)) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
    * Check if password is set
    * @return bool
    */
    public function issetFormItem($item): bool
    {
        if(empty($item) || !isset($item) || $item == "" || is_null($item)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Check if password respect rules
     * @return bool
     */
    public function verifyPasswordFormat(string $password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $special_chars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$special_chars || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Check if passwords are similar
     * @return bool
     */
    public function verifySimilarPasswords(string $password_1, string $password_2)
    {
        if($password_1 !== $password_2) {
            return false;
        } else {
            return true;
        }
    }
}