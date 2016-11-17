@extends('logueado.layouts.content-layout-user')

@section('content-logueo')
	
	<div class="clear-fix"></div>

	<div class="profiles">
		<div class="clear-fix"></div>
		<br>
		<!-- REDES AQUI -->

		<div class="clearfix"></div>
		<div class="row" style="margin-left:0px;">
			<div class="my-social">
				<div class="interesting-header">
					<h2>Mis post</h2>
				</div>

				<div class="container_social">
					<div id="myPost">
						<!-- RECORRIENDO LOS POST -->
						@if(count($posts)>0)
							@if(Auth::check())
								@foreach($posts as $post)
									<!-- VEMOS QUE EL POST SEA ACTIVO  -->
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
															<div class="post-icono"><a href="{{url('view_user/'.$post->profil_id)}}"><img src="{{url($post->img_profile) }}" alt="shymow"></a></div>
															<div class="post-user"><a href="{{url('view_user/'.$post->profil_id)}}">{{$post->user }}</a></div>
															<div class="post-twitt"><span>@Robe_extremo</span></div>
														</div>
													</div>
													<br>
													<div class="clearfix"></div>
													<div class="post-description hashtag-post">
														{{$post->description}}
														@if(isset($post->path))
															<img src="{{url($post->path)}}" class="img-responsive" alt="Shymow"></img>
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
																			<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}"></a>
																		@endfor
																		@for ($i = 1; $i <= 5-(int)$post->qualification; $i++)
																			<a data-star="{{(int)$post->qualification+$i}}" class="glyphicon glyphicon-star qualification-no-popular" data-post="{{$post->id_post}}"></a>
																		@endfor
																@else
																		@for ($i = 1; $i <= (int)$post->qualification; $i++)
																			<a data-star="{{$i}}" class="glyphicon glyphicon-star qualification-popular" data-post="{{$post->id_post}}"></a>
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
															@if($post->userLike == Auth::user()->id)
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
																<div class="post-icono"><a href="{{url('view_user/'.$post->profil_id)}}"><img src="{{url($post->img_profile) }}" alt="shymow"></a></div>
																<div class="post-user"><a href="{{url('view_user/'.$post->profil_id)}}">{{$post->user }}</a></div>
																<div class="post-twitt"><span>@Robe_extremo</span></div>
															</div>
														</div>
														<br>
														<div class="clearfix"></div>
														<div class="post-description hashtag-post">
															{{$post->description}}
															@if(isset($post->path))
																<img src="{{url($post->path)}}" class="img-responsive" alt="Shymow"></img>
															@endif
															<br>
															<div class="col-sm-12">
																<br>
																<div class="content-post no-background">
																	<div class="post-body tendencias-post">
																		<div class="post-header">
																			<div class="post-user">
																				<div class="post-icono"><a href="{{url('view_user/'.$post->creator_perfil)}}"><img src="{{url($post->imagen_perfil_creator)}}" alt="shymow"></a></div>
																				<div class="post-user"><a href="{{url('view_user/'.$post->creator_perfil)}}">{{$post->name}}</a></div>
																				<div class="post-twitt"><span></span></div>
																			</div>
																		</div>
																		<br>
																		<div class="clearfix"></div>
																		<div class="post-description hashtag-post">
																			{{$post->description_old_post}}
																			@if(isset($post->img_share_active) && $post->img_share_active)
																				<img src="{{url($post->path_share)}}" class="img-responsive" alt="Shymow"></img>
																			@endif
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
																		    <li><a data-post_id="{{$post->id_post}}" data-user_id="{{$post->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
																		  </ul>
																	</span>
																</div>
																@if($post->userLike == Auth::user()->id)
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
												</div>>
										</div>
									@endif
								@endforeach
							@else
								@foreach($posts as $post)
									<!-- VEMOS QUE EL POST SEA ACTIVO  -->
									@if(!$post->share_active)
										<div class="col-sm-6 col-md-offset-3 col-sm-offset-3">
											<br>
											<div class="content-post no-background">
												<div class="post-body tendencias-post">
													<div class="post-header">


														<div class="post-user">
															<div class="post-icono"><a href="{{url('view_user/'.$post->profil_id)}}"><img src="{{url($post->img_profile) }}" alt="shymow"></a></div>
															<div class="post-user"><a href="{{url('view_user/'.$post->profil_id)}}">{{$post->user }}</a></div>
															<div class="post-twitt"><span>@Robe_extremo</span></div>
														</div>
													</div>
													<br>
													<div class="clearfix"></div>
													<div class="post-description hashtag-post">
														{{$post->description}}
														@if(isset($post->path))
															<img src="{{url($post->path)}}" class="img-responsive" alt="Shymow"></img>
														@endif
													</div>
													<div class="post-media">

														<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
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

															<div class="post-user">
																<div class="post-icono"><a href="{{url('view_user/'.$post->profil_id)}}"><img src="{{url($post->img_profile) }}" alt="shymow"></a></div>
																<div class="post-user"><a href="{{url('view_user/'.$post->profil_id)}}">{{$post->user }}</a></div>
																<div class="post-twitt"><span>@Robe_extremo</span></div>
															</div>
														</div>
														<br>
														<div class="clearfix"></div>
														<div class="post-description hashtag-post">
															{{$post->description}}
															@if(isset($post->path))
																<img src="{{url($post->path)}}" class="img-responsive" alt="Shymow"></img>
															@endif
															<br>
															<div class="col-sm-12">
																<br>
																<div class="content-post no-background">
																	<div class="post-body tendencias-post">
																		<div class="post-header">
																			<div class="post-user">
																				<div class="post-icono"><a href="{{url('view_user/'.$post->creator_perfil)}}"><img src="{{url($post->imagen_perfil_creator)}}" alt="shymow"></a></div>
																				<div class="post-user"><a href="{{url('view_user/'.$post->creator_perfil)}}">{{$post->name}}</a></div>
																				<div class="post-twitt"><span></span></div>
																			</div>
																		</div>
																		<br>
																		<div class="clearfix"></div>
																		<div class="post-description hashtag-post">
																			{{$post->description_old_post}}
																			@if(isset($post->img_share_active) && $post->img_share_active)
																				<img src="{{url($post->path_share)}}" class="img-responsive" alt="Shymow"></img>
																			@endif
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

													</div>
													<br>
												</div>
										</div>
									@endif
								@endforeach
							@endif
						@else
							<h3>Este usuario no tiene post</h3>
						@endif
						
					</div>
				</div>
				<div class="add-social insert-social">
				</div>
			</div>
		</div>
		<hr>
		<div class="row" style="margin-left:0px;">
			<div class="my-social">
				<div class="interesting-header">
					<h2>Mis redes sociales</h2>
				</div>

				<div class="container_social">
					@if(isset($users->redes))
						@for($i=0; $i<count($socialNet);$i++)
							@if(isset(json_decode($users->redes,true)[$socialNet[$i]]))
								@foreach( json_decode($users->redes,true)[$socialNet[$i] ] as $red)
									<div class="social-redes">
										<a href="{{url($red)}}" target="_blank">
											<div class="img-social">
												<div class="sub-img-social">
													<img src="{{url('img/profile/'.$socialNet[$i].'.png')}}" alt="shymow">
												</div>
												<img src="{{url('img/profile/redes_add/'.$socialNet[$i].'.jpg')}}" alt="shymow">
											</div>
										</a>
										<div class="social-body">
											<a href="{{url($red)}}" class="color_reds" target="_blank">
												<h2>{{explode(" ",$users->name)[0]}}</h2>
											</a>
											<p>{{$socialNet[$i]}}</p>
										</div>
									</div>
								@endforeach
							@endif
						@endfor
					@else
						<h3>Este usuario no ha agregado enlace de sus redes sociales</h3>
					@endif
				</div>
				<div class="add-social insert-social">
				</div>
			</div>
		</div>
		<hr>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis canales de streaming</h2>
				</div>
				@if(isset($users->streamings))
					<ul>
						@for($i=0; $i<count($streamNet);$i++)
							@if(isset(json_decode($users->streamings,true)[$streamNet[$i]]))
								@foreach( json_decode($users->streamings,true)[$streamNet[$i]] as $streamings)
									<li><a href="{{$streamings}}">{{$streamNet[$i]}}</a></li>
								@endforeach
							@endif
						@endfor
					</ul>
				@else
					<h4>Este usuario no ha agregado enlace de sus streamings</h4>
				@endif
			</div>
		</div>
		<hr>
		<br>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis páginas web</h2>
				</div>
				@if(isset($users->webs))
					<ul>
						@foreach(json_decode($users->webs,true) as $web)
							<div class="col-sm-6 add-body out-padding">
								<div class="form-group">
									<li><a href="{{$web}}">{{$web}}</a></li>
								</div>
							</div>
						@endforeach
					</ul>
				@else
					<h4>Este usuario no ha agregado enlace de sus páginas web</h4>
				@endif
			</div>
		</div>
		<hr>
		<br>
		<div class="row" style="margin-left:0px;">
			<div class="add-social">
				<div class="interesting-header">
					<h2>Mis blogs</h2>
				</div>
				@if(isset($users->blogs))
					<ul>
						@foreach(json_decode($users->blogs,true) as $blog)
							<li><a href="{{$blog}}">{{$blog}}</a></li>
						@endforeach
					</ul>
				@else
					<h4>Este usuario no ha agregado enlace de sus blogs</h4>
				@endif
			</div>
			<br>
			<br>
			<br>
			<br>
			<div class="clearfix"></div>
		</div>
	</div>
		
@stop
@extends('logueado.layouts.content-float-chat')
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