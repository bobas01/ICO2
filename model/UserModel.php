<?php

namespace App\Model;

use PDO;

class UserModel extends Model
{
    public function emailExists($email)
    {
        $stmt = $this->getDb()->prepare("SELECT * FROM User WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function register($name, $email, $password, $phone)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->getDb()->prepare("INSERT INTO User (name, email, password, phoneNumber) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashed_password, $phone]);
    }

    public function getUserByEmail($email) {
        $query = "SELECT Id, password, role FROM User WHERE email = :email";
        $result = $this->read($query, [':email' => $email]);
        error_log("getUserByEmail result: " . print_r($result, true));
        return $result;
    }
    
}

?>
