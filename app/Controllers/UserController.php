<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Classes\User;
use Classes\Account;
use Models\UserModel;
use Models\AccountModel;
use Helpers\DatabaseHelpers;

Class UserController{

    private $userModel;
    private $accountModel;
    private $databaseHelpers;
    private $viewPath = "app/Views/UserView.php";
    private $headerPath = "app/Views/HeaderView.php";
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->accountModel = new AccountModel();
        $this->databaseHelpers = new DatabaseHelpers();
    }

    public function index()
    {
        if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
            header("Location: Login");
            exit();
        }
        if (file_exists($this->viewPath)) {

            // Récupération de l'utilisateur actuel
            $actualUser = $_SESSION["actualUser"];
            $actualUserTableName = $actualUser->getTableName();

            // Récupération de tous les comptes de l'utilisateur
            $id = $actualUser->getId();
            $username = $actualUser->getUsername();
            $password = $actualUser->getPassword();
            $role = $actualUser->getRole();

            switch($role){
                case 0:
                    $userRole = "Administrateur";
                    break;
                case 1:
                    $userRole = "Utilisateur";
                    break;
                case 2:
                    $userRole = "Invité";
                    break;
            }
            $creationDate = $actualUser->getCreationDate();

            require_once dirname(__DIR__, 2) . "/" . $this->headerPath;
            require_once dirname(__DIR__, 2) . "/" . $this->viewPath;
        } else {
            header("Location: Login");
            exit();
        }
    }

    public function updateUser(){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User($id, $username, $password, null, null, null);

        if($this->userModel->updateUsernameAndPassword($user)){
            $actualUser = $this->userModel->getUserById($id);
            $actualUser->setPassword($password);
            $_SESSION['actualUser'] = $actualUser;
        }

        header("Location: User");
        exit();
    }
}