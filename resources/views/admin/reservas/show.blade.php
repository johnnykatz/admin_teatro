@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Reserva
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('admin.reservas.show_fields')
                    <a href="{!! route('admin.reservas.index') !!}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
