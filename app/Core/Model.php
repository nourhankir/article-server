<?php

abstract class Model {
    protected static string $table;
    protected static string $primaryKey = 'id';

    public static function all(mysqli $conn): array {
        $sql = "SELECT * FROM " . static::$table;
        $result = $conn->query($sql);

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    public static function find(mysqli $conn, int $id): ?array {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public static function create(mysqli $conn, array $data): ?array {
        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $types = str_repeat('s', count($data));
        $values = array_values($data);

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            implode(', ', $columns),
            $placeholders
        );

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);

        if ($stmt->execute()) {
            return static::find($conn, $conn->insert_id);
        }

        return null;
    }
}
