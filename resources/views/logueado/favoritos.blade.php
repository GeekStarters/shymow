@extends('logueado.layouts.content-layout')


@section('content-logueo')
<div class="col-sm-offset-4 col-sm-8 favorits">
	<div class="interesting-header">
		<h2>Favoritos</h2>
	</div>
	<hr>
	<!-- AQUI INICIA LO CORTADO -->
	<div class="col-md-12">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			@include('flash::message')
			<?php $counts = 0; ?>
			@if(count($post_content) > 0)
				@foreach($categories as $category)
					<?php $countPost = 0; ?>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
						  <h4 class="panel-title">
						    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{str_replace(' ', '', $category->name)}}" aria-expanded="true" class="text-favorite" aria-controls="{{str_replace(' ', '', $category->name)}}">
						      {{$category->name}}
						      <span class="glyphicon glyphicon-chevron-down"></span>
						    </a>
						  </h4>
						</div>
						@if($counts == 0)
							<div id="{{str_replace(' ', '', $category->name)}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						@else
							<div id="{{str_replace(' ', '', $category->name)}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						@endif
						  <div class="panel-body">
						<?php $countCat = 0; ?>
						@foreach($post_content as $post)
							@if($category->id == $post->category_post_id)
								@if(!$post->share_active)
								    <div class="col-sm-12">
										<div class="content-post no-background">
											<div class="post-body tendencias-post">
												<div class="post-header">
													<div class="post-follow">
														@if($post->profil_id == Auth::id())
															<a href="{{url('/delete_post/'.$post->id_post)}}" class="delete_post">
																<i class="glyphicon glyphicon-remove"></i>
															</a>
														@endif
														<a id="foll" data-user_id="{{$post->profil_id}}"
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
													@if(isset($post->friend))
														<div class="col-sm-12">
															<br>
															<div class="content-post no-background">
																<div class="post-body tendencias-post">
																	<div class="post-header">
																		<div class="post-user">
																			<div class="post-icono"><a href="{{url('view_user/'.$post->user_id_friend)}}"><img src="{{url($post->imagen_perfil_friend)}}" alt="shymow"></a></div>
																			<div class="post-user"><a href="{{url('view_user/'.$post->user_id_friend)}}">{{$post->friend_name}}</a></div>
																			<div class="post-twitt"><span></span></div>
																		</div>
																	</div>
																	<br>
																	<div class="clearfix"></div>
																	<div class="post-description hashtag-post">
																		<a href="{{url('view_user/'.$post->user_id_friend)}}" class="button-more">VER +</a>
																	</div>
																</div>
																<br>
															</div>
														</div>
													@endif
												</div>
												<div class="post-media">

													<!-- <img src="img/profile/star/golden-disc.jpg" alt="shymow"> -->
												</div>
												<div class="post-footer block-center text-center">
													<div class="post-data-footer-face ">
														<span class="post-qualification  border-right-post-tendencias" data-user_id="{{$post->profil_id}}">
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
																    <!-- <li><a href="#">Facebook</a></li>
																    <li><a href="#">Twitter</a></li> -->
																    <li role="separator" class="divider"></li>
																    <li><a data-post_id="{{$post->id_post}}" data-user_id="{{$post->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
																  </ul>
															</span>
														</div>
														@if($post->userLike == Auth::user()->id)
															<span class="like-me post-like-me-active border-right-post-tendencias" data-like="{{$post->id_post}}" data-user_id="{{$post->profil_id}}">
																<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
															</span> 
														@else
															<span class="like-me post-like-me border-right-post-tendencias" data-like="{{$post->id_post}}" data-user_id="{{$post->profil_id}}">
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
												<div class="box-comment-header center-block" data-user_id="{{$post->profil_id}}" style="width:90%;">
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
									<div class="col-sm-12">
										<br>
										<div class="content-post no-background">
											<div class="post-body tendencias-post">
												<div class="post-header">
													<div class="post-follow">
														@if($post->profil_id == Auth::id())
															<a href="{{url('/delete_post/'.$post->id_post)}}" class="delete_post">
																<i class="glyphicon glyphicon-remove"></i>
															</a>
														@endif
														<a id="foll"
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
														<span class="post-qualification  border-right-post-tendencias" data-user_id="{{$post->profil_id}}">
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
																    <!-- <li><a href="#">Facebook</a></li>
																    <li><a href="#">Twitter</a></li> -->
																    <li role="separator" class="divider"></li>
																    <li><a data-post_id="{{$post->id_post}}" data-user_id="{{$post->id_user}}" class="share_post_shymow" data-toggle="modal" data-target="#myModal">Compartir</a></li>
																  </ul>
															</span>
														</div>
														@if($post->userLike == Auth::user()->id)
															<span class="like-me post-like-me-active border-right-post-tendencias" data-like="{{$post->id_post}}" data-user_id="{{$post->profil_id}}">
																<span class="number-post">{{$post->like}}</span> <span class="glyphicon glyphicon-heart"></span>
															</span> 
														@else
															<span class="like-me post-like-me border-right-post-tendencias" data-like="{{$post->id_post}}" data-user_id="{{$post->profil_id}}">
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
												<div class="box-comment-header center-block" data-user_id="{{$post->profil_id}}" style="width:90%;">
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
								<?php $countPost++; ?>
							@endif
						@endforeach
						@if($countPost < 1)
							<h3>No se encontraron post</h3>
						@endif
						  </div>
						</div>
					</div>
					<?php $counts++; ?>
				@endforeach
			@else
				<h3>No se han creado murales</h3>
			@endif
		</div>
		<br>
		<br>
		<br>

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
	<!-- AQUI FINALIZA LO CORTADO -->
</div>
@extends('logueado.layouts.content-modal')
@extends('logueado.layouts.content-float-chat')
@stop
@section('scripts')
<script>
	jQuery(document).ready(function($) {
		Hashtag.setOptions({
		    templates: {
		        'fb': '<a href="{{url("tendencia")}}/{#n}">{#}</a>'
		    }
		});
		Hashtag.replaceTags('.hashtag-post','fb');
		Hashtag.replaceTags('.hashtag-top','fb');
	});
</script>
@stop