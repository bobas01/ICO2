<?php

namespace App\Controller;

use App\Model\UserModel; // Assurez-vous d'avoir un modèle pour gérer les utilisateurs

class RegisterController extends Controller
{
    public function index()
    {
        $error = '';
        $success = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validation du mot de passe
            $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/";
            if (!preg_match($password_regex, $password)) {
                $error = "Le mot de passe doit contenir au moins 12 caractères, une majuscule, des minuscules, un chiffre et un caractère spécial.";
            } elseif ($password !== $confirm_password) {
                $error = "Les mots de passe ne correspondent pas.";
            } else {
                $userModel = new UserModel();
                if ($userModel->emailExists($email)) {
                    $error = "Cet email est déjà utilisé.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    if ($userModel->register($name, $email, $hashed_password, $phone)) {
                        $success = "Inscription réussie !";
                        header("Location: login.php");
                        exit();
                    } else {
                        $error = "Erreur lors de l'inscription.";
                    }
                }
            }
        }

        // Rendu de la vue
        $this->render('register/index', compact('error', 'success'));
    }
}