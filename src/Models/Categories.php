<?php

namespace App\StoreShoe\Models;

use App\StoreShoe\Commons\Model;


class Categories extends Model
{
    private string $table = 'categories';

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM $this->table";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }


    public function getByID($id)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
    public function insert($name)
    {
        try {
            $sql = "
                INSERT INTO $this->table(name) 
                VALUES (:name)
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':name', $name);


            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function update($id, $name)
    {
        try {
            $sql = "
                UPDATE $this->table 
                SET name = :name
                WHERE id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function deleteByID($id)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
}
