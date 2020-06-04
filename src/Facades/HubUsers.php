<?php

namespace Bellpi\HubUsers\Facades;

use Illuminate\Support\Facades\Facade;

class HubUsers extends Facade
{
	protected static function getFacadeAccessor(){
		return 'hub-users';
	}
}