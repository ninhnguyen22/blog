<?php

namespace App\Providers;

use App\Admin\Repositories\GistRepository;
use App\Admin\Repositories\Interfaces\GistRepositoryInterface;
use App\Services\Markdown\Contracts\FileStrategyContract;
use App\Services\Markdown\FileGenerate;
use App\Services\Markdown\Strategies\FileStrategy;
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
        // FileStrategyContract
        $this->app->bind(FileStrategyContract::class, function ($app) {
            return new FileStrategy(new FileGenerate());
        });
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
