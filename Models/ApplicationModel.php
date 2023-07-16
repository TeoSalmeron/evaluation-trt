<?php

namespace App\Models;

use App\Models\Model;

class ApplicationModel extends Model 
{
    private int $id;
    private string $candidate_id;
    private int $advertisement_id;
    private string $verified_by;

    public function __construct() 
    {
        $this->table = "application";
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of candidate_id
     */ 
    public function getCandidate_id()
    {
        return $this->candidate_id;
    }

    /**
     * Set the value of candidate_id
     *
     * @return  self
     */ 
    public function setCandidate_id($candidate_id)
    {
        $this->candidate_id = $candidate_id;

        return $this;
    }

    /**
     * Get the value of advertisement_id
     */ 
    public function getAdvertisement_id()
    {
        return $this->advertisement_id;
    }

    /**
     * Set the value of advertisement_id
     *
     * @return  self
     */ 
    public function setAdvertisement_id($advertisement_id)
    {
        $this->advertisement_id = $advertisement_id;

        return $this;
    }

    /**
     * Get the value of verified_by
     */ 
    public function getVerified_by()
    {
        return $this->verified_by;
    }

    /**
     * Set the value of verified_by
     *
     * @return  self
     */ 
    public function setVerified_by($verified_by)
    {
        $this->verified_by = $verified_by;

        return $this;
    }
}