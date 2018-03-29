@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Propiedad
        </h1>
    </section>
    <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($propiedad, ['route' => ['admin.propiedads.update', $propiedad->id], 'method' => 'patch','files'=>true]) !!}

                        @include('admin.propiedads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection