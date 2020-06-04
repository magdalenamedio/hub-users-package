<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  @if(request()->is('home*'))
                    <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Cerrar Sesiòn') }}
                    </a>
                  @else  
                    @forelse($user->profiles as $profile_user)
                        <a class="dropdown-item" href="{{route('dashboard',$profile_user)}}">{{$profile_user->name}}</a>
                     @empty
                       <a class="dropdown-item" href="">Sin perfiles asignados</a>
                     @endforelse
                     <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesiòn') }}
                    </a>
                  @endif  
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>  
               </li>
               
            </ul>
        </div>
    </div>
</nav>