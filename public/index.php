<?php

    // echo "good".'<br><br>';
    
   
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\ProductController;

    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';

    $router = new Router();
    
    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';

    // $router->get('', [ProductController::class, 'index']);
    // $router->get('/', [ProductController::class, 'index']);
    // $router->get('/products', [ProductController::class, 'index']);
    // $router->get('/products/', [ProductController::class, 'index']);
    // $router->get('/public', [ProductController::class, 'index']);
    // $router->get('/public/', [ProductController::class, 'index']);
    // $router->get('/products/index', [ProductController::class, 'index']);
    // $router->get('/products/create', [ProductController::class, 'create']);
    // $router->post('/products/create', [ProductController::class, 'create']);
    // $router->get('/products/update', [ProductController::class, 'update']);
    // $router->post('/products/update', [ProductController::class, 'update']);
    // $router->post('/products/delete', [ProductController::class, 'delete']);
    // $router->post('/public/delete', [ProductController::class, 'delete']);

    
    $router->get('/', [ProductController::class, 'index']);
    $router->get('/products', [ProductController::class, 'index']);
    $router->get('/products/index', [ProductController::class, 'index']);
    $router->get('/products/create', [ProductController::class, 'create']);
    $router->post('/products/create', [ProductController::class, 'create']);
    $router->get('/products/update', [ProductController::class, 'update']);
    $router->post('/products/update', [ProductController::class, 'update']);
    $router->post('/products/delete', [ProductController::class, 'delete']);

    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>'; 

    $router->resolve();