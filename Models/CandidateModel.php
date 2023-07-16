<?php

namespace App\Models;

use App\Models\Model;

class CandidateModel extends Model 
{
    private string $first_name;
    private string $last_name;
    private string $cv_path;

    public function __construct()
    {
        $this->table = "candidate";
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of cv_path
     */ 
    public function getCv_path()
    {
        return $this->cv_path;
    }

    /**
     * Set the value of cv_path
     *
     * @return  self
     */ 
    public function setCv_path($cv_path)
    {
        $this->cv_path = $cv_path;

        return $this;
    }
}