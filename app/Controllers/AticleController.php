<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';

class ArticleController extends Controller {
    public function index($request) {
        $articles = Article::all($this->db);
        $this->response($articles);
    }

    public function store($request) {
        $data = $request->input();
        $article = Article::create($this->db, $data);
        $this->response($article);
    }

    public function update($request) {
        $data = $request->input();
        if (!isset($data['id'])) return $this->error('Missing article ID');

        $id = $data['id'];
        $article = Article::find($this->db, $id);
        if (!$article) return $this->error('Article not found');

        $this->db->query("UPDATE articles SET title = '{$data['title']}', category_id = {$data['category_id']} WHERE id = $id");
        $this->response(['message' => 'Article updated']);
    }

    public function delete($request) {
        $id = $request->get('id');
        if (!$id) return $this->error('Missing article ID');

        $this->db->query("DELETE FROM articles WHERE id = $id");
        $this->response(['message' => 'Article deleted']);
    }
    public function byCategory($request) {
    $categoryId = $request->get('category_id');
    if (!$categoryId) return $this->error('Missing category_id');

    $stmt = $this->db->prepare("SELECT * FROM articles WHERE category_id = ?");
    $stmt->bind_param('i', $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    $articles = [];
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }

    $this->response($articles);
}

}

