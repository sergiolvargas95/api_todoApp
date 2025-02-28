<?php

use Dotenv\Dotenv;
use Bramus\Router\Router;
use Todo\Admin\config\ContainerConfig;
use Todo\Admin\middlewares\AuthMiddleware;
use Todo\Admin\exceptions\UnauthorizedException;

require __DIR__  . '/../../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

/**
 * DI Container
 */
$container = ContainerConfig::create();
$todoController = $container->get(Todo\Admin\controllers\TodoController::class);
$categoryController = $container->get(Todo\Admin\controllers\CategoryController::class);
$authController = $container->get(Todo\Admin\controllers\AuthController::class);
$authService = $container->get(Todo\Admin\services\AuthService::class);

$router = new Router();

$router->before('GET|POST|PUT|DELETE', '/.*', function() use ($authService) {
    try {
        AuthMiddleware::handle($authService);
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(["error" => $e->getMessage()]);
        exit;
    }
});

/************************************* Public Routes *************************************/
/**
 * Auth
 */

$router->post('/register', function() use ($authController) {
    echo $authController->register();
});

$router->post('/login', function() use ($authController) {
    echo $authController->login();
});

/************************************* Private Routes *************************************/

/**
 * Auth
 */
$router->post('/logout', function() use ($authController) {
    echo $authController->logout();
});

/**
 * Todos
 */
$router->get('/todos', function() use ($todoController){
    $user_id = $_SERVER['AUTH_USER_ID'];
    echo $todoController->getAll($user_id);
});

$router->get('/todos/{id}', function($id) use ($todoController){
    $user_id = $_SERVER['AUTH_USER_ID'];
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
    $user_id = $_SERVER['AUTH_USER_ID'];
    echo $categoryController->getAll($user_id);
});

$router->get('/categories/{id}', function($id) use ($categoryController) {
    $user_id = $_SERVER['AUTH_USER_ID'];
    echo $categoryController->getById($id, $user_id);
});

$router->post('/categories', function() use ($categoryController){
    echo $categoryController->create();
});

$router->put('/categories', function() use ($categoryController) {
    echo $categoryController->update();
});

$router->delete('/categories/{id}', function($id) use ($categoryController) {
    $user_id = $_SERVER['AUTH_USER_ID'];
    echo  $categoryController->delete($id, $user_id);
});

$router->run();
