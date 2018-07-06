@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Butaca
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($butaca, ['route' => ['admin.butacas.update', $butaca->id], 'method' => 'patch']) !!}

                        @include('admin.butacas.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection