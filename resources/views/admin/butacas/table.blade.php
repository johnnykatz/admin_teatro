<table class="table table-responsive" id="butacas-table">
    <thead>
    <tr>
        <th>Fila</th>
        <th>Columna</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($butacas as $butaca)
        <tr>
            <td>{!! $butaca->fila !!}</td>
            <td>{!! $butaca->columna !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.butacas.destroy', $butaca->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.butacas.show', [$butaca->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.butacas.edit', [$butaca->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Desea eliminar la butaca?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>