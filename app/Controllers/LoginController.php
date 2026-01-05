<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Classes\User;
use Classes\Account;
use Models\UserModel;
use Controllers\NotificationController;

Class LoginController{

    private $userModel;
    private $notificationController;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->notificationController = new NotificationController();
    }

    public function index(){
        $this->notificationController->getNotification();
        require_once 'app/Views/LoginView.php';
        //require_once 'LoginView.php';

    }

    public function authentificate(){
        if(!isset($_POST["username"]) || !isset($_POST["password"])){
            header("Location: Login");
            exit();
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $this->userModel->getUserByUsername($username);

        if($user != null && password_verify($password, $user->getPassword())){
            $_SESSION["actualUser"] = $user;
            $user->setPassword($password);
            $_SESSION["loggedIn"] = true;
            $_SESSION["role"] = $user->getRole();

            header("Location: ../Dashboard");
        } else{
            $_SESSION["notification"] = [
                'message' => "Nom d'utilisateur ou mot de passe incorrect",
                'color' => 'var(--error)'
            ];
            header("Location: ../Login");
        }
        exit();
    }

    public function logout(){
        session_destroy();
        header("Location: Login");
        exit();
    }

    // Tester si le mot de passe est le bon
    public function isPasswordCorrect($user, $password){
        return password_verify($password, $user->getPassword());
    }
}