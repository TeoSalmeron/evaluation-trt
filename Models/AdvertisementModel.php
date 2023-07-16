<?php

namespace App\Models;

use App\Models\Model;

class AdvertisementModel extends Model
{
    private int $id;
    private string $title;
    private string $address;
    private string $text;
    private string $posted_by;
    private string $verified_by;

    public function __construct()
    {
        $this->table = "advertisement";
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of posted_by
     */ 
    public function getPosted_by()
    {
        return $this->posted_by;
    }

    /**
     * Set the value of posted_by
     *
     * @return  self
     */ 
    public function setPosted_by($posted_by)
    {
        $this->posted_by = $posted_by;

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