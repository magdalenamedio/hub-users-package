<?php
namespace Bellpi\HubUsers;
use Illuminate\Support\Facades\Config;

class ConnectionsController{


	public function setConnection($name_connection)
    {

	    $connection = Config::get($name_connection);
      Config::set('database.default', $connection);
     
      try {
            \DB::connection()->getPdo();
            if(\DB::connection()->getDatabaseName()){
                    \DB::connection()->getDatabaseName();
                    \DB::connection($default_connection);
            }else{
                die("No se puede encontrar base de datos. Revise su configuración.");  
            }     
        }catch (\Exception $e) {
                $connection = Config::get('hub-users-databases.local-connection');
                $default_connection = Config::set('database.default', $connection);
                 try {
                 	\DB::connection()->getPdo();
	                if(\DB::connection()->getDatabaseName()){
	                     \DB::connection()->getDatabaseName();
	                     \DB::connection($default_connection);
	                }else{
	                    die("No se puede encontrar base de datos. Revise su configuración.");
	                }
	            }catch (\Exception $e) { 
	            	 die("No se puede connectar a la base de datos. Revise su configuración.");
	            } 
        }
    }

}