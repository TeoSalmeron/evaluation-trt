<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    // Database table
    protected $table;
    private $db;

    /**
     * Request function, search datas into Database and return response
     *
     * @param string $sql
     * @param array|null $attributes
     */
    public function request(string $sql, array $attributes = null)
    {
        // Get database instance
        $this->db = Db::getInstance();

        if ($attributes !== null) {
            // Prepared request
            $query = $this->db->prepare($sql);
            $query->execute($attributes);
            return $query;
        } else {
            // Simple request
            return $this->db->query($sql);
        }
    }

    /**
     * Return element of this table with specific attributes (ex: ["id" => 1, "creation_date" => "2023-01-21"]);
     *
     * @param array $attributes
     */
    public function findBy(array $attributes)
    {
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
        return $this->request('SELECT * FROM ' . $this->table . ' WHERE ' . $list_of_keys, $values)->fetchAll();
    }

    /**
     * Return all elements from a table
     */
    public function findAll()
    {
        $query = $this->request('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    /**
     * Return a specific element from a table using ID
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->request("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }

    /**
     * Delete specific element from a table using ID
     *
     * @param integer $id
     */
    public function delete(int $id)
    {
        return $this->request("DELETE FROM $this->table WHERE id = ?", [$id]);
    }

    public function deleteUser(string $id)
    {
        $this->request("DELETE FROM reservation WHERE booked_by = ?", [$id]);
        $this->request("DELETE FROM users_allergen WHERE user_id = ?", [$id]);
        $this->request("DELETE FROM customer WHERE id = ?", [$id]);
        return $this->request("DELETE FROM users WHERE id = ?", [$id]);
    }

    /**
     * Create a new element into $this->table
     */
    public function create()
    {
        $keys = [];
        $inter = [];
        $values = [];

        // Loop to explode array
        foreach ($this as $key => $value) {
            // INSERT INTO X (x,x,x...) VALUES (?, ?, ?...)
            if ($value != null && $key != 'db' && $key != 'table') {
                $keys[] = $key;
                $inter[] = "?";
                $values[] = $value;
            }
        }

        // Turn arrays into string
        $list_of_keys = implode(', ', $keys);
        $list_of_inter = implode(', ', $inter);

        // Execute request
        return $this->request('INSERT INTO ' . $this->table . '(' . $list_of_keys . ')VALUES(' . $list_of_inter . ')', $values);
    }

    /**
     * Update element from a table using ID
     */
    public function update($id)
    {
        $keys = [];
        $values = [];

        // Loop to explode array
        foreach ($this as $key => $value) {
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
        return $this->request("UPDATE $this->table SET " . $list_of_keys . " WHERE id = ?", $values);
    }

    /**
     * Set datas into Model instance
     *
     * @param $datas
     */
    public function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            // Get setter's name corresponding to the key
            // exemple : title -> setTitle
            $setter = 'set' . ucfirst($key);

            // Check if setter exists
            if (method_exists($this, $setter)) {
                // Call setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}
