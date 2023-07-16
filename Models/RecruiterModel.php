<?php

namespace App\Models;

use App\Models\Model;

class RecruiterModel extends Model 
{
    private string $company_name;

    public function __construct()
    {
        $this->table = "recruiter";
    }

    /**
     * Get the value of company_name
     */ 
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @return  self
     */ 
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }
}