<?php
namespace Bellpi\HubUsers\Http\Middleware;
use Bellpi\HubUsers\Facades\HubUsers;

use Closure;

class LocalConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        HubUsers::setConnection('hub-users-databases.local-connection');
         try {
            \DB::connection()->getPdo();
            if(\DB::connection()->getDatabaseName()){
                \DB::connection()->getDatabaseName();
            }else{
            
                die("No se puede encontrar base de datos. Revise su configuracion.");  
            }     
        } catch (\Exception $e) {
            die("No se puede establecer conexión con el servidor.  Revise su configuración.");
        }
    }
}
