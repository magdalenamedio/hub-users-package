<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $fillable = [
        'id','name', 'description','slug','service_id'
    ];

	public function actions(){
    	return $this->hasMany(Action::class);   
	}
}