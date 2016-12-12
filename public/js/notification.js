jQuery(document).ready(function($) {
	var conn = new WebSocket('ws://127.0.0.1:8282');
	conn.onopen = function(e) {
		console.log("Connection established! Notify");
	};
	conn.onmessage = function(e) {
		console.log(e);
		var data = JSON.parse(e.data);
		var actualuser = $( "#unvalus" ).data("unvalus");
		if(actualuser==data.channel)
		{
			notifyMe(data.name,'/'+data.img,data.type);
		}
	};

	//NOTIFICACION CALIFICACION
	$('.post-qualification').on('click', 'a', function(event) {
		event.preventDefault();

		var userId = $(this).parents('.post-qualification').data('user_id');
		$.ajax({
			url: '/notification_user/'+userId,
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				if (!data.error) {
					conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Calificaron post" }));
				}
			}
		});
		
	});

	//NOTIFICACION LIKE

	$('.like-me').click(function(event) {
    		/* Act on the event */
		var userId = $(this).data('user_id');
        var objecto = $(this);
        var no_like = $(this).hasClass('post-like-me-active');
        
        $.ajax({
            url: '/notification_user/'+userId,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
				if (!data.error) {
					if (no_like == false) {             
                        conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Dieron like a post" }));
                    }else{
                        conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Quito like a post" }));
                    }
				}
			}

        });
	});

	//PROCESO DE COMENTARIOS NOTIFICACION
    $(".box-comment-header").submit('.form-comment',function(event) {
    	/* Act on the event */

    	var userId = $(this).data('user_id');
    	$.ajax({
			url: '/notification_user/'+userId,
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				if (!data.error) {
					conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Comentaron tu post" }));
				}
			}
		});
    });


    //PROCESO DE NOTIFICACION FOLLOW
    $('body').on('click', '.post-follow #foll', function(event) {
        event.preventDefault();
        /* Act on the event */
        var classCss = $(this).hasClass('follow-post-active');
        var userId = $(this).data('user_id');
        $.ajax({
			url: '/notification_user/'+userId,
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				if (!data.error) {
					if (classCss) {
                        conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Dejo de seguir tu post" }));
                    }else{
                    	conn.send(JSON.stringify({channel:data.identification,name:data.name,img:data.img,type:"Sigue tu post" }));
                    }
					
				}
			}
		});
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
	  console.log(result);
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
});