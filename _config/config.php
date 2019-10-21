<?php

// --------------------------- //
//       ERRORS DISPLAY        //
// --------------------------- //

//!\\ A enlever lors du déploiement
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', true);


// --------------------------- //
//          SESSIONS           //
// --------------------------- //

ini_set('session.cookie_lifetime', false);
session_start();


// --------------------------- //
//         CONSTANTS           //
// --------------------------- //

// Paths
define("PATH_REQUIRE", substr($_SERVER['SCRIPT_FILENAME'], 0, -9)); // Pour fonctions d'inclusion php
define("PATH", substr($_SERVER['PHP_SELF'], 0, -9)); // Pour images, fichiers etc (html)

// Website informations
define("WEBSITE_TITLE", "Site de chat de amirouche");
define("WEBSITE_NAME", "Amirouche chat");
define("WEBSITE_URL", "http://localhost/app/"); // constante de lien que je dois changer pendant le transfert
define("WEBSITE_DESCRIPTION", "ce site est un site de chat réalisé par amirouche hellal");
define("WEBSITE_KEYWORDS", "chat ,discussion,rencontre");
define("WEBSITE_LANGUAGE", "Français");
define("WEBSITE_AUTHOR", "Amirouche HELLAL");
define("WEBSITE_AUTHOR_MAIL", "hellal.amirouche@gmail.com");

// Facebook Open Graph tags
define("WEBSITE_FACEBOOK_NAME", "");
define("WEBSITE_FACEBOOK_DESCRIPTION", "");
define("WEBSITE_FACEBOOK_URL", "");
define("WEBSITE_FACEBOOK_IMAGE", "");

// DataBase informations
define("DATABASE_HOST", "localhost");
define("DATABASE_NAME", "tchat-amirouche");
define("DATABASE_USER", "root");
define("DATABASE_PASSWORD", "");


