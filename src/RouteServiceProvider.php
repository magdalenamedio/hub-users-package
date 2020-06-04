<?php
namespace Bellpi\HubUsers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
	
	protected $namespace='Bellpi\HubUsers\Http\Controllers';
	/**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';
    
	public function map()
	{
		Route::namespace($this->namespace)
		->group(__DIR__.'/../routes/web.php');
	}
}

