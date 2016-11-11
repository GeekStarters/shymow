<nav class="nav-shymow">
  <ul class="nav navbar-nav navbar-right">
    <a href="{{url('/')}}">
      <img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
    </a>
    @if(Auth::check())
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ url(Auth::user()->img_profile) }}" alt=""> {{Auth::user()->name}} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-submenu">
                <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
                  <li><a tabindex="-1" href="{{url('identificate')}}">Shymow shop</a></li>
                </ul>
              </li>
              <li><a href="{{ url('agregar-producto') }}">Shymow Shop</a></li>
            <li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
          </ul>
        </li>
    @endif
  </ul>
  <ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
    <!-- Buscador superior -->
    <form class="navbar-form navbar-left" role="search">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-describedby="basic-addon2">
        <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="32" height="32"></button></span>
      </div>
      <a href="{{url('/')}}" class="btn btn-default"><span class="glyphicon glyphicon-home"></span></a href="index.html" class="btn btn-default">
      @if(Auth::check())
        <a href="{{url('perfil')}}" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></a href="index.html" class="btn btn-default">
      @endif
    </form>

  </ul>
</nav>
