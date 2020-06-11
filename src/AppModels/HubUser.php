<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class HubUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	public function profiles(){
        return $this->belongsToMany(Profile::class,'profile_user')->withPivot('service_id')->withTimeStamps();   
    }  

     public function services(){
        $relation = $this->belongsToMany(Service::class, 'profile_user','hub_user_id','service_id');

        $relation->getQuery()->getQuery()
            ->joins[0]->table = \DB::raw('(SELECT DISTINCT hub_user_id,service_id FROM profile_user) as profile_user');

        return $relation; 

    } 
}