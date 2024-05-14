<?php

use Illuminate\Routing\Router;
use App\Models\Product;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    
    $router->resource('interns', InternController::class);
    
    $router->resource('products', ProductController::class);

    
    $router->resource('users', UserController::class);
    
    $router->resource('products', ProductController::class);
    $router->resource('warehouse/products', AddProductToWarehouse::class);
    $router->resource('stores/requests', AdminStoreRequest::class);
    $router->resource('stores', StoreController::class);
    $router->resource('requests', WarehouseController::class);
    $router->resource('inventory-users', InventoryUserController::class);
});
