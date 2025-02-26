<?php

namespace App\Infrastructure\Persistence;

use App\School\Entities\Teacher;
use PDO;

class TeacherRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function createTeacher(Teacher $teacher) {
        $sql = "INSERT INTO teachers (user_id, department_id) VALUES (:user_id, :department_id)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':user_id', $teacher->getUserId());
        $stmt->bindParam(':department_id', $teacher->getDepartmentId());


        return $stmt->execute();
    }

  
    public function findAll() {
        $stmt = $this->pdo->query("SELECT * FROM teachers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
