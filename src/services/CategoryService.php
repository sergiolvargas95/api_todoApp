<?php

namespace Todo\Admin\services;

use Todo\Admin\factories\CategoryFactory;
use Todo\Admin\repositories\CategoryRepository;

class CategoryService {
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(int $user_id) {
        return $this->categoryRepository->getAll($user_id);
    }

    public function getCategoryById(int $id, int $user_id) {
        return $this->categoryRepository->getById($id, $user_id);
    }

    public function createCategory(array $data): bool {
        $category = CategoryFactory::createFromArray($data);

        return $this->categoryRepository->create($category);
    }

    public function updateCategory(array $data): bool {
        $category = $this->categoryRepository->getById($data['id'], $data['user_id']);

        if(!$category) {
            return false;
        }

        $category = CategoryFactory::createFromArray($category);

        if(isset($data['name'])) {
            $category->setName($data['name']);
        }

        if(isset($data['color'])) {
            $category->setColor($data['color']);
        }

        return $this->categoryRepository->update($category);
    }

    public function deleteCategory(int $id, int $user_id) {
        $category = $this->categoryRepository->getById($id, $user_id);

        if(!$category) {
            return false;
        }

        return $this->categoryRepository->delete($category['id'], $category['user_id']);
    }
}