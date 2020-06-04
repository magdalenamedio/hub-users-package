<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $fillable = [
       'id','name', 'description','url'
    ];

     public function modules(){
        return $this->hasMany(Module::class);   
    } 

    public function profiles(){
        return $this->hasMany(Profile::class);   
    }     

}