<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
        'id','name', 'description','service_id'
    ];

	public function available_modules(){
    	return $this->belongsToMany(Module::class,'module_profile')->withTimeStamps();   
	} 

	public function available_actions(){
    	return $this->belongsToMany(Action::class,'action_profile')->withTimeStamps();   
	} 

	public function hasModule(object $module){

        foreach ($this->available_modules as $valid_module ) {
           if ($valid_module->slug === $module->slug){
                return true;
           } 
        }
        
        return false;   
    }
}