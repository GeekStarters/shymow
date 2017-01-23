<nav class="nav-shymow">
  <ul class="nav navbar-nav navbar-right">
    <a href="{{url('/')}}">
      <img src="{{url('img/logo.png')}}" alt="shymow" style="max-width:200px; margin-right:20px; margin-left:20px;">
    </a>
    @if(Auth::check())
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            <span style="position: relative;">
                <img src="{{ url(Auth::user()->img_profile) }}" alt="">
                <span id="n-img-p">
                  @if(DataHelpers::knowNotificationNum()>0)
                  <span class="notification-perfil">
                    <span>
                      {{DataHelpers::knowNotificationNum()}}
                    </span>
                  </span>
                  @endif
                </span>
            </span>
              
              {{DataHelpers::nameUser(Auth::user()->id)}} <b class="caret"></b>
            </a>
        <ul class="dropdown-menu">
          <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="{{ url('identificate_perfil') }}">Editar perfil</a></li>
              @if(Auth::user()->role == "1" || Auth::user()->role == "2")
                  <li><a tabindex="-1" href="{{url('identificate')}}">Shymow Shop</a></li>
                @endif
              </ul>
            </li>
          <li>
              <a href="{{ url('my_notifications') }}">Notificaciones 
              @if(DataHelpers::knowNotificationNum()>0)
                <span class="notification-g">
                  <span class="number-notify-g">
                    {{DataHelpers::knowNotificationNum()}}
                  </span>
                </span>
              @endif
            </a>
          </li>
         @if(Auth::user()->role == "1" || Auth::user()->role == "2")
           <li><a href="{{ url('agregar-producto') }}">Mi Shymow Shop</a></li>
           @endif
          <li><a href="{{ url('logout') }}">Cerrar sesión</a></li>
        </ul>
      </li>
    @endif
  </ul>
  <ul class="nav navbar-nav navbar-left" style="margin-right:20px !important; margin-left:20px !important;">
    @if(Auth::check())
    <form class="navbar-form navbar-left" role="search">
      <div class="input-group" id="custom-templates">
        <input id="typesearch" class="typeahead form-control" name="top_search" data-provide="typeahead" placeholder="Search" autocomplete="off" type="text">
        <span class="input-group-addon" id="basic-addon2" style="padding:0;"><button style="border:none;padding:0px;"><img src="{{url('img/search.png')}}" alt="search" width="32" height="32"></button></span>
      </div>
      <a href="{{url('/')}}" class="btn btn-default"><span class="glyphicon glyphicon-home"></span></a href="index.html" class="btn btn-default">
      <a href="{{url('perfil')}}" class="btn btn-default"><span class="glyphicon glyphicon-user"></span></a href="index.html" class="btn btn-default">
    </form>
    
    @else
    <form class="navbar-form navbar-left" role="search">
      <a href="{{url('/')}}" class="btn btn-default"><span class="glyphicon glyphicon-home"></span></a href="index.html" class="btn btn-default">
    </form>
    @endif

  </ul>
</nav>
@section('scriptsTwo')
<script>
  $(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
</script> 
@stop