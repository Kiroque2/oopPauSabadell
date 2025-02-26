<?php

namespace App\School\Repositories;

use App\School\Entities\Subject;

interface ISubjectRepository {
    public function getAllSubjects(): array;
    public function findSubjectById(int $id): ?Subject;
    public function createSubject(string $name): bool;
}
