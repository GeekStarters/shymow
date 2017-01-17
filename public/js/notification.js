jQuery(document).ready(function($) {
	// var conn = new WebSocket('ws://127.0.0.1:8282');
	var conn = new WebSocket('ws://52.42.76.191:8282');
	conn.onopen = function(e) {
	};
	actualuser = $( "#unvalus" ).data("unvalus");
	conn.onmessage = function(e) {
		var data = JSON.parse(e.data);
		if(actualuser==data.channel)
		{
			var count = $('.number-notify-g').text();
			count = parseInt(count) + 1;
			$('.number-notify-g').text(count);
			if ($('#n-img-p').find('.notification-perfil').length > 0) {
				var count = $('.notification-perfil').text();
				count = parseInt(count) + 1;
				$('.notification-perfil').text(count);
			}else{
				count =1;
				$('#n-img-p').html('<span class="notification-perfil">'+count+'</span>');
			}


			if (data.notify == 1) {
				if (data.sound == 1) {
					notifyMe(data.name,'/'+data.img,data.type);
					var audio = new Audio('/sound/notification.mp3');
					audio.play();
					
				}else{
					notifyMe(data.name,'/'+data.img,data.type);
				}
			}
		}
	};

    //PROCESO DEL LIKE PRODUCTO
    $('.like-me-product').click(function(event) {
	        /* Act on the event */
	        var post = $(this).data('like');
	        var user = $(this).data('user');
	        var objecto = $(this);
	        if (user != null) {
	        }else{
	            // alert(post);
	            var no_like = $(this).hasClass('post-like-me');

	            var like = objecto.children('.number-post').text();
	            like = parseInt(like);
	            var type = no_like ? 1 : 5;
	            $.ajax({
	                url: '/create_like_product/'+post+'/'+type,
	                type: 'POST',
	                dataType: 'HTML',
	                success: function($data){
	                    if (!data.error) {
	                    	if (no_like == false) {             
		                        objecto.addClass('post-like-me');
		                        objecto.removeClass('post-like-me-active');
		                        objecto.children('.number-post').text(like-1);
		                        conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:data.description,sound:data.sound,notify:data.notify }));

		                    }else{
		                    	
		                        objecto.removeClass('post-like-me');
		                        objecto.addClass('post-like-me-active');
		                        objecto.children('.number-post').text(like+1);
		                        conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:data.description,sound:data.sound,notify:data.notify }));
		                    }
	                    }
	                }
	            })
	            .fail(function() {
	                console.log("error");
	            });

	        }
	    });

//FIN PROCESO DE LIKE




	//NOTIFICACION CALIFICACION
	$('.post-qualification').on('click', 'a', function(event) {
		event.preventDefault();
		var post_id = $(this).data('post');
		var userId = $(this).parents('.post-qualification').data('user_id');
		saveNotification(userId,"Calificaron Post",actualuser,0,post_id);
		
	});

	//NOTIFICACION LIKE

	$('.like-me').click(function(event) {
    		/* Act on the event */
		var userId = $(this).data('user_id');
        var objecto = $(this);
        var no_like = $(this).hasClass('post-like-me-active');
        var post_id = $(this).data('like');
        if (post_id != null) {
        	if (no_like == false) {             
                saveNotification(userId,"Calificaron Post",actualuser,1,post_id);

            }else{
                saveNotification(userId,"Calificaron Post",actualuser,8,post_id);

            }
        	
        }
        
	});

    //PROCESO DE COMENTARIOS NOTIFICACION
    $(".box-comment-header").submit('.form-comment',function(event) {
    	/* Act on the event */

    	var userId = $(this).data('user_id');
    	var padre = $(this).parents('.content-post');
    	var post_id = padre.find('.box-comment').data('trend');
    	saveNotification(userId,"Calificaron Post",actualuser,4,post_id);
    });

    //PROCESO DE NOTIFICACION FOLLOW
    $('body').on('click', '.post-follow #foll', function(event) {
        event.preventDefault();
        /* Act on the event */
        var classCss = $(this).hasClass('follow-post-active');
        var userId = $(this).data('user_id');
        var post_id = $(this).data('follow');
        if (classCss) {
            saveNotification(userId,"Calificaron Post",actualuser,6,post_id);
        }else{
        	saveNotification(userId,"Calificaron Post",actualuser,2,post_id);
        }
        
    });

	function notifyMe(theBody,theIcon,theTitle,theText) {
	  // Let's check if the browser supports notifications
	  if (!("Notification" in window)) {
	   notiIE(theIcon,theTitle,theText);
	  }

	  // Let's check whether notification permissions have already been granted
	  else if (Notification.permission === "granted") {
	    // If it's okay let's create a notification
	    spawnNotification(theBody,theIcon,theTitle);
	  }

	  // Otherwise, we need to ask the user for permission
	  else if (Notification.permission !== 'denied') {
	    Notification.requestPermission(function (permission) {
	      // If the user accepts, let's create a notification
	      if (permission === "granted") {
	        var notification = new Notification("Hi there!");
	      }
	    });
	  }

	  // At last, if the user has denied notifications, and you 
	  // want to be respectful there is no need to bother them any more.
	}Notification.requestPermission().then(function(result) {
	  // console.log(result);
	});
	function spawnNotification(theBody,theIcon,theTitle) {
	  var options = {
	      body: theBody,
	      icon: theIcon
	  }
	  var n = new Notification(theTitle,options);
	}

	function notiIE(image,theTitle,theText)
	{
	   $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: theTitle,
                // (string | mandatory) the text inside the notification
                text:theText,
                // (string | optional) the image to display on the left
                image: image,
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (function) before the gritter notice is opened
                before_open: function(){
                    if($('.gritter-item-wrapper').length == 3)
                    {
                        // Returning false prevents a new gritter from opening
                        return false;
                    }
                }
		});
	}

	function saveNotification(user_id,text_notification,key_sender,type,object){
		$.ajax({
			url: '/save_notification/',
			type: 'GET',
			dataType: 'JSON',
			data: {sender: key_sender,reseiver:user_id,type:type,objectId:object},
			success: function(data){
				if (!data.error) {
					conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:data.description,sound:data.sound,notify:data.notify }));
				}
			}
		});
	}
});