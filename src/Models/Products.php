<?php


namespace App\StoreShoe\Models;

use App\StoreShoe\Commons\Model;

class Products extends Model
{
    private string $table = "products";

    public function getAll()
    {
        try {
            $sql = "SELECT  p.id            p_id            , 
                            p.name          p_name          , 
                            p.price         p_price         , 
                            p.quantity      p_quantity      , 
                            p.description   p_description   , 
                            p.image         p_image         , 
                            p.category_id   p_category_id   , 
                            c.name          c_name   
                    FROM $this->table p
                    JOIN categories c 
                    ON p.category_id = c.id
                    ORDER BY p.id
                    DESC
                    LIMIT 8
                    
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function resultProductFilter($id, $conditions = '')
    {
        try {
            $sql = "SELECT  p.image        p_image , 
                            p.name         p_name , 
                            p.price        p_price , 
                            p.id           p_id  
                    FROM products p 
                    JOIN 
                        product_productSize pps ON pps.product_id = p.id
                    JOIN 
                        productSize ps ON ps.id = pps.size_id
                    JOIN 
                        categories c ON c.id = p.category_id
                    where c.id = :id
                    $conditions   
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);
            
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function getSizeByIdCategory($id)
    {
        try {
            $sql = "SELECT DISTINCT ps.size
                    FROM products p
                    JOIN product_productSize pps ON p.id = pps.product_id
                    JOIN productSize ps ON pps.size_id = ps.id
                    WHERE p.category_id = :id
                    ORDER BY ps.size;";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về giá trị null hoặc thông báo lỗi phù hợp
            error_log('ERROR: ' . $e->getMessage());
            return null;
        }
    }
    public function getProductFromCategory($p_category_id)
    {
        try {
            $sql = "SELECT  p.id            AS p_id, 
                            p.name          AS p_name, 
                            p.price         AS p_price, 
                            p.image         AS p_image, 
                            p.category_id   AS p_category_id, 
                            c.name          AS c_name,
                            c.id            AS c_id
                    FROM $this->table p
                    JOIN categories c 
                    ON p.category_id = c.id
                    WHERE p.category_id = :p_category_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':p_category_id', $p_category_id, \PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về giá trị null hoặc thông báo lỗi phù hợp
            error_log('ERROR: ' . $e->getMessage());
            return null;
        }
    }

    public function getSizeByIdProduct($id)
    {
        try {
            $sql = "SELECT  p.id, 
                            ps.size 
                    FROM    products p
                    JOIN    
                        product_productSize pps ON p.id = pps.product_id
                    JOIN    
                        productSize ps ON pps.size_id = ps.id
                    WHERE p.id = :id;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về giá trị null hoặc thông báo lỗi phù hợp
            error_log('ERROR: ' . $e->getMessage());
            return null;
        }
    }


    public function getProductDetail($id)
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
                        c.name AS category_name,
                        -- ps.id AS ps_id,
                        GROUP_CONCAT(ps.size ORDER BY ps.size SEPARATOR ', ') AS sizes
                    FROM 
                        products p
                    JOIN 
                        product_productSize pps ON p.id = pps.product_id
                    JOIN 
                        productSize ps ON pps.size_id = ps.id
                    JOIN 
                        categories c ON p.category_id = c.id
                    WHERE 
                        p.id = :id
                    GROUP BY 
                        p.id, p.name, p.price, p.quantity, p.description, p.image, p.category_id, c.name
                    ORDER BY 
                        p.id DESC;
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
    public function getByID($id)
    {
        try {
            $sql = "SELECT  p.id            p_id            , 
                            p.name          p_name          , 
                            p.price         p_price         , 
                            p.quantity      p_quantity      , 
                            p.description   p_description   , 
                            p.image         p_image         , 
                            p.category_id   p_category_id   , 
                            c.name          c_name   
                    FROM $this->table p
                    JOIN categories c 
                    ON p.category_id = c.id
                    WHERE p.id = :id
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

    public function getProductToAddToCartByID($id)
    {
        try {
            $sql = "SELECT  p.id            p_id            , 
                            p.name          p_name          , 
                            p.price         p_price         , 
                            p.quantity      p_quantity      , 
                            p.description   p_description   , 
                            p.image         p_image         , 
                            p.category_id   p_category_id   , 
                            c.name          c_name   
                    FROM $this->table p
                    JOIN categories c 
                    ON p.category_id = c.id
                    WHERE p.id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function getCategory()
    {
        try {
            $sql = "SELECT * FROM categories";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function insert($name, $price, $quantity, $description, $image, $category_id)
    {
        try {
            $sql = "
                INSERT INTO $this->table 
                (name, price, quantity, description, image, category_id)
                VALUES 
                (:name, :price, :quantity, :description, :image, :category_id)
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':category_id', $category_id);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function update($id, $name, $price, $quantity, $description, $image, $category_id)
    {
        try {
            $sql = "
                UPDATE $this->table 
                SET name = :name,
                    price = :price,
                    quantity = :quantity,
                    description = :description,
                    image = :image,
                    category_id = :category_id
                WHERE id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':category_id', $category_id);

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
