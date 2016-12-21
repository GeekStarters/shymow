@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="chat-messages-container">
	<div class="col-sm-5">
		<div class="chat-border">
			<div class="header-chat text-center">
				<h2>Bandeja de entrada</h2>
				<hr>
			</div>
			<div class="message-search">
				<div class="form-group has-feedback">
				  <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
				  <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
				  <span id="inputSuccess2Status" class="sr-only">(search)</span>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="content-messages">
				@if(count($messages)>0)
					@foreach($messages as $message)
						@if(!$message['read'])
							@if($message['emisor'] != Auth::id())
								<div class="row">
							    	<div class="notify-message chatSelect notReaderMessage" data-key="{{$message['key']}}" data-receptor="{{$message['userViewId']}}" data-transmitter="{{ Auth::id() }}">
							@else
								<div class="row">
							    	<div class="notify-message chatSelect" data-key="{{$message['key']}}" data-receptor="{{$message['userViewId']}}" data-transmitter="{{ Auth::id() }}">
							@endif
							        
						@else
							<div class="row">
							    <div class="notify-message chatSelect" data-key="{{$message['key']}}" data-receptor="{{$message['userViewId']}}" data-transmitter="{{ Auth::id() }}">
						@endif
									<div class="clearfix"></div>
							        <div class="col-sm-3">
							            <img src="{{url($message['userViewImage'])}}" alt="shymow">
							        </div>
							        <div class="col-sm-9">
							            <div class="notify-message-header">
							                <div class="name">
							                    <span>
							                    	{{$message['userViewName']}}
							                    </span>
							                </div>
							                <div class="time">
							                    <span>{{$message['messageTime']}}</span>
							                </div>
							            </div>
							            <div class="clearfix"></div>
							            <div class="content-information">
							                {{$message['message']}}
							            </div>
							        </div>
							    </div>
							</div>
							<div class="clearfix"></div>
					@endforeach
				@else
					<h3 class="text-center">No hay mensajes</h3>
				@endif
			</div>
		</div>
	</div>
	<div class="col-sm-7 chat-border" id="container-message">
		<div class="content-new-chat-message-description"></div>
		<div class="content-chat-message-description">
			<div class="message-description-header">
				<div class="user">
					<h4>No hay seleccion</h4>

				</div>
				<div class="more-options">
					<div class="btn btn-default" role="group" id="btn_create_message" aria-label="Nuevo mensaje"><span class="glyphicon glyphicon-plus"></span> Nuevo mensaje</div>
					<!-- <span id="chat-proper-options" type="button" style="cursor: pointer;font-size:1.5em;" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">

						<i class="fa fa-cog" aria-hidden="true"></i>
					</span> -->
				</div>
				<div class="clearfix"></div>
				<hr>
			</div>
			<div class="message-description-information">		
				@if($errors->first('email'))
				@endif
				@foreach ($errors->all() as $error)
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>Warning!</strong> {{$error}}
				</div>
                @endforeach
                <div id="errors-validate-send"></div>
                <div class="content-chat-messages" id="stackMessages">
                	<h3>No ha seleccionado conversación</h3>
                </div>
                <br>
    			<div id="sendMessageChat">
    				{!! Form::open(array('name'=>'SendMessageChatForm','id'=>'sendMessageChatForm')) !!}
						{!! Form::text('new_message-chat-form','',['class'=>'form-control','id'=>'new_message-chat-form','placeholder'=>'Escribe un mensaje','autocomplete'=>'off']) !!}
		                <input type="hidden" name="room_" id="room" value="">
		                <input type="hidden" name="from_chat" id="from_chat" value="">
		            	{!! Form::submit('ENVIAR', ['class'=>'butto-formns navbar-right','style'=>'margin:10px']) !!}
		            	
					{!! Form::close() !!}
    			</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('scripts')
@stop
@extends('logueado.layouts.content-float-chat')