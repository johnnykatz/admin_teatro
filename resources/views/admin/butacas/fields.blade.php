<!-- Fila Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fila', 'Fila:') !!}
    {!! Form::number('fila', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Columna Field -->
<div class="form-group col-sm-6">
    {!! Form::label('columna', 'Columna:') !!}
    {!! Form::number('columna', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.butacas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
