<li class="{{ Request::is('reservas*') ? 'active' : '' }}">
    <a href="{!! route('admin.reservas.index') !!}"><i class="fa fa-edit"></i><span>Reservas</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('admin.users.index') !!}"><i class="fa fa-edit"></i><span>Usuarios</span></a>
</li>

<li class="{{ Request::is('butacas*') ? 'active' : '' }}">
    <a href="{!! route('admin.butacas.index') !!}"><i class="fa fa-edit"></i><span>Butacas</span></a>
</li>


