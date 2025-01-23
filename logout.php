<?php
session_start(); // Démarrer la session

// Détruire toutes les variables de session
$_SESSION = [];

// Si vous souhaitez détruire complètement la session, utilisez session_destroy()
session_destroy();

// Rediriger vers la page d'accueil ou la page de connexion
header("Location: /ICO/"); // Redirige vers la page d'accueil
exit();
