<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 

require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';
require_once './controller/CardController.php';
require_once './controller/CardsDistributionController.php';
require_once './controller/EventController.php';
require_once './controller/GameController.php';
require_once './controller/MaterialController.php';
require_once './controller/MessageController.php';
require_once './controller/PostController.php';
require_once './controller/BackofficeController.php';
require_once './controller/LoginController.php';
require_once './controller/RegisterController.php';
$router = new AltoRouter();

$router->setBasePath('/ICO');

// Définissez vos routes ici
$router->map('GET', '/', 'HomeController#index', 'home');
$router->map('GET', '/regles_du_jeu', 'RulesController#index', 'rules');
$router->map('GET', '/contact', 'ContactController#index', 'contact');
$router->map('POST', '/contact/send', 'ContactController#sendMail', 'contact_send');
$router->map('GET', '/backoffice', 'BackOfficeController#index', 'backoffice');
$router->map('GET', '/backoffice/cartes-bonus', 'BackOfficeController#cartesBonus', 'cartes_bonus');
$router->map('GET', '/backoffice/cartes-roles', 'BackOfficeController#cartesRoles', 'cartes_roles');
$router->map('GET', '/backoffice/cartes-action', 'BackOfficeController#cartesAction', 'cartes_action');
$router->map('GET', '/backoffice/distribution-cartes', 'BackOfficeController#distributionCartes', 'distribution_cartes');
$router->map('GET', '/backoffice/materiel', 'BackOfficeController#materiel', 'materiel');
$router->map('GET', '/backoffice/evenements', 'BackOfficeController#evenements', 'evenements');
$router->map('GET', '/backoffice/jeux-extensions', 'BackOfficeController#jeuxExtensions', 'jeux_extensions');
$router->map('GET', '/backoffice/articles', 'BackOfficeController#articles', 'articles');
$router->map('GET', '/inscription', 'InscriptionController#index', 'inscription');

// Routes pour Card
$router->map('GET', '/cards', 'CardController#getAll', 'cards_list');
$router->map('POST', '/cards/create', 'CardController#createCard', 'cards_create');
$router->map('GET', '/cards/[i:id]', 'CardController#read', 'cards_read');

$router->map('POST', '/cards/[i:id]/delete', 'CardController#delete', 'cards_delete');
$router->map('POST', '/cards/update/[i:id]', 'CardController#updateCard', 'cards_update');

// Routes pour CardsDistribution
$router->map('GET', '/cards-distribution', 'CardsDistributionController#getAll', 'cards_distribution_list');
$router->map('POST', '/cards-distribution/create', 'CardsDistributionController#create', 'cards_distribution_create');
$router->map('GET', '/cards-distribution/[i:id]', 'CardsDistributionController#read', 'cards_distribution_read');
$router->map('POST', '/cards-distribution/[i:id]/update', 'CardsDistributionController#update', 'cards_distribution_update');
$router->map('POST', '/cards-distribution/[i:id]/delete', 'CardsDistributionController#delete', 'cards_distribution_delete');

// Routes pour Event
$router->map('GET', '/events', 'EventController#getAll', 'events_list');
$router->map('POST', '/events/create', 'EventController#create', 'events_create');
$router->map('GET', '/events/[i:id]', 'EventController#read', 'events_read');
$router->map('POST', '/events/[i:id]/update', 'EventController#update', 'events_update');
$router->map('POST', '/events/[i:id]/delete', 'EventController#delete', 'events_delete');

// Routes pour Game
$router->map('GET', '/games', 'GameController#getAll', 'games_list');
$router->map('POST', '/games/create', 'GameController#create', 'games_create');
$router->map('GET', '/games/[i:id]', 'GameController#read', 'games_read');
$router->map('POST', '/games/[i:id]/update', 'GameController#update', 'games_update');
$router->map('POST', '/games/[i:id]/delete', 'GameController#delete', 'games_delete');

// Routes pour Material
$router->map('GET', '/materials', 'MaterialController#getAll', 'materials_list');
$router->map('POST', '/materials/create', 'MaterialController#create', 'materials_create');
$router->map('GET', '/materials/[i:id]', 'MaterialController#read', 'materials_read');
$router->map('POST', '/materials/[i:id]/update', 'MaterialController#update', 'materials_update');
$router->map('POST', '/materials/[i:id]/delete', 'MaterialController#delete', 'materials_delete');

// Routes pour Message
$router->map('GET', '/messages', 'MessageController#getAll', 'messages_list');
$router->map('POST', '/messages/create', 'MessageController#create', 'messages_create');
$router->map('GET', '/messages/[i:id]', 'MessageController#read', 'messages_read');
$router->map('POST', '/messages/[i:id]/update', 'MessageController#update', 'messages_update');
$router->map('POST', '/messages/[i:id]/delete', 'MessageController#delete', 'messages_delete');

// Routes pour Post
$router->map('GET', '/posts', 'PostController#getAll', 'posts_list');
$router->map('POST', '/posts/create', 'PostController#create', 'posts_create');
$router->map('GET', '/posts/[i:id]', 'PostController#read', 'posts_read');
$router->map('POST', '/posts/[i:id]/update', 'PostController#update', 'posts_update');
$router->map('POST', '/posts/[i:id]/delete', 'PostController#delete', 'posts_delete');

// Routes pour Login
$router->map('GET|POST', '/login', 'LoginController#index', 'login');


// Routes pour Register
$router->map('POST', '/inscription', 'RegisterController#index', 'register');

$match = $router->match();

if (is_array($match)) {
    $controller = $match['target'];
    list($controllerName, $actionName) = explode('#', $controller);
    $controllerName = "\\App\\Controller\\" . $controllerName;
    
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            call_user_func_array([$controller, $actionName], $match['params']);
        } else {
            // Gérer l'erreur : méthode non trouvée
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found: Action not found";
        }
    } else {
        // Gérer l'erreur : contrôleur non trouvé
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found: Controller not found";
    }
} else {
    // Gérer l'erreur : route non trouvée
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found: Page not found";
}
