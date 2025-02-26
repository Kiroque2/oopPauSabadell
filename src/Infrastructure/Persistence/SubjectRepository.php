<?php

namespace App\Infrastructure\Persistence;

use App\School\Entities\Subject;
use PDO;

class SubjectRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los sujetos
    public function getAllSubjects(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM subjects");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo sujeto
    public function createSubject(Subject $subject): bool {
        $stmt = $this->pdo->prepare("INSERT INTO subjects (name) VALUES (:name)");
        $stmt->bindParam(':name', $subject->getName());
        return $stmt->execute();
    }

    // Obtener un sujeto por ID
    public function getSubjectById(int $id): ?Subject {
        $stmt = $this->pdo->prepare("SELECT * FROM subjects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Subject($data['name']);
        }
        return null;
    }
    
    // Actualizar un sujeto
    public function updateSubject(int $id, Subject $subject): bool {
        $stmt = $this->pdo->prepare("UPDATE subjects SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $subject->getName());
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Eliminar un sujeto
    public function deleteSubject(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM subjects WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
