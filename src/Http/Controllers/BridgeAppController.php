<?php

namespace Bellpi\HubUsers\Http\Controllers;
use Bellpi\HubUsers\Facades\HubUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Bellpi\HubUsers\Models\Service;
use Bellpi\HubUsers\Models\User;
use Bellpi\HubUsers\Models\Profile;
use Bellpi\HubUsers\Models\Module;

use App\Service as LocalService;
use App\HubUser as LocalUser;
use App\Profile as LocalProfile;
use App\Module as LocalModule;

class BridgeAppController extends controller {

	 static function httpPost($url, $data)
	 {
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    return $response;
	 }
  	
	public function bridgeToApp(Profile $profile){
		$host = request()->getSchemeAndHttpHost();
		$user=User::find(auth()->user()->id);
		$modules=Module::where('service_id',$profile->service_id)->get();
		$service=Service::find($profile->service_id);
		$profile_modules=Profile::with('available_modules')->find($profile->id);
		if($host == $service->url){
			$this->updateModels($user,$service,$profile,$modules,$profile_modules->available_modules);
			return redirect()->away($service->url.'/dashboard/'.$profile->id);	
		}
		else{
			$url=$service->url.'/login';
			$data=[
				'username'=>$user->email,
				'password'=>$user->password
			];

			$response = $this->httpPost($url,$data);	

			/*dd($response);*/
			if($response==200){
				$this->updateModels($user,$service,$profile,$modules,$profile_modules->available_modules);
				return redirect()->away($service->url.'/dashboard/'.$profile->id);
			}else{
				return back()->with('warning','No se ha podido establecer conexión');
			} 	
		}
	}

	private function updateModels($user,$service,$profile,$modules,$available_modules){
		HubUsers::setConnection('hub-users-databases.local-connection');
		$user_hub=LocalUser::find($user->id);
		LocalUser::updateOrCreate(['id'=>$user->id],$user->toArray());
		LocalService::updateOrCreate(['id'=>$service->id],$service->toArray());
		LocalProfile::updateOrCreate(['id'=>$profile->id],$profile->toArray());
		foreach ($modules as $module) {
			LocalModule::updateOrCreate(['id'=>$module->id],$module->toArray());		
		}
		$user_hub->profiles()->syncWithOutDetaching([$profile->id=>['service_id'=>$service->id]]);
		$profile_local=LocalProfile::find($profile->id);
		$profile_local->available_modules()->detach();
	    if(count($available_modules) > 0){ 
	      foreach ($available_modules as $_module) {
	          $profile_local->available_modules()->attach([$_module->id=>['service_id'=>$profile->service_id]]);
	      }
	    }
  	}		
}