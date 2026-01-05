<?php

namespace Controllers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Classes\User;
use Classes\Account;
use Models\UserModel;
use Models\AccountModel;
use Helpers\DatabaseHelpers;

Class DashboardController{

    private $userModel;
    private $accountModel;
    private $databaseHelpers;
    private String $viewPath = "app/Views/DashboardView.php";
    private String $noViewPath = "app/Views/NoAccountTableView.php";
    private String $headerPath = "app/Views/HeaderView.php";
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

            $actualUser = $_SESSION["actualUser"];
            $role = $actualUser->getRole();

            require_once dirname(__DIR__, 2) . "/" . $this->headerPath;

            if($actualUser->getTableName() != "none" && !empty($actualUser->getTableName())){
                $actualUserTableName = $actualUser->getTableName();
                $accounts = $this->accountModel->getAllAccounts($actualUserTableName);
                $categories = $this->accountModel->getAllCategories($actualUserTableName);

                if(!isset($_POST['searchTerm']) || empty($_POST['searchTerm'])){
                    $searchTerm = null;
                } else{
                    $searchTerm = $_POST['searchTerm'];
                }

                if(!isset($_POST['category']) || $_POST['category'] == "null"){
                    $category = null;
                } else{
                    $category = $_POST['category'];
                }

                if(!isset($_POST['sort']) || empty($_POST['sort'])){
                    $sort = "recent";
                } else{
                    $sort = $_POST['sort'];
                }

                $accounts = $this->accountModel->getAllAccountsTest($actualUserTableName, $sort, $category, $searchTerm);
                $accounts = $this->decipherAccounts($accounts);
                require_once $this->viewPath;
            } else{
                require_once $this->noViewPath;
            }
        } else {
            header("Location: Login");
            exit();
        }
    }

    public function decipherAccounts($accounts){
        foreach($accounts as $account){
            $account->setUsername($this->databaseHelpers->decipher($account->getUsername()));
            $account->setPassword($this->databaseHelpers->decipher($account->getPassword()));
            $account->setComment($this->databaseHelpers->decipher($account->getComment()));
        }
        return $accounts;
    }

    public function addAccount(){
        if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['category']) && isset($_SESSION["actualUser"])) {
            $actualUserTableName = $_SESSION["actualUser"]->getTableName();

            $name = $_POST['name'];
            $username = $this->databaseHelpers->cipher($_POST['username']);
            $password = $this->databaseHelpers->cipher($_POST['password']);
            $comment = $this->databaseHelpers->cipher($_POST['comment']) ?? "";

            if(!empty($_POST['newCategory']))
                $category = $_POST['newCategory'];
            else
                $category = $_POST['category'];

            $account = new Account(null, $name, $username, $password, $comment, $category, null);

            $this->accountModel->insertAccount($actualUserTableName, $account);
        }
        header("Location: Login");
        exit();
    }

    public function deleteAccount(){
        if(isset($_POST['id']) && isset($_SESSION["actualUser"])) {
            $actualUserTableName = $_SESSION["actualUser"]->getTableName();
            $id = $_POST['id'];
            $this->accountModel->deleteAccount($actualUserTableName, $id);
        }
        header("Location: Login");
        exit();
    }

    public function updateAccount(){
        if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['category']) && isset($_SESSION["actualUser"])) {
            $actualUserTableName = $_SESSION["actualUser"]->getTableName();

            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $this->databaseHelpers->cipher($_POST['username']);
            $password = $this->databaseHelpers->cipher($_POST['password']);
            $comment = $this->databaseHelpers->cipher($_POST['comment']) ?? "";

            if(!empty($_POST['newCategory']))
                $category = $_POST['newCategory'];
            else
                $category = $_POST['category'];

            $account = new Account($id, $name, $username, $password, $comment, $category, null);

            $this->accountModel->updateAccount($actualUserTableName, $account);
        }
        header("Location: Login");
        exit();
    }

}