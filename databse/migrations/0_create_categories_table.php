<?php

$mysqli = new mysqli("localhost", "root", "", "your_database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

if ($mysqli->query($sql)) {
    echo "✅ categories table created successfully.\n";
} else {
    echo "❌ Error creating categories table: " . $mysqli->error . "\n";
}

$mysqli->close();
