<?php

namespace Todo\Admin\config;

use DI\Container;
use Todo\Admin\config\Database;
use Todo\Admin\controllers\TodoController;
use Todo\Admin\controllers\CategoryController;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\repositories\CategoryRepository;
use Todo\Admin\services\TodoService;
use Todo\Admin\services\CategoryService;

class ContainerConfig {
    public static function create(): Container {
        $container = new Container();

        // Database Singleton
        $container->set(Database::class, function() {
            return Database::getInstance();
        });

        // Repositories
        $container->set(TodoRepository::class, function($container) {
            return new TodoRepository($container->get(Database::class)->getConnection());
        });

        $container->set(CategoryRepository::class, function($container) {
            return new CategoryRepository($container->get(Database::class)->getConnection());
        });

        // Services
        $container->set(TodoService::class, function($container) {
            return new TodoService($container->get(TodoRepository::class));
        });

        $container->set(CategoryService::class, function($container) {
            return new CategoryService($container->get(CategoryRepository::class));
        });

        // Controllers
        $container->set(TodoController::class, function($container) {
            return new TodoController($container->get(TodoService::class));
        });

        $container->set(CategoryController::class, function($container) {
            return new CategoryController($container->get(CategoryService::class));
        });

        return $container;
    }
}
