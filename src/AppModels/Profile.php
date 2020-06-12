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

	public function hasModules(array $modules){

        foreach($modules as $module){
            foreach ($this->available_modules as $_module ) {
               if ($module->slug === $_module){
                    return true;
               } 
            }
        } 
        return false;   
    }
}