<?php

require_once __DIR__ . '/../Core/Model.php';

class Article extends Model {
    protected static string $table = 'articles';
    protected static string $primaryKey = 'id';
}
