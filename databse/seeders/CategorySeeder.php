<?php

$mysqli = new mysqli("localhost", "root", "", "your_database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$categories = ['Technology', 'Health', 'Science', 'Business', 'Education'];

$stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");

foreach ($categories as $name) {
    $stmt->bind_param("s", $name);
    $stmt->execute();
}

echo "✅ 5 categories inserted successfully.\n";

$stmt->close();
$mysqli->close();
