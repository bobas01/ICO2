<?php
namespace App\Model;    

class PostModel extends Model {
    public function createPost($title, $description, $createdAt, $image, $idUser) {
        $query = "INSERT INTO Post (title, description, createdAt, image, idUser) VALUES (:title, :description, :createdAt, :image, :idUser)";
        return $this->create($query, [
            ':title' => $title,
            ':description' => $description,
            ':createdAt' => $createdAt,
            ':image' => $image,
            ':idUser' => $idUser
        ]);
    }

    public function readPost($id) {
        $query = "SELECT * FROM Post WHERE id = :id";
        return $this->read($query, [':id' => $id]);
    }

    public function updatePost($id, $title, $description, $createdAt, $image) {
        $query = "UPDATE Post SET title = :title, description = :description, createdAt = :createdAt, image = :image WHERE id = :id";
        return $this->update($query, [
            ':title' => $title,
            ':description' => $description,
            ':createdAt' => $createdAt,
            ':image' => $image,
            ':id' => $id
        ]);
    }

    public function deletePost($id) {
        $query = "DELETE FROM Post WHERE id = :id";
        return $this->delete($query, [':id' => $id]);
    }

    public function getAllPosts() {
        $query = "SELECT * FROM Post";
        return $this->getAll($query);
    }
}