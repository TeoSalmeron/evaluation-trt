<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    // Database table
    protected $table;
    private $db;

    /**
     * Search for specific elements using attributes
     */
    public function findBy(array $attributes)
    {
        $this->db = Db::getInstance();
        $keys = [];
        $values = [];

        // Loop to explode array
        foreach ($attributes as $key => $value) {
            // Select * FROM X WHERE $key = ? AND $key = ?
            $keys[] = "$key = ?";
            $values[] = $value;
        }

        // Turn $keys array into a string
        $list_of_keys = implode(' AND ', $keys);

        // Execute request
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE " . $list_of_keys);
        $stmt->execute($values);
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
    * Search user with e-mail
    */
    public function findUser(string $email)
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }

    /**
     * Create new element in $this table
     */
    public function create(array $datas)
    {
        $this->db = Db::getInstance();
        $keys = [];
        $inter = [];
        $values = [];

        // Loop to explode array
        foreach($datas as $key => $value) {
            // INSERT INTO table (key, key, key) VALUES(?,?,?)
            if($value != null && $key != "db" && $key !="table") {
                $keys[] = $key;
                $inter[] = "?";
                $values[] = $value;
            }
        }
        // Key string = key1, key2, key3...
        $list_of_keys = implode(', ', $keys);

        // Inter string = ?, ?, ?...
        $list_of_inter = implode(', ', $inter);

        // Execute request
        $stmt = $this->db->prepare("INSERT INTO $this->table ($list_of_keys) VALUES($list_of_inter)");
        $result = $stmt->execute($values);
        return $result;
    }

    /**
     * Delete specific element using ID
     */
    public function delete($id)
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $result = $stmt->execute([$id]);
        return $result;
    }

    /**
     * Update specific element using attributes and ID
     */
    public function update(array $datas, $id) 
    {
        $this->db = Db::getInstance();
        $keys = [];
        $values = [];

        // Loop to explode array
        foreach ($datas as $key => $value) {
            // UPDATE X SET x = ?... WHERE id = ?
            if ($value != null && $key != 'db' && $key != 'table') {
                $keys[] = "$key = ?";
                $values[] = $value;
            }
        }

        // Set ID at the end of $values
        $values[] = $id;

        // Turn $keys into a string
        $list_of_keys = implode(', ', $keys);

        // Execute request
        $stmt = $this->db->prepare("UPDATE $this->table SET $list_of_keys WHERE id = ?");
        $result = $stmt->execute($values);
        return $result;
    }

    /*
    * Return all unconfirmed users
    */

    public function returnAllUnconfirmedUsers(string $role)
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("SELECT * FROM users INNER JOIN $role ON users.id = " . $role .".id WHERE users.verified = 0");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Return all unconfirmed advertisements
     */
    public function returnAllUnconfirmedAds()
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("SELECT * FROM advertisement WHERE verified_by IS NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    /**
     * Return company name depending on advertisement
     */
    public function returnAllConfirmedAds()
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("SELECT advertisement.id AS a_id, advertisement.title, advertisement.location, advertisement.description, recruiter.company_name FROM advertisement INNER JOIN recruiter ON recruiter.id = advertisement.posted_by WHERE advertisement.verified_by IS NOT NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    /**
     * Return all applications
     */
    public function returnAllApplications()
    {
        $this->db = Db::getInstance();
        $stmt = $this->db->prepare("SELECT advertisement.title AS title, advertisement.id AS advertisement_id, advertisement.location AS advertisement_location, users.email AS email, recruiter.company_name AS company_name, application.id AS application_id FROM application INNER JOIN candidate ON application.candidate_id = candidate.id INNER JOIN users ON application.candidate_id = users.id INNER JOIN advertisement ON application.advertisement_id = application.id INNER JOIN recruiter ON advertisement.posted_by = recruiter.id WHERE application.verified_by IS NULL");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
