<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../Services/Response.php';

class Controller {
    protected mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function response($data, int $status = 200) {
        Response::json($data, $status);
    }

    public function error(string $message, int $status = 400) {
        Response::error($message, $status);
    }
}
