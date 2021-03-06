@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Usuarios</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.users.create') !!}">Nuevo Usuario</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Filtros de búsquedas</h3>
                <hr>
                @include('admin.users.filtros')

            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.users.table')
                <div class="text-center">
                    {!! $users->appends(Request::all())->render() !!}
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

