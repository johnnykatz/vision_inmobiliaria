@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tipo Propiedad
        </h1>
    </section>
    <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tipoPropiedad, ['route' => ['admin.tipoPropiedads.update', $tipoPropiedad->id], 'method' => 'patch']) !!}

                        @include('admin.tipoPropiedads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection