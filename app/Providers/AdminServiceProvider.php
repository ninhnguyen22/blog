<?php

namespace App\Providers;

use App\Admin\Repositories\GistRepository;
use App\Admin\Repositories\Interfaces\GistRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        GistRepositoryInterface::class => GistRepository::class
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
