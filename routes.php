<?php


use App\StoreShoe\Controllers\Admin\CategoryController;
use App\StoreShoe\Controllers\Admin\DashboardController;
use App\StoreShoe\Controllers\Admin\ProductController;
use App\StoreShoe\Controllers\Admin\ProductPropertiesController;
use App\StoreShoe\Controllers\Admin\ProductSizeController;
use App\StoreShoe\Controllers\Client\HomeController;
use App\StoreShoe\Controllers\Client\ProductDetailController;
use Bramus\Router\Router;



$router = new Router;

$router->get('/', HomeController::class . '@index');
$router->get('/product/{id}', ProductDetailController::class . '@index');

$router->mount('/admin', function () use ($router) {
    $router->get('/', DashboardController::class . '@index');

    $router->mount('/categories', function () use ($router) {
        $router->get('/', CategoryController::class . '@index');
        $router->get('/{id}/delete', CategoryController::class . '@delete');
        $router->match('GET|POST', '/{id}/update', CategoryController::class . '@update');
        $router->match('GET|POST', '/create', CategoryController::class . '@create');

    });

    $router->mount('/productSize', function () use ($router) {
        $router->get('/', ProductSizeController::class . '@index');
        $router->get('/{id}/delete', ProductSizeController::class . '@delete');
        $router->match('GET|POST', '/{id}/update', ProductSizeController::class . '@update');
        $router->match('GET|POST', '/create', ProductSizeController::class . '@create');

    });

    $router->mount('/products', function () use ($router) {
        $router->get('/', ProductController::class . '@index');
        $router->get('/{id}/delete', ProductController::class . '@delete');
        $router->get('/{id}/show',   ProductController::class . '@show');
        $router->match('GET|POST', '/{id}/update', ProductController::class . '@update');
        $router->match('GET|POST', '/create', ProductController::class . '@create');

    });
    $router->mount('/product-properties', function () use ($router) {
        $router->get('/', ProductPropertiesController::class . '@index');
        $router->get('/{id}/delete', ProductPropertiesController::class . '@delete');
        $router->get('/{id}/show',   ProductPropertiesController::class . '@show');
        $router->match('GET|POST', '/{id}/update', ProductPropertiesController::class . '@update');
        $router->match('GET|POST', '/create', ProductPropertiesController::class . '@create');

    });
} );

$router->run();