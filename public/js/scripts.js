$( document ).ready(function() {

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.get('search_typeahead', function(data){
        var users = data.data;

        var user = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: users
        });
        user.initialize();
        $('#custom-templates .typeahead').typeahead(null, {
          name: 'best-pictures',
          display: 'value',
          source: user.ttAdapter(),
          templates: {
            empty: [
              '<div class="empty-message">',
                'unable to find any Best Picture winners that match the current query',
              '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile('<a href="/user/{{id}}"><div><img class="img-responsive" src="{{img}}"><strong>{{name}}</strong></div></a>')
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
                        console.log(count);
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
    		// alert(post);
            var objecto = $(this);
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
    	});

    //FIN PROCESO DE LIKE


    $('.post-qualification').on('click', 'a', function(event) {
        event.preventDefault();
        /* Act on the event */
        var value = $(this).data('star');
        var post_id = $(this).data('post');
        var padre = $(this).parents('.post-qualification');
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
        
    });


    $('body').on('click', '.share_post_shymow', function(event) {
        /* Act on the event */
        event.preventDefault();

        var post_id = $(this).data('post_id');
        var user_id = $(this).data('user_id');
        var contenedor = $('#modal_container');
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
                console.log(data);
                html += '<div class="modal-body">';
                html += '<input type="text" name="new_description" class="form-control" placeholder="Haz un comentario..." style="border: 0px;box-shadow:none;">';
                html += '<div class="col-sm-12" style="margin-top: 20px">';
                html += '<br>';
                html += '<div class="content-post no-background">';
                html += '<div class="post-body tendencias-post">';
                html += '<div class="post-header">';
                html += '<div class="post-user">';
                html += '<div class="post-icono"><img src="'+data.img_profile+'" alt="shymow"></div>';
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
        
    });

    $('body').on('click', '.post-follow a', function(event) {
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
});