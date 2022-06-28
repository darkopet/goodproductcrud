<?php
    echo "chckpnt1<br><br>"; 
     
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\ProductController;

    echo "chckpnt2<br><br>";
    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';

    $router = new Router();
    
    echo "chckpnt3<br><br>";
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
 
    // $router->get('/', [ProductController::class, 'index']);
    $router->get('/public/', [ProductController::class, 'index']);
    // $router->get('/products', [ProductController::class, 'index']);
    // $router->get('/products/index', [ProductController::class, 'index']);

    echo "chckpnt4<br><br>";

    $router->get('/products/create', [ProductController::class, 'create']);
    $router->post('/products/create', [ProductController::class, 'create']);
    
    $router->get('/products/update', [ProductController::class, 'update']);
    $router->post('/products/update', [ProductController::class, 'update']);
    
    $router->post('/products/delete', [ProductController::class, 'delete']);

    echo "chckpnt5<br><br>";

    echo '<pre>';
    var_dump($_SERVER);
    echo '</pre>'; 

    echo "chckpnt6<br><br>";
 
    $router->resolve(); // PROBLEM call_user_func !!!

    echo "<br><br>chckpnt10<br><br>";
