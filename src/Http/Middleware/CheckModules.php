<?php
namespace Bellpi\HubUsers\Http\Middleware;
use Closure;
class CheckModules
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
    
            //Excluir del array las parametros request y closure, para obtener los parametros que se definen en el middleware de cada contralador
              
            $modules = array_slice(func_get_args(), 2);
              
            $profiles=auth()->user()->profiles;
                
              

            foreach ($profiles as $profile) {
                if($profile->hasModules($profiles))
                {
                     return $next($request);
                }     
            }
             

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            }

             return abort(401);
       
        }   
       
   
}
