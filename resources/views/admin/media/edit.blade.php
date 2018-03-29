@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Media
        </h1>
    </section>
    <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($media, ['route' => ['admin.media.update', $media->id], 'method' => 'patch']) !!}

                        @include('admin.media.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection