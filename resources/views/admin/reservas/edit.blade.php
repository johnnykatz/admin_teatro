@extends('layouts.app')
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.multiple').select2();
            inicializarFecha();

        });
    </script>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Reserva
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($reserva, ['route' => ['admin.reservas.update', $reserva->id], 'method' => 'patch','id'=>'form']) !!}

                        @include('admin.reservas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection