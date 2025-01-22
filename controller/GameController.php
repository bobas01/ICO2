<?php
namespace App\Controller;       
use App\Model\GameModel;

class GameController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new GameModel($conn);
    }

    public function create() {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $stripeProductId = $_POST['stripeProductId'];

            $this->model->createGame($title, $price, $stripeProductId);
            header("Location: /backoffice/jeux-extensions");
        } else {
            echo "Accès refusé.";
        }
    }

    public function read($id) {
        return $this->model->readGame($id);
    }

    public function update($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $stripeProductId = $_POST['stripeProductId'];

            $this->model->updateGame($id, $title, $price, $stripeProductId);
            header("Location: /backoffice/jeux-extensions");
        } else {
            echo "Accès refusé.";
        }
    }

    public function delete($id) {
        if ($this->isAdmin()) {
            $this->model->deleteGame($id);
            header("Location: /backoffice/jeux-extensions");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAll() {
        return $this->model->getAllGames();
    }
}