<?php

namespace Todo\Admin\config;

use DI\Container;
use Todo\Admin\controllers\TodoController;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\services\TodoService;

class ContainerConfig {
    public static function create(): Container {
        $container = new Container();

        $container->set(Database::class, function() {
            return Database::getInstance();
        });

        $container->set(TodoRepository::class, function($container) {
            return new TodoRepository($container->get(Database::class)->getConnection());
        });

        $container->set(TodoService::class, function($container) {
            return new TodoService($container->get(TodoRepository::class));
        });

        $container->get(TodoController::class, function($container) {
            return new TodoController($container->get(TodoService::class));
        });

        return $container;
    }
}