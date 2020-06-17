@extends('hub-users::layouts.meta_app')
@section('content')
<div class="wrapper">  
   @include('hub-users::layouts.sidebar_launch')
    <!-- Page Content Holder -->
    <div id="content">
      @include('hub-users::layouts.header_dash_menu')
       <div class="card">
          <div class="card-header">
            Aplicaciones
          </div>
          <div class="card-body">
            @if (session('warning'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{session('warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
             @endif
            <div class="row">
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
                             <div class="dropdown">
                                <a class="btn btn-primary btn-white dropdown-toggle" id="dropdownMenuLink-{{$service->id}}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresar</a>
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
            <!-- div-row -->
            </div> 
        </div>
    </div>
</div>
<!-- div-wrapper -->
@endsection