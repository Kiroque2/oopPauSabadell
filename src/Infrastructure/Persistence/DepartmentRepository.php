<?php

namespace App\Infrastructure\Persistence;

use App\School\Entities\Departments;
use PDO;

class DepartmentRepository {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getDepartmentById($departmentId) {
        $stmt = $this->pdo->prepare('SELECT * FROM departments WHERE id = :id');
        $stmt->execute(['id' => $departmentId]);
        return $stmt->fetch();
    }
    

    public function createDepartment(string $name): ?Departments {
        $sql = "INSERT INTO departments (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);

        if ($stmt->execute()) {
            $id = $this->pdo->lastInsertId();
            return new Departments((int) $id, $name);
        }

        return null;
    }

    public function getAllDepartments(): array {
        $sql = "SELECT * FROM departments";
        $stmt = $this->pdo->query($sql);
        $departments = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $departments[] = new Departments($row['id'], $row['name']);
        }

        return $departments;
    }


public function findAll()
{
    $stmt = $this->pdo->query('SELECT * FROM departments');
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

}
