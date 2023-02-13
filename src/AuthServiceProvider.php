<?php

namespace RedJasmine\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $middlewareGroups = [


        'user'   => [
            'auth:user',

        ],
        'seller' => [
            'auth:seller',
        ],
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() : void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../lang', 'red-jasmine.auth');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'red-jasmine.auth');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole() : void
    {
        // Publishing the configuration file.
        $this->publishes([
                             __DIR__ . '/../config/auth.php' => config_path('red-jasmine/auth.php'),
                         ], 'red-jasmine.auth.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/:lc:vendor'),
        ], 'red-jasmine.auth.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/:lc:vendor'),
        ], 'red-jasmine.auth.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/:lc:vendor'),
        ], 'red-jasmine.auth.views');*/

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register() : void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/auth.php', 'red-jasmine.auth');


        // 合并 auth 配置
        config(Arr::dot(config('red-jasmine.auth', []), 'auth.'));

        // Register the service the package provides.
        $this->app->singleton('red-jasmine.auth', function ($app) {
            return new Auth();
        });


        // 注册路由
        $router = $this->app->make('router');
        foreach ($this->middlewareGroups as $key => $middleware) {
            $router->middlewareGroup($key, $middleware);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'red-jasmine.auth' ];
    }
}
