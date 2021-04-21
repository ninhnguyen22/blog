<?php

use Illuminate\Routing\Router;

Route::group([
    'middleware' => config('user.route.middleware')
], function (Router $router) {
    $router->get('/category/{slug}-{id}', 'HomeController@category')
        ->where(['slug' => '\S+', 'id' => '[0-9]+'])
        ->name('category');

    $router->get('/{slug}-{id}', 'HomeController@article')
        ->where(['slug' => '\S+', 'id' => '[0-9]+'])
        ->name('article');

    $router->get('', 'HomeController@index')->name('home');

    // CV
    $router->group(['prefix' => 'blog', 'namespace' => 'Cv', 'as' => 'blog.'], function ($router) {
        $router->get('', 'HomeController@index')->name('home');
        $router->get('/categories', 'HomeController@categories')->name('categories');
        $router->get('/category/{slug}-{id}.html', 'HomeController@category')
            ->where(['slug' => '\S+', 'id' => '[0-9]+'])
            ->name('category');
        $router->get('/{slug}-{id}.html', 'HomeController@detail')
            ->where(['slug' => '\S+', 'id' => '[0-9]+'])
            ->name('detail');
    });
});
