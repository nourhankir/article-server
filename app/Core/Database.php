<?php

class Database {
    public static function connect(): mysqli {
        $config = require __DIR__ . '/../../config/database.php';

        $conn = new mysqli(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database']
        );

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
