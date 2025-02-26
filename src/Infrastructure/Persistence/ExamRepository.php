<?php

namespace App\Infrastructure\Persistence;

use App\School\Repositories\IExamRepository;
use App\School\Entities\Exams;
use PDO;

class ExamRepository implements IExamRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllExams(): array {
        $stmt = $this->pdo->query("SELECT * FROM exams");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findExamById(int $id): ?Exams {
        $stmt = $this->pdo->prepare("SELECT * FROM exams WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $examData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $examData ? new Exams($examData['id'], $examData['name'], $examData['date']) : null;
    }

    public function save(Exams $exam): bool {
        $stmt = $this->pdo->prepare("INSERT INTO exams (name, date) VALUES (:name, :date)");
        return $stmt->execute([
            'name' => $exam->getName(),
            'date' => $exam->getDate(),
        ]);
    }

    public function deleteExamById(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM exams WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
