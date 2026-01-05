<?php


namespace Router;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
use Controllers\LoginController;

class Router {

    public function route($url){

        // Vérifier si l'URL est vide
        if(empty($url)){
            header("Location: Login");
            exit();
        }

        // Découper l'URL
        $urlParts = explode('/', $url);
        $controllerName = "Controllers\\" . $urlParts[0] . "Controller";
        $methodName = $urlParts[1] ?? "index";

        // Vérifier si le contrôleur existe
        if(class_exists($controllerName)){
            // Instancier le contrôleur
            $controller = new $controllerName();

            if(method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else{
                // Rediriger vers la page de connexion si la méthode n'existe pas
                header("Location: ../" . $urlParts[0]);
                exit();
            }
        } else{
            // Rediriger vers la page de connexion si le contrôleur n'existe pas
            header("Location: Login");
            exit();
        }
    }
}
