<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Classes\User;
use Classes\Account;
use Models\UserModel;
use Models\AccountModel;


Class PasswordController{


    private $viewPath = "app/Views/PasswordView.php";
    private $headerPath = "app/Views/HeaderView.php";

    public function index()
    {
        if (file_exists($this->viewPath)) {

            if(isset($_SESSION["actualUser"])){
                $actualUser = $_SESSION["actualUser"];
                $role = $actualUser->getRole();
                require_once dirname(__DIR__, 2) . "/" . $this->headerPath;
            }
            require_once dirname(__DIR__, 2) . "/" . $this->viewPath;
        }
        else{
            header("Location: Login");
            exit();
        }
    }
}