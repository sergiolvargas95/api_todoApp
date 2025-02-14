<?php

require __DIR__  . '/../../vendor/autoload.php';

use Todo\Admin\config\Database;
use Todo\Admin\controllers\TodoController;
use Todo\Admin\repositories\TodoRepository;
use Todo\Admin\services\TodoService;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$router = new \Bramus\Router\Router();

// Instanciar dependencias
$db = Database::getInstance()->getConnection();
$todoRepository = new TodoRepository($db);
$todoService = new TodoService($todoRepository);
$controller = new TodoController($todoService);

$router->get('/', function() use ($controller) {
    $controller->getAll();
});

$router->get('/todos/{id}', function($id) use ($controller) {
    $controller->getById($id);
});

$router->post('/todos/{title}', function($title) use ($controller) {
    $controller->create($title);
});

$router->put('/todos/{id}/{title}/{completed}', function($id, $title, $completed) use ($controller) {
    $controller->update($id, $title, $completed);
});

$router->delete('/todos/{id}', function($id) use ($controller) {
    $controller->delete($id);
});

$router->run();
