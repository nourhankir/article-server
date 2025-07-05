<?php

class Request {
    public function get(string $key, $default = null) {
        return $_GET[$key] ?? $default;
    }

    public function post(string $key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    public function input(): array {
        return json_decode(file_get_contents("php://input"), true) ?? [];
    }

    public function method(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function uri(): string {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return trim(str_replace('/public', '', $uri), '/');
    }
}
