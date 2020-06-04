@extends('hub-users::layouts.meta_app')
@section('content')
<div class="wrapper">  
   @include('hub-users::layouts.sidebar_menu')
    <!-- Page Content Holder -->
    <div id="content">
      @include('hub-users::layouts.header_dash_menu')
       <div class="card">
          <div class="card-header">
            Inicio
          </div>
          <div class="card-body">
            <div class="row">
              @forelse($profile->available_modules as $module)
                <div class="card bg-light mb-3 col-md-6" >
                  <div class="card-header">Gestionar {{$module->name}}</div>
                  <div class="card-body ">
                    <div class="row col-md-12 d-flex justify-content-center">
                        <h4 style="font-size: 50px"><i class="fas fa-cubes"></i></h4>
                    </div>
                    <div class="row col-md-12 d-flex justify-content-center">   
                        <a href=""><input type="button" class="btn btn-primary" value="Ir"></input></a>
                    </div>  
                  </div>
                </div>
              @empty
                <div class="card bg-light mb-3 col-md-6" >
                  <div class="card-header">Sin Modulos asignados</div>
                  <div class="card-body ">
                    <div class="row col-md-12 d-flex justify-content-center">
                        <h4 style="font-size: 50px"><i class="fas fa-users"></i></h4>
                    </div>
                    <div class="row col-md-12 d-flex justify-content-center">   
                        <a href=""><input type="button" disabled="true" class="btn btn-primary" value="Ir"></input></a>
                    </div>  
                  </div>
                </div>
              @endforelse                    
            </div> 
        </div>
    </div>
</div>
<!-- div-wrapper -->
@endsection
