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
$tocoController = $container->get(Todo\Admin\controllers\TodoController::class);
$categoryController = $container->get(Todo\Admin\controllers\CategoryController::class);

$router = new Router();

/**
 * Todos
 */
$router->get('/todos', function() use ($tocoController){
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $tocoController->getAll($user_id);
});

$router->get('/todos/{id}', function($id) use ($tocoController){
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $tocoController->getById($id, $user_id);
});

$router->post('/todos', function() use ($tocoController) {
    echo $tocoController->create();
});

$router->put('/todos', function() use ($tocoController){
    echo $tocoController->update();
});

/**
 * Categories
 */
$router->get('/categories', function() use ($categoryController) {
    echo $categoryController->getAll();
});

$router->get('/categories/{id}', function($id) use ($categoryController) {
    echo $categoryController->getById($id);
});

$router->post('/categories', function() use ($categoryController){
    echo $categoryController->create();
});

$router->put('/categories', function() use ($categoryController) {
    echo $categoryController->update();
});

$router->delete('/categories/{id}', function($id) use ($categoryController) {
    echo  $categoryController->delete($id);
});

$router->run();
