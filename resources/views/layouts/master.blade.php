<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title','Shymow')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/imgareaselect-animated') }}">
    <link rel="stylesheet" href="{{ asset('/css/imgareaselect-default.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/imgareaselect-deprecated.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/slider-horizontal.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="og:url" content="http://shymow.com" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Shymow, tu red social y buscador de redes sociales" />
    <meta property="og:description" content="Shymow es el primer buscador de redes sociales y una red social. ¡Sé el primero en registrarte y probar Shymow Beta! #EraShymow" /><!-- 
    <meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" /> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {!! Analytics::render() !!}
  </head>
  <body @yield('bodyStyle')>
      @if(Auth::check())
        <div style="display: none" id="unvalus" data-unvalus="{{Auth::user()->identification}}"></div>
      @endif
      @if(Auth::check())
        @if(Auth::user()->confirmed == false)
          <div class="alert alert-warning alert-dismissible cookies" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Advertencia!</strong> Debes confirmar tu cuenta
          </div>
        @endif
      @endif()
      @yield('header')
      @yield('content')

       <!-- js files -->
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src=" {{ asset('js/jquery-tweetscroll.js') }}"></script> <!-- jQuery tweetscroll plugin -->
    <script src="{{ asset('js/caroufredsel-carousel.js')}}"></script><!-- CarouFredSel carousel plugin -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=" {{ asset('js/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('js/jquery.gritter.js') }} "></script>
    <script src=" {{ asset('js/validate.min.js') }} "></script>
    <script src=" {{ asset('js/hashtag.js') }} "></script>
    <script src=" {{ asset('js/handlebars.js') }} "></script>
    <script src=" {{ asset('js/typeahead.js') }} "></script>
    <script src=" {{ asset('js/sweetalert.js') }}"></script>
    <script src=" {{ asset('js/scripts.js') }} "></script>
    <script src=" {{ asset('js/validate.js') }} "></script>
    @if(Auth::check())<script src=" {{ asset('js/notification.js') }} "></script>@endif
    <script src=" {{ asset('js/messages.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/responsiveCarousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.imgareaselect.min.js') }}"></script>
    @yield('scripts')
    @yield('scriptsTwo')

  </body>
</html>