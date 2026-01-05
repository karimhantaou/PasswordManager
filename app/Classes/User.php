<?php

    namespace Classes;
    use Classes\Account;

    Class User
    {

        // Properties

        private $id;
        private $username;
        private $password;
        private $tableName;
        private $role;

        private $creationDate;

        // Constructor
        public function __construct($id, $username, $password, $tableName, $role, $creationDate)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->tableName = $tableName;
            $this->role = $role;
            $this->creationDate = $creationDate;
        }

        // Getters
        public function getId()
        {
            return $this->id;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getTableName()
        {
            return $this->tableName;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function getCreationDate()
        {
            return $this->creationDate;
        }

        // Setters
        public function setId($id): void
        {
            $this->id = $id;
        }

        public function setUsername($username): void
        {
            $this->username = $username;
        }

        public function setPassword($password): void
        {
            $this->password = $password;
        }

        public function setTableName($tableName): void
        {
            $this->tableName = $tableName;
        }

        public function setRole($role): void
        {
            $this->role = $role;
        }
    }