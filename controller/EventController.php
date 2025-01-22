<?php
namespace App\Controller;
use App\Model\EventModel;

class EventController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new EventModel($conn);
    }

    public function create() {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $createdAt = date('Y-m-d H:i:s');
            $endDate = $_POST['endDate'];
            $idUser = $_SESSION['user_id'];

            $this->model->createEvent($title, $description, $createdAt, $endDate, $idUser);
            header("Location: /backoffice/evenements");
        } else {
            echo "Accès refusé.";
        }
    }

    public function read($id) {
        return $this->model->readEvent($id);
    }

    public function update($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $endDate = $_POST['endDate'];

            $this->model->updateEvent($id, $title, $description, date('Y-m-d H:i:s'), $endDate);
            header("Location: /backoffice/evenements");
        } else {
            echo "Accès refusé.";
        }
    }

    public function delete($id) {
        if ($this->isAdmin()) {
            $this->model->deleteEvent($id);
            header("Location: /backoffice/evenements");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAll() {
        return $this->model->getAllEvents();
    }
}