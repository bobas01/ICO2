<?php
namespace App\Model;    

class EventModel extends Model {
    public function createEvent($title, $description, $createdAt, $endDate, $idUser) {
        $query = "INSERT INTO Event (title, description, createdAt, endDate, idUser) VALUES (:title, :description, :createdAt, :endDate, :idUser)";
        return $this->create($query, [
            ':title' => $title,
            ':description' => $description,
            ':createdAt' => $createdAt,
            ':endDate' => $endDate,
            ':idUser' => $idUser
        ]);
    }

    public function readEvent($id) {
        $query = "SELECT * FROM Event WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateEvent($id, $title, $description, $createdAt, $endDate) {
        $query = "UPDATE Event SET title = :title, description = :description, createdAt = :createdAt, endDate = :endDate WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':description' => $description,
            ':createdAt' => $createdAt,
            ':endDate' => $endDate,
            ':id' => $id
        ]);
    }

    public function deleteEvent($id) {
        $query = "DELETE FROM Event WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllEvents() {
        $query = "SELECT * FROM Event";
        return $this->getAll($query);
    }
}
