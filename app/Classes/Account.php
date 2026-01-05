<?php

    namespace Classes;
    Class Account{

        // Properties

        private $id;
        private $name;
        private $username;
        private $password;
        private $comment;
        private $category;
        private $creationDate;

        // Constructor
        public function __construct($id, $name, $username, $password, $comment, $category, $creationDate)
        {
            $this->id = $id;
            $this->name = $name;
            $this->username = $username;
            $this->password = $password;
            $this->comment = $comment;
            $this->category = $category;
            $this->creationDate = $creationDate;
        }

        // Getters

        public function getId()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getComment()
        {
            return $this->comment;
        }

        public function getCategory()
        {
            return $this->category;
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

        public function setName($name): void
        {
            $this->name = $name;
        }

        public function setUsername($username): void
        {
            $this->username = $username;
        }

        public function setPassword($password): void
        {
            $this->password = $password;
        }

        public function setComment($comment): void
        {
            $this->comment = $comment;
        }

        public function setCategory($category): void
        {
            $this->category = $category;
        }

        public function setCreationDate($creationDate): void
        {
            $this->creationDate = $creationDate;
        }
    }

