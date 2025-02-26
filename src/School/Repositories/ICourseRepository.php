<?php

namespace App\School\Repositories;

interface ICourseRepository {
    public function getAllCourses(): array;
    public function createCourse(string $name, int $degree_id): bool;
    public function assignStudentToCourse(int $studentId, int $courseId): bool; 
}
