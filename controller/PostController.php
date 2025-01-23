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
            $idUser = $_SESSION['user_id'];

            // Gestion de l'upload d'image
            $image = $this->uploadImage($_FILES['image']);

            if ($image) {
                $this->model->createPost($title, $description, $createdAt, $image, $idUser);
                header("Location: /backoffice/posts");
            } else {
                echo "Erreur lors de l'upload de l'image.";
            }
        } else {
            echo "Accès refusé.";
        }
    }

    private function uploadImage($file) {
        $extensionsOk = ["jpg", "jpeg", "png", "gif", "webp"];
        $dossierUpload = "upload/";
        $message = "";

        if ($file['error'] == UPLOAD_ERR_OK) {
            $nomFichier = basename($file["name"]);
            $fichierTemporaire = $file["tmp_name"];
            $extensionFichier = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));

            if (in_array($extensionFichier, $extensionsOk)) {
                $nomFichier = preg_replace("/[^a-zA-Z0-9._-]/", "_", $nomFichier);
                $nomFichier = strtolower(pathinfo($nomFichier, PATHINFO_FILENAME));
                $nomFichier = uniqid() . "_" . $nomFichier . "." . $extensionFichier;

                $destination = $dossierUpload . $nomFichier;

                if (move_uploaded_file($fichierTemporaire, $destination)) {
                    return $nomFichier; // Retourne le nom du fichier uploadé
                } else {
                    $message = "Erreur à l'envoi du fichier.";
                }
            }
        }
        return false; // Retourne false en cas d'erreur
    }

    public function readPost($id) {
        return $this->model->readPost($id);
    }

    public function updatePost($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $description = $_POST['description'];

            // Gestion de l'upload d'image
            $image = $this->uploadImage($_FILES['image']);

            if ($image) {
                $this->model->updatePost($id, $title, $description, date('Y-m-d H:i:s'), $image);
                header("Location: /backoffice/posts");
            } else {
                echo "Erreur lors de l'upload de l'image.";
            }
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