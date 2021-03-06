 <!-- Sidebar Holder -->
<nav id="sidebar">
<div class="sidebar-header">
    <h3>{{config('app.name')}}</h3>
</div>
  <div class="sidebar-user-header">
    <div class="user-pic">
      <img class="img-fluid img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
        alt="User picture">
    </div>
    <div class="user-info">
      <span class="user-name">
        <strong>{{ Auth::user()->name }}</strong>
      </span>
       <span class="user-role">{{$profile->name}}</span>
      <span class="user-status">
        <i class="fa fa-circle"></i>
        <span>Online</span>
      </span>
    </div>
  </div>
  <!-- sidebar-user-header  -->
  <ul class="list-unstyled components">
     <p></p>
     <p></p>
      <li>
      <a class="dropdown-toggle" data-toggle="collapse" href="#submenu"><i class="fas fa-id-badge"></i> Perfiles</a>
      <ul class="collapse list-unstyled" id="submenu">
           @forelse($user->profiles as $profile_user)
              <li>
               <a  href="{{route('dashboard',$profile_user)}}">{{$profile_user->name}}
               </a>
             </li>
           @empty
             <li>
              <a href="#">Sin perfiles asignados</a>
            </li>
           @endforelse
      </ul>
    </li>
     <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
        <a  href="{{route('home')}}"><i class="fas fa-home"></i><span> Inicio</span></a>
      </li>
     <li class="{{ (request()->is('dashboard*')) ? 'active' : '' }}">
        <a  href="{{route('dashboard',$profile)}}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a>
      </li>
      @forelse($modules as $module)
        @if($profile->available_modules->contains($module->id))
          <li class="">
            <a  href=""><i class="fas fa-cubes"></i><span> {{$module->name}}</span></a>
          </li>
        @endif  
      @empty
        <li class="">
          <a  href=""><i class="fas fa-cubes"></i><span> Sin modulos asignados</span></a>
        </li>
      @endforelse
     
       <li class="" href="{{ route('logout') }}">
       <a href="#"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <i class="fas fa-power-off"></i>{{ __(' Cerrar Sesiòn') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</nav>
