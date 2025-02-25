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
$todoController = $container->get(Todo\Admin\controllers\TodoController::class);
$categoryController = $container->get(Todo\Admin\controllers\CategoryController::class);

$router = new Router();

/**
 * Auth
 */

$router->post('/register', function() use ($authController) {

});

$router->post('/login', function() use ($authController) {

});

$router->post('/logout', function() use ($authController) {

});

/**
 * Todos
 */
$router->get('/todos', function() use ($todoController){
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $todoController->getAll($user_id);
});

$router->get('/todos/{id}', function($id) use ($todoController){
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $todoController->getById($id, $user_id);
});

$router->post('/todos', function() use ($todoController) {
    echo $todoController->create();
});

$router->put('/todos', function() use ($todoController){
    echo $todoController->update();
});

/**
 * Categories
 */
$router->get('/categories', function() use ($categoryController) {
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $categoryController->getAll($user_id);
});

$router->get('/categories/{id}', function($id) use ($categoryController) {
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo $categoryController->getById($id, $user_id);
});

$router->post('/categories', function() use ($categoryController){
    echo $categoryController->create();
});

$router->put('/categories', function() use ($categoryController) {
    echo $categoryController->update();
});

$router->delete('/categories/{id}', function($id) use ($categoryController) {
    //TODO: modificar cuando se implemente autenticación
    $user_id = $_GET['user_id'] ?? null;
    echo  $categoryController->delete($id, $user_id);
});

$router->run();
