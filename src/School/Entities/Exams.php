<?php 

    namespace App\School\Entities;

    class Exams extends Subject{

        protected int $id;
        protected int $subject_id;
        protected ?\DateTime $exam_date;
        protected string $description;
        

        function __construct(int $id, int $subject_id, ?\DateTime $exam_date, string $description){
            $this->id=$id;
            $this->subject_id=$subject_id;
            $this->exam_date=$exam_date;
            $this->description=$description;
        }

        public function getId(){
            return $this->id;
        }

        public function getSubjectId(){
            return $this->subject_id;
        }

        public function getExamDate(){
            return $this->exam_date;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setId(int $id){
            $this->id=$id;
            return $this;
        }

        public function setSubjectId(int $subject_id){
            $this->subject_id=$subject_id;
            return $this;
        }   

        public function setExamDate(?\DateTime $exam_date){
            $this->exam_date=$exam_date;
            return $this;
        }

        public function setDescription(string $description){
            $this->description=$description;
            return $this;
        }

        


    }