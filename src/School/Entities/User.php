<?php

    namespace App\School\Entities;

     class User{
        private int $id;
        private string $uuid;
        private string $firstname;
        private string $lastname;
        private string $email;
        private string $password;
        private ?\DateTime $createdAt=null;
        private ?\DateTime $updatedAt=null;
        private string $usertype;


        function __construct($id, $uuid, $firstname, $lastname, $email, $password, $createdAt, $updatedAt, $usertype){
            $this->id=$id;
            $this->uuid=$uuid;
            $this->firstname=$firstname;
            $this->lastname=$lastname;
            $this->email=$email;
            $this->password=$password;
            $this->createdAt=$createdAt;
            $this->updatedAt=$updatedAt;
            $this->usertype=$usertype;
        }

        function setId(int $id){
            $this->id=$id;
            return $this;
        }

        function getId(){
            return $this->id;
        }

        function setUuid(string $uuid){
            $this->uuid=$uuid;
            return $this;
        }

        function getUuid(){
            return $this->uuid;
        }

        function setFirstname(string $firstname){
            $this->firstname=$firstname;
            return $this;
        }

        function getFirstname(){
            return $this->firstname;
        }

        function setLastname(string $lastname){
            $this->lastname=$lastname;
            return $this;
        }

        function getLastname(){
            return $this->lastname;
        }
        

        function setEmail(string $email){
            $this->email=$email;
            return $this;
        }

        function getEmail(){
            return $this->email;
        }

        function setPassword(string $password){
            $this->password=$password;
            return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        function setCreatedAt(\DateTime $createdAt){
            $this->createdAt=$createdAt;
            return $this;
        }

        function getCreatedAt(){
            return $this->createdAt;
        }

        function setUpdatedAt(\DateTime $updatedAt){
            $this->updatedAt=$updatedAt;
            return $this;
        }

        function getUpdatedAt(){
            return $this->updatedAt;
        }

        function setUsertype(string $usertype){
            $this->usertype=$usertype;
            return $this;
        }

        function getUsertype(){
            return $this->usertype;
        }
    }