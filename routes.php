<?php


use App\StoreShoe\Controllers\Admin\CategoryController;
use App\StoreShoe\Controllers\Admin\DashboardController;
use App\StoreShoe\Controllers\Admin\ProductController;
use App\StoreShoe\Controllers\Admin\ProductPropertiesController;
use App\StoreShoe\Controllers\Admin\ProductSizeController;
use App\StoreShoe\Controllers\Client\AjaxController;
use App\StoreShoe\Controllers\Client\ClientAuthController;
use App\StoreShoe\Controllers\Client\HomeController;
use App\StoreShoe\Controllers\Client\ProductDetailController;
use App\StoreShoe\Controllers\Client\ProductFilterController;
use App\StoreShoe\Controllers\Client\UserInforController;
use App\StoreShoe\Models\Users;
use Bramus\Router\Router;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$router = new Router;
// Router Client
$router->get('/', HomeController::class . '@index');
$router->get('/tin-tuc', HomeController::class . '@general');
$router->get('/lien-he', HomeController::class . '@contact');
$router->get('/product/{id}', ProductDetailController::class . '@index');
$router->get('/filter_data/{id}', ProductFilterController::class . '@index');
$router->get('/filter_data', AjaxController::class . '@filter_data');
$router->match('GET|POST', '/users-infor/{id}', UserInforController::class . '@index');
$router->match('GET|POST', '/user/getpassword', ClientAuthController::class . '@forgotpassword');
$router->match('GET|POST', '/user/newpassword/{id}', ClientAuthController::class . '@newpassword');
// Authenticate
$router->mount('/auth', function () use ($router) {
    $router->match('GET|POST', '/login', ClientAuthController::class . '@login');
    $router->match('GET|POST', '/register', ClientAuthController::class . '@register');
    $router->match('GET|POST', '/logout', ClientAuthController::class . '@logout');
});



// Router Admin
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
});

$router->before("GET|POST", '/admin/*|/admin/.*', function () {
    if (isset($_COOKIE['jwt_admin'])) {
        try {
            $jwt_admin = $_COOKIE['jwt_admin'];
            $decode = JWT::decode($jwt_admin, new Key('quyen', 'HS256'));
            $user_id = $decode->user_id;
            $user_data = ( new Users() )->getUserByID($user_id);

            if ($user_data['role'] != 1) {
                header('Location: /');
                exit;
            }
        } catch (Exception $e) {
            // Log the exception message if needed
            header('Location: /auth/login');
            exit;
        }
    } else {
        header('Location: /');
        exit;
    }
});


$router->run();
