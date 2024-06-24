<?php

namespace App\StoreShoe\Models;

use App\StoreShoe\Commons\Model;

class Users extends Model
{
    private string $table = 'users';

    public function createUser($name, $address, $email, $tel, $username, $password, $avatar)
    {
        try {
            // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Câu lệnh SQL với tên bảng chuẩn hóa
            $sql = "INSERT INTO $this->table (
                        name, 
                        address, 
                        email, 
                        tel, 
                        username, 
                        password, 
                        avatar
                    ) VALUES (
                        :name, 
                        :address, 
                        :email, 
                        :tel, 
                        :username, 
                        :password, 
                        :avatar
                    )";

            $stmt = $this->conn->prepare($sql);

            // Liên kết các tham số với giá trị tương ứng
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword); // Sử dụng mật khẩu băm
            $stmt->bindParam(':avatar', $avatar);

            // Thực thi câu lệnh
            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
    public function getByID($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            // Lấy dữ liệu người dùng từ kết quả truy vấn
            $user = $stmt->fetch();
            
            if ($user) {
                return $user; // Trả về dữ liệu người dùng nếu tìm thấy
            } else {
                return null; // Trả về null nếu không tìm thấy người dùng với ID tương ứng
            }
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function updateUser($id, $name, $address, $email, $tel, $avatar) {
        try {
           $sql = "UPDATE $this->table SET 
                            name = :name, 
                            address = :address, 
                            email = :email, 
                            tel = :tel, 
                            avatar = :avatar 
                        WHERE id = :id";
           
    
            $stmt = $this->conn->prepare($sql);
    
            // Liên kết các tham số với giá trị tương ứng
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tel', $tel);
            $stmt->bindParam(':avatar', $avatar);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function checkEmailExist($email)
    {
        try {
            $sql = "SELECT * FROM $this->table 
                    WHERE email = :email
                ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function checkLoginByUserPass($username, $password)
    {
        try {
            $sql = "SELECT  id, username, password, role FROM $this->table WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute(); // Thêm bước thực thi câu lệnh SQL

            $user = $stmt->fetch(); // Lấy kết quả dưới dạng mảng kết hợp

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }


    public function getUserByID($id)
    {
        try {
            $sql = "SELECT  * FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Thêm bước thực thi câu lệnh SQL

            return $stmt->fetch(); // Lấy kết quả dưới dạng mảng kết hợp
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function updatePassUser($password, $id) {
        try {
            $sql = "UPDATE $this->table set 
                    password = :password
                    WHERE id = :id
                    ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
}
