<?php

require_once __DIR__ . '/../Core/Model.php';

class Category extends Model {
    protected static string $table = 'categories';
    protected static string $primaryKey = 'id';
}
