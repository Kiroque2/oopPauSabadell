<?php

    namespace App\School\Entities;

    use App\School\Entities\User;
   
    use App\School\Trait\Timestampable;

    class Student extends User {
        private int $id;
        private int $userId;
        private string $dni;
        private string $enrollmentyear;
        use Timestampable;

        function __construct($id, $userId, $dni, $enrollmentyear, $uuid, $firstname, $lastname, $email, $password, $createdAt, $updatedAt, $usertype){
            $this->id = $id;
            $this->userId = $userId;
            $this->dni = $dni;
            $this->enrollmentyear = $enrollmentyear;
            parent::__construct($uuid, $firstname, $lastname, $email, $password, $createdAt, $updatedAt, $usertype);
        }

        public function getId(){
            return $this->id;
        }

        public function setId(){
            $this->id=$id;
            return $this;
        }

        public function getDni(){
            return $this->dni;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function setUserId($userId){
            $this->userId=$userId;
            return $this;
        }

        public function setDni(string $dni){
            $this->dni=$dni;
            return $this;
        }

        public function getEnrollmentYear(){
            return $this->enrollmentyear;
        }

        public function setEnrollmentYear(string $enrollmentyear){
            $this->enrollmentyear=$enrollmentyear;
            return $this;
        }

        public function getEnrollments(){
            return $this->enrollments;
        }


        public function addEnrollment(Enrollment $enrollment){
            $this->enrollments[]=$enrollment;
        }   

        protected $enrollments=[];

        public function showSchool(){
            echo parent::MYSCHOOL;
        }
       
      
    }