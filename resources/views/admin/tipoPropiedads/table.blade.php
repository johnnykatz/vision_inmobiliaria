<table class="table table-responsive" id="tipoPropiedads-table">
    <thead>
        <th>Nombre</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tipoPropiedads as $tipoPropiedad)
        <tr>
            <td>{!! $tipoPropiedad->nombre !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.tipoPropiedads.destroy', $tipoPropiedad->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.tipoPropiedads.show', [$tipoPropiedad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.tipoPropiedads.edit', [$tipoPropiedad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>