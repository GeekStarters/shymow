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
            Política de cookies
          </h2>
          <br>
          <br>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="answer">
            Cookie es un fichero que se descarga en su ordenador al acceder a determinadas páginas web. Las cookies permiten a una página web, entre otras cosas, almacenar y recuperar información sobre los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información que contengan y de la forma en que utilice su equipo, pueden utilizarse para reconocer al usuario. El navegador del usuario memoriza cookies en el disco duro solamente durante la sesión actual ocupando un espacio de memoria mínimo y no perjudicando al ordenador. Las cookies no contienen ninguna clase de información personal específica, y la mayoría de las mismas se borran del disco duro al finalizar la sesión de navegador (las denominadas cookies de sesión).
            <br><br>
            La mayoría de los navegadores aceptan como estándar a las cookies y, con independencia de las mismas, permiten o impiden en los ajustes de seguridad las cookies temporales o memorizadas.
            <br><br>
            Sin su expreso consentimiento –mediante la activación de las cookies en su navegador–Shymow no enlazará en las cookies los datos memorizados con sus datos personales proporcionados en el momento del registro o la compra.
            <br><br>
          </div>
          <p class="question">
            ¿Qué tipos de cookies utiliza esta página web?
          </p>
          <div class="answer">
            - Cookies técnicas: Son aquéllas que permiten al usuario la navegación a través de una página web, plataforma o aplicación y la utilización de las diferentes opciones o servicios que en ella existan como, por ejemplo, controlar el tráfico y la comunicación de datos, identificar la sesión, acceder a partes de acceso restringido, recordar los elementos que integran un pedido, realizar el proceso de compra de un pedido, realizar la solicitud de inscripción o participación en un evento, utilizar elementos de seguridad durante la navegación, almacenar contenidos para la difusión de videos o sonido o compartir contenidos a través de redes sociales. <br><br>
            - Cookies de personalización: Son aquéllas que permiten al usuario acceder al servicio con algunas características de carácter general predefinidas en función de una serie de criterios en el terminal del usuario como por ejemplo serian el idioma, el tipo de navegador a través del cual accede al servicio, la configuración regional desde donde accede al servicio, etc.
            <br><br>
            - Cookies de análisis: Son aquéllas que bien tratadas por nosotros o por terceros, nos permiten cuantificar el número de usuarios y así realizar la medición y análisis estadístico de la utilización que hacen los usuarios del servicio ofertado. Para ello se analiza su navegación en nuestra página web con el fin de mejorar la oferta de productos o servicios que le ofrecemos. 
            <br><br>
            - Cookies publicitarias: Son aquéllas que, bien tratadas por nosotros o por terceros, nos permiten gestionar de la forma más eficaz posible la oferta de los espacios publicitarios que hay en la página web, adecuando el contenido del anuncio al contenido del servicio solicitado o al uso que realice de nuestra página web. Para ello podemos analizar sus hábitos de navegación en Internet y podemos mostrarle publicidad relacionada con su perfil de navegación. 
            <br><br>
            - Cookies de publicidad comportamental: Son aquéllas que permiten la gestión, de la forma más eficaz posible, de los espacios publicitarios que, en su caso, el editor haya incluido en una página web, aplicación o plataforma desde la que presta el servicio solicitado. Estas cookies almacenan información del comportamiento de los usuarios obtenida a través de la observación continuada de sus hábitos de navegación, lo que permite desarrollar un perfil específico para mostrar publicidad en función del mismo.
            <br><br>
            Cookies de terceros: La Web de shymow.com puede utilizar servicios de terceros que, por cuenta de nosotros, recopilarán información con fines estadísticos. Dichos servicios respetarán lo expresado en el presente texto.
          </div>
          <br><br>
        </div>
      </div>
    </div>
    <img src="{{url('img/faq/footer-faq.jpg')}}" alt="shymow" style="width:100%;">
  </div>
  
@endsection
