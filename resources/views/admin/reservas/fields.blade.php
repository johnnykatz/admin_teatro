{!! Form::text('reserva_id',(isset($reserva))? $reserva->id:null,['class'=>'hidden']) !!}

<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    <div class="input-group">
        {!! Form::text('fecha',(isset($reserva->fecha))? date("d-m-Y",strtotime($reserva->fecha)):date("d-m-Y"),['class'=>'form-control datepicker', 'required','readonly']) !!}
        <span class="input-group-btn">
        <button class="btn btn-default"
                onclick="cargarCombo('fecha','butacas','{!! route('admin.butacas.getButacasLibresAjax')!!}')"
                type="button">Buscar butacas disponibles</button>
      </span>
    </div>
</div>


<!-- Numero Personas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_personas', 'Numero de Personas:') !!}
    {!! Form::number('numero_personas', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('butacas', 'Butacas:') !!}
    {!! Form::select('butacas[]', $butacas,(isset($butacas_reservadas))?$butacas_reservadas:null, ['class' => 'form-control multiple','id'=>'butacas','required','multiple'=>'multiple']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary','onclick'=>'return controlNumeroButacas()']) !!}
    <a href="{!! route('admin.reservas.index') !!}" class="btn btn-default">Cancelar</a>
</div>