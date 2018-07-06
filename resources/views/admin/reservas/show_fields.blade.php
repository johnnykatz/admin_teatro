<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $reserva->id !!}</p>
</div>

<!-- Fecha Field -->
<div class="form-group">
    {!! Form::label('fecha', 'Fecha:') !!}
    <p>{!! date("d-m-Y",strtotime($reserva->fecha)) !!}</p>
</div>

<!-- Numero Personas Field -->
<div class="form-group">
    {!! Form::label('numero_personas', 'Numero Personas:') !!}
    <p>{!! $reserva->numero_personas !!}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('butaca', 'Butacas:') !!}
    <p>
        @php($butacas=array())
        @foreach($reserva->butacas as $butaca)
            @php($butacas[]=$butaca->full_name)
        @endforeach
        {!! implode(",",$butacas) !!}
    </p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'Usuario:') !!}
    <p>{!! $reserva->user->name.", ". $reserva->user->last_name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $reserva->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $reserva->updated_at !!}</p>
</div>

