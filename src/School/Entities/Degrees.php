<?php

namespace App\School\Entities;

use App\School\Entities\Subject;

class Degree {
    protected int $id;
    protected string $name;
    protected int $duration_years;
    protected array $subjects = [];  

    function __construct(int $id, string $name, int $duration_years) {
        $this->id = $id;
        $this->name = $name;
        $this->duration_years = $duration_years;
    }

 
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDurationYears(): int {
        return $this->duration_years;
    }


    public function addSubject(Subject $subject): self {
        $this->subjects[] = $subject;
        return $this;
    }

  
    public function getSubjects(): array {
        return $this->subjects;
    }
}
