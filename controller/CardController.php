<?php

namespace App\Controller;

require_once 'Controller.php'; // Assurez-vous que le chemin est correct

use App\Model\CardModel;

class CardController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new CardModel();
    }

    public function createCard() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $rules = $_POST['rules'] ?? '';
            $type = $_POST['type'] ?? 'bonus';

            // Récupérer l'ID de l'utilisateur à partir de la session
            $idUser = $_SESSION['user_id'] ?? null;

            // Vérifiez si l'utilisateur est connecté
            if ($idUser === null) {
                $_SESSION['error'] = "Vous devez être connecté pour créer une carte.";
                header("Location: /ICO/backoffice"); // Rediriger vers le backoffice
                exit();
            }

            // Gestion de l'upload d'image
            $uploadDir = 'img/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Vérifier si le fichier est une image
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;

                    // Créer la carte dans la base de données
                    if ($this->model->createCard($title, $rules, $image, $type, $idUser)) {
                        $_SESSION['message'] = "La carte a été créée avec succès.";
                    } else {
                        $_SESSION['error'] = "Une erreur est survenue lors de la création de la carte.";
                    }
                } else {
                    $_SESSION['error'] = "Désolé, une erreur s'est produite lors de l'upload de votre fichier.";
                }
            } else {
                $_SESSION['error'] = "Le fichier n'est pas une image.";
            }

            // Rediriger vers le backoffice après la création de la carte
            header("Location: /ICO/backoffice"); // Rediriger vers le backoffice
            exit();
        }

        // Si ce n'est pas une requête POST, afficher le formulaire
        $this->render('backoffice/index'); // Assurez-vous que cette méthode rend le bon template
    }

    public function readCard($id) {
        return $this->model->readCard($id);
    }

    public function updateCard($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $rules = $_POST['rules'] ?? '';
            $type = $_POST['type'] ?? 'bonus';

            // Récupérer l'ID de l'utilisateur à partir de la session
            $idUser = $_SESSION['user_id'] ?? null;

            // Vérifiez si l'utilisateur est connecté
            if ($idUser === null) {
                $_SESSION['error'] = "Vous devez être connecté pour mettre à jour une carte.";
                header("Location: /ICO/backoffice");
                exit();
            }

            // Gestion de l'upload d'image (facultatif)
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'img/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

                // Vérifier si le fichier est une image
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                        $image = $uploadFile; // Utiliser le nouveau chemin de l'image
                    } else {
                        $_SESSION['error'] = "Désolé, une erreur s'est produite lors de l'upload de votre fichier.";
                    }
                } else {
                    $_SESSION['error'] = "Le fichier n'est pas une image.";
                }
            }

            // Mettre à jour la carte dans la base de données
            if ($this->model->updateCard($id, $title, $rules, $image, $type)) {
                $_SESSION['message'] = "La carte a été mise à jour avec succès.";
            } else {
                $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour de la carte.";
            }

            // Rediriger vers le backoffice après la mise à jour
            header("Location: /ICO/backoffice");
            exit();
        }

        // Si ce n'est pas une requête POST, récupérer les détails de la carte
        $card = $this->model->readCard($id); // Récupérer les détails de la carte
        echo json_encode($card); // Retourner les détails de la carte en JSON pour la modale
    }

    public function delete($id) {
        if ($this->isAdmin()) {
            $this->model->deleteCard($id);
            header("Location: /backoffice/cards");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAllCards() {
        if ($this->isAdmin()) {
            $cards = $this->model->getAllCards(); // Récupérer toutes les cartes
            $this->renderPage('backoffice/index', ['cards' => $cards]); // Passer les cartes à la vue
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
}