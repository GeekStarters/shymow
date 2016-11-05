<div>
	{!! Form::open(array('name'=>'new_message','id'=>'new_message_form')) !!}
		<div class="message-description-header">
			<div class="user">
				<h3>
					<span style="font-family: gothamTwo;">Nuevo Mensaje</span>
				</h3>
			</div>
			<div class="clearfix"></div>
			<hr>
		</div>
		<div class="message-description-new-information">
			<div class="form-group form-new-message">
				<label for="message">Para:</label>
				{!! Form::text('from_message','',['class'=>'form-control','id'=>'from_message','data-provide' => 'typeahead','placeholder'=>'Search', 'autocomplete' => 'off']) !!}

				{!! Form::hidden('from_id','',['id'=>'from_id']) !!}
			</div>
			<div id="errors-validate"></div>
		</div>
		{!! Form::text('message','',['class'=>'form-control','id'=>'message','placeholder' => 'Escribe un mensaje']) !!}
		{!! Form::submit('ENVIAR',['class'=>'butto-formns navbar-right','style'=>'margin:10px']) !!}
	{!! Form::close() !!}
</div>

<script>
	jQuery(document).ready(function($) {
		
        $.get('/search_typeahead', function(data){
	        var users = data.data;

	        var user = new Bloodhound({
	          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
	          queryTokenizer: Bloodhound.tokenizers.whitespace,
	          local: users
	        });
	        user.initialize();

	        $('#from_message').typeahead(null, {
	          name: 'search',
	          source: user.ttAdapter(),
	          display: 'name',
	          templates: {
	            empty: [
	              '<div class="empty-message">',
	                'No se han encontrado usuarios',
	              '</div>'
	            ].join('\n'),
	            suggestion: Handlebars.compile('<a><div><img class="img-responsive" src="/@{{img}}"><strong>@{{name}}</strong></div></a>')
	          }
	        }).bind('typeahead:selected', function(ev, suggestion) {
	          $('#from_id').val(suggestion.id);
	        });
	    },'json');




	});
</script>