
{!! Form::model(Request::all(),['route'=>'admin.users.index','method'=>'GET','class'=>'form-horizontal','id'=>'form_listado']) !!}


<div class="form-group">
    {!! Form::label('buscar', 'Buscar:',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('buscar',(isset($filtro['buscar']))? $filtro['buscar']:'',['class'=>'form-control','placeholder'=>'Buscar por apellido o nombre']) !!}
    </div>
</div>

<div class="form-group col-sm-3 pull-right">
    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
    <button class="btn btn-default" type="button" onclick="return document.getElementById('buscar').value = '';">
        Limpiar
    </button>
</div>
{!! Form::close() !!}