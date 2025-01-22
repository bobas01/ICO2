<?php
namespace App\Model;    

class GameModel extends Model {
    public function createGame($title, $price, $stripeProductId) {
        $query = "INSERT INTO Game (title, price, stripeProductId) VALUES (:title, :price, :stripeProductId)";
        return $this->create($query, [
            ':title' => $title,
            ':price' => $price,
            ':stripeProductId' => $stripeProductId
        ]);
    }

    public function readGame($id) {
        $query = "SELECT * FROM Game WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateGame($id, $title, $price, $stripeProductId) {
        $query = "UPDATE Game SET title = :title, price = :price, stripeProductId = :stripeProductId WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':price' => $price,
            ':stripeProductId' => $stripeProductId,
            ':id' => $id
        ]);
    }

    public function deleteGame($id) {
        $query = "DELETE FROM Game WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllGames() {
        $query = "SELECT * FROM Game";
        return $this->getAll($query);
    }
}