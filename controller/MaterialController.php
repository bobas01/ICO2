<?php
namespace App\Controller;
use App\Model\MaterialModel;

class MaterialController extends Controller {
    private $model;

    public function __construct($conn) {
        $this->model = new MaterialModel($conn);
    }   

    public function createMaterial() {
        if ($this->isAdmin()) {
            // Vérification des données d'entrée
            $title = $_POST['title'] ?? null;
            $description = $_POST['description'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
            $idUser = $_POST['idUser'] ?? null;

            if ($title && $description && $quantity && $idUser) {
                $this->model->createMaterial($title, $quantity, $idUser);
                header("Location: /backoffice/materiels");
                exit();
            } else {
                echo "Données manquantes.";
            }
        } else {
            echo "Accès refusé.";
        }   
    }   

    public function getAllMaterials() {
        return $this->model->getAllMaterials();
    }   

    public function getMaterialById($id) {
        return $this->model->readMaterial($id);
    }   

    public function updateMaterial($id) {
        if ($this->isAdmin()) {
            // Vérification des données d'entrée
            $title = $_POST['title'] ?? null;
            $quantity = $_POST['quantity'] ?? null;

            if ($title && $quantity) {
                $this->model->updateMaterial($id, $title, $quantity);
                header("Location: /backoffice/materiels");
                exit();
            } else {
                echo "Données manquantes.";
            }
        } else {
            echo "Accès refusé.";
        }
    }      

    public function deleteMaterial($id) {
        if ($this->isAdmin()) {
            $this->model->deleteMaterial($id);
            header("Location: /backoffice/materiels");
            exit();
        } else {
            echo "Accès refusé.";
        }
    }
}   