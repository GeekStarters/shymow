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
		<br>
		<div id="myPost">
			@foreach($posts as $post)
				@if(!$post->share_active)
					<div class="col-sm-6 col-md-offset-3 col-sm-offset-3">
						<br>
						<div class="content-post no-background">
							<div class="post-body tendencias-post">
								<div class="post-header">

									<div class="post-follow">
										<a 
											@if($post->follow)
												class="follow-post-active"
											@else
												class="follow-post-desactive"
											@endif

											data-follow="{{$post->id_post}}">
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
										<span class="post-qualification  border-right-post-tendencias">
											@if((int)$post->qualification < 5)
													@for ($i = 1; $i <= (int)$post->qualification; $i++)
														<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}" ></a>
													@endfor
													@for ($i = 1; $i <= 5-(int)$post->qualification; $i++)
														<a  data-star="{{(int)$post->qualification+$i}}" class="glyphicon glyphicon-star qualification-no-popular" data-post="{{$post->id_post}}"></a>
													@endfor
											@else
													@for ($i = 1; $i <= (int)$post->qualification; $i++)
														<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}" ></a>
													@endfor
											@endif
											
											 
										</span>
										
										<div class="dropup">
											<span class="post-share border-right-post-tendencias">
												  <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												    
													<span class="number-post">{{$post->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
												  </span>
												  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
												    <li><a href="#">Facebook</a></li>
												    <li><a href="#">Twitter</a></li>
												    <li role="separator" class="divider"></li>
												    <li><a data-post_id="{{$post->id_post}}" data-user_id="{{$post->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
												  </ul>
											</span>
										</div>
										@if($post->profil_id == Auth::user()->id)
											<span class="like-me post-like-me-active border-right-post-tendencias" data-like="{{$post->id_post}}">
												<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
											</span> 
										@else
											<span class="like-me post-like-me border-right-post-tendencias" data-like="{{$post->id_post}}">
												<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
											</span> 
										@endif
										<span class="post-comment border-right-post-tendencias box-comment" data-trend="{{$post->id_post}}">
											<span class="number-post post_change">{{$post->posts}}</span> <span class="glyphicon glyphicon-comment"></span>
										</span>
										<br>
									</div>
									<br>
								</div>

							</div>
							<div class="box-comment-content">
								<div class="box-comment-header center-block" style="width:90%;">
									<div class="form-group">
										<label>Comentario</label>
										<label class="text-danger"></label>
										{!! Form::open(['method' => 'get'])  !!}
											{!! Form::text('comment','',['class'=>'form-control']) !!}
										{!! Form::close() !!}
									</div>
								</div>
								<hr>
								<div class="box-comment-body no-background">
									@if($post->posts < 1)
										<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">No existen comentarios</h3>
									@endif
								</div>
							</div>
							<br>
						</div>
					</div>
				@else
					<div class="col-sm-6 col-md-offset-3 col-sm-offset-3">
						<br>
						<div class="content-post no-background">
							<div class="post-body tendencias-post">
								<div class="post-header">

									<div class="post-follow">
										<a 
											@if($post->follow)
												class="follow-post-active"
											@else
												class="follow-post-desactive"
											@endif 


											data-follow="{{$post->id_post}}">
											<i class="glyphicon glyphicon-user"></i>
											<i class="glyphicon glyphicon-plus"></i>
										</a>
									</div>

									<div class="post-user">
										<div class="post-icono"><a href=""><img src="{{url('img/profile/default.png')}}" alt="shymow"></a></div>
										<div class="post-user"><a href="">{{Auth::user()->name}}</a></div>
										<div class="post-twitt"><span></span></div>
									</div>
								</div>
								<br>
								<div class="clearfix"></div>
								<div class="post-description hashtag-post">
									{{$post->description}}
									<br>
									<div class="col-sm-12">
										<br>
										<div class="content-post no-background">
											<div class="post-body tendencias-post">
												<div class="post-header">
													<div class="post-user">
														<div class="post-icono"><a href=""><img src="{{url($post->imagen_perfil_creator)}}" alt="shymow"></a></div>
														<div class="post-user"><a href="">{{$post->name}}</a></div>
														<div class="post-twitt"><span></span></div>
													</div>
												</div>
												<br>
												<div class="clearfix"></div>
												<div class="post-description hashtag-post">
													{{$post->description_old_post}}
												</div>
												<div class="post-media">

													<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
												</div>

											</div>
											<br>
										</div>
									</div>


								<div class="clearfix"></div>
								</div>
								<div class="post-media">

									<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
								</div>
								<div class="post-footer block-center text-center">
									<div class="post-data-footer-face ">
										<span class="post-qualification  border-right-post-tendencias">
											@if((int)$post->qualification < 5)
													@for ($i = 1; $i <= (int)$post->qualification; $i++)
														<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}" ></a>
													@endfor
													@for ($i = 1; $i <= 5-(int)$post->qualification; $i++)
														<a  data-star="{{(int)$post->qualification+$i}}" class="glyphicon glyphicon-star qualification-no-popular" data-post="{{$post->id_post}}"></a>
													@endfor
											@else
													@for ($i = 1; $i <= (int)$post->qualification; $i++)
														<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}" ></a>
													@endfor
											@endif
											
											 
										</span>
										
										<div class="dropup">
											<span class="post-share border-right-post-tendencias">
												  <span class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												    
													<span class="number-post">{{$post->share}}</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
												  </span>
												  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
												    <li><a href="#">Facebook</a></li>
												    <li><a href="#">Twitter</a></li>
												    <li role="separator" class="divider"></li>
												    <li><a data-post_id="{{$post->old_post_id}}" data-user_id="{{$post->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
												  </ul>
											</span>
										</div>
										@if($post->profil_id == Auth::user()->id)
											<span class="like-me post-like-me-active border-right-post-tendencias" data-like="{{$post->id_post}}">
												<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
											</span> 
										@else
											<span class="like-me post-like-me border-right-post-tendencias" data-like="{{$post->id_post}}">
												<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
											</span> 
										@endif
										<span class="post-comment border-right-post-tendencias box-comment" data-trend="{{$post->id_post}}">
											<span class="number-post post_change">{{$post->posts}}</span> <span class="glyphicon glyphicon-comment"></span>
										</span>
										<br>
									</div>
									<br>
								</div>

							</div>
							<div class="box-comment-content">
								<div class="box-comment-header center-block" style="width:90%;">
									<div class="form-group">
										<label>Comentario</label>
										<label class="text-danger"></label>
										{!! Form::open(['method' => 'get'])  !!}
											{!! Form::text('comment','',['class'=>'form-control']) !!}
										{!! Form::close() !!}
									</div>
								</div>
								<hr>
								<div class="box-comment-body no-background">
										<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">No existen comentarios</h3>
								</div>
							</div>
							<br>
						</div>
					</div>
				@endif
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
		<div class="clearfix"></div>
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
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
					</div>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
					</div>
				</div>
				<div class="col-sm-6 add-body out-padding">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Streaming"><button><span class="glyphicon glyphicon-plus"></span></button>
					</div>
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
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Compartir</h4>
		      </div>
		      {!! Form::open(['url' => 'create_share_post','method' => 'post','files' => false]) !!}

		      	<div class="col-md-12" id="modal_container">
		      		
		      	</div>
			    <div class="clearfix"></div>

			    
			{!! Form::close() !!}
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