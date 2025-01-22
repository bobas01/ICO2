<?php
namespace App\Controller;
use App\Model\PostModel;

class PostController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new PostModel($conn);
    }

    public function createPost() {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $createdAt = date('Y-m-d H:i:s');
            $image = $_POST['image'];
            $idUser = $_SESSION['user_id'];

            $this->model->createPost($title, $description, $createdAt, $image, $idUser);
            header("Location: /backoffice/posts");
        } else {
            echo "Accès refusé.";
        }
    }

    public function readPost($id) {
        return $this->model->readPost($id);
    }

    public function updatePost($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_POST['image'];

            $this->model->updatePost($id, $title, $description, date('Y-m-d H:i:s'), $image);
            header("Location: /backoffice/posts");
        } else {
            echo "Accès refusé.";
        }
    }

    public function deletePost($id) {
        if ($this->isAdmin()) {
            $this->model->deletePost($id);
            header("Location: /backoffice/posts");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAllPosts() {
        return $this->model->getAllPosts();
        }
}