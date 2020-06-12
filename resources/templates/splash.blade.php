<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-align-justify"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
          <li class="nav-item active">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
          </a>
        <div class="dropdown-menu dropdown-menu-right col-md-6" style="height:500px; overflow:auto" aria-labelledby="navbarDropdown">
          <div class="row col-md-12">
            @forelse($services as $service)
              <div class="card bg-light mb-3 col-md-6" >
                <div class="card-header">{{$service->name}}</div>
                <div class="card-body ">
                  <div class="row col-md-12 d-flex justify-content-center">
                      <h4 style="font-size: 50px"><i class="fas fa-briefcase"></i></h4>
                  </div>
                  <div class="row col-md-12 d-flex justify-content-center">  
                    @if($user->services->contains($service->id)) 
                       <div class="btn-group">
                           <div class="dropdown-submenu">
                              <a class="btn btn-primary btn-white py-1 px-3 mt-2 dropdown-toggle" id="dropdownMenuLink-{{$service->id}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresar</a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-{{$service->id}}" x-placement="bottom-start">
                               @forelse($user->profiles as $profile)
                                 @if($profile->pivot->service_id == $service->id)
                                  <a class="dropdown-item" href="{{route('brigde',['profile'=>$profile])}}">{{$profile->name}}</a>
                                 @endif 
                                @empty 
                                 <a class="dropdown-item" href="#"></i>Sin perfiles asignados</a>
                                @endforelse
                            </div>
                           </div>
                        </div>            
                    @else
                      <a href="#"><input type="button" class="btn btn-primary" value="Adquirir servicio"></input></a>
                    @endif
                  </div>  
                </div>
              </div>  
            @empty
              <div class="card bg-light mb-3 col-md-12" >
                <button>No hay servicios creados, contacte al administrador del sistema</button>
              </div>
            @endforelse
           </div>
          </div>    
        </li>
      </ul>
    </div>
  </div>