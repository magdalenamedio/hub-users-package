<?php

namespace Bellpi\HubUsers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class HubUsersServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->LoadViewsFrom($this->basePath('resources/views'),'hub-users'); 

        $this->LoadMigrationsFrom($this->basePath('database/migrations'));

        $this->publishes([$this->basePath('resources/assets')=>public_path('vendor/hub-users')
        ],'hub-users-assets');

        $this->publishes([$this->basePath('config')=>base_path('config/hub_users')
        ],'hub-users-config');

        $this->publishes([
            $this->basePath('resources/views')=>resource_path('views/vendor/hub-users')
        ],'hub-users-views');

        $this->publishes([__DIR__.'/AppModels'=>base_path('/app')
        ],'hub-users-models');

    }

    public function register()
    {
        $this->app->bind('hub-users',function(){
            return new ConnectionsController;
        });



        $router = $this->app['router'];
        $router->aliasMiddleware('hub-users-modules', Http\Middleware\CheckModules::class);
        $router->aliasMiddleware('hub-users-profiles', Http\Middleware\CheckProfiles::class);
        $router->pushMiddlewareToGroup('hub-users-dbconnection', Http\Middleware\LocalConnection::class);

        $this->mergeConfigFrom($this->basePath('config/dbconfig.php'),'hub-users-databases'); 
    }
    
    protected function basePath($path=''){
        return __DIR__.'/../'.$path;
    }
}