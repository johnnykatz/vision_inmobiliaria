@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            EstadoPropiedad
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.estadoPropiedads.store']) !!}

                        @include('admin.estadoPropiedads.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
