@section('scripts')

@endsection



{!! Form::model(Request::all(),['route'=>'admin.users.index','method'=>'GET','class'=>'form-horizontal']) !!}

<div class="form-group">

    {!! Form::label('nombre', 'Nombre:',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('nombre',(isset($filtro['nombre']))? $filtro['nombre']:'',['class'=>'form-control']) !!}

    </div>
</div>

<div class="form-group col-sm-1 pull-right ">
    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}

</div>
{!! Form::close() !!}