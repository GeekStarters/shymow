$( document ).ready(function() {
    
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function preview(img, selection) {
        var scaleX = 100 / (selection.width || 1);
        var scaleY = 100 / (selection.height || 1);
      
        $('#ferret + div > img').css({
            width: Math.round(scaleX * 400) + 'px',
            height: Math.round(scaleY * 300) + 'px',
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
        });
    }
    $.get('/search_typeahead', function(data){
        var users = data.data;

        var user = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: users
        });
        user.initialize();
        $('#custom-templates .typeahead').typeahead(null, {
          name: 'search',
          display: 'name',
          source: user.ttAdapter(),
          templates: {
            empty: [
              '<div class="empty-message">',
                'No se encontraron usuarios',
              '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<a href="/view_user/{{id}}"><div><img class="img-responsive" src="/{{img}}"><strong>{{name}}</strong></div></a>')
          }
        });
    },'json');

    //PROCESO DE COMENTARIOS
    $('.box-comment').click(function(event) {
        /* Act on the event */

        // CONTENEDOR
        var contenedor = $('.content-post');
        // CONTENEDOR DEL POST
        var padre = $(this).parents('.content-post');

        // ID POST
        var post = $(this).data('trend');

        // IDENTIFICAR EL FORMULARIO
        var boolean = padre.find('form').hasClass('form-comment');

        if (boolean) {
            padre.find('form').removeClass('form-comment');
        }else{
            //ELIMINANDO LAS CLASES DE OTROS FORM Y SUBIENDO EL CONTENIDO
            $('.content-post').find('form').each(function(index, el) {
                if ($(this).hasClass('form-comment')) {
                    $(this).removeClass('form-comment');
                }
            });

            // BAJANDO CONTENIDO
            $('.content-post').find('.box-comment-content').slideUp('slow')
            padre.find('form').addClass('form-comment');

            //CANTIDAD DE POST
            var numerComment = $(this).find('.number-post').text();
            numerComment = parseInt(numerComment);
            if (numerComment > 0) {
                $.ajax({
                    url: '/get_comment/'+post,
                    type: 'GET',
                    dataType: 'html',

                    beforeSend: function(){
                        padre.find('.box-comment-body').html('<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">Cargando...</h3>');
                    },
                    success: function($data){
                        padre.find('.box-comment-body').html($data);
                    },
                })
                .fail(function() {
                    console.log("error");
                });
                
            }
        }
        padre.find('.box-comment-content').slideToggle('slow');
    });
    $('.box-comment-product').click(function(event) {
    	/* Act on the event */

    	// CONTENEDOR
    	var contenedor = $('.content-post');
    	// CONTENEDOR DEL POST
    	var padre = $(this).parents('.content-post');

    	// ID POST
    	var post = $(this).data('trend');

    	// IDENTIFICAR EL FORMULARIO
    	var boolean = padre.find('form').hasClass('form-comment');

    	if (boolean) {
    		padre.find('form').removeClass('form-comment');
    	}else{
    		//ELIMINANDO LAS CLASES DE OTROS FORM Y SUBIENDO EL CONTENIDO
    		$('.content-post').find('form').each(function(index, el) {
	    		if ($(this).hasClass('form-comment')) {
	    			$(this).removeClass('form-comment');
	    		}
	    	});

	    	// BAJANDO CONTENIDO
	    	$('.content-post').find('.box-comment-content').slideUp('slow')
    		padre.find('form').addClass('form-comment');

    		//CANTIDAD DE POST
    		var numerComment = $(this).find('.number-post').text();
    		numerComment = parseInt(numerComment);
    		if (numerComment > 0) {
    			$.ajax({
    				url: '/get_comment-product/'+post,
    				type: 'GET',
    				dataType: 'html',

    				beforeSend: function(){
    					padre.find('.box-comment-body').html('<h3 style="margin-left:10px; color:#CCC;margin-bottom: 10px; font-family:gothamTwo;">Cargando...</h3>');
    				},
    				success: function($data){
    					padre.find('.box-comment-body').html($data);
    				},
    			})
    			.fail(function() {
    				console.log("error");
    			});
    			
    		}
    	}
    	padre.find('.box-comment-content').slideToggle('slow');
    });



    $(".box-comment-header-product").submit('.form-comment',function(event) {
        /* Act on the event */
        event.preventDefault();

        // CONTENEDOR DEL POST
        var padre = $(this).parents('.content-post');
        var post = padre.find('.box-comment-product').data('trend');
        var comment = $(this).find('input').val();
        var count = padre.find('.post-comment ').children('.number-post').text();

        if (comment.length > 0 ) {
            $.ajax({
                url: '/create_comment-product/'+post,
                type: 'POST',
                dataType: 'HTML',
                data: {comment: comment},
                success: function($data){
                        
                        count = parseInt(count) + 1;
                        padre.find('.post_change').text('');
                        padre.find('.post_change').text(count);

                        padre.find('input').val("");
                        padre.find('.box-comment-body').html($data);
                }                   

            })
            .fail(function() {
                console.log("error");
            });
            
        }
    });

    $(".box-comment-header").submit('.form-comment',function(event) {
    	/* Act on the event */
    	event.preventDefault();

    	// CONTENEDOR DEL POST
    	var padre = $(this).parents('.content-post');
    	var post = padre.find('.box-comment').data('trend');
    	var comment = $(this).find('input').val();
        var count = padre.find('.post-comment ').children('.number-post').text();

    	if (comment.length > 0 ) {
    		$.ajax({
    			url: '/create_comment/'+post,
    			type: 'POST',
    			dataType: 'HTML',
    			data: {comment: comment},
    			success: function($data){
    					
    					count = parseInt(count) + 1;
    					padre.find('.post_change').text('');
                        padre.find('.post_change').text(count);

    					padre.find('input').val("");
    					padre.find('.box-comment-body').html($data);
    			}					

    		})
    		.fail(function() {
    			console.log("error");
    		});
    		
    	}
    });

    //FIN PROCESO DE COMENTARIOS


    //PROCESO DEL LIKE
    	$('.like-me').click(function(event) {
    		/* Act on the event */
            var post = $(this).data('like');
    		var user = $(this).data('user');
            var objecto = $(this);
            console.log(user);
            if (user != null) {
                // alert(post);
                var no_like = $(this).hasClass('like-user');
                
                $.ajax({
                    url: '/create_like_user/'+post,
                    type: 'POST',
                    dataType: 'HTML',
                    success: function($data){
                        if (no_like == false) {             
                            objecto.addClass('like-user');
                            objecto.removeClass('like-user-active');

                        }else{
                            objecto.removeClass('like-user');
                            objecto.addClass('like-user-active');

                        }
                    }
                })
                .fail(function() {
                    console.log("error");
                });
            }else{
                // alert(post);
                var no_like = $(this).hasClass('post-like-me');

                var like = objecto.children('.number-post').text();
                like = parseInt(like);
                
                $.ajax({
                    url: '/create_like/'+post,
                    type: 'POST',
                    dataType: 'HTML',
                    success: function($data){
                        if (no_like == false) {             
                            objecto.addClass('post-like-me');
                            objecto.removeClass('post-like-me-active');
                            objecto.children('.number-post').text(like-1);

                        }else{
                            objecto.removeClass('post-like-me');
                            objecto.addClass('post-like-me-active');
                            objecto.children('.number-post').text(like+1);

                        }
                    }
                })
                .fail(function() {
                    console.log("error");
                });

            }
    	});

    //FIN PROCESO DE LIKE

    //PROCESO CALIFICACION PRODUCTO
    $('.post-qualification-product').on('click', 'a', function(event) {
        event.preventDefault();
        /* Act on the event */
        var value = $(this).data('star');

        var post_id = $(this).data('post');

        var padre = $(this).parents('.post-qualification-product');
        
        if (post_id != null) {
            $.ajax({
                url: '/create_qualification_product/'+post_id+'/'+value,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (!data.error) {
                        var html_append = "";
                        if(data.qualification < 5)
                        {
                            for (var i = 1; i <= parseInt(data.qualification); i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-post="'+post_id+'"></a>'
                      
                            for (var i = 1; i <= (5-parseInt(data.qualification)); i++)
                                html_append += '<a data-star="'+(parseInt(data.qualification)+i)+'" class="glyphicon glyphicon-star qualification-no-popular" data-post="'+post_id+'"></a>'
                            
                            padre.html(html_append);
                        }else{
                            for (var i = 1; i <= data.qualification; i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-post="'+post_id+'"></a>'
                            
                            padre.html(html_append);
                        }
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
        
    });

    // PROCESO DE CALIFICACION
    $('.post-qualification').on('click', 'a', function(event) {
        event.preventDefault();
        /* Act on the event */
        var value = $(this).data('star');

        var post_id = $(this).data('post');
        var user_qualification = $(this).data('userqualification');

        var padre = $(this).parents('.post-qualification');
        
        if (post_id != null && user_qualification == null) {
            $.ajax({
                url: '/create_qualification/'+post_id+'/'+value,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (!data.error) {
                        var html_append = "";
                        if(data.qualification < 5)
                        {
                            for (var i = 1; i <= parseInt(data.qualification); i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-post="'+post_id+'"></a>'
                      
                            for (var i = 1; i <= (5-parseInt(data.qualification)); i++)
                                html_append += '<a data-star="'+(parseInt(data.qualification)+i)+'" class="glyphicon glyphicon-star qualification-no-popular" data-post="'+post_id+'"></a>'
                            
                            padre.html(html_append);
                        }else{
                            for (var i = 1; i <= data.qualification; i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-post="'+post_id+'"></a>'
                            
                            padre.html(html_append);
                        }
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
        if (post_id == null && user_qualification != null) {
            $.ajax({
                url: '/create_qualification_user/'+user_qualification+'/'+value,
                type: 'POST',
                dataType: 'JSON',
                success: function(data){
                    if (!data.error) {
                        var html_append = "";
                        if(data.qualification < 5)
                        {
                            for (var i = 1; i <= parseInt(data.qualification); i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-userqualification="'+user_qualification+'"></a>'
                      
                            for (var i = 1; i <= (5-parseInt(data.qualification)); i++)
                                html_append += '<a data-star="'+(parseInt(data.qualification)+i)+'" class="glyphicon glyphicon-star qualification-no-popular" data-userqualification="'+user_qualification+'"></a>'
                            
                            padre.html(html_append);
                        }else{
                            for (var i = 1; i <= data.qualification; i++)
                                html_append += '<a data-star="'+i+'" class="glyphicon glyphicon-star qualification-popular" data-userqualification="'+user_qualification+'"></a>'
                            
                            padre.html(html_append);
                        }
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        }

        
    });


    $('body').on('click', '.share_product_shymow', function(event) {
        /* Act on the event */
        event.preventDefault();

        var post_id = $(this).data('post_id');
        var user_id = $(this).data('user_id');
        var contenedor = $('#modal_container');
        
        if (post_id != null && user_id != null) {
            $.ajax({
                url: '/share_product/'+post_id+'/'+user_id,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){

                    var html = '<p class="text-center"><i class="block-center text-center fa fa-spinner fa-spin fa-3x fa-fw"></i>';
                    html+= '<span class="block-center text-center sr-only">Loading...</span><br></p>';

                    contenedor.html(html)
                },
                success: function(data){
                    var html = "";
                    html += '<div class="modal-body">';
                        html += '<input type="text" name="new_description" class="form-control" placeholder="Haz un comentario..." style="border: 0px;box-shadow:none;">';
                        html += '<div class="col-sm-12" style="margin-top: 20px">';
                            html += '<br>';
                            html += '<div class="post-media">';
                                if (data.image.exists){
                                    html += '<img src="'+data.image.path+'" style="width:100%;" alt="Shymow-Shop">';
                                    html += '<input type="hidden" value="'+data.image.path+'" name="image">';             
                                }
                            html += '</div>';
                            html += '<div class="shop-content">';
                            html += '    <div class="col-sm-12 col-md-8">';
                            html += '        <h2 class="title-shop">'+data.title+'</h2>';
                            html += '        <p>'+data.description+'</p>';
                            html += '    </div>';
                            html += '    <div class="col-sm-12 col-md-4">';
                            html += '        <h2 class="price" style="float:right;">'+data.price+'€</h2>';
                            html += '        <br>';
                            html += '        <br>';
                            html += '        <div class="clearfix"></div>';
                            html += '    </div>';
                            html += '</div>';
                        html += '</div>';
                    html += '</div>';

                    html += '<input type="hidden" value="'+data.description+'" name="description">';
                    html += '<input type="hidden" value="'+data.id+'" name="user_id">';
                    html += '<input type="hidden" value="'+data.id+'" name="product_id">';
                    html += '<div class="modal-footer">';
                        html += '<br>';
                        html += '<br>';
                        html += '<button type="submit" class="btn btn-primary" style="margin:10px !important;">Publicar</button>';
                    html += '</div>';

                    contenedor.html(html);
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
    });

    $('body').on('click', '.share_post_shymow', function(event) {
        /* Act on the event */
        event.preventDefault();

        var post_id = $(this).data('post_id');
        var user_id = $(this).data('user_id');
        var contenedor = $('#modal_container');
        
        if (post_id != null && user_id != null) {
            $.ajax({
                url: '/share_post/'+post_id+'/'+user_id,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){

                    var html = '<p class="text-center"><i class="block-center text-center fa fa-spinner fa-spin fa-3x fa-fw"></i>';
                    html+= '<span class="block-center text-center sr-only">Loading...</span><br></p>';

                    contenedor.html(html)
                },
                success: function(data){
                    var html = "";
                    html += '<div class="modal-body">';
                    html += '<input type="text" name="new_description" class="form-control" placeholder="Haz un comentario..." style="border: 0px;box-shadow:none;">';
                    html += '<div class="col-sm-12" style="margin-top: 20px">';
                    html += '<br>';
                    html += '<div class="content-post no-background">';
                    html += '<div class="post-body tendencias-post">';
                    html += '<div class="post-header">';
                    html += '<div class="post-user">';
                    html += '<div class="post-icono"><img src="/'+data.img_profile+'" alt="shymow"></div>';
                    html += '<div class="post-user"><strong>'+data.user_name+'</strong></div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<br>';
                    html += '<div class="clearfix"></div>';
                    html += '<div class="post-description hashtag-post">'+data.post_description+'</div>';
                    html += '<div class="post-media">';
                            if (data.image.exists){
                                html += '<img src="'+data.image.path+'" alt="Shymow-Shop">';
                                html += '<input type="hidden" value="'+data.image.path+'" name="image">';             
                            }
                    html += '</div>';
                    html += '<br>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    html += '<input type="hidden" value="'+data.post_description+'" name="description">';
                    html += '<input type="hidden" value="'+data.user_id+'" name="user_id">';
                    html += '<input type="hidden" value="'+data.post_id+'" name="post_id">';
                    html += '<div class="modal-footer">';
                    html += '<label style="float:left;margin-top: 20px">Seleccionar categoría</label>';
                    html += '<select name="category" class="form-control">';
                            for (var i = 0; i < data.category.length; i++) {
                                html += '<option value="'+data.category[i]['id']+'">'+data.category[i]['name']+'</option>';
                            }
                    html += '</select>';
                    html += '<br>';
                    html += '<button type="submit" class="btn btn-primary">Publicar</button>';
                    html += '</div>';

                    contenedor.html(html);
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
        
        if (post_id == null && user_id != null) {
            $.ajax({
                url: '/share_user/'+user_id,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){

                    var html = '<p class="text-center"><i class="block-center text-center fa fa-spinner fa-spin fa-3x fa-fw"></i>';
                    html+= '<span class="block-center text-center sr-only">Loading...</span><br></p>';

                    contenedor.html(html)
                },
                success: function(data){
                    var html = "";
                    html += '<div class="profiles">';
                    html += '<div class="modal-body">';
                    html += '<input type="text" name="new_description" class="form-control" placeholder="Haz un comentario..." style="border: 0px;box-shadow:none;">';
                    html += '<div class="col-sm-12" style="margin-top: 20px">';
                    html += '<br>';
                    html += '<div class="content-post no-background">';
                    html += '<div class="post-body tendencias-post">';
                    html += '<div class="post-header">';
                    html += '<div class="post-user">';
                    html += '<div class="post-icono"><img src="/'+data.img_profile+'" alt="shymow"></div>';
                    html += '<div class="post-user"><strong>'+data.user_name+'</strong></div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<br>';
                    html += '<div class="clearfix"></div>';
                    html += '<div class="post-description hashtag-post"><div class="busquedas-social"><a href="/view_user/'+data.user_id+'" style="background: #66C1BF;padding: 5px 5px;color: #fff;font-family: gothamTwo;border-radius: 5px;float: right;top: -25px;position: relative;">VER +</a></div></div>';
                    html += '<div class="post-media">';
                    html += '</div>';
                    html += '<br>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '<input type="hidden" value="'+data.user_id+'" name="user_id">';
                    html += '<div class="modal-footer">';
                    html += '<label style="float:left;margin-top: 20px">Seleccionar categoría</label>';
                    html += '<select name="category" class="form-control">';
                            for (var i = 0; i < data.category.length; i++) {
                                html += '<option value="'+data.category[i]['id']+'">'+data.category[i]['name']+'</option>';
                            }
                    html += '</select>';
                    html += '<br>';
                    html += '<button type="submit" class="btn btn-primary">Compartir</button>';
                    html += '</div>';
                    html += '</div>';

                    contenedor.html(html);
                }
            })
            .fail(function() {
                console.log("error");
            });
        }
    });

    $('body').on('click', '.post-follow #foll', function(event) {
        event.preventDefault();
        /* Act on the event */
        var classCss = $(this).hasClass('follow-post-active');

        var post_id = $(this).data('follow');
        var section = $(this);
        //alert(post_id);
        $.ajax({
            url: '/follow_post?post='+post_id,
            type: 'POST',
            dataType: 'JSON',
            data: {post: post_id},
            success: function(data){
                if (!data.error) {
                    if (classCss) {
                        section.removeClass('follow-post-active');
                        section.addClass('follow-post-desactive');
                    }else{

                        section.removeClass('follow-post-desactive');
                        section.addClass('follow-post-active');
                    }
                }
            }
        })
        .fail(function() {
            console.log("error");
        });
        
    });


    //AGREGAR STREAM
    $('.add-social').on('click', '.add-stream', function(event) {
        event.preventDefault();
        /* Act on the event */
        var object = $(this);
        var $container = $('.stream-container');
        var count = $container.children().length +1;
        var text = $(this).parent('.form-group').find('input[type="text"]').val();
        if (isValidUrl(text,true)) {
            var streamNet = ['twitch','bambuser','livestream'];
            var result = text.replace("www", ""); 
            result = result.split(".");
            resultOut = result[0].split('//');
            var page;
            if (resultOut[1] == "") {
                page = result[1];
            }else{
                page = resultOut[1];
            }

            // console.log(page);
            var controlador = 0;
            for (var i =0; i<streamNet.length; i++) {
                if (streamNet[i] == page) {
                    controlador ++;
                    $(this).attr('data-stream', streamNet[i]);

                    $.post('/add_networks', {networks:streamNet[i],data:text }, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        object.parents('.add-social').find('.error-danger').fadeOut('slow');

                        var html = "";
                            html += '<div class="col-sm-6 sody out-padding">';
                            html +=    '<div class="form-group">';
                            html +=        '<input type="text" class="form-control" placeholder="Streaming"><button class="add-stream button-add" data-stream=""><span class="glyphicon glyphicon-plus"></span></button>';
                            html +=    '</div>';
                            html +='</div>';

                        if (object.hasClass('add-stream')) {
                            object.removeClass('add-stream');
                            object.addClass('button-delete');

                            if (object.children('span').hasClass('glyphicon-plus')) {
                                object.children('span').removeClass('glyphicon-plus');
                                object.children('span').addClass('glyphicon-minus');
                            }
                        }

                        $container.append(html);    
                    });
                }
            }

            if (controlador < 1) {
                $(this).parents('.add-social').find('.error-danger').fadeIn('slow');
            }
        }else{
            $(this).parents('.add-social').find('.error-danger').fadeIn('slow');
        }
    });
    //Eliminar stream
    $('.add-social').on('click', '.button-delete', function(event) {
        event.preventDefault();
        var objects = $(this);
        var stream = $(this).siblings('input[type="text"]').val();
        var network = $(this).data('stream');
        // console.log(network);
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            $.post('/delete_networks', {networks: network,streamings: stream}, function(data, textStatus) {
                if (textStatus == "success") {
                    if (!data.error) {
                        objects.parents('.add-body').fadeOut('slow');
                        swal("Deleted!", data.message, "success");
                    }
                }
            });
        });
    });
    function isValidUrl(url,obligatory,ftp)
    {
        // Si no se especifica el paramatro "obligatory", interpretamos
        // que no es obligatorio
        if(obligatory==undefined)
            obligatory=0;
        // Si no se especifica el parametro "ftp", interpretamos que la
        // direccion no puede ser una direccion a un servidor ftp
        if(ftp==undefined)
            ftp=0;
     
        if(url=="" && obligatory==0)
            return true;

        if(ftp)
            var pattern = /^(http|https|ftp)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
        else
            var pattern = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;

        if(url.match(pattern))
            return true;
        else
            return false;
    }

    //Agregar spacio para crear red
    $('.container_social').on('click', '.new_social', function(event) {
        event.preventDefault();
        /* Act on the event */
        var insert = $('.insert-social .social-container-insert');
        var name = $(this).data('name');
        if (insert.length < 1) {
            var html =      '<div class="social-container-insert">'
                html +=        '<br>'
                html +=        '<div class="col-sm-6 add-body out-padding">'
                html +=            '<div class="form-group">'
                html +=                '<input type="text" class="form-control" placeholder="Red social"><button data-name="'+name+'" class="add-redes button-add"><span class="glyphicon glyphicon-plus"></span></button>'
                html +=            '</div>'
                html +=        '</div>'
                html +=    '</div>'
            $('.insert-social').append(html);
        }
    });

    $('.insert-social').on('click', '.add-redes', function(event) {
        event.preventDefault();
        /* Act on the event */
        var text = $(this).parent('.form-group').find('input[type="text"]').val();
        var name = $(this).data('name');

        if (isValidUrl(text,true)) {
            var socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
            var result = text.replace("www", ""); 
            result = result.split(".");
            resultOut = result[0].split('//');
            var page;
            if (resultOut[1] == "" || resultOut[1].length < 4) {
                page = result[1];
                if (page == "es") {
                    page = result[2];
                }
            }else{
                page = resultOut[1];
            }
            // console.log(page);
            var controlador = 0;
            for (var i =0; i<socialNet.length; i++) {
                
                if (socialNet[i] == page) {
                    controlador ++;

                    $.post('/add_networks', {networks:socialNet[i],data:text }, function(data, textStatus, xhr) {
                        /*optional stuff to do after success */
                        $('.social-danger').fadeOut('slow');

                        var insert = $('.insert-social .social-container-insert');
                        if (insert.length > 0) {
                            insert.remove();
                        };

                        if (data.error) {
                            swal("Error!", data.message, "success");
                        }else{

                            var html = '<div class="social-redes">';
                            html +=        '<a href="'+text+'" target="_blank">';
                                html +=        '<div class="img-social">';
                                html +=            '<div class="sub-img-social">';
                                html +=                '<img src="img/profile/'+page+'.png" alt="shymow">';
                                html +=            '</div>';
                                html +=           ' <img src="img/backred.png" alt="shymow">';
                                html +=       ' </div>';
                            html +=       ' </a>';
                            html +=       ' <div class="social-body">';
                            html +=            '<h2>'+name+'</h2>';
                            html +=            '<p>'+page+'</p>';
                            html +=            '<h6 class="text-danger delete_red" data-network="'+page+'" data-red="'+text+'" style="cursor:pointer;">Eliminar</h6>'
                            html +=        '</div>';
                            html +=    '</div>';
                            $('.container_social').prepend(html);
                        }
                    });
                }
            }
            if (controlador < 1) {
                $('.social-danger').fadeIn('slow');
            }
        }else{
            $('.social-danger').fadeIn('slow');
        }
    });
    //Eliminar redes
    $('.container_social').on('click', '.delete_red', function(event) {
        event.preventDefault();
        /* Act on the event */
        var network = $(this).data('network');
        var red = $(this).data('red');
        var object = $(this);
         swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            $.post('/delete_networks', {networks: network,data: red}, function(data, textStatus) {
                if (textStatus == "success") {
                    if (!data.error) {
                        
                        object.parents('.social-redes').fadeOut('slow');
                        swal("Deleted!", data.message, "success");
                    }
                }
            });
        });
    });


    // Agregar y eliminar blogs y web
    $('.add-social').on('click', '.web-blogs-add', function(event) {
        var object = $(this);
        var type = object.data('type');
        var val = object.siblings('input[type="text"]').val();
        var container = $('.'+type+'-container');
        if (isValidUrl(val,true)) {
            $.post('/add_networks', {networks: type,data:val}, function(data, textStatus, xhr) {
                $('.alert-'+type).fadeOut('slow');

                var html = "";
                    html += '<div class="col-sm-6 add-body out-padding">';
                    html +=    '<div class="form-group">';
                    html +=        '<input type="text" class="form-control" placeholder="http://"><button class="button-add web-blogs-add" data-type="'+type+'"><span class="glyphicon glyphicon-plus"></span></button>';
                    html +=    '</div>';
                    html +='</div>';

                if (object.hasClass('web-blogs-add')) {
                    object.removeClass('web-blogs-add');
                    object.addClass('web-blogs-delete');

                    if (object.children('span').hasClass('glyphicon-plus')) {
                        object.children('span').removeClass('glyphicon-plus');
                        object.children('span').addClass('glyphicon-minus');
                    }
                }

                container.append(html);    
            });
        }else{
            $('.alert-'+type).fadeIn('slow');
        }
    });


    $('.add-social').on('click', '.web-blogs-delete', function(event) {
        event.preventDefault();
        /* Act on the event */

        var object = $(this);
        var type = object.data('type');
        var val = object.siblings('input[type="text"]').val();
        var container = $('.'+type+'-container');

         swal({
          title: "Are you sure?",
          text: "Your will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            $.post('/delete_networks', {networks: type,data: val}, function(data, textStatus) {
                if (textStatus == "success") {
                    if (!data.error) {
                        
                        object.parents('.col-sm-6').fadeOut('slow');
                        swal("Deleted!", data.message, "success");
                    }
                }
            });
        });
    });


    $('#chat-proper-options').popover();
    $('#chat-proper').click(function(event) {
        /* Act on the event */
        var i = $(this);
        $('#online-user').popover('destroy');
        if (i.next('div.popover:visible').length == 0){
            var text = $.ajax({
                url: '/notifyGetMessages',
                type: 'GET',
                async: false,
                success: function(data){
                    return data;
                }
            })
            .fail(function() {
                return "Error";
            });
            i.popover({
                trigger: 'manual',
                content:text.responseText,
                html: true,
                title:"Messages", 
                placement:"top",
            });
            i.popover('show');
        }else{
            i.popover('destroy');
        }
    });
    $('body').on('mouseenter', '.online-detail-user', function(event) {
        /* Act on the event */
        var userId = $(this).data('user');
        var i = $(this);
        $.ajax({
            url: '/online_detail/'+userId,
            type: 'GET',
            dataType: 'html',
            success: function(data){
                i.popover({
                    content:data,
                    html: true,
                       title:"Online", 
                    placement:"left",
                });
            }
        })
        .fail(function() {
            console.log("error");
        });
    });
    $('#online-user').click(function(event) {
        /* Act on the event */
        $('#chat-proper').popover('destroy');
        var i = $(this);
        if (i.next('div.popover:visible').length == 0){
            var text = $.ajax({
                url: '/online',
                type: 'GET',
                dataType: 'html',
                async: false,
                success: function(data){
                    return data;
                }
            })
            .fail(function() {
                return "Error";
            });
            i.popover({
                trigger: 'manual',
                content:text.responseText,
                html: true,
                title:"Online", 
                placement:"top",
            });
            i.popover('show');
        }else{
            i.popover('destroy');
        }
    });
    $('body').on('mouseenter', '#online-user', function(event) {
        event.preventDefault();
        var i = $(this);
        
    });
    $('body').on('click', '#chat-proper', function(event) {
        $('.float-chat').find('.popover-content').addClass('chat-float-view');
    });

    $('body').on('mouseover', '.chat-content-view', function(event) {
        event.preventDefault();
        /* Act on the event */
        $(this).css('background', '#B3DBCD');
    });
    $('body').on('mouseout', '.chat-content-view', function(event) {
        event.preventDefault();
        /* Act on the event */
        $(this).css('background', 'none');
    });


    $('#btn_create_message').click(function(event) {
            /* Act on the event */
            $('#container-message').find('.content-chat-message-description').fadeOut('fast');
            $('#container-message').find('.content-new-chat-message-description').fadeIn('fast');
        $.ajax({
            url: '/create_new_message',
            type: 'GET',
            dataType: 'html',
            beforeSend: function(){
                var html ="";
                html +='<div class="text-center"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>';
                $('#container-message').find('.content-new-chat-message-description').html(html);
            },
            success:function(data){
                $('#container-message').find('.content-new-chat-message-description').html(data);
            }
        })
        .fail(function() {
            console.log("error");
        });
    });


    $('body').on('click', '.chatSelect', function(event) {
        event.preventDefault();
        /* Act on the event */
        $('#container-message').find('.content-new-chat-message-description').fadeOut('fast');
        $('#container-message').find('.content-chat-message-description').fadeIn('fast');
        var object = $(this);
        var name = $(this).find('.notify-message-header').children('.name').text();

        //Channel
        var key = $(this).data('key');
        var receptor = $(this).data('receptor');
        var emisor = $(this).data('transmitter');
        $('#room').attr('value', key);
        $('#from_chat').attr('value', receptor);

                    
        var html = "";
        html += '<h3>';
        html+=  '<i class="fa fa-comments" style="color: #37B4AA"></i>';
        html+=  '<span data-transmitter="'+emisor+'">'+name+'</span>';
        html+=  '<span id="openChannel" data-channelopen="'+key+'"></span>';
        html += '</h3>';
        $('#container-message').find('.user').html(html);

        if ($('.message-description-information').hasClass('height-chat') == false) {
            $('.message-description-information').addClass('height-chat');
        }

        $.ajax({
            url: '/all_messages',
            type: 'GET',
            dataType: 'json',
            data: {channel: key},
            beforeSend: function(){
                $('body').find('.content-chat-messages').html('<div class="text-center"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>');
            },
            success:function(data){
                if (!data.error) {

                    var values = JSON.parse(data.data)  
                    var message = "";
                    $('.message-description-information')
                    for($i=0;$i<values.length;$i++){
                        var data = values[$i];
                        message += '<div class="row">';
                        message +=  '<div class="chat-message">';
                        message +=      '<div class="clearfix"></div>';
                        message +=      '<div class="col-sm-2">';
                        message +=          '<img src="/'+data.emisorImg+'" alt="shymow">';
                        message +=      '</div>';
                        message +=      '<div class="col-sm-10">';
                        message +=          '<div class="notify-message-header">';
                        message +=                 '<div class="name">';
                        message +=                     '<span>';
                        message +=                      data.emisorName;
                        message +=                     '</span>';
                        message +=                 '</div>';
                        message +=                 '<div class="time">';
                        message +=                     '<span></span>';
                        message +=                 '</div>';
                        message +=             '</div>';
                        message +=         '<div class="clearfix"></div>';
                        message +=         '<div class="content-information">';
                        message +=             data.message;
                        message +=         '</div>';
                        message +=     '</div>';
                        message +=  '</div>';
                        message += '</div>';
                        message += '<div class="clearfix"></div>';

                        $('body').find('.content-chat-messages').empty();
                        $('body').find('.content-chat-messages').append(message);

                        $('#sendMessageChat').slideDown('slow');
                        var WH = object.height();
                        var SH =object.height();
                        object.scrollTop = object.scrollHeight;
                    }


                    $.post('/change_read', {channel: key}, function(data, textStatus, xhr) {
                        if (object.hasClass('notReaderMessage')) {;
                            object.removeClass('notReaderMessage')
                        }
                    });
                }else{
                    $('body').find('.content-chat-messages').html('<div class="alert lert-danger alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  <strong>Warning!</strong>'+data.message+' </div>');
                }
            }
        })
        .fail(function() {
            console.log("error");
        });
    });



    // EDITAR MI FRASE
    $('#frase').click(function(event) {
        /* Act on the event */
        var text = $(this).parent('p').text();
        var object = $(this).parent('p').children('#contentFra');
        swal({
          title: "Mi frase",
          text: "Escribe una frase nueva:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: text
        },
        function(inputValue){
          if (inputValue === false) return false;
          
          if (inputValue === "") {
            swal.showInputError("Necesitas escribir tu frase!");
            return false
          }
          
          $.ajax({
              url: '/edit_data_profile',
              type: 'POST',
              dataType: 'JSON',
              data: {type: 'frase',data:inputValue},
              success:function(data){
                if (!data.error) {
                    swal("Bien!", "Tu nueva frase: " + inputValue);
                    object.text(inputValue);
                }else{
                    swal("Error!", "Vuelve a intentarlo");
                }
              }
          })
          .fail(function() {
              console.log("error");
          });
          
        });
    });

    //Editar descripcion
    $('#descripcion_profile').click(function(event) {
        /* Act on the event */
        var text = $(this).parent('p').text();
        var object = $(this).parent('p').children('#myDescr');
        swal({
          title: "Mi breve descripción",
          text: "Escribe una descripción nueva:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: text,
        },
        function(inputValue){
          if (inputValue === false) return false;
          
          if (inputValue === "") {
            swal.showInputError("Necesitas una descripción!");
            return false
          }
          
          $.ajax({
              url: '/edit_data_profile',
              type: 'POST',
              dataType: 'JSON',
              data: {type: 'descripcion',data:inputValue},
              success:function(data){
                if (!data.error) {
                    swal("Bien!", "Tu nueva frace: " + inputValue);
                    object.text(inputValue);
                }else{
                    swal("Error!", "Vuelve a intentarlo");
                }
              }
          })
          .fail(function() {
              console.log("error");
          });
          
        });
    });

    // Editar trabajo
    $('#work').click(function(event) {
        /* Act on the event */
        var text = $(this).siblings('.val').text();
        var object = $(this).siblings('.val');
        swal({
          title: "Mi profesión",
          text: "Escribe una profesión:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: text
        },
        function(inputValue){
          if (inputValue === false) return false;
          
          if (inputValue === "") {
            swal.showInputError("Necesitas escribir una profesión!");
            return false
          }
          
          $.ajax({
              url: '/edit_data_profile',
              type: 'POST',
              dataType: 'JSON',
              data: {type: 'work',data:inputValue},
              success:function(data){
                if (!data.error) {
                    swal("Bien!", "Tu nueva frace: " + inputValue);
                    object.text(inputValue);
                }else{
                    swal("Error!", "Vuelve a intentarlo");
                }
              }
          })
          .fail(function() {
              console.log("error");
          });
          
        });
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
        $('#state').html('<option value="all">Todo</option>'+data);
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
        $('#city').html('<option value="all">Todo</option>'+data);
        if (data == "")
          $('#city').html('<option value="all">Municipios no encontrados</option>');
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
});