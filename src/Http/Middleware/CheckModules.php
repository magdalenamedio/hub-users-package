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
            $module_selected = [];
            $profile_selected =[];
            $profiles=auth()->user()->profiles;
                
            foreach ($profiles as $profile) {
                $available_modules=$profile->available_modules;
                foreach ($available_modules as $module) {
                     foreach ($modules as $_module) {
                      if($_module === $module->slug){
                        $profile_selected = $profile;
                        $module_selected = $module;
                      }
                    }
                }
            }
            
            if(!empty($profile_selected) && !empty($module_selected)){
                if($profile_selected->hasModule($module_selected)){
                     return $next($request);
                }
            }    

               
                     

            if ($request->ajax()) {
                return response('No autorizado.', 401);
            }

            return abort(401);
       
        }   
       
   
}
