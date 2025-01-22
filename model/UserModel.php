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
        $stmt = $this->getDb()->prepare("INSERT INTO User (name, email, password, phoneNumber) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $password, $phone]);
    }
}

?>
