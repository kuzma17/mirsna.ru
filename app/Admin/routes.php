<?php

use Illuminate\Routing\Router;

Admin::registerHelpersRoutes();

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('pages', PageController::class);
    $router->resource('menu', MenuController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('slideshow', SlideshowController::class);

});
