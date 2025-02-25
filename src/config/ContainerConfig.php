<?php

namespace Todo\Admin\config;

use DI\Container;
use Todo\Admin\config\Database;
use Todo\Admin\controllers\AuthController;
use Todo\Admin\controllers\TodoController;
use Todo\Admin\controllers\CategoryController;
use Todo\Admin\repositories\AuthRepository;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\repositories\CategoryRepository;
use Todo\Admin\services\AuthService;
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

        $container->set(AuthRepository::class, function($container) {
            return new AuthRepository($container->get(Database::class)->getConnection());
        });

        // Services
        $container->set(TodoService::class, function($container) {
            return new TodoService($container->get(TodoRepository::class));
        });

        $container->set(CategoryService::class, function($container) {
            return new CategoryService($container->get(CategoryRepository::class));
        });

        $container->set(AuthService::class, function($container) {
            return new AuthService($container->get(AuthRepository::class));
        });


        // Controllers
        $container->set(TodoController::class, function($container) {
            return new TodoController($container->get(TodoService::class));
        });

        $container->set(CategoryController::class, function($container) {
            return new CategoryController($container->get(CategoryService::class));
        });

        $container->set(AuthController::class, function($container) {
            return new AuthController($container->get(AuthService::class));
        });


        return $container;
    }
}
