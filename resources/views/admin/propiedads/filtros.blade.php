@section("scripts")
    <script>
        $(document).ready(function () {

        })


    </script>
@endsection
{!! Form::model(Request::all(),['route'=>'admin.propiedads.index','method'=>'GET','class'=>'form-horizontal','id'=>'form_listado']) !!}

<div class="form-group">
    {!! Form::label('comodin', '@:',['class'=>'col-sm-1 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('comodin',(isset($filtro['comodin']))? $filtro['comodin']:'',['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-3 pull-right">
    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}