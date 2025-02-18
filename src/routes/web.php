<?php

use Todo\Admin\config\Database;
use Todo\Admin\controllers\TodoController;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\services\TodoService;

require __DIR__  . '/../../vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$db = Database::getInstance();
$repository = new TodoRepository($db->getConnection());
$service = new TodoService($repository);
$controller = new TodoController($service);

$router = new \Bramus\Router\Router();

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
