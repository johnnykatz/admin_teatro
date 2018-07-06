<table class="table table-responsive" id="reservas-table">
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Numero Personas</th>
        <th>Butacas</th>
        <th colspan="3">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reservas as $reserva)
        <tr>
            <td>{!! $reserva->user->name.", ". $reserva->user->last_name!!}</td>
            <td>{!! date("d-m-Y",strtotime($reserva->fecha)) !!}</td>
            <td>{!! $reserva->numero_personas !!}</td>
            <td>
                @php($butacas=array())
                @foreach($reserva->butacas as $butaca)
                    @php($butacas[]=$butaca->full_name)
                @endforeach
                {!! implode(",",$butacas) !!}
            </td>
            <td>
                {!! Form::open(['route' => ['admin.reservas.destroy', $reserva->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.reservas.show', [$reserva->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.reservas.edit', [$reserva->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Desea eliminar la reserva?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>