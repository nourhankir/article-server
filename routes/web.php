<?php

require_once __DIR__ . '/../app/Controllers/ArticleController.php';
require_once __DIR__ . '/../app/Controllers/CategoryController.php';

$router->get('articles', [ArticleController::class, 'index']);
$router->post('articles', [ArticleController::class, 'store']);
$router->get('categories', [CategoryController::class, 'index']);
$router->put('articles', [ArticleController::class, 'update']);
$router->delete('articles', [ArticleController::class, 'delete']);

$router->put('categories', [CategoryController::class, 'update']);
$router->delete('categories', [CategoryController::class, 'delete']);
$router->get('articles/by-category', [ArticleController::class, 'byCategory']);

