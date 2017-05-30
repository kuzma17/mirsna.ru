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
    $router->resource('typeitem', TypeItemController::class);
    $router->resource('brands', BrandController::class);
    $router->resource('size', SizeController::class);
    $router->resource('height', HeightController::class);
    $router->resource('hard', HardController::class);
    $router->resource('spring', SpringController::class);
    $router->resource('weight', WeightController::class);
    $router->resource('series', SeriesController::class);
    $router->resource('items', ItemController::class);
    $router->resource('promotions', PromotionController::class);
});
