<?php

$mysqli = new mysqli("localhost", "root", "", "your_database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;
";

if ($mysqli->query($sql)) {
    echo "✅ articles table created successfully.\n";
} else {
    echo "❌ Error creating articles table: " . $mysqli->error . "\n";
}

$mysqli->close();
