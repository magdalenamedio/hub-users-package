<?php 
namespace Bellpi\HubUsers\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

	public function actions(){
    	return $this->hasMany(Action::class);   
	}
}