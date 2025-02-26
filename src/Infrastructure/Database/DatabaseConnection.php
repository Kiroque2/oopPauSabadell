<?php 

namespace App\Infrastructure\Database;

use PDO;
use PDOException;

class DatabaseConnection {
    private static ?PDO $db = null; // Permite que sea null al inicio

    public static function getConnection(): ?PDO {
        if (self::$db !== null) {
            return self::$db;
        }

        $db_info = [
            'dsn' => "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4",
            'dbuser' => $_ENV['DB_USER'],
            'dbpassword' => $_ENV['DB_PASSWORD']
        ];

        try {
            self::$db = new PDO(
                $db_info['dsn'],
                $db_info['dbuser'],
                $db_info['dbpassword'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return self::$db;
        } catch (PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            return null; // En lugar de `die()`, devuelve `null`
        }
    }
}
