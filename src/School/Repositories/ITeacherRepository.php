<?php

namespace App\School\Repositories;

interface ITeacherRepository {
    public function getTeacherByUserId(int $userId);
    public function createTeacher(int $userId): int;
    public function assignTeacherToDepartment(int $teacherId, int $departmentId): bool;
}
