<?php

namespace App\Infrastructure\Persistence;

use App\School\Entities\Degree;
use PDO;

class DegreeRepository {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Crear un nuevo degree
    public function createDegree(Degree $degree): bool {
        $sql = "INSERT INTO degrees (name, duration_years) VALUES (:name, :duration_years)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $degree->getName());
        $stmt->bindParam(':duration_years', $degree->getDurationYears());

        return $stmt->execute();
    }

    // Obtener todos los degrees
    public function getAllDegrees(): array {
        $sql = "SELECT * FROM degrees";
        $stmt = $this->pdo->query($sql);
        $degrees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $degrees;
    }

    // Obtener un degree por su ID
    public function getDegreeById(int $id): ?Degree {
        $sql = "SELECT * FROM degrees WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $degreeData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($degreeData) {
            return new Degree($degreeData['id'], $degreeData['name'], $degreeData['duration_years']);
        }

        return null;
    }
}
