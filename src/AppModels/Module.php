<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $fillable = [
        'id','name', 'description','service_id'
    ];

	public function actions(){
    	return $this->hasMany(Action::class);   
	}
}