<?php 

namespace App\School\Entities;

class Course {
    protected $id;
    protected $name;
    protected $degreeId;  

   
    function __construct(string $name, int $degreeId = null, int $id = null) {
        $this->name = $name;
        $this->degreeId = $degreeId;  
        if ($id) {
            $this->id = $id;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDegreeId() {
        return $this->degreeId;
    }

    public function setDegreeId(int $degreeId) {
        $this->degreeId = $degreeId;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }
}
