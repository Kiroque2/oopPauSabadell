<?php

namespace App\Infrastructure\Persistence;

use App\School\Entities\Course;
use PDO;

class CourseRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para crear un nuevo curso
    public function createCourse(Course $course) {
        $stmt = $this->pdo->prepare("INSERT INTO courses (name) VALUES (:name)");
        $stmt->bindParam(':name', $course->getName());
        $stmt->execute();
    }

    // Método para obtener todos los cursos
    public function getAllCourses() {
        $stmt = $this->pdo->query("SELECT * FROM courses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function assignStudentToCourse(int $studentId, int $courseId): bool {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO student_courses (student_id, course_id) VALUES (:student_id, :course_id)");
            return $stmt->execute(['student_id' => $studentId, 'course_id' => $courseId]);
        } catch (PDOException $e) {
            return false;
        }
    }
}
