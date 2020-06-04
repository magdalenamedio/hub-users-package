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
     {{--  <span class="user-role">Administrator</span> --}}
      <span class="user-status">
        <i class="fa fa-circle"></i>
        <span>Online</span>
      </span>
    </div>
  </div>
  <!-- sidebar-user-header  -->
  <ul class="list-unstyled components">
    
  </ul>
</nav>
