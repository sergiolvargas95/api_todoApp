<?php

namespace Todo\Admin\controllers;

use Todo\Admin\services\CategoryService;

class CategoryController {
    private $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function getAll(int $user_id) {
        return json_encode($this->categoryService->getAllCategories($user_id));
    }

    public function getById(int $id, int $user_id) {
        return json_encode($this->categoryService->getCategoryById($id, $user_id));
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data || !isset($data['name'], $data['color'])) {
            http_response_code(400);
            return json_encode(["error" => "Invalid data"]);
        }

        $success = $this->categoryService->createCategory($data);

        if($success) {
            http_response_code(201);
            return json_encode(["message" => "Category created Succesfully"]);
        } else {
            http_response_code(500);
            return json_encode(["error" => "Error creating Category"]);
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);

        if(!$data || !isset($data['name'], $data['color'])) {
            http_response_code(400);
            json_encode(["error" => "Invalid data"]);
        }

        $success = $this->categoryService->updateCategory($data);

        if($success) {
            http_response_code(201);
            return json_encode(["message" => "Category updated Succesfully"]);
        } else {
            http_response_code(500);
            return json_encode(["error" => "Error updating Category"]);
        }
    }

    public function delete(int $id, int $user_id) {
        $success = $this->categoryService->deleteCategory($id, $user_id);
        if($success) {
                http_response_code(201);
                return json_encode(["message" => "Category deleted Succesfully"]);
            } else {
                http_response_code(500);
                return json_encode(["error" => "Error deleting Category"]);
            }
        }
}