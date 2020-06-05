<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{

	protected $fillable = [
        'id','name', 'description','service_id','module_id'
    ];

    
}