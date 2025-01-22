<?php
namespace App\Model;    

class MaterialModel extends Model {
    public function createMaterial($title, $quantity, $idUser) {
        $query = "INSERT INTO Material (title, quantity, idUser) VALUES (:title, :quantity, :idUser)";
        return $this->create($query, [
            ':title' => $title,
            ':quantity' => $quantity,
            ':idUser' => $idUser
        ]);
    }

    public function readMaterial($id) {
        $query = "SELECT * FROM Material WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateMaterial($id, $title, $quantity) {
        $query = "UPDATE Material SET title = :title, quantity = :quantity WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':quantity' => $quantity,
            ':id' => $id
        ]);
    }

    public function deleteMaterial($id) {
        $query = "DELETE FROM Material WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllMaterials() {
        $query = "SELECT * FROM Material";
        return $this->getAll($query);
    }
}