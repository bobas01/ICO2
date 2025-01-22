<?php

namespace App\Model;

use PDO;
use PDOException;

class Model {
    
    private static $db;

    private static function setDb(){

        try {
            self::$db = new PDO('mysql:host=localhost;dbname=ICO;charset=UTF8', 'root');
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "Erreur :" . $e->getMessage();
        }
    }

    protected function getDb(){
        if(self::$db == null){
            self::setDb();
        }
        return self::$db;
    }

    protected function create($query, $params) {
        $stmt = $this->getDb()->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $params[$key]);
        }
        return $stmt->execute();
    }

    protected function read($query, $params) {
        $stmt = $this->getDb()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function update($query, $params) {
        $stmt = $this->getDb()->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $params[$key]);
        }
        return $stmt->execute();
    }

    protected function delete($query, $params) {
        $stmt = $this->getDb()->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindParam($key, $params[$key]);
        }
        return $stmt->execute();
    }

    protected function getAll($query) {
        $stmt = $this->getDb()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}