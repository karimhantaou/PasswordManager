<?php

require_once __DIR__ . '/vendor/autoload.php';

use Router\Router;
use Dotenv\Dotenv;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// vérifier qu'elles existent
$dotenv->required([
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    'DB_PASSWORD'
]);

// Démarrer la session
session_start();

// Router
$router = new Router();

// Récupérer l'URL demandée
$url = $_GET['url'] ?? '';

// Lancer le routeur
$router->route($url);
