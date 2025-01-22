<?php
namespace App\Model;

class CardModel extends Model {
    public function createCard($title, $rules, $image, $type, $idUser) {
        $query = "INSERT INTO Card (title, rules, image, type, idUser) VALUES (:title, :rules, :image, :type, :idUser)";
        return $this->create($query, [
            ':title' => $title,
            ':rules' => $rules,
            ':image' => $image,
            ':type' => $type,
            ':idUser' => $idUser
        ]);
    }
    

    public function readCard($id) {
        $query = "SELECT * FROM Card WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateCard($id, $title, $rules, $image, $type) {
        $query = "UPDATE Card SET title = :title, rules = :rules, image = :image, type = :type WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':rules' => $rules,
            ':image' => $image,
            ':type' => $type,
            ':id' => $id
        ]);
    }

    public function deleteCard($id) {
        $query = "DELETE FROM Card WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllCards() {
        $query = "SELECT * FROM Card";
        return $this->getAll($query);
    }
}
