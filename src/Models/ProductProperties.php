<?php


namespace App\StoreShoe\Models;

use App\StoreShoe\Commons\Model;

class ProductProperties  extends Model
{
    private string $table = "product_productSize";

    public function getAll()
    {
        try {
            $sql = "SELECT 
                        p.id AS p_id,
                        p.name AS p_name,
                        p.price AS p_price,
                        p.quantity AS p_quantity,
                        p.description AS p_description,
                        p.image AS p_image,
                        p.category_id AS p_category_id,
                        GROUP_CONCAT(pz.size ORDER BY pz.size SEPARATOR ', ') AS sizes,
                        pt.id AS pt_id
                    FROM 
                        products p
                    JOIN 
                        product_productSize pt ON p.id = pt.product_id
                    JOIN 
                        productSize pz ON pt.size_id = pz.id
                    GROUP BY 
                        p.id, p.name, p.price, p.quantity, p.description, p.image, p.category_id, pt.id
                    ORDER BY 
                        p.id DESC;
            ";

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
            $sql = "SELECT 
                        p.id AS p_id,
                        p.name AS p_name,
                        p.price AS p_price,
                        p.quantity AS p_quantity,
                        p.description AS p_description,
                        p.image AS p_image,
                        p.category_id AS p_category_id,
                        GROUP_CONCAT(pz.size ORDER BY pz.size SEPARATOR ', ') AS sizes,
                        pt.id AS pt_id
                    FROM 
                        products p
                    JOIN 
                        product_productSize pt ON p.id = pt.product_id
                    JOIN 
                        productSize pz ON pt.size_id = pz.id
                    WHERE pt.id = :id
                    GROUP BY 
                        p.id, p.name, p.price, p.quantity, p.description, p.image, p.category_id, pt.id
                    ORDER BY 
                        p.id DESC
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function getProductSize()
    {
        try {
            $sql = "SELECT id , size FROM productSize";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function getProduct()
    {
        try {
            $sql = "SELECT id , name FROM products";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function insert($product_id, $size_id)
    {
        try {
            $sql = "
                INSERT INTO $this->table 
                (product_id, size_id)
                VALUES 
                (:product_id, :size_id)
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':size_id', $size_id);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function update($id, $product_id, $size_id)
    {
        try {
            $sql = "
                UPDATE $this->table 
                SET product_id = :product_id,
                    size_id = :size_id
                WHERE id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':size_id', $size_id);

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
