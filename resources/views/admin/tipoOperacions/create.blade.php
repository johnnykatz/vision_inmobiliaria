@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            TipoOperacion
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.tipoOperacions.store']) !!}

                        @include('admin.tipoOperacions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
