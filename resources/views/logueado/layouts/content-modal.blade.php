
<!-- Modal -->
<div class="modal fade" id="moreHobbie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hobbies</h4>
      </div>
    {!! Form::open(['url' => 'edit_hobbies','method' => 'post']) !!}
      <div class="modal-body">
        
    	<div class="group-form">
    		<label for="day">Hobbies</label> <span>Ejemplo: Caminar, Jugar, Chatear</span>
    		{!! Form::text('hobbies',Auth::user()->more_hobbies,["class"=>"form-control"]) !!}
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="dateEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar fecha de nacimiento</h4>
      </div>
    {!! Form::open(['url' => 'editBorn','method' => 'post']) !!}
      <div class="modal-body">
        
        	<div class="group-form">
        		<label for="day">Día</label>
        		<select name="day" id="day" class="form-control">
        			@for($i = 1;$i<=31;$i++)
        				<option value="{{$i}}">{{$i}}</option>
        			@endfor
        		</select>
        	</div>
        	<div class="group-form">
        		<label for="month">Mes</label>
        		<select name="month" id="month" class="form-control">
        				<option value="01">Enero</option>
        				<option value="02">Febrero</option>
        				<option value="03">Marzo</option>
        				<option value="04">Abril</option>
        				<option value="05">Mayo</option>
        				<option value="06">Junio</option>
        				<option value="07">Julio</option>
        				<option value="08">Agosto</option>
        				<option value="09">Septiembre</option>
        				<option value="10">Octubre</option>
        				<option value="11">Noviembre</option>
        				<option value="12">Diciembre</option>
        		</select>
        	</div>
        	<div class="group-form">
        		<label for="year">Año</label>
        		<select name="year" id="year" class="form-control">
        			@for($i = date("Y");$i>=date("Y")-100;$i--)
        				<option value="{{$i}}">{{$i}}</option>
        			@endfor
        		</select>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar residencia</h4>
      </div>
    {!! Form::open(['url' => 'editHome','method' => 'post']) !!}
      <div class="modal-body">
        <div class="form-group">
            <label for="pais">País</label>
            {!! Form::select('pais',array('all' => 'Todo') + $countries,'',['class'=>'form-control','required' => 'required','id'=>'pais']) !!}
            <hr>
        </div>
        <div class="form-group">
            <label>Provincia</label>
            {!! Form::select('provincia',array('all' => 'Seleccione pais'),'',['class'=>'form-control', 'required' => 'required','id'=>'state']); !!}          
        </div>
        <div class="form-group">
            <label>Municipio</label>
            {!! Form::select('municipio',array('all' => 'Seleccione Provincia'),'',['class'=>'form-control', 'required' => 'required','id'=>'city']); !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    {!! Form::close() !!}
    </div>
  </div>
</div>