<?php

namespace App\School\Entities;

class Teacher {
    private $id;
    private $userId;
    private $departmentId;

    public function __construct($id = null, $userId = null, $departmentId = null) {
        $this->id = $id;
        $this->userId = $userId;
        $this->departmentId = $departmentId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getDepartmentId() {
        return $this->departmentId;
    }

 
}
