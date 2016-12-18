@extends('layouts.master')

@section('content')
<div class="contacto">
    @extends('layouts.nav')
    <div class="img-contacto">
      <div class="row">
        <div class="col-sm-6">
          <img src="{{url('img/contacto/contacto.jpg')}}" alt="shymow">
        </div>
        <div class="col-sm-6">
          <div>
            <br>
            <br>
            <br>
            <h2 style="">Contáctanos</h2>
            <br>
            <br>
            <br>
            <p>
              Si necesitas ayuda, puedes contactar con nosotros en @SoporteShymow a través de la misma plataforma (Perfil>Sobre mí> nómbranos en tu actualización). También puedes hacerlo vía mail en la dirección sorporte@shymow.com.
              <br><br>
              Si eres una empresa o una celebridad puedes contactar con nosotros en empresas@shymow.com.
              <br>
              Para cualquier otra consulta, puedes enviar un correo electrónico a info@shymow.com.
              <br><br>
              <b class="text-center">¡Responderemos a tus inquietudes</b>
              
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection
@extends('logueado.layouts.content-float-chat')