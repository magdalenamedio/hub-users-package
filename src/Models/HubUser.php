<?php 
namespace Bellpi\HubUsers\Models;

use Illuminate\Database\Eloquent\Model;


class HubUser extends Model
{


	public function profiles(){
        return $this->belongsToMany(Profile::class,'profile_user')->withPivot('service_id')->withTimeStamps();   
    }  

     public function services(){
        $relation = $this->belongsToMany(Service::class, 'profile_user','user_id','service_id');

        $relation->getQuery()->getQuery()
            ->joins[0]->table = \DB::raw('(SELECT DISTINCT user_id,service_id FROM profile_user) as profile_user');

        return $relation; 
    }  
    
}
