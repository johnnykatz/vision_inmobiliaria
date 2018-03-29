@extends('layouts.app')

@section('content')
<div class="clearfix hidden-lg hidden-sm hidden-md"></div>
    <section class="content-header">
        <h1 class="pull-left">Propiedades</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('admin.propiedads.create') !!}">Nuevo</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Filtros</h3>
                @include('admin.propiedads.filtros')

            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.propiedads.table')
                <div class="text-center">
                    {!! $propiedades->appends(Request::all())->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

