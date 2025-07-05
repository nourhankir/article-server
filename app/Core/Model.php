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
    public function update(mysqli $conn): bool {
    $data = get_object_vars($this);
    $id = $data[static::$primaryKey];
    unset($data[static::$primaryKey]); // don't update the ID itself

    $columns = array_keys($data);
    $setClause = implode(', ', array_map(fn($col) => "$col = ?", $columns));
    $types = str_repeat('s', count($columns));
    $values = array_values($data);
    $values[] = $id;

    $sql = sprintf(
        "UPDATE %s SET %s WHERE %s = ?",
        static::$table,
        $setClause,
        static::$primaryKey
    );

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types . 'i', ...$values);
    return $stmt->execute();
}
public function delete(mysqli $conn): bool {
    $id = $this->{static::$primaryKey};

    $sql = sprintf(
        "DELETE FROM %s WHERE %s = ?",
        static::$table,
        static::$primaryKey
    );

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    return $stmt->execute();
}

}
