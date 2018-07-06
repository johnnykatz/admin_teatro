@section("scripts")
    <script>
        $(document).ready(function () {
            inicializarFecha();
        })

    </script>
@endsection
{!! Form::model(Request::all(),['route'=>'admin.reservas.index','method'=>'GET','class'=>'form-horizontal','id'=>'form_listado']) !!}

<div class="form-group">
    {!! Form::label('fecha', 'Fecha de creación:',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('fecha',(isset($filtro['fecha']))? $filtro['fecha']:'',['class'=>'form-control datepicker', 'readonly']) !!}
    </div>
</div>

<div class="form-group col-sm-3 pull-right">
    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
    <button class="btn btn-default" type="button" onclick="return document.getElementById('fecha').value = '';">
        Limpiar
    </button>
</div>
{!! Form::close() !!}