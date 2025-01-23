<?php

namespace App\Controller;

use App\Model\UserModel;

class LoginController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function index() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Veuillez remplir tous les champs.";
            } else {
                // Vérification de l'utilisateur
                $user = $this->model->getUserByEmail($email);

                if ($user && is_array($user) && !empty($user)) {
                    // Vérification du mot de passe
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['Id'];
                        $_SESSION['role'] = $user['role'];
                        
                        // Rendre la page d'accueil après la connexion
                        $currentPage = 'login'; // Définir la page actuelle
                        $pageTitle = "Connexion"; // Titre de la page
                        $content = $this->render('login/index', compact('pageTitle'), true); // Rendre le contenu de la page de connexion
                        $this->renderLayout($content, $currentPage); // Rendre la mise en page avec le contenu
                        return; // Sortir pour éviter d'exécuter le code suivant
                    } else {
                        $_SESSION['error'] = "Mot de passe incorrect.";
                    }
                } else {
                    $_SESSION['error'] = "Aucun compte trouvé avec cet email.";
                }
            }
        }

        // Si la méthode n'est pas POST, rendre la vue de connexion
        $this->render('login/index');
    }
}
