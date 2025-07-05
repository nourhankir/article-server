<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';

class CategoryController extends Controller {
    public function index($request) {
        $categories = Category::all($this->db);
        $this->response($categories);
    }

    public function store($request) {
        $data = $request->input();
        $category = Category::create($this->db, $data);
        $this->response($category);
    }

    public function update($request) {
        $data = $request->input();
        if (!isset($data['id'])) return $this->error('Missing category ID');

        $id = $data['id'];
        $category = Category::find($this->db, $id);
        if (!$category) return $this->error('Category not found');

        $this->db->query("UPDATE categories SET name = '{$data['name']}' WHERE id = $id");
        $this->response(['message' => 'Category updated']);
    }

    public function delete($request) {
        $id = $request->get('id');
        if (!$id) return $this->error('Missing category ID');

        $this->db->query("DELETE FROM categories WHERE id = $id");
        $this->response(['message' => 'Category deleted']);
    }
}


