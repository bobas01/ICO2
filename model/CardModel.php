<?php
namespace App\Model;

class CardModel extends Model {
    public function createCard($title, $rules, $image, $type, $idUser) {
        $query = "INSERT INTO cards (title, rules, image, type, idUser) VALUES (:title, :rules, :image, :type, :idUser)";
        $params = [
            ':title' => $title,
            ':rules' => $rules,
            ':image' => $image,
            ':type' => $type,
            ':idUser' => $idUser
        ];
        return $this->create($query, $params);
    }

    public function readCard($id) {
        $query = "SELECT * FROM cards WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateCard($id, $title, $rules, $image, $type) {
        $query = "UPDATE cards SET title = :title, rules = :rules, image = :image, type = :type WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':rules' => $rules,
            ':image' => $image,
            ':type' => $type,
            ':id' => $id
        ]);
    }

    public function deleteCard($id) {
            $query = "DELETE FROM cards WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllCards($type = null) {
        if ($type) {
            $query = "SELECT * FROM cards WHERE type = :type";
            return $this->getAll($query, [':type' => $type]);
        } else {
            $query = "SELECT * FROM cards";
            return $this->getAll($query);
        }
    }
}
