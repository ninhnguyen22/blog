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
        $router->resource('gist', 'GistController');

        // GIT Page
//        $router->resource('git_pages', 'GitPageController');

        // API
        $router->group([
            'as' => 'api.',
            'prefix' => 'api'
        ], function ($router) {
            $router->get('tags', 'TagController@api');
            $router->get('home', 'GitPageController@home')->name('home');
            $router->get('article', 'GitPageController@article')->name('article');
            $router->get('categories', 'GitPageController@categories')->name('categories');
            $router->get('category', 'GitPageController@category')->name('category');
        });
    });

    /**
     * Resume router
     */
    $router->group([
        'prefix' => config('admin.route.resume.prefix'),
        'namespace' => config('admin.route.resume.namespace'),
        'middleware' => config('admin.route.resume.middleware'),
        'as' => config('admin.route.prefix') . '.' . config('admin.route.resume.prefix') . '.',
    ], function (Router $router) {
        $router->resource('list', 'IndexController');
        $router->get('/generate', 'IndexController@generate')->name('generate');
        $router->resource('profile', 'ProfileController');
        $router->resource('skill', 'SkillController');
        $router->resource('project', 'ProjectController');
        $router->resource('experience', 'ExperienceController');
    });

});
