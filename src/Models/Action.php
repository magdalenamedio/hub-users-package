<?php 
namespace Bellpi\HubUsers\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	   

	protected $connection = 'hub_users';

	public function available_modules(){
    	return $this->belongsToMany(Module::class,'module_profile')->withTimeStamps();   
	} 

	public function available_actions(){
    	return $this->belongsToMany(Action::class,'action_profile')->withTimeStamps();   
	} 
    
}