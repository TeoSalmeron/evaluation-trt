<?php

namespace App\Models;

use App\Models\Model;

class ConsultingModel extends Model 
{

    public function __construct()
    {
        $this->table = "consulting";
    }

}