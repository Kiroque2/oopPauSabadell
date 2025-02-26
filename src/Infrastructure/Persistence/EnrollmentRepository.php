<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IEnrollmentRepository;
use App\School\Entities\Enrollment;
use PDO;

class EnrollmentRepository implements IEnrollmentRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function save(Enrollment $enrollment) {
        $stmt = $this->pdo->prepare("INSERT INTO enrollments (student_id, course_id, date) VALUES (:student_id, :course_id, :date)");
        return $stmt->execute([
            'student_id' => $enrollment->studentId,
            'course_id' => $enrollment->courseId,
            'date' => $enrollment->date
        ]);
    }

    public function findByDni(string $dni) {
        $stmt = $this->pdo->prepare("SELECT * FROM enrollments WHERE student_id = (SELECT id FROM students WHERE dni = :dni)");
        $stmt->execute(['dni' => $dni]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllEnrollments(): array {
        $stmt = $this->pdo->query("SELECT * FROM enrollments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
