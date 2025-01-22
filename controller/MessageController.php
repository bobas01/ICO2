<?php
namespace App\Controller;       
use App\Model\MessageModel;

class MessageController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new MessageModel($conn);
    }

    public function createMessage() {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $mail = $_POST['mail'];
            $description = $_POST['description'];

            $this->model->createMessage($title, $mail, $description);
            header("Location: /backoffice/messages");
        } else {
            echo "Accès refusé.";
        }
    }

    public function readMessage($id) {
        return $this->model->readMessage($id);
    }

    public function updateMessage($id) {
        if ($this->isAdmin()) {
            $title = $_POST['title'];
            $mail = $_POST['mail'];
            $description = $_POST['description'];

            $this->model->updateMessage($id, $title, $mail, $description);
            header("Location: /backoffice/messages");
        } else {
            echo "Accès refusé.";
        }
    }

    public function deleteMessage($id) {
        if ($this->isAdmin()) {
            $this->model->deleteMessage($id);
            header("Location: /backoffice/messages");
        } else {
            echo "Accès refusé.";
        }
    }

    public function getAllMessages() {
        return $this->model->getAllMessages();
    }
}