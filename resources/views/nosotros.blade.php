@extends('layouts.master')

@section('content')
	 <div class="shymow">
    @extends('layouts.nav')

    <div class="container">
      <div class="whatis">
        <h2>¿Qué es Shymow?</h2>
        <p>Shymow es el primer directorio social o buscador de redes sociales. ¡Al fin podrás encontrar todo lo que quieras en las diferentes redes sociales!
      <br>
      <br>
      En Shymow encontrarás perfiles según tus preferencias, puedes combinar distintas opciones de búsqueda:</p>

      <div class="row shymowWhat">
        <div class="col-sm-3"><img src="{{ url('img/shymow/1.png') }}" alt="shymow"><p>Personas de <br> tu ciudad</p></div>
        <div class="col-sm-3"><img src="{{ url('img/shymow/2.png') }}" alt="shymow"><p>Comercio <br> y sus ofertas</p></div>
        <div class="col-sm-3"><img src="{{ url('img/shymow/3.png') }}" alt="shymow"><p>Personas con <br> tus intereses</p></div>
        <div class="col-sm-3"><img src="{{ url('img/shymow/4.png') }}" alt="shymow"><p>Personas y <br> celebridades</p></div>
      </div>
      <br>
      <br>
      <br>
        <p style="font-family:gothamTwo; font-size:1.4;text-align:center;">¡Y podrás descubrir nuevas tendencias!</p>
      <br>
      <br>
      <br>
      <p>
        Con este directorio social conseguirás conectarte con aquello que realmente te importa y te interesa. Los usuarios registrados podrán colgar los perfiles de sus redes sociales, con lo que, si lo deseas, Shymow se convertirá en el mejor expositor de tus perfiles. Además, podrás guardar en favoritos aquellas cuentas que te interesen y compartirlos con el resto de la comunidad.
      </p>
      <br>
      <br>
      <br>
      <div class="neWas">
        <p style="font-size:3em;line-height:1.2;font-family:gothamTwo;">Empieza una nueva era, <br> ¿a qué esperas para descubrirla?;)?</p>
        <h2 style="font-size:4em !important;line-height:1.2;font-family:gothamTwo;">#EraShymow</h2>
      </div>
      <section class="video" style="max-width:600px; margin:auto;">
              <video src="video/shymow.mp4" controls loop muted preload="auto" poster="img/video.jpg" >
                HTML5 Video is required for this example
              </video> 
            </section>
      </div>
    </div>
    <img src="{{url('img/shymow/footer.png')}}" style="width:100%;" alt="shymow">
  </div>
  
@endsection
