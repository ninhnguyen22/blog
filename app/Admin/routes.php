<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    /**
     * BLOG router
     */
    $router->group([
        'prefix' => config('admin.route.blog.prefix'),
        'namespace' => config('admin.route.blog.namespace'),
        'middleware' => config('admin.route.blog.middleware'),
        'as' => config('admin.route.prefix') . '.' . config('admin.route.blog.prefix') . '.',
    ], function (Router $router) {

        $router->resource('categories', 'CategoryController');
        $router->resource('articles', 'ArticleController');

        $router->resource('tags', 'TagController');

        // API
        $router->get('api/tags', 'TagController@api');
    });

});
