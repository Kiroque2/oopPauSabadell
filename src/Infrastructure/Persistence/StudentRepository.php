<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IStudentRepository;
use App\Infrastructure\Database\DatabaseConnection;
use PDO;

class StudentRepository implements IStudentRepository {
    private PDO $db;

    public function __construct() {
        $this->db = DatabaseConnection::getConnection();
    }

    public function getAllStudents(): array {
        $query = "
            SELECT s.id, s.user_id, s.dni, s.enrollment_year, 
                   u.first_name, u.last_name, u.email 
            FROM students s
            JOIN users u ON s.user_id = u.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStudent(int $user_id, string $dni, int $enrollment_year): bool {
        $query = "INSERT INTO students (user_id, dni, enrollment_year) VALUES (:user_id, :dni, :enrollment_year)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':enrollment_year', $enrollment_year, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Implementación del método getStudentById
    public function getStudentById(int $id): ?array {
        $query = "
            SELECT s.id, s.user_id, s.dni, s.enrollment_year, 
                   u.first_name, u.last_name, u.email 
            FROM students s
            JOIN users u ON s.user_id = u.id
            WHERE s.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        return $student ?: null;
    }

    // Implementación del método deleteStudentById
    public function deleteStudentById(int $id): bool {
        $query = "DELETE FROM students WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
