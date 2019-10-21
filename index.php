<?php

// Inclusion des fichiers principaux
include_once '_config/config.php';
include_once '_functions/functions.php';


// Définition de la page courante
// si je suis connecté :

  if (isset($_GET['page']) AND !empty($_GET['page'])) {
    $page = trim(strtolower($_GET['page']));
} else { //si non la page homme index.php qui est la page de connexion
    $page = 'connexion';
}
 
 


// Tableau contenant toutes les pages
$allPages = scandir('controllers/');

// Vérification de l'existence de la page
if (in_array($page.'_controller.php', $allPages)) {

    // Connexion à la base de données
    include_once '_config/db.php';

    // Inclusion de la page
    include_once 'models/'.$page.'_model.php';
    include_once 'controllers/'.$page.'_controller.php';
    include_once 'views/'.$page.'_view.php';

} else {

    // Inclusion de la page erreur
    include_once 'models/error_model.php';
    include_once 'controllers/error_controller.php';
    include_once 'views/error_view.php';

}


