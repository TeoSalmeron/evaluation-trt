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
        if(!preg_match("/^[A-Za-z\é\è\ê\É\È\Ê-]+$/", $name)) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
    * Check if password is set
    * @return bool
    */
    public function verifyPassword(string $password): bool
    {
        if(empty($password) || !isset($password) || $password == "") {
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