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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body @yield('bodyStyle')>

      @yield('header')
      @yield('content')

       <!-- js files -->
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src=" {{ asset('js/jquery-tweetscroll.js') }}"></script> <!-- jQuery tweetscroll plugin -->
    <script src="js/caroufredsel-carousel.js"></script><!-- CarouFredSel carousel plugin -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=" {{ asset('js/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('js/validate.min.js') }} "></script>
    <script src=" {{ asset('js/hashtag.js') }} "></script>
    <script src=" {{ asset('js/typeahead.js') }} "></script>
    <script src=" {{ asset('js/scripts.js') }} "></script>
    <script src=" {{ asset('js/validate.js') }} "></script>
    
    @yield('scripts')
    @yield('scriptsTwo')

  </body>
</html>