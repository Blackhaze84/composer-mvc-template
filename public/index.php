<?php

require_once __DIR__ . '/../includes/app.php';



use MVC\Router;

use Controllers\VendedorController;

$router = new Router;

$router->get('/', [VendedorController::class, 'crear']);

$router->get('/hello', function () {
    echo "hello";
});

$router->get(
    '/render',
    $router->render('paginas/blog', $datos = [])
);


$router->run();
