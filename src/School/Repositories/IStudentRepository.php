<?php

namespace App\School\Repositories;

interface IStudentRepository {
    public function getAllStudents(): array;
    public function createStudent(int $user_id, string $dni, int $enrollment_year): bool;
    public function getStudentById(int $id): ?array;
    public function deleteStudentById(int $id): bool;
}
