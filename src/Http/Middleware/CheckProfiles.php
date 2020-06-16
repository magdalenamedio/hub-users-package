<?php
namespace Bellpi\HubUsers\Http\Middleware;
use Closure;
class CheckProfiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //Captar el rol del usuario para poder redirigir 
        public function handle($request, Closure $next)
        {
    
          //Excluir del array las parametros request y closure, para obtener los parametros que se definen en el middleware de cada contralador
          
          $profiles = array_slice(func_get_args(), 2);
          
        
            
          //Comprobar que el hasRoles trae un valor boleano verdadero de ser al contrario retorna a un 403 

           
          if(auth()->user()->hasProfiles($profiles))
          {
             return $next($request);
          }

         if ($request->ajax()) {
            return response('No autorizado.', 401);
          }

          return abort(401);
       
        }   
}