<?php

namespace App\Models;

use App\Models\UsersModel;

class AdministratorModel extends UsersModel 
{

    public function __construct()
    {
        $this->table = "administrator";
    }

}