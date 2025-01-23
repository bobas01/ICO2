<?php

namespace App\Model;

use PDO;
use PDOException;

class Model {
    
    private static $db;

    private static function setDb(){
        try {
            self::$db = new PDO('mysql:host=localhost;dbname=ICO;charset=UTF8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch(PDOException $e){
            throw new \Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    protected function getDb(){
        if(self::$db == null){
            self::setDb();
        }
        return self::$db;
    }

    protected function create($query, $params) {
        try {
            $stmt = $this->getDb()->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la création : " . $e->getMessage());
        }
    }

    protected function read($query, $params) {
        try {
            $stmt = $this->getDb()->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 1) {
                throw new \Exception("Plus d'un enregistrement trouvé.");
            }
            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la lecture : " . $e->getMessage());
        }
    }

    protected function update($query, $params) {
        try {
            $stmt = $this->getDb()->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la mise à jour : " . $e->getMessage());
        }
    }

    protected function delete($query, $params) {
        try {
            $stmt = $this->getDb()->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la suppression : " . $e->getMessage());
        }
    }

    protected function getAll($query, $params = []) {
        try {
            $stmt = $this->getDb()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la récupération de tous les enregistrements : " . $e->getMessage());
        }
    }

    protected function exists($query, $params) {
        try {
            $stmt = $this->getDb()->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de la vérification d'existence : " . $e->getMessage());
        }
    }

    protected function count($query, $params = []) {
        try {
            $stmt = $this->getDb()->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors du comptage : " . $e->getMessage());
        }
    }
}
