jQuery(document).ready(function($) {
	var conn = new WebSocket('ws://127.0.0.1:8181');

	conn.onopen = function(e) {
	  console.log("Connection established!");
	  suscribe();
	};

	conn.onmessage = function(e) {
		console.log(e);
		var value = JSON.parse(e.data);
	  	var count = $('.chatSelect').size();
		var controlador = true;
		var d = value.time;
		var container = $('body').find('#stackMessages');
		function dataUser(key,receiver,iam,img,name,time,msg){
			var html = "";
				html += '<div class="row">';
			    	html += '<div class="notify-message chatSelect notReaderMessage" data-key="'+key+'" data-receptor="'+receiver+'" data-transmitter="'+iam+'">';
						html += '<div class="clearfix"></div>';
				        html += '<div class="col-sm-3">';
				            html += '<img src="'+img+'" alt="shymow">';
				        html += '</div>';
				        html += '<div class="col-sm-9">';
				            html += '<div class="notify-message-header">';
				                html += '<div class="name">';
				                    html += '<span>';
				                    	html += name;
				                    html += '</span>';
				                html+= '</div>';
				                html+= '<div class="time">';
				                    html+= '<span>'+time+'</span>';
				                html+= '</div>';
				            html+= '</div>';
				            html+= '<div class="clearfix"></div>';
				            html+= '<div class="content-information">';
				                html+= msg;
				            html+= '</div>';
				        html+= '</div>';
				    html+= '</div>';
				html+= '</div>';
				html+= '<div class="clearfix"></div>';

				return html;
		}
		$.get('/data_user',{transmitter:value.transmitter},function(data) {
			var user = JSON.parse(data.data);	
			console.log(user,d);
			$('.chatSelect').each(function(index, el) {
			  	if (!data.error) {
			  		var val = $(this).data('key');
				  	if (val == value.channel) {
				  		$(this).addClass('notReaderMessage');
				  		$(this).find('.content-information').text(value.message);
				  		$(this).find('.time').children('span').text(d);
				  		controlador =false;
				  	}
			  	}
			});

		  	if (controlador) {
		  		console.log("entre");
				$('.content-messages').prepend(dataUser(value.channel,value.transmitter,value.receiver,user.img,user.name,d,value.message));
		  	}

		  	var channelUser = $('#container-message').find('#openChannel').data('channelopen');
		  	if (channelUser == value.channel) {
		  		var view = "";
					view += '<div class="row">';
                    view +=  '<div class="chat-message">';
                    view +=      '<div class="clearfix"></div>';
                    view +=      '<div class="col-sm-2">';
                    view +=          '<img src="/'+user.img+'" alt="shymow">';
                    view +=      '</div>';
                    view +=      '<div class="col-sm-10">';
                    view +=          '<div class="notify-message-header">';
                    view +=                 '<div class="name">';
                    view +=                     '<span>';
                    view +=                      user.name;
                    view +=                     '</span>';
                    view +=                 '</div>';
                    view +=                 '<div class="time">';
                    view +=                     '<span></span>';
                    view +=                 '</div>';
                    view +=             '</div>';
                    view +=         '<div class="clearfix"></div>';
                    view +=         '<div class="content-information">';
                    view +=             value.message;
                    view +=         '</div>';
                    view +=     '</div>';
                    view +=  '</div>';
                    view += '</div>';
                    view += '<div class="clearfix"></div>';
            	container.append(view);
            	container.animate({ scrollTop: container[0].scrollHeight}, 1000);
		  	}
		});
	};
	function sendComunication(command,msg,receiver,transmitter,channel,time) {
	    conn.send(JSON.stringify({command: command, message: msg,receiver:receiver,transmitter:transmitter,channel:channel,time:time}));
	}

	function suscribe(){
		$.ajax({
			url: '/channels',
			type: 'GET',
			dataType: 'JSON',
			success: function(data){
				var newData = JSON.parse(data.data);
				for (var i = 0; i < newData.length; i++) {
					var channel = newData[i];
					conn.send(JSON.stringify({command: "subscribe", channel:channel.channel,transmitter:data.emisor }));
				}
			}
		})
		.fail(function() {
			console.log("error");
		});		
	}
	
    var validator = new FormValidator('sendMessageChatForm', [{
	    name: 'room_',
	    display: 'All',
	    rules: 'required'
    },{
        name: 'from_chat',
        display: 'receptor',
        rules: 'All'
    },{
        name: 'new_message-chat-form',
        display: 'Message',
        rules: 'required'
    }], function(errors, event) {
        if (errors.length > 0) {
            var errorString = '';

            for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                
                errorString += errors[i].message + '<br />';
            }

            var html ='<div class="alert alert-danger alert-dismissible" role="alert">';
              html +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
              html +=errorString;
            html +='</div>';
            $('#errors-validate-send').slideDown('fast');
            $('#errors-validate-send').html(html);
        }
    });
	$('body').on('submit', '#sendMessageChatForm', function(event) {
		event.preventDefault();
		/* Act on the event */
		var message = $('#new_message-chat-form').val();
		var channel = $('#room').val();
		var receiver = $('#from_chat').val();
		var transmitter = $('#container-message').find('.user').find('span').data('transmitter');
		$('#new_message-chat-form').val("");
		var container = $('body').find('#stackMessages');
		$.ajax({
			url: '/set_message?channel='+channel+'&msg='+message+'&transmitter='+transmitter+'&receiver='+receiver,
			type: 'POST',
			dataType: 'JSON',
			success:function(data){
				if (!data.error) {
					var values = JSON.parse(data.data); 
					var view = "";
						view += '<div class="row">';
	                    view +=  '<div class="chat-message">';
	                    view +=      '<div class="clearfix"></div>';
	                    view +=      '<div class="col-sm-2">';
	                    view +=          '<img src="/'+values.emisorImg+'" alt="shymow">';
	                    view +=      '</div>';
	                    view +=      '<div class="col-sm-10">';
	                    view +=          '<div class="notify-message-header">';
	                    view +=                 '<div class="name">';
	                    view +=                     '<span>';
	                    view +=                      values.emisorName;
	                    view +=                     '</span>';
	                    view +=                 '</div>';
	                    view +=                 '<div class="time">';
	                    view +=                     '<span></span>';
	                    view +=                 '</div>';
	                    view +=             '</div>';
	                    view +=         '<div class="clearfix"></div>';
	                    view +=         '<div class="content-information">';
	                    view +=             message;
	                    view +=         '</div>';
	                    view +=     '</div>';
	                    view +=  '</div>';
	                    view += '</div>';
	                    view += '<div class="clearfix"></div>';
                	container.append(view);
					sendComunication("message",message,receiver,transmitter,channel,values.time);
					container.animate({ scrollTop: container[0].scrollHeight}, 1000);
				}else{
					var view = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>ERROR!</strong> Intentalo nuevamente</div>';
					container.append(view);
					container.animate({ scrollTop: container[0].scrollHeight}, 1000);
					
				}
			}
		})
		.fail(function() {
			console.log("error");
		});	
	});



		// NUEVO MENSAJE Y NUEVO CHAT


	var validator = new FormValidator('new_message', [{
        name: 'message',
        display: 'All',
        rules: 'required'
    },{
        name: 'from_message',
        display: 'User',
        rules: 'required'
    },{
        name: 'from_id',
        display: 'User',
        rules: 'required'
    }], function(errors, event) {
        if (errors.length > 0) {
            var errorString = '';

            for (var i = 0, errorLength = errors.length; i < errorLength; i++) {
                
                errorString += errors[i].message + '<br />';
            }

            var html ='<div class="alert alert-danger alert-dismissible" role="alert">';
              html +='<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
              html +=errorString;
            html +='</div>';
            $('#errors-validate').slideDown('fast');
            $('#errors-validate').html(html);
        }
    });



    $('body').on('submit', '#new_message_form', function(event) {
		event.preventDefault();
		/* Act on the event */
		var receiver = $('#from_message').val();
		var receiverId = $('#from_id').val();
		var message = $('#message').val();

		$.ajax({
	    	url: '/new_message_form?receiverid='+receiverId+'&message='+message,
	    	type: 'POST',
	    	dataType: 'JSON',
	    	success: function(data){
	    		if (!data.error) {
	    			var values = JSON.parse(data.data);
	    			sendComunication("newMessage",message,receiverId,values.transmitter,values.channel,values.tiempo);
	    			location.reload();
	    		}else{
	    			location.reload();
	    		}
	    	}
	    })
	    .fail(function() {
	    	console.log("error");
	   	});
	});							
        

});