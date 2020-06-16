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
            $this->basePath('resources/views/auth')=>resource_path('views/vendor/hub-users/auth')
        ],'hub-users-views-auth');

        $this->publishes([
            $this->basePath('resources/views/layouts')=>resource_path('views/vendor/hub-users/layouts')
        ],'hub-users-views-layouts');

        $this->publishes([
            $this->basePath('resources/views/home.blade.php')=>resource_path('views/vendor/hub-users')
        ],'hub-users-views-home');

        $this->publishes([
            $this->basePath('resources/views/launch.blade.php')=>resource_path('views/vendor/hub-users')
        ],'hub-users-views-launch');

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

        $this->mergeConfigFrom($this->basePath('config/dbconfig.php'),'hub-users-databases'); 
    }
    
    protected function basePath($path=''){
        return __DIR__.'/../'.$path;
    }
}