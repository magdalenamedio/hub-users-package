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

        $this->setConnection('hub-users-databases.package-connection');

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
        $router->pushMiddlewareToGroup('hub-users-profiles', Http\Middleware\CheckProfiles::class);
        $router->pushMiddlewareToGroup('hub-users-dbconnection', Http\Middleware\LocalConnection::class);

        $this->mergeConfigFrom($this->basePath('config/dbconfig.php'),'hub-users-databases'); 
         
    }

    
    public function setConnection($name_connection)
    {
      
      $connection = Config::get($name_connection);
      $default_connection = Config::set('database.default', $connection);

      try {
            \DB::connection()->getPdo();
            if(\DB::connection()->getDatabaseName()){
                    \DB::connection()->getDatabaseName();
            }else{
                die("No se puede encontrar base de datos. Revise su configuración.");  
            }     
        }catch (\Exception $e) {
                $connection = Config::get('hub-users-databases.local-connection');
                $default_connection = Config::set('database.default', $connection);
                if(\DB::connection()->getDatabaseName()){
                     \DB::connection()->getDatabaseName();
                }else{
                    die("No se puede encontrar base de datos. Revise su configuración.");
                }
        }
    }
    
    protected function basePath($path=''){
        return __DIR__.'/../'.$path;
    }
}