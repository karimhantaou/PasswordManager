<?php

    namespace Models;
    require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
    use Classes\Account;
    use Config\Database;
    use Helpers\DatabaseHelpers;

    Class AccountModel{
        
        //Récupérer un compte par son identifiant
        public function getAccountById($tableName, $id): Account
        {
            $sql = "SELECT * FROM " . $tableName . " WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Exécution de la requête

            $accountData = $stmt->fetch(\PDO::FETCH_ASSOC);

            return new Account(
                $accountData['id'],
                $accountData['name'],
                $accountData['username'],
                $accountData['password'],
                $accountData['comment'],
                $accountData['category'],
                $accountData['creationDate']
            );
        }

        //Récupérer tous les comptes
        public function getAllAccounts($tableName): array{
            $sql = "SELECT * FROM " . $tableName;

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête

            $accountsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $accounts = [];

            foreach($accountsData as $account){

                $creationDate = new \DateTime($account['creationDate']);

                $accounts[] = new Account(
                    $account['id'],
                    $account['name'],
                    $account['username'],
                    $account['password'],
                    $account['comment'],
                    $account['category'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }

            return $accounts;
        }

        public function getAllAccountsSort($tableName, $sort): array{

            switch ($sort) {
                case 'recent':
                    $sort = 'creationDate DESC';
                    break;
                case 'ancient':
                    $sort = 'creationDate ASC';
                    break;
                case 'az':
                    $sort = 'name ASC';
                    break;
                case 'za':
                    $sort = 'name DESC';
                    break;
                default:
                    $sort = 'creationDate DESC';
                    break;
            }

            $sql = "SELECT * FROM " . $tableName . " ORDER BY " . $sort;

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête

            $accountsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $accounts = [];

            foreach($accountsData as $account){

                $creationDate = new \DateTime($account['creationDate']);

                $accounts[] = new Account(
                    $account['id'],
                    $account['name'],
                    $account['username'],
                    $account['password'],
                    $account['comment'],
                    $account['category'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }

            return $accounts;
        }

        public function getAllAccountsTest($tableName, $sort, $category, $search): array{

            switch ($sort) {
                case 'recent':
                    $sort = 'creationDate DESC';
                    break;
                case 'ancient':
                    $sort = 'creationDate ASC';
                    break;
                case 'az':
                    $sort = 'name ASC';
                    break;
                case 'za':
                    $sort = 'name DESC';
                    break;
                default:
                    $sort = 'creationDate DESC';
                    break;
            }

            $search = '%' . $search . '%';

            $sql = "SELECT * FROM " . $tableName . " WHERE (:search IS NULL OR name LIKE :search) AND (:category IS NULL OR category = :category) ORDER BY " . $sort;

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':search', $search);
            $stmt->bindParam(':category', $category);
            $stmt->execute(); // Exécution de la requête

            $accountsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $accounts = [];

            foreach($accountsData as $account){

                $creationDate = new \DateTime($account['creationDate']);

                $accounts[] = new Account(
                    $account['id'],
                    $account['name'],
                    $account['username'],
                    $account['password'],
                    $account['comment'],
                    $account['category'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }

            return $accounts;
        }

        public function searchAccounts($tableName, $searchTerm, $category): array{
            $sql = "SELECT * FROM " . $tableName . " WHERE name LIKE :searchTerm AND category = :category";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':searchTerm', $searchTerm);
            $stmt->bindParam(':category', $category);
            $stmt->execute(); // Exécution de la requête

            $accountsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $accounts = [];

            foreach($accountsData as $account){

                $creationDate = new \DateTime($account['creationDate']);

                $accounts[] = new Account(
                    $account['id'],
                    $account['name'],
                    $account['username'],
                    $account['password'],
                    $account['comment'],
                    $account['category'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }

            return $accounts;
        }

        public function getAllCategories($tableName){
            $sql = "SELECT DISTINCT category FROM " . $tableName . " WHERE category != 'Aucune'";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête

            $categoriesData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $categories = [];

            foreach($categoriesData as $category){
                $categories[] = $category['category'];
            }

            return $categories;
        }

        // Ajouter un compte
        public function insertAccount($tableName, $account){
            $db = new Database(); // Création d'une instance de la classe Database
            $helpers = new DatabaseHelpers(); // Création d'une instance de la classe DatabaseHelpers

            $name = $account->getName();
            $username = $account->getUsername();
            $password = $account->getPassword();
            $comment = $account->getComment();
            $category = $account->getCategory();

            $sql = "INSERT INTO " . $tableName ." (name, username, password, comment, category) VALUES (:name, :username, :password, :comment, :category)";

            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':name', $name); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':comment', $comment); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':category', $category); // Liaison du paramètre :role avec le rôle

            $stmt->execute(); // Exécution de la requête
        }

        public function deleteAccount($tableName, $id){
            $sql = "DELETE FROM " . $tableName . " WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Exécution de la requête
        }

        public function updateAccount($tableName, $account){

            $id = $account->getId();
            $name = $account->getName();
            $username = $account->getUsername();
            $password = $account->getPassword();
            $comment = $account->getComment();
            $category = $account->getCategory();

            $sql = "UPDATE " . $tableName . " SET name = :name, username = :username, password = :password, comment = :comment, category = :category WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':comment', $comment);
            $stmt->bindParam(':category', $category);
            $stmt->execute(); // Exécution de la requête
        }

    }