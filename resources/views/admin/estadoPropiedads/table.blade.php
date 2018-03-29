<table class="table table-responsive" id="estadoPropiedads-table">
    <thead>
        <th>Nombre</th>
        <th>Slug</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($estadoPropiedads as $estadoPropiedad)
        <tr>
            <td>{!! $estadoPropiedad->nombre !!}</td>
            <td>{!! $estadoPropiedad->slug !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.estadoPropiedads.destroy', $estadoPropiedad->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.estadoPropiedads.show', [$estadoPropiedad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.estadoPropiedads.edit', [$estadoPropiedad->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>