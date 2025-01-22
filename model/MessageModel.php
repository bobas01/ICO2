<?php
namespace App\Model;    

class MessageModel extends Model {
    public function createMessage($title, $mail, $description) {
        $query = "INSERT INTO Message (title, mail, description) VALUES (:title, :mail, :description)";
        return $this->create($query, [
            ':title' => $title,
            ':mail' => $mail,
            ':description' => $description
        ]);
    }

    public function readMessage($id) {
        $query = "SELECT * FROM Message WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updateMessage($id, $title, $mail, $description) {
        $query = "UPDATE Message SET title = :title, mail = :mail, description = :description WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':mail' => $mail,
            ':description' => $description,
            ':id' => $id
        ]);
    }

    public function deleteMessage($id) {
        $query = "DELETE FROM Message WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllMessages() {
        $query = "SELECT * FROM Message";
        return $this->getAll($query);
    }
}