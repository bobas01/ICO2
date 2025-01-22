<?php
namespace App\Controller;
use App\Model\CardsDistributionModel;

class CardsDistributionController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new CardsDistributionModel($conn);
    }

    public function create() {
        if ($this->isAdmin()) {
            $players = $_POST['players'];
            $pirates = $_POST['pirates'];
            $marins = $_POST['marins'];
            $siren = $_POST['siren'];
            $idUser = $_SESSION['user_id'];

            $this->model->createCardsDistribution($players, $pirates, $marins, $siren, $idUser);
            header("Location: /backoffice/distribution-cartes");
        } else {
            echo "Accès refusé.";
        }
    }

    public function read($id) {
        return $this->model->readCardsDistribution($id);
    }

    public function update($id) {
        if ($this->isAdmin()) {
            $players = $_POST['players'];
            $pirates = $_POST['pirates'];
            $marins = $_POST['marins'];
            $siren = $_POST['siren'];

            $this->model->updateCardsDistribution($id, $players, $pirates, $marins, $siren);
            header("Location: /backoffice/distribution-cartes");
        } else {
            echo "Accès refusé.";
        }
    }

    public function delete($id) {
        if ($this->isAdmin()) {
            $this->model->deleteCardsDistribution($id);
            header("Location: /backoffice/distribution-cartes");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAll() {
        return $this->model->getAllCardsDistribution();
    }
}