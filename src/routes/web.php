<?php

use Dotenv\Dotenv;
use Bramus\Router\Router;
use Todo\Admin\config\ContainerConfig;

require __DIR__  . '/../../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

/**
 * DI Container
 */
$container = ContainerConfig::create();
$controller = $container->get(Todo\Admin\controllers\TodoController::class);

$router = new Router();

$router->get('/todos', function() use ($controller){
    echo $controller->getAll();
});

$router->get('/todos/{id}', function($id) use ($controller){
    echo $controller->getById($id);
});

$router->post('/todos', function() use ($controller) {
    echo $controller->create();
});

$router->put('/todos', function() use ($controller){
    echo $controller->update();
});

$router->run();
