@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="chat-messages-container">
	<div class="col-sm-5">
		<div class="chat-border">
			<div class="header-chat text-center">
				<h2>
					<span class="notification_num">
						<span class="number-notify-g">
							0
						</span>
					</span>
					 &nbsp;&nbsp;Notificaciones</h2>
				<hr>
			</div>
			<ul class="list-notification">
				<li><img src="{{url('img/config_shymow_shop/all_notifications_small.png')}}" alt="">Todas las notificaciones</li>
				<li><img src="{{url('img/config_shymow_shop/add_friends.png')}}" alt="">Me sigue</li>
				<li><img src="{{url('img/config_shymow_shop/delete_friend.png')}}" alt="">Ya no me sigue</li>
				<li><img src="{{url('img/config_shymow_shop/02.png')}}" alt="">Me etiquetó</li>
				<li><img src="{{url('img/config_shymow_shop/03.png')}}" alt="">Compartió</li>
				<li><img src="{{url('img/config_shymow_shop/04.png')}}" alt="">Le gustó</li>
				<li><img src="{{url('img/config_shymow_shop/05.png')}}" alt="">Nuevo mensaje</li>
				<li><img src="{{url('img/config_shymow_shop/07.png')}}" alt="">Me calificó</li>
				<li><img src="{{url('img/config_shymow_shop/06.png')}}" alt="">Nuevo comentario</li>
				<li><img src="{{url('img/config_shymow_shop/label.png')}}" alt="">Nuevo en comercios favoritos</li>
				<li><img src="{{url('img/config_shymow_shop/trends.png')}}" alt="">Nuevas tendencias</li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-sm-7 chat-border" id="container-message">
		<div class="content-new-chat-message-description"></div>
		<div class="content-chat-message-description">
			<div class="message-description-header">
				<div class="user">
					<h2 class="header-chat"><img src="{{url('img/config_shymow_shop/all_notifications_big.png')}}" alt=""> Todas las notificaciones</h2>

				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="checkbox">
				    <label>
				      <input type="checkbox"> Seleccionar todas
				    </label> |
				    <label>
				      <input type="checkbox"> Borrar selección
				    </label>
				</div>
				<hr>
			</div>
			<div class="content-notifications">
				<div class="checkbox">
				    <label>
				      <input type="checkbox">
				      <div class="notification-body">
				      	<div class="col-sm-3">
				      		<div class="col-sm-7">
				      			<img src="{{url('img/7.jpg')}}" class="img-responsive" alt="">
				      		</div>
				      		<div class="type-notification">
				      			<img src="{{url('img/config_shymow_shop/07.png')}}" alt="">
				      		</div>
				      	</div>
				      	<div class="col-sm-8">
				      		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos necessitatibus vero earum deserunt mollitia magni nobis tempore quam modi sequi! Quidem tenetur porro quasi rem nemo aspernatur, modi dolor praesentium! #hola
				      	</div>
				      </div>
				    </label>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
<script>
	Hashtag.setOptions({
		    templates: {
		        'fb': '<a href="{{url("tendencia")}}/{#n}">{#}</a>'
		    }
		});
		Hashtag.replaceTags('.hashtag-post','fb');

		$('#flash-overlay-modal').modal();
</script>
@stop
@extends('logueado.layouts.content-float-chat')