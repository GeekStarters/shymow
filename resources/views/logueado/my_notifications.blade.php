@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="chat-messages-container">
	<div class="col-sm-5">
		<div class="chat-border">
			<div class="header-chat text-center">
				<h2>
					
							@if($count >0)
								<span class="notification_num">
									<span class="number-notify-g">
										{{$count}}
									</span>
								</span>
							@endif
					 &nbsp;&nbsp;Notificaciones</h2>
				<hr>
			</div>
			<ul class="list-notification">
				<li><a href="/my_notifications"><img src="{{url('img/config_shymow_shop/all_notifications_small.png')}}" >Todas las notificaciones</a></li>
				<li data-type="2"><img src="{{url('img/config_shymow_shop/add_friends.png')}}">Me sigue</li>
				<li data-type="6"><img src="{{url('img/config_shymow_shop/delete_friend.png')}}" >Ya no me sigue</li>
				<!-- <li><img src="{{url('img/config_shymow_shop/02.png')}}" data-type="">Me etiquetó</li> -->
				<li data-type="3"><img src="{{url('img/config_shymow_shop/03.png')}}" >Compartió</li>
				<li data-type="1"><img src="{{url('img/config_shymow_shop/04.png')}}" >Le gustó</li>
				<!-- <li><img src="{{url('img/config_shymow_shop/05.png')}}" data-type="7">Nuevo mensaje</li> -->
				<li data-type="0"><img src="{{url('img/config_shymow_shop/07.png')}}" >Me calificó</li>
				<li data-type="4"><img src="{{url('img/config_shymow_shop/06.png')}}" >Nuevo comentario</li>
				<!-- <li><img src="{{url('img/config_shymow_shop/label.png')}}" data-type="">Nuevo en comercios favoritos</li> -->
				<!-- <li><img src="{{url('img/config_shymow_shop/trends.png')}}" data-type="">Nuevas tendencias</li> -->
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="col-sm-7 chat-border" id="container-message">
		@if(count($notifications) > 0)
			<div class="content-chat-message-description">
				<div class="message-description-header">
					<div class="user">
						<h2 class="header-chat"><img src="{{url('img/config_shymow_shop/all_notifications_big.png')}}" alt=""> Todas las notificaciones</h2>

					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="checkbox">
					    <label>
					      <input type="checkbox" id="select_all"> Seleccionar todas
					    </label> |
					    <label>
					      <input type="checkbox" id="delete"> Borrar selección
					    </label>
					</div>
					<hr>
				</div>
				<div id="notification-container">
					@foreach($notifications as $notification)
						@if($notification->read)
							<div class="content-notifications">
						@else
							<div class="content-notifications notification_unread">
						@endif
							<div class="checkbox">
							    <label style="width: 100%">
							      <input type="checkbox" value="{{$notification->notification_id}}">
							      <div class="notification-body">
							      	<div class="type-notification">
							      		<img src="{{url($notification->img_profile)}}" class="img-responsive" alt="">
							      		<img src="{{url('img/icon_notification/'.$notification->type.'.png')}}" alt="">
							      	</div>
							      	<span class="description-notification hashtag-post"><i><a href="{{url('view_user/'.$notification->senderId)}}"> {{$notification->name}}</a> {{$notification->description}}</i> - {{DataHelpers::knowTime($notification->time)}} <br> {{$notification->postsDescription}}</span>
							      </div>
							    </label>
							</div>
							<hr>
						</div>
					@endforeach
				</div>
			</div>
		@else
			<h3>No se encontraron notificaciones</h3>
		@endif
	</div>
</div>
@stop
@extends('logueado.layouts.content-float-chat')
@section('scripts')
<script>
	$(document).ready(function() {
		$('#select_all').click(function(event) {
			/* Act on the event */
			if ($(this).is(":checked")) {
				$('.content-notifications').find('input').prop("checked", "checked");
			}else{
				$('.content-notifications').find('input').prop("checked", "");
			}
		});

		$('#delete').click(function(event) {
			/* Act on the event */
			var data = [];
		  	$(".content-notifications input:checkbox:checked").each(function(){
				//cada elemento seleccionado
				data.push($(this).val());
				
			});
		  	var codes = data.toString();
		  	if (codes != "") {
				if ($(this).is(":checked")) {
					swal({
					  title: "¿Estás seguro?",
					  text: "No podrás recuperar estos datos",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Yes",
					  cancelButtonText: "No",
					  closeOnConfirm: false,
					  closeOnCancel: false
					},
					function(isConfirm) {
					  if (isConfirm) {
					  		$.ajax({
						  		url: 'delete_notification',
						  		type: 'POST',
						  		dataType: 'JSON',
						  		data: {data: codes},
						  		success: function(data){
						  			if (!data.error) {
						  				$(".content-notifications input:checkbox:checked").each(function(){
											//cada elemento seleccionado
											$(this).parents('.content-notifications').slideUp('slow');
											$(this).prop("checked", "");
											
										});
						  				swal("Deleted!", data.message, "success");
						  			}else{
						  				swal("Deleted!", data.message, "success");
						  			}
						  		}
						  	})
						  	.fail(function() {
						  		console.log("error");
						  	});
					  } else {
					  	$(".content-notifications input:checkbox:checked").each(function(){
							//cada elemento seleccionado
							$(this).prop("checked", "");
							
						});
					    swal("Cancelado", "Tus datos están a salvo", "error");
					  }
					});
				}
			}
		});

		$('.list-notification li[data-type]').click(function(event) {
			/* Act on the event */
			var type = $(this).data('type');
			console.log(type);
			var container = $('#notification-container');
			if (type != "" || type == 0) {
				$.ajax({
					url: 'get_notification_type',
					type: 'GET',
					dataType: 'html',
					data: {type: type},
					beforeSend: function(){
						
						var html = '<p class="text-center"><i class="block-center text-center fa fa-spinner fa-spin fa-3x fa-fw"></i>';
                   		html+= '<span class="block-center text-center sr-only">Loading...</span><br></p>';

                   		container.html(html);
					},
					success: function(data){
						console.log(data == "")
						if (data != "") {
							container.html(data);
						}else{
							var html = '';
                   			html+= '<h3 class="block-center text-center">No hay notificaciones</h3>';
                   			container.html(html);
						}
					}
				})
				.fail(function() {
					console.log("error");
				});
				
			}
		});
	});
	Hashtag.setOptions({
		    templates: {
		        'fb': '<a href="{{url("tendencia")}}/{#n}">{#}</a>'
		    }
		});
		Hashtag.replaceTags('.hashtag-post','fb');

		$('#flash-overlay-modal').modal();
</script>
@stop
