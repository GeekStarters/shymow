@extends('layouts.master')
@section('content')
    @extends('layouts.nav')
    <div class="all">
      <br>
      <br>
      <br>
      <div class="content">
        <div class="row">
          <div class="col-sm-3 col-md-3 contentSearch">
            <section class="header">
              <img src="img/finder.png" alt="Finder">
            </section>
            <section class="content-for">
              <div class="row">
                <br>
                <div class="col-md-12">
                  {!! Form::model(Request::all(), array('url' => 'busqueda_inicio','method'=>'get','id'=>'buscador')) !!}
                    <div class="input-group col-md-12">
                      {!! Form::text('search','',['placeholder'=>'Search for...','class'=>'form-control','aria-describedby'=>'basic-addon2','style'=>'padding:0','id'=>'searching']) !!}
                      <span class="input-group-addon" id="basic-addon2" style="padding:0;"><span style="border:none;padding:0px;"><img src="img/search.png" alt="search" width="38" height="32"></span></span>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="formulario">
                    <div class="form-group">
                      <div class="col-md-12">
                        {!! Form::label('Quiero encontrar:')!!}
                        <div class="form-group">
                          <div class="col-sm-6">
                            <input type="radio" value="all" name="like" id="searchAll" sele>
                            <label for="like">Todo</label><br>

                            <input type="radio" value="0" name="like" id="SearchPeople">
                            <label for="like">Personas</label><br>

                            <input type="radio" value="2" name="like" id="SearchBusiness">
                            <label for="like">Empresas</label><br>
                            
                            <input type="radio" value="1" name="like" id="SearchCelebrities">
                            <label for="like">Celebridad</label>
                            <br>

                            <input type="radio" value="youtubers" name="like" id="searchYoutubers">
                            <label for="like">Youtubers</label><br>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                    <br>
                      <div class="col-sm-12 col-md-6 padd-right" id="actComercial">
                        {!! Form::label('Act. comercial')!!}
                        {!! Form::select('comercio',array('all' => 'Todo') + $subCategories,'',['class'=>'form-control','required' => 'required','id'=>'comercio']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left" id="searchcategories">
                        {!! Form::label('Categoría')!!}
                        {!! Form::select('categoria',array('all' => 'Todo') + $categories,'',['class'=>'form-control','required' => 'required','id'=>'categoria']) !!}
                        <hr>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right" id="searchGender">
                        {!! Form::label('Genero')!!}
                        {!! Form::select('genero',array('all' => 'Todo','m' => 'Hombre', 'f' => 'Mujer'),'',['class'=>'form-control','required' => 'required','id'=>'genero']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left" id="searchEdad">
                        {!! Form::label('Edad')!!}
                        <select name="edad" id="" class="form-control">
                          <option value="all">Todo</option>
                          @for($i = 1;$i<=99;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                        <hr>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right" id="interesting">
                        <label>Intereses</label>
                        {!! Form::select('interes',array('all' => 'Todo') + $interest,'',['class'=>'form-control','required' => 'required','id'=>'interes']) !!}
                        <hr>
                      </div>
                      <div class="col-sm-12 col-md-6 padd-left">
                        <label>País</label>
                        {!! Form::select('pais',array('all' => 'Todo') + $countries,'',['class'=>'form-control','required' => 'required','id'=>'pais']) !!}
                        <hr>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-sm-12 col-md-6 padd-right">
                        <label>Provincia</label>
                        {!! Form::select('provincia',array('all' => 'Seleccione pais'),'',['class'=>'form-control', 'required' => 'required','id'=>'state']); !!}
                      </div>
                      <div class="col-md-6 col-sm-12 padd-left">
                        <label>Municipio</label>
                        {!! Form::select('municipio',array('all' => 'Seleccione Provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'city']); !!}
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                      <hr>
                    </div>

                    <div class="form-group center-block" id="buscado">
                      <div class="col-md-12">
                        <label>Lo más buscado</label>
                      </div>
                      <div class="center-block col-md-12 img-formulario" id="img-interest">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/deportes.png" alt="deportes" data-interest="1" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/restaurantes.png" data-interest="2" alt="restaurantes" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/entretenimiento.png" data-interest="3" alt="entretenimiento" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/compras.png" data-interest="4" alt="compras" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/amistad.png" data-interest="5" alt="amistad" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/musica.png" data-interest="6" alt="musica" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/celebridades.png" data-interest="7" alt="celebridades" class="img-responsive">
                        <!-- </div> -->
                      </div>
                      {!! Form::hidden('interest','all',['id' => 'interest']) !!}
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block" id="filtroredes">
                      <div class="col-md-12">
                      <hr>
                        <label>Filtrar por red social</label>
                      </div>
                      <div class="text-center col-md-12 img-formulario-redes" id="img-redes">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/twitt.png" alt="twitter" data-redes="twitter" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/face.png" data-redes="facebook" alt="facebook" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/youtube.png" data-redes="youtube" alt="youtube" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/instagram.png" data-redes="instagram" alt="instagram" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/pinteres.png" data-redes="pinterest" alt="pinterest" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/vine.png" data-redes="vine" alt="vine" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/tumbrl.png" data-redes="tumblr" alt="tumblr" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/g+.png" alt="google" data-redes="plus" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/linkedin.png" data-redes="linkedin" alt="linkedin" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/snap.png" data-redes="snapchat"   alt="snapchat" class="img-responsive">
                        <!-- </div> -->

                        {!! Form::hidden('redes','all',['id' => 'redes']) !!}
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group center-block" id="filtrostream">
                      <div class="col-md-12">
                      <hr>
                        <label>Filtrar por plataforma de streaming</label>
                      </div>
                      <div class="center-block col-md-12 img-formulario" id="img-stream">  
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/twich.png" alt="twitch" data-stream="twitch" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/bambuser.png" alt="bambuser" data-stream="livestream" class="img-responsive">
                        <!-- </div> -->
                        <!-- <div class="muchtSearch col-xs-4 col-sm-6 col-md-3"> -->
                          <img src="img/lives.png" alt="lives" data-stream="bambuser" class="img-responsive">
                        <!-- </div> -->
                        {!! Form::hidden('stream','all',['id' => 'stream']) !!}
                      </div>

                    </div>

                      <div class="col-md-12 center-block center-text">
                        <br>
                        {!! Form::submit('BUSCAR',['class'=>'butto-formns center-block']) !!}
                      </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </section>
          </div>
          
          <div class="col-sm-9">
            <div class="text-center busquedas-header">
              <a name="search"></a>
              <h2 style="color: #5f5d5d;font-size: 2em;">Resultados de la búsqueda</h2>
            </div>
            <?php $tuser= count($users) ?>
            @if(count($users) > 0)
              <div class="col-sm-11 col-sm-offset-1">
                @if($_GET['like'] == "2" || $_GET['like'] == "all")
                  <div id="mapa" style="height: 350px;margin-bottom: 50px"></div>
                @endif
                @if($_GET['like'] == "0")
                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#CAT-NAME" aria-expanded="true" class="text-favorite" aria-controls="CAT-NAME">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_usuarios.png" alt="">
                          Personas
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="CAT-NAME" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">

                        @foreach($users as $user)
                          <div class="container-busquedas">
                            <div class="sub-content-busqueda">

                              <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                              <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                <div class="content-busqueda-header">
                                  <span class="first-title">{{$user->name}}</span>
                                   <span class="sub-title">{{$user->pais}}</span>
                                </div>
                                <p>{{$user->descripcion}}</p>
                              </div>

                              <div class="busquedas-settings" style="padding:0px !important;">
                                
                                <div class="busquedas-social">
                                @if(isset($user->redes))
                                  @for($i=0; $i<count($socialNet);$i++)
                                    @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                      @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                      <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                      @endforeach
                                    @endif
                                  @endfor
                                @endif
                                  <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif
                @if($_GET['like'] == "1")
                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#CAT-NAME" aria-expanded="true" class="text-favorite" aria-controls="CAT-NAME">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_celebrities.png" alt="">
                          Celebridad
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="CAT-NAME" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">

                        @foreach($users as $user)
                          <div class="container-busquedas">
                            <div class="sub-content-busqueda">

                              <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                              <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                <div class="content-busqueda-header">
                                  <span class="first-title">{{$user->name}}</span>
                                   <span class="sub-title">{{$user->pais}}</span>
                                </div>
                                <p>{{$user->descripcion}}</p>
                              </div>

                              <div class="busquedas-settings" style="padding:0px !important;">
                                
                                <div class="busquedas-social">
                                @if(isset($user->redes))
                                  @for($i=0; $i<count($socialNet);$i++)
                                    @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                      @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                      <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                      @endforeach
                                    @endif
                                  @endfor
                                @endif
                                  <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif
                @if($_GET['like'] == "2")
                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#CAT-NAME" aria-expanded="true" class="text-favorite" aria-controls="CAT-NAME">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_empresa.png" alt="">
                          Empresa
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="CAT-NAME" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        @foreach($users as $user)
                          <div class="container-busquedas">
                            <div class="sub-content-busqueda">

                              <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                              <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                <div class="content-busqueda-header">
                                  <span class="first-title">{{$user->name}}</span>
                                   <span class="sub-title">{{$user->pais}}</span>
                                </div>
                                <p>{{$user->descripcion}}</p>
                              </div>

                              <div class="busquedas-settings" style="padding:0px !important;">
                                
                                <div class="busquedas-social">
                                @if(isset($user->redes))
                                  @for($i=0; $i<count($socialNet);$i++)
                                    @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                      @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                      <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                      @endforeach
                                    @endif
                                  @endfor
                                @endif
                                  <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                          <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif

                @if($_GET['like'] == "all")
                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#empresa" aria-expanded="true" class="text-favorite" aria-controls="empresa">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_empresa.png" alt="">
                          Empresa
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="empresa" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        @foreach($users as $user)
                          @if(isset($user->empresa))
                            <div class="container-busquedas">
                              <div class="sub-content-busqueda">
                                <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                                <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                  <div class="content-busqueda-header">
                                    <span class="first-title">{{$user->name}}</span>
                                     <span class="sub-title">{{$user->pais}}</span>
                                  </div>
                                  <p>{{$user->descripcion}}</p>
                                </div>

                                <div class="busquedas-settings" style="padding:0px !important;">
                                  
                                  <div class="busquedas-social">
                                  @if(isset($user->redes))
                                    @for($i=0; $i<count($socialNet);$i++)
                                      @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                        @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                        <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                        @endforeach
                                      @endif
                                    @endfor
                                  @endif
                                    <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                          @endif
                          
                        @endforeach
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#personas" aria-expanded="true" class="text-favorite" aria-controls="personas">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_usuarios.png" alt="">
                          Personas
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="personas" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        @foreach($users as $user)
                            <div class="container-busquedas">
                              <div class="sub-content-busqueda">
                                <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                                <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                  <div class="content-busqueda-header">
                                    <span class="first-title">{{$user->name}}</span>
                                     <span class="sub-title">{{$user->pais}}</span>
                                  </div>
                                  <p>{{$user->descripcion}}</p>
                                </div>

                                <div class="busquedas-settings" style="padding:0px !important;">
                                  
                                  <div class="busquedas-social">
                                  @if(isset($user->redes))
                                    @for($i=0; $i<count($socialNet);$i++)
                                      @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                        @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                        <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                        @endforeach
                                      @endif
                                    @endfor
                                  @endif
                                    <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                          
                          
                        @endforeach
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#celebridad" aria-expanded="true" class="text-favorite" aria-controls="celebridad">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_celebrities.png" alt="">
                          Celebridad
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="celebridad" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        @foreach($users as $user)
                            @if($user->role == 1)
                              <div class="container-busquedas">
                                <div class="sub-content-busqueda">
                                  <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                                  <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                    <div class="content-busqueda-header">
                                      <span class="first-title">{{$user->name}}</span>
                                       <span class="sub-title">{{$user->pais}}</span>
                                    </div>
                                    <p>{{$user->descripcion}}</p>
                                  </div>

                                  <div class="busquedas-settings" style="padding:0px !important;">
                                    
                                    <div class="busquedas-social">
                                    @if(isset($user->redes))
                                      @for($i=0; $i<count($socialNet);$i++)
                                        @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                          @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                          <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                          @endforeach
                                        @endif
                                      @endfor
                                    @endif
                                      <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            @endif
                          
                          
                        @endforeach
                      </div>
                    </div>
                  </div>


                  <div class="panel panel-default panel-changes">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#mayores" aria-expanded="true" class="text-favorite" aria-controls="mayores">
                          <img class="img_cat_search" class="img-responsive" src="img/icon_tercera_edad.png" alt="">
                          Tercera edad
                          <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                      </h4>
                    </div>
                      <div id="mayores" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        @foreach($users as $user)
                            @if($user->edad > 63)
                              <div class="container-busquedas">
                                <div class="sub-content-busqueda">
                                  <div class="img-busqueda col-sm-3" style="padding:0px !important;"><img src="{{$user->img_profile}}" alt="shymow"></div>

                                  <div class="busquedas-content col-sm-6" style="padding:0px !important;">
                                    <div class="content-busqueda-header">
                                      <span class="first-title">{{$user->name}}</span>
                                       <span class="sub-title">{{$user->pais}}</span>
                                    </div>
                                    <p>{{$user->descripcion}}</p>
                                  </div>

                                  <div class="busquedas-settings" style="padding:0px !important;">
                                    
                                    <div class="busquedas-social">
                                    @if(isset($user->redes))
                                      @for($i=0; $i<count($socialNet);$i++)
                                        @if(isset(json_decode($user->redes,true)[$socialNet[$i]]))
                                          @foreach( json_decode($user->redes,true)[$socialNet[$i] ] as $red)

                                          <a href="{{url($red)}}" target="_blank"><img src="{{url('img/profile/'.$socialNet[$i].'-post.png')}}" alt="shymow"></a>
                                          @endforeach
                                        @endif
                                      @endfor
                                    @endif
                                      <a href="{{url('view_user/'.$user->id)}}" class="show-more">VER +</a>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                            @endif
                          
                          
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif
                




              </div>
              <div class="clearfix"></div>
            @else
              <h3>No se encontraron resultados</h3>
            @endif
            


              
            {!! $users->appends(Request::all())->fragment('search')->render() !!}
          </div>
        </div>
      </div>



    </div>
@endsection


@section('scripts')
<script type="text/javascript" src="{{url('https://maps.googleapis.com/maps/api/js?key=AIzaSyDssPGqiz3lLJ8RoKvlXlUk2OGR97z4zVk')}}"></script>
<script>
  <?php if ($_GET['like'] == "2" || $_GET['like'] == "all"): ?>
    function initMap() {
      var myLatLng = {lat: 19.508020, lng: -99.096680};

      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 3,
        center: myLatLng
      });
      <?php if(count($localAll) > 0): ?>
        @foreach($localAll as $local)

          var contentString = 
          '<div id="content">'+
            '<div class="col-xs-3">'+
              '<img src="{{$local["img"]}}" style="width:100%;">'+
            '</div>'+
            '<div class="col-xs-9">'+
              '<h4> {{$local["alias"]}}</h4>'+
            '</div>'+
          '</div>';
          var cor = {lat: {{$local['lat']}}, lng: {{$local['lng']}}}
          // var infowindow = new google.maps.InfoWindow({
          //   content: contentString,
          //   maxWidth:300
          // });
          infoWindow = new google.maps.InfoWindow({ content: contentString,maxWidth:300 });

          var icon = {
              url: '{{$local["icon"]}}', // url
              scaledSize: new google.maps.Size(30, 30), // scaled size
              origin: new google.maps.Point(0,0), // origin
              anchor: new google.maps.Point(0, 0) // anchor
          };
          var marker = new google.maps.Marker({
            position: cor,
            map: map,
            title: '{{$local["address"]}}',
            icon:icon,
            info: contentString
          });

          google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent( this.info );
            infoWindow.open( map, this );
          });
        @endforeach
      <?php endif ?>


    }
    initMap();
  <?php endif ?>
</script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.crsl-items').carousel({
    visible: 3,
    itemMinWidth: 180,
    itemEqualHeight: 370,
    itemMargin: 9,
  });


  $('#preview').click(function(event) {
    /* Act on the event */
    $('#navbtns').find('.next').click();
  });
  $('#nextview').click(function(event) {
    /* Act on the event */
    $('#navbtns').find('.previous').click();
  });
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
  $('#pais').change(function(event) {
    /* Act on the event */
    $('#state').html('<option>Cargando..</option>');
    $('#city').html('<option>Selecciona municipio</option>');
    var id = $(this).val();
    $.ajax({
      url: 'state/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#state').html(data);
      }
    })
    .fail(function() {
      console.log("error");
    })
  });

  $('#state').change(function(event) {
    /* Act on the event */
    $('#city').html('<option>Cargando..</option>');
    var id = $(this).val();
    $.ajax({
      url: 'city/'+id,
      type: 'GET',
      dataType: 'html',
      success: function(data){
        $('#city').html(data);
        if (data == "")
          $('#city').html('<option value="all">Municipios no encontrados</option>');
      }
    })
    .fail(function() {
      console.log("error");
    })
  });


  $('#img-interest img').on('click',function(event) {
    event.preventDefault();
    var interestSelect = $(this).data('interest');
    var interest = $('#interest').attr('value');
    $( "#img-interest img" ).each(function() {
      $( this ).css({
        "background":"",
        "border-radius":""
      });
    });
     if(interest != interestSelect){
        $('#interest').attr('value',interestSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#interest').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
    /* Act on the event */
  });

   $('#img-redes img').on('click',function(event) {
      event.preventDefault();
      var redesSelect = $(this).data('redes');
      var redes = $('#redes').attr('value');
      $( "#img-redes img" ).each(function() {
        $( this ).css({
          "background":"",
          "border-radius":""
        });
      });
       if(redes != redesSelect){
        $('#redes').attr('value',redesSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#redes').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
      /* Act on the event */
  });



  $('#img-stream img').on('click',function(event) {
      event.preventDefault();
      var streamSelect = $(this).data('stream');
      var stream = $('#stream').attr('value');
      $( "#img-stream img" ).each(function() {
        $( this ).css({
          "background":"",
          "border-radius":""
        });
      });
      if(stream != streamSelect){
        $('#stream').attr('value',streamSelect);

        $(this).css({
          "background":"#A841FF",
          "border-radius":"5px"
        });
      }else{
        $('#stream').attr('value',"all");
        $(this).css({
          "background":"",
          "border-radius":""
        });
      }
      /* Act on the event */
  });


  $('#SearchPeople').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideUp('slow');
    $('#searchcategories').slideUp('slow');

    $('#searchGender').slideDown('slow');
    $('#searchEdad').slideDown('slow');
    $('#interesting').css('visibility', 'visible');

    $('#filtroredes').slideDown('slow');
    $('#filtrostream').slideDown('slow');
  });

  $('#SearchBusiness').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideDown('slow');
    $('#searchcategories').slideDown('slow');
    $('#searchcategories').css('visibility', 'visible');
    $('#actComercial').css('visibility', 'visible');


    $('#interesting').css('visibility', 'hidden');
    $('#searchGender').slideUp('slow');
    $('#searchEdad').slideUp('slow');
    $('#filtroredes').slideUp('slow');
    $('#filtrostream').slideUp('slow');


  });

  $('#SearchCelebrities').click(function(event) {
    /* Act on the event */
    $('#actComercial').slideUp('slow');
    $('#searchcategories').slideUp('slow');

    $('#searchGender').slideDown('slow');
    $('#searchEdad').slideDown('slow');
    $('#interesting').css('visibility', 'visible');

    $('#filtroredes').slideDown('slow');
    $('#filtrostream').slideDown('slow');
  });

  $('#searchcategories').change(function(event) {
    /* Act on the event */
    $('#actComercial').css('visibility', 'hidden');
    $('#searchcategories').css('visibility', 'visible');
  });

  $('#actComercial').change(function(event) {
    /* Act on the event */
    $('#searchcategories').css('visibility', 'hidden');
    $('#actComercial').css('visibility', 'visible');
  });

  $('#searching').keyup(function(event) {
    $('#interesting').css('visibility', 'visible');

    var txt = $(this).val();
    if (txt.length > 0) {
      // $('#SearchPeople').prop('checked', true);
      $('#actComercial').slideUp('slow');
      $('#searchcategories').slideUp('slow');
      $('#SearchPeople').is('checked');
    }else{
      $('#actComercial').slideDown('slow');
      $('#searchcategories').slideDown('slow');
    }
  });

  $('#searching').select(function(event) {
    $('#interesting').css('visibility', 'visible');

    var txt = $(this).val();
    if (txt.length > 0) {
      // $('#SearchPeople').prop('checked', true);
      $('#actComercial').slideUp('slow');
      $('#searchcategories').slideUp('slow');
      $('#SearchPeople').is('checked');
    }else{
      $('#actComercial').slideDown('slow');
      $('#searchcategories').slideDown('slow');
    }
  });



  </script>
@endsection