@extends('logueado.layouts.content-layout')

@section('content-logueo')
	
	<div class="clear-fix"></div>

	<div class="profiles">
		<div class="clear-fix"></div>
		<hr>

		<div class="col-md-offset-2 col-md-8">
		<br>
			<div class="post">
				<div class="col-md-12">
					<h2 class="text-center">¿Quieres contarle algo al mundo?</h2>
				</div>
				<div class="post-container">
					<div class="post-avatar">
						<img src="{{ url(Auth::user()->img_profile) }}" alt="" style="width:100%;"> 
					</div>
					<div class="post-content">
						@foreach ($errors->post->all() as $error)
		                <p class="text-danger">
		                  <b>{{ $error}}</b>             
		                </p>
		                @endforeach
						{!! Form::open(['url' => 'create_perfil_post','method' => 'post','files' => true]) !!}
							{!! Form::textarea('description','',['class'=>'form-control'])!!}
							<!-- <br> -->

							<button type="submit" class="butto-formns">PUBLICAR</button>
							
							{!! Form::select('category', array('' => 'Seleccionar') + $category,'',['class'=>'form-control']) !!}


							<div class="camera">
								<i class="glyphicon glyphicon-camera"></i>
							</div>
							<input name="img" type="file" id="uploadImg">
							<br>
							<img id="blah" class="upload-image-post" src="#" alt="image" />
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<div id="myPost">
			@foreach($posts as $post)
				<div class="col-sm-6 col-md-offset-3 col-sm-offset-3">
					<div class="content-post no-background">
						<div class="post-body tendencias-post">
							<div class="post-header">

								<div class="post-follow">
									<a href="">
										<i class="glyphicon glyphicon-user"></i>
										<i class="glyphicon glyphicon-plus"></i>
									</a>
								</div>

								<div class="post-user">
									<div class="post-icono"><a href=""><img src="{{Auth::user()->img_profile }}" alt="shymow"></a></div>
									<div class="post-user"><a href="">{{Auth::user()->name }}</a></div>
									<div class="post-twitt"><span>@Robe_extremo</span></div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
							<div class="post-description hashtag-post">
								{{$post->description}}
								@if(isset($post->path))
									<img src="{{url($post->path)}}" class="img-responsive" alt="Shymow">
								@endif
							</div>
							<div class="post-media">

								<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
							</div>
							<div class="post-footer block-center text-center">
								<div class="post-data-footer-face ">
									<span class="post-qualification">
										<div class="qualification-popular border-right-post-tendencias">
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
											<span class="glyphicon glyphicon-star"></span>
										</div>
									</span>
									<span class="post-share border-right-post-tendencias">
										<span class="number-post">{{$post->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
									</span>
									<span class="post-like-me border-right-post-tendencias">
										<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
									</span>
									<span class="post-comment border-right-post-tendencias">
										<span class="number-post">52</span> <span class="glyphicon glyphicon-comment"></span>
									</span>
									<br>
								</div>
								<br>
							</div>
						</div>
						<br>
					</div>
				</div>
			@endforeach
		</div>
		<div class="clearfix"></div>
		<div class="row col-md-12">
			<div class="my-post">
				<div class="interesting-header">
					<h2>Mis últimos post</h2>
				</div>
				<div class="col-sm-4">
					<div class="content-post">
						<div class="post-body">
							<div class="post-header">

								<div class="post-follow"><img src="img/profile/follow-twitter.png" alt="shymow"></div>

								<div class="post-user">
									<div class="post-icono"><a href="#"><img src="img/profile/star/one.jpg" alt="shymow"></a></div>
									<div class="post-user"><a href="#">Robe.es</a></div>
									<div class="post-twitt"><span>@Robe_extremo</span></div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
							<div class="post-description">
								<p>¡Ya tenemos disco de oro, y aquí os dejamos esta foto para compartirlo con todos vosotros! <br>Foto: Eduardo Navarro</p>
							</div>
							<div class="post-media">
								<img src="img/profile/star/golden-disc.jpg" alt="shymow">
							</div>
							<div class="post-data">
								<div class="post-stadistic">
									<div class="data-header">
										RETWEETS
									</div>
									<div class="data-num">
										75
									</div>
								</div>
								<div class="post-stadistic">
									<div class="data-header">
										ME GUSTA
									</div>
									<div class="data-num">
										109
									</div>

								</div>
								<div class="post-follow-people">
									<a href="#">
										<img src="img/profile/star/2.jpg" alt="shymow">
									</a>
									<a href="#">
										<img src="img/profile/star/3.jpg" alt="shymow">
									</a>
									<a href="#">
										<img src="img/profile/star/4.jpg" alt="shymow">
									</a>
									<a href="#">
										<img src="img/profile/star/5.jpg" alt="shymow">
									</a>
									<a href="#">
										<img src="img/profile/star/6.jpg" alt="shymow">
									</a>
								</div>
								<div class="clearfix"></div>
								<hr>
								<div class="post-date">
									<span>Dic. 10 nov. 2016</span>
								</div>
								<div class="post-data-footer">
									<a href="#">
										<span class="glyphicon glyphicon-share-alt"></span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-retweet"></span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-heart"></span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-option-horizontal"></span>
									</a>
								</div>
							</div>
						</div>
						<ul class="post-footer">
							<div class="post-property"><img src="img/profile/twitter-post.png" alt="shymow"></div>
							<li class="post-qualification">
								<div class="qualification-header">
									Calificación
								</div>
								<div class="qualification">
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
								</div>
							</li>
							<li class="post-share">
								<i class="fa fa-share-alt" aria-hidden="true"></i>
							</li>
							<li class="post-like-me">
								<span class="glyphicon glyphicon-heart"></span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<br>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="content-post">
						<div class="post-body">
							<div class="post-header">

								<div class="post-follow"><img src="img/profile/follow-twitter.png" alt="shymow"></div>

								<div class="post-user">
									<div class="post-icono"><a href=""><img src="img/profile/star/one.jpg" alt="shymow"></a></div>
									<div class="post-user"><a href="">Robe.es</a></div>
									<div class="post-twitt"><span>@Robe_extremo</span></div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
							<div class="post-description">
								<p>¡Ya tenemos disco de oro, y aquí os dejamos esta foto para compartirlo con todos vosotros! <br>Foto: Eduardo Navarro</p>
							</div>
							<div class="post-media">
								<img src="img/profile/star/golden-disc.jpg" alt="shymow">
							</div>
							<div class="post-data">
								<ul class="nav navbar-nav navbar-right">
									<img src="img/logo.png" alt="shymow" style="margin-right:5px;">
								  <li class="dropdown">
					  					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="img/profile/people/one.jpg" alt=""> <b class="caret"></b></a>
					  					<ul class="dropdown-menu">
					  						<!-- <li class="dropdown-submenu">
										        <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
										        <ul class="dropdown-menu">
										          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
										          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
										        </ul>
										      </li> -->
					  						<li><a href="#">Perfil</a></li>
					  					</ul>
					  				</li>
								</ul>
								<div class="post-data-footer-face">
									<a href="#">
										<span class="glyphicon glyphicon-thumbs-up"></span>
										<span class="data-text">Me gusta</span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-comment"></span>
										<span class="data-text">Comentar</span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-share-alt"></span>
										<span class="data-text">Compartir</span>
									</a>
								</div>

								<div class="face-stadist">
									<div class="right-coment">
										Mejores Comentarios
									</div>
									<span>A <div class="face-comment">933 personas</div> les gusta esto.</span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<ul class="post-footer">
							<div class="post-property"><img src="img/profile/face-post.png" alt="shymow"></div>
							<li class="post-qualification">
								<div class="qualification-header">
									Calificación
								</div>
								<div class="qualification">
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
								</div>
							</li>
							<li class="post-share">
								<i class="fa fa-share-alt" aria-hidden="true"></i>
							</li>
							<li class="post-like-me">
								<span class="glyphicon glyphicon-heart"></span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<br>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="content-post">
						<div class="post-body">
							<div class="post-header">

								<div class="post-follow"><img src="img/profile/follow-twitter.png" alt="shymow"></div>

								<div class="post-user">
									<div class="post-icono"><a href="#"><img src="img/profile/star/one.jpg" alt="shymow"></a></div>
									<div class="post-user"><a href="#">Robe.es</a></div>
									<div class="post-twitt"><span>@Robe_extremo</span></div>
								</div>
							</div>
							<br>
							<div class="clearfix"></div>
							<div class="post-description">
								<p>¡Ya tenemos disco de oro, y aquí os dejamos esta foto para compartirlo con todos vosotros! <br>Foto: Eduardo Navarro</p>
							</div>
							<div class="post-media">
								<iframe width="420" height="315" src="https://www.youtube.com/embed/qeMFqkcPYcg" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="post-data">
								<ul class="nav navbar-nav navbar-right">
									<img src="img/logo.png" alt="shymow" style="margin-right:5px;">
								  <li class="dropdown">
					  					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="img/profile/people/one.jpg" alt=""> <b class="caret"></b></a>
					  					<ul class="dropdown-menu">
					  						<!-- <li class="dropdown-submenu">
										        <a class="test" tabindex="-1" href="#">Configuración <span class="caret"></span></a>
										        <ul class="dropdown-menu">
										          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
										          <li><a tabindex="-1" href="#">2nd level dropdown</a></li>
										        </ul>
										      </li> -->
					  						<li><a href="#">Perfil</a></li>
					  					</ul>
					  				</li>
								</ul>
								<div class="post-data-footer-face">
									<a href="#">
										<span class="glyphicon glyphicon-thumbs-up"></span>
										<span class="data-text">Me gusta</span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-comment"></span>
										<span class="data-text">Comentar</span>
									</a>
									<a href="#">
										<span class="glyphicon glyphicon-share-alt"></span>
										<span class="data-text">Compartir</span>
									</a>
								</div>
							
								<div class="face-stadist">
									<div class="right-coment">
										Mejores Comentarios
									</div>
									<span>A <div class="face-comment">933 personas</div> les gusta esto.</span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<ul class="post-footer">
							<div class="post-property"><img src="img/profile/face-post.png" alt="shymow"></div>
							<li class="post-qualification">
								<div class="qualification-header">
									Calificación
								</div>
								<div class="qualification">
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
									<span class="glyphicon glyphicon-star"></span>
								</div>
							</li>
							<li class="post-share">
								<i class="fa fa-share-alt" aria-hidden="true"></i>
							</li>
							<li class="post-like-me">
								<span class="glyphicon glyphicon-heart"></span>
							</li>
						</ul>
						<div class="clearfix"></div>
						<br>
					</div>
				</div>
			</div>
		</div>
		<br>
		<br>
		<br>
		<div class="search-more">
			<div class="left">
				<hr>
			</div>
			<div class="center">
				<div>
					<span>CARGAR +</span>
				</div>
			</div>
			<div class="right">
				<hr>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row" style="margin-left:0px;">
			<div class="my-social">
				<div class="interesting-header">
					<h2>Mis redes sociales</h2>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/twitter.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>@BeluFornes</h2>
						<p>Twitter</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/facebook.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Facebook</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/youtube.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Youtube</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/instagram.jpg" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Instagram</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/vine.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Vine</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/tumblr.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Tumblr</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/g+.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Google Plus</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<div class="sub-img-social">
							<img src="img/profile/linkedin.png" alt="shymow">
						</div>
						<img src="img/profile/star/my-social1.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2>BeluFornes</h2>
						<p>Linkedin</p>
					</div>
				</div>
				<div class="social-redes">
					<div class="img-social">
						<img src="img/profile/more.jpg" alt="shymow">
					</div>
					<div class="social-body">
						<h2 style="color:#60BBB2;">Agregar <br>Red social</h2>
					</div>
				</div>

			</div>
		</div>
		<hr>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis canales de streaming</h2>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<hr>
		<br>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis páginas web</h2>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<hr>
		<br>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis blogs</h2>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<form action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="http://"><button><span class="glyphicon glyphicon-plus"></span></button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
<script>
	jQuery(document).ready(function($) {
		$('.camera i').click(function(event) {
			$('#uploadImg').click();
		});

		$("#uploadImg").change(function(){
		    readURL(this);
		    $('#blah').fadeIn('slow');
		});

		function readURL(input) {

		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#blah').attr('src', e.target.result);
		        }

		        reader.readAsDataURL(input.files[0]);
		    }
		}
		Hashtag.setOptions({
		    templates: {
		        'fb': '<a href="{{url("tendencia")}}/{#n}">{#}</a>'
		    }
		});
		Hashtag.replaceTags('.hashtag-post','fb');
	});
</script>
@stop