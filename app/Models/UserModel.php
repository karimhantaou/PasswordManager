<?php

    namespace Models;
    require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
    use Classes\User;
    use Config\Database;

    Class UserModel{

        // Récupérer un utilisateur par son identifiant
        public function getUserById($id)
        {
            $sql = "SELECT * FROM users WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Exécution de la requête

            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
            $creationDate = new \DateTime($userData['creationDate']);

             return new User(
                $userData['id'],
                $userData['username'],
                $userData['password'],
                $userData['tableName'],
                $userData['role'],
                $creationDate->format('d/m/Y H:i:s')
            );
        }

        // Récupérer tous les utilisateurs
        public function getAllUsers(){
            $sql = "SELECT * FROM users";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête

            $userData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $users = [];

            foreach($userData as $user){
                $creationDate = new \DateTime($user['creationDate']);

                $users[] = new User(
                    $user['id'],
                    $user['username'],
                    $user['password'],
                    $user['tableName'],
                    $user['role'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }

            return $users;
        }

        // Récupérer un utilisateur selon son nom d'utilisateur
        public function getUserByUsername($username){
            $sql = "SELECT * FROM users WHERE username = :username";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':username', $username);
            $stmt->execute(); // Exécution de la requête

            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($userData == null){
                return null;
            } else{
                $creationDate = new \DateTime($userData['creationDate']);
                return new User(
                    $userData['id'],
                    $userData['username'],
                    $userData['password'],
                    $userData['tableName'],
                    $userData['role'],
                    $creationDate->format('d/m/Y H:i:s')
                );
            }
        }

        // Ajouter un utilisateur
        public function insertUser($user){
            $username = $user->getUsername();
            $password = $user->getPassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "INSERT INTO users (username, password, tableName, role) VALUES (:username, :password, :tableName, :role)";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role); // Liaison du paramètre :role avec le rôle

            try{
                return $stmt->execute(); // Exécution de la requête
            } catch(\Exception $e){
                return false;
            }
        }

        // Ajouter un utilisateur avec retour booléen
        public function insertUserBool($user){
            $username = $user->getUsername();
            $password = $user->getPassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "INSERT INTO users (username, password, tableName, role) VALUES (:username, :password, :tableName, :role)";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role); // Liaison du paramètre :role avec le rôle

            return $stmt->execute(); // Exécution de la requête
        }

        // Mettre à jour un utilisateur
        public function updateUser(User $user){
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "UPDATE users SET username = :username, password = :password, tableName = :tableName, role = :role WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role); // Liaison du paramètre :role avec le rôle

            $stmt->execute(); // Exécution de la requête
        }

        // Mettre à jour un utilisateur selon son identifiant
        public function updateUserById($id, $user){
            $username = $user->getUsername();
            $password = $user->getPassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "UPDATE users SET username = :username, password = :password, tableName = :tableName, role = :role WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role); // Liaison du paramètre :role avec le rôle

            $stmt->execute(); // Exécution de la requête
        }

        // Mettre à jour un utilisateur sans mot de , par son identifiant
        public function updateUserNoPassword($id, $user){
            $username = $user->getUsername();
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "UPDATE users SET username = :username, tableName = :tableName, role = :role WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role); // Liaison du paramètre :role avec le rôle

            $stmt->execute(); // Exécution de la requête
        }

        //Mettre à jour nom d'utilisateur et mot de passe
        public function updateUsernameAndPassword($user){
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET username = :username, password = :password WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe

             return $stmt->execute(); // Exécution de la requête
    }

        // Mettre à jour le nom d'utilisateur, le mot de passe et la table
        public function updateUserAdmin($user){
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            //$password = password_hash($password, PASSWORD_DEFAULT);
            $tableName = $user->getTableName();
            $role = $user->getRole();

            $sql = "UPDATE users SET username = :username, password = :password, tableName = :tableName, role = :role WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur
            $stmt->bindParam(':username', $username); // Liaison du paramètre :username avec le nom d'utilisateur
            $stmt->bindParam(':password', $password); // Liaison du paramètre :password avec le mot de passe
            $stmt->bindParam(':tableName', $tableName); // Liaison du paramètre :tableName avec le nom de la table
            $stmt->bindParam(':role', $role);

            try{
                return $stmt->execute(); // Exécution de la requête
            } catch(\Exception $e){
                return false;
            }
        }


        // Supprimer tout les utilisateurs
        public function deleteAllUsers(){
            $sql = "DELETE FROM users";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->execute(); // Exécution de la requête
        }

        // Supprimer un utilisateur par son identifiant
        public function deleteUserById($id){
            $sql = "DELETE FROM users WHERE id = :id";

            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données

            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            $stmt->bindParam(':id', $id); // Liaison du paramètre :id avec l'identifiant de l'utilisateur

            try{
                return $stmt->execute(); // Exécution de la requête
            } catch(\Exception $e){
                return false;
            }
        }

        // Créer une table pour un utilisateur
        public function createTable($tableName){
            $sql = "CREATE TABLE IF NOT EXISTS $tableName (
      `id` int NOT NULL AUTO_INCREMENT,
      `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
      `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Aucune',
      `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    )";
            $db = new Database(); // Création d'une instance de la classe Database
            $conn = $db->getConnection(); // Obtention de la connexion à la base de données
            $stmt = $conn->prepare($sql); // Préparation de la requête SQL
            try{
                return $stmt->execute(); // Exécution de la requête
            } catch(\Exception $e){
                $_SESSION['error'] = $e->getMessage();
                return false;
            }
        }

        public function deleteUserTable($tableName){
            $sql = "DROP TABLE $tableName";

            $db = new Database();
            $conn = $db->getConnection();

            $stmt = $conn->prepare($sql);

            try{
                return $stmt->execute();
            } catch(\Exception $e){
                $_SESSION['error'] = $e->getMessage();
                return false;
            }
        }
    }