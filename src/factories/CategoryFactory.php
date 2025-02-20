<?php

namespace Todo\Admin\factories;

use Todo\Admin\models\Category;

class CategoryFactory {
    public static function createFromArray(array $data): Category {
        return new Category(
            $data['id'],
            $data['name'],
            $data['color']
        );
    }
}