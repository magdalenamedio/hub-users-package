<?php
namespace Bellpi\HubUsers;
use Illuminate\Support\Facades\Config;

class ConnectionsController{


	public function setConnection($name_connection)
    {

     $connection = Config::get($name_connection);
      \DB::purge('hub-users.package-connection');
	  Config::set('database.default',$connection);
	  \DB::connection($connection);
    }

}