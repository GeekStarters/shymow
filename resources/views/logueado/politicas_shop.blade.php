@extends('layouts.master')

@section('content')
<div class="faq">
    @extends('layouts.nav')
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <br>
          <br>
          <br>
          <h2 class="text-center">
            Políticas de Shymow Shop
          </h2>
          <br>
          <br>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <p class="question">
            ¿Cómo puedo registrarme en Shymow?
          </p>
          <div class="answer">
            Dirígete a <b> www.shymow.com.</b> Puedes registrarte de dos maneras, dando clic al icono de las redes sociales que aparecen en el registro o introduciendo tu e-mail (después te enviaremos un correo a tu dirección de correo y tendrás que confirmar el registro). En ambos casos debes rellenar un formulario.
          </div>
          <br><br>
          <p class="question">
            ¿Todo el mundo verá mis redes sociales y las cosas que hay en ellas?
          </p>
          <div class="answer">
            Tienes libertad para elegir si quieres que tus cosas se vean. En el momento en que pongas un perfil público, la comunidad podrá acceder a él. Si los perfiles de tus redes sociales son privados, sólo se verá un link hacia ellas. Si lo que buscas es enseñárselas al mundo, puedes mostrar las publicaciones públicas en <b>“Mis últimos post”</b>.
          </div>
          <br><br>
          <p class="question">
            ¿Para qué sirve la sección de “Mis últimos post” en el perfil?
          </p>
          <div class="answer">
            Algun@s desean mostrar sus últimos post de sus redes sociales con perfiles públicos, con lo que pueden habilitar esta opción con la pestaña <b>“Mostrar”</b>. Aquell@s que prefieran tener en <b>Shymow</b> el enlace a sus redes sociales sin mostrar información de sus perfiles, podrán habilitar la función <b>“Ocultar”</b>.
          </div>
          <br><br>
          <p class="question">
            ¿Me encontrarán por mi alias o por el nombre que tenga <br>puesto en mis redes sociales?
          </p>
          <div class="answer">
            Te encontrarán de ambas maneras.
          </div>
          <br><br>
          <p class="question">
            ¿Cuántas redes sociales, canales de streaming o webs puedo poner?
          </p>
          <div class="answer">
            ¡Podrás poner todo lo que desees!
          </div>
          <br><br>
          <p class="question">
            ¿Cuántos intereses puedo poner?
          </p>
          <div class="answer">
            Todos los que tú quieras. Sin embargo, por cuestiones de espacio, sólo se mostraran algunos, aunque podrán encontrarte por todos ellos. Puedes arrastrar o mover los que prefieras destacar en tu perfil (sección sobre mí).
          </div>
          <br><br>
          <p class="question">
            ¿Qué es Shymow Shop?
          </p>
          <div class="answer">
            Puedes ver productos o servicios destacados de las celebridades y negocios a los que sigues. ¡Entérate de las últimas noticias, promociones y lanzamientos! 
          </div>
          <br><br>
          <p class="question">
            ¿Cómo funcionan las tendencias?
          </p>
          <div class="answer">
            En el buscador: <br>
            <ul><li style="list-style:circle;">Puedes buscarlas a través de las diferentes opciones y botones del Shymow Finder.</li></ul>
            <br> <br>
            En el perfil, sección “Tendencias”:
            <ul><li style="list-style:circle;">Tendencias más populares: aparecen tipo lista a la izquierda; son aquellas que engloban toda la comunidad Shymow. Las tendencias de tus amigos aparecen en el centro de tu perfil.</li></ul>
            <br><br>
            En el perfil, sección “Favoritos”:
            <ul><li style="list-style:circle;">Muestran las publicaciones de tus intereses por clasificaciones (música, comic, celebridades, moda, videojuegos,…).</li></ul>
          </div>
          <br><br>
          <p class="question">
            ¿Por qué no aparece información de un tema concreto que estoy buscando?
          </p>
          <div class="answer">
            Shymow es una plataforma nueva, enseguida empezará a llenarse contenido. ¡Comparte el vídeo promocional de <b>Shymow</b> para acelerar el proceso! También puedes utilizar el hashtag <b>#EraShymow</b>.
          </div>
          <br><br>

          <p class="question">
            Necesito ayuda
          </p>
          <div class="answer">
            ¡Estaremos encantad@s de ayudarte! Puedes ponerte en contacto con nosotros en el apar
          </div>
          <br><br>
        </div>
      </div>
    </div>
    <img src="{{url('img/faq/footer-faq.jpg')}}" alt="shymow" style="width:100%;">
  </div>
  
@endsection
