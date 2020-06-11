<?php

namespace Bellpi\HubUsers\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bellpi\HubUsers\Models\Service;
use Bellpi\HubUsers\Facades\HubUsers;

use App\Service as LocalService;
use App\HubUser as LocalUser;
use App\Profile as LocalProfile;
use App\Module as LocalModule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $user=auth()->user();
        $services=Service::all();

        return view('hub-users::launch', compact('user','services'));
    }

    public function dashboard(LocalProfile $profile)
    {

        HubUsers::setConnection('hub-users-databases.local-connection');
        $user=LocalUser::find(auth()->user()->id);
        $profile=LocalProfile::find($profile->id);
        $modules=LocalModule::where('service_id',$profile['service_id'])->get();
        $service=LocalService::find($profile->service_id);
        $services=LocalService::all();
        return view('hub-users::home',compact('user','service','services','profile','modules'));
    }


}
