<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Classes\User;
use Classes\Account;
use Models\UserModel;
use Models\AccountModel;
use Helpers\DatabaseHelpers;

Class AdminController{

    private $userModel;
    private $accountModel;
    private $databaseHelpers;
    private $notificationController;
    private $viewPath = "app/Views/AdminView.php";
    private $headerPath = "app/Views/HeaderView.php";

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->accountModel = new AccountModel();
        $this->notificationController = new NotificationController();
    }

    public function index()
    {
        if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || $_SESSION['role'] != 0)
            {
                $_SESSION['notification'] = [
                    'message' => "Vous n'avez pas les droits pour accéder à cette page",
                    'color' => 'var(--error)'
                ];
                header("Location: Login");
                exit();
            }


        if (file_exists($this->viewPath)) {
            $actualUser = $_SESSION["actualUser"];
            $actualUserTableName = $actualUser->getTableName();
            $role = $actualUser->getRole();

            //

            $users = $this->userModel->getAllUsers();

            //

            $this->notificationController->getNotification();
            require_once $this->headerPath;
            require_once $this->viewPath;
        } else {
            $_SESSION['notification'] = [
                'message' => "La page demandée n'existe pas",
                'color' => 'var(--error)'
            ];
            header("Location: Login");
            exit();
        }
    }

    public function updateUser(){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $tableName = $_POST['tableName'];
        $role = $_POST['role'];

        if(!empty($_POST['newPassword'])){
            $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        } else{
            $password = $_POST['oldPassword'];
        }

        $user = new User($id, $username, $password, $tableName, $role, null);

        if($this->userModel->updateUserAdmin($user)){
            $_SESSION['notification'] = [
                'message' => "L'utilisateur a bien été modifié",
                'color' => 'var(--success)'
            ];
        } else{
            $_SESSION['notification'] = [
                'message' => "L'utilisateur n'a pas pu être modifié",
                'color' => 'var(--error)'
            ];
        }
        header("Location: Admin");
        exit();
    }

    public function deleteUser(){
        $id = $_POST['id'];
        $tableName = $_POST['tableName'];

        if($this->userModel->deleteUserById($id)){
            if($this->userModel->deleteUserTable($tableName)){
                $_SESSION['notification'] = [
                    'message' => "L'utilisateur a bien été supprimé",
                    'color' => 'var(--success)'
                ];
            } else{
                $_SESSION['notification'] = [
                    'message' => $_SESSION['error'],
                    'color' => 'var(--error)'
                ];
            }
        } else{
            $_SESSION['notification'] = [
                'message' => "L'utilisateur n'a pas pu être supprimé",
                'color' => 'var(--error)'
            ];
        }
        header("Location: Admin");
        exit();
    }

    public function insertUser(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $tableName = $this->randomString(10);
        $role = $_POST['role'];

        $user = new User(null, $username, $password, $tableName, $role, null);


        if($this->userModel->insertUser($user)){
            if($this->userModel->createTable($tableName)){
                $_SESSION['notification'] = [
                    'message' => "L'utilisateur a bien été ajouté",
                    'color' => 'var(--success)'
                ];
            } else{
                $_SESSION['notification'] = [
                    'message' => $_SESSION['error'],
                    'color' => 'var(--error)'
                ];
            }
        } else{
            $_SESSION['notification'] = [
                'message' => "L'utilisateur n'a pas pu être ajouté",
                'color' => 'var(--error)'
            ];
        }

        header("Location: Admin");
        exit();
    }

    function randomString($length): string{
        $c = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        $maxIndex = strlen($c) - 1;

        for ($i = 0; $i < $length; $i++) {
            $result .= $c[random_int(0, $maxIndex)];
        }

        return $result;
    }
}