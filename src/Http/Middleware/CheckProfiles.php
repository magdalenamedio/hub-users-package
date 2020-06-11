<?php
namespace Bellpi\HubUsers\Http\Middleware;
use Bellpi\HubUsers\Facades\HubUsers;

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
    public function handle($request, Closure $next)
    {  
        return $next($request);
    }
}
