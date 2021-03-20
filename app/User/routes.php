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
});
