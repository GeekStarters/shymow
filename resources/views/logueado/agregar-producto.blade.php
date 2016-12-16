@extends('logueado.layouts.content-layout-out-header')


@section('content-logueo')
<div class="col-md-12">
	<br>
	<div class="col-md-10 col-md-offset-1 out-padding create-product-container">
		<div class="create-product-header">
			<div class="col-md-4 border-right">
				<h2 class="text-center">
					Qué quieres publicar
				</h2>
			</div>
			<div class="col-md-4 border-right">
				<h2 class="text-center">
					Describe tu producto
				</h2>
			</div>
			<div class="col-md-4">
				<h2 class="text-center">
					Confirma tu producto
				</h2>
			</div>
			<div class="clearfix"></div>
		</div>
		{!! Form::open(array('url' => 'informacion-producto','method'=>'Post')) !!}
			<div class="create-product-content">
				<br><br>
				<div class="create-product-title">
					@foreach($errors->all(('<p class="text-danger" style="color: #a94442 !important;">:message</p>') )as $message)
						{!!$message!!}
					@endforeach
					<br>
					<div class="col-md-4 col-sm-12">
						<p>Elige el titulo de tu publicación</p>
						<span>Más llamativo, es mucho mejor</span>
					</div>
					<div class="col-md-8 col-sm-12">
							{!! Form::text('title','',['class'=>'form-control']); !!}
					</div>
				</div>
				<br>
				<div class="clearfix"></div>
				<div class="category-select-product-create">
					@for($i=0; $i < 1 ; $i++)
						<div class="col-md-offset-1 product-category-select col-sm-6 col-md-2" data-id="{{$categorys[$i]->id}}">
							<img class="img-responsive" src="{{url($categorys[$i]->path)}}" alt="Shymow Shop">
							<h2>
								{{$categorys[$i]->name}}
							</h2>
						</div>
					@endfor
					@for($i=1; $i < count($categorys) ; $i++)
						<div class="product-category-select col-sm-6 col-md-2" data-id="{{$categorys[$i]->id}}">
							<img class="img-responsive" src="{{url($categorys[$i]->path)}}" alt="Shymow Shop">
							<h2>
								{{$categorys[$i]->name}}
							</h2>
						</div>
					@endfor
					{!! Form::text('category','',["style"=>"display:none;","id" => "input-category"]) !!}
					<br>
					<div class="clearfix"></div>
				</div>
				<div class="create-product-selects text-center center-block">
					<div class="col-md-4 categorys-product">
						<div class="list-display">
							 <div class="list-group" id="categorys-product-content">
							</div>
							<br>
						</div>
						{!! Form::text('type','',["style"=>"display:none;","id" => "input-type"]) !!}
					</div>
					<div class="col-md-4 first-spesification">
						<div class="list-display">
							 <div class="list-group" id="first-spesification-content">
							</div>
						</div>
						{!! Form::text('first-spesification','',["style"=>"display:none;","id" => "input-first-spesification"]) !!}
					</div>
					<div class="col-md-4 last-spesification">
						<div class="list-display">
							 <div class="list-group" id="last-spesification-content">
							</div>
						</div>
						{!! Form::text('last-spesification','',["style"=>"display:none;","id" => "input-last-spesification"]) !!}
					</div>
				</div>
				<div class="col-md-12 next-right">
					<br>
					<br>
					<button class="butto-formns navbar-right botton-margin">CONTINUAR</button>
				</div>	
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-1 create-product-support">
		<a href="{{url('ayuda_shop')}}"><img src="img/create_product/support.png" class="img-responsive" alt="Soporte"></a>
	</div>

	<div class="row">
		<div class="col-md-12 text-center create-product-footer">
			<p>
				¿Conoces las políticas de Shymow Shop? Has click aquí para conocerlas
				<a href="{{url('politicas_shop')}}">Politicas de Shymow Shop</a>
			</p>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		$('#flash-overlay-modal').modal();
		$('.product-category-select').click(function(event) {
			/* Act on the event */
			var category = $(this);

			//Limpiar categorias
			$('.product-category-select').removeClass('category-select-buy');
			$('#input-category').attr('value','');

			//Agregando
			category.addClass('category-select-buy');
			var id = category.data('id');
			$('#input-category').attr('value',id);
			
			var path = 'buscar-categorias/'+id;
			var datas = 'product_type';
			var roots = $('#categorys-product-content');
			$('.categorys-product').slideDown('fast');
			searchCategories(path,datas,roots);

			$('.first-spesification').slideUp('fast');
			$('.last-spesification').slideUp('fast');
			$('#input-first-spesification').attr('value','');
			$('#input-last-spesification').attr('value','');
			$('#input-type').attr('value','');


		});

		$('#categorys-product-content').on('click', 'a', function(event) {
			event.preventDefault();
			/* Act on the event */
			var padre = $('#categorys-product-content a');
			var input = $('#input-type');
			var the = $(this);
			var id = the.data('id');
			selectionCategory(padre,input,the,id);

			var path = 'buscar-categorias/'+id;
			var datas = 'first-spesification';
			var roots = $('#first-spesification-content');

			$('.last-spesification').slideUp('fast');
			$('#input-last-spesification').attr('value','');
			$('#input-first-spesification').attr('value','');

			id = parseInt(id);
			if (id != "" && id > 0) {
				searchCategories(path,datas,roots);
				$('.first-spesification').slideDown('fast');
			}
		});

		$('#first-spesification-content').on('click', 'a', function(event) {
			event.preventDefault();
			/* Act on the event */
			var padre = $('#first-spesification-content a');
			var input = $('#input-first-spesification');
			var the = $(this);
			var id = the.data('id');
			selectionCategory(padre,input,the,id);

			var path = 'buscar-categorias/'+id;
			var datas = 'last-spesification';
			var roots = $('#last-spesification-content');

			$('.last-spesification').slideUp('fast');
			$('#input-last-spesification').attr('value','');
			id = parseInt(id);
			if (id != "" && id > 0) {
				$('.last-spesification').slideDown('fast');
				searchCategories(path,datas,roots);
			}


		});

		$('#last-spesification-content').on('click', 'a', function(event) {
			event.preventDefault();
			/* Act on the event */
			var padre = $('#last-spesification-content a');
			var input = $('#input-last-spesification');
			var the = $(this);
			var id = the.data('id');
			selectionCategory(padre,input,the,id);
			id = parseInt(id);
			console.log(id);

		});
	});
	function searchCategories(path,datas,roots){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url: path,
			type: 'GET',
			dataType: 'html',
			data: {type: datas},
			success: function(data){
				roots.html(data);
			}
		})
		.fail(function() {
			console.log("error");
		});
	}

	function selectionCategory(padre,input,the,id){
		// Guardamos la posicion de donde estan todos los a
			var padre = padre;

			//Recorremos el padre y eliminamos la clase de todos
			padre.each(function(index, el) {
				$(el).removeClass('active-personal');

			});

			//Limpiamos el input
				input.attr('value','');
			//Guardamos el ID y agregamos la clase
			the.addClass('active-personal');
			input.attr('value',id);
	}
</script>
@stop