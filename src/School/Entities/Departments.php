<?php

namespace App\School\Entities;

use App\School\Entities\Teacher;


class Departments {

    protected int $id;
    protected string $name;

    function __construct(int $id, string $name){
        $this->id=$id;
        $this->name=$name;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setId(int $id){
        $this->id=$id;
        return $this;
    }

    public function setName(string $name){
        $this->name=$name;
        return $this;
    }

    

}