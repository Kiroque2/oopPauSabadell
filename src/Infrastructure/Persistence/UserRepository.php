<?php

namespace App\Infrastructure\Persistence;

use PDO;

class UserRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

  
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserById($userId) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch();
    }

public function createUser($firstName, $lastName, $email, $password, $userType) {

    $createdAt = date('Y-m-d H:i:s');
    $updatedAt = $createdAt; 
  
    $uuid = uniqid('', true); 

    $sql = "INSERT INTO users (uuid, first_name, last_name, email, password, user_type, created_at, updated_at) 
            VALUES (:uuid, :first_name, :last_name, :email, :password, :user_type, :created_at, :updated_at)";
    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(':uuid', $uuid);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':user_type', $userType);
    $stmt->bindParam(':created_at', $createdAt); 
    $stmt->bindParam(':updated_at', $updatedAt); 
    return $stmt->execute(); 
}


public function findAll()
{
    $stmt = $this->pdo->query('SELECT * FROM users');
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}


}
