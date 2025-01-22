<?php

namespace App\Controller;

use App\Model\CardModel;

class CardController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new CardModel();
    }

    public function createCard() {
        if ($this->isAdmin()) {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $rules = $_POST['rules'];
            $image = $_POST['image'];
            $type = $_POST['type'];
            $idUser = $_SESSION['user_id'];

            $this->model->createCard($title, $rules, $image, $type, $idUser);
            header("Location: /backoffice/cards");
        } else {
            echo "Accès refusé.";
        }
    }

    public function readCard($id) {
        return $this->model->readCard($id);
    }

    public function update($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $rules = $_POST['rules'];
            $image = $_POST['image'];
            $type = $_POST['type'];

            $this->model->updateCard($id, $title, $rules, $image, $type);
            header("Location: /backoffice/cards");
        } else {
            echo "Accès refusé.";
        }
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
        return $this->model->getAllCards();
    }
}