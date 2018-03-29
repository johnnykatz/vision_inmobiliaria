<table class="table table-responsive" id="media-table">
    <thead>
        <th>Url</th>
        <th>Descripcion</th>
        <th>Tipo Media Id</th>
        <th>Propiedad Id</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($media as $media)
        <tr>
            <td>{!! $media->url !!}</td>
            <td>{!! $media->descripcion !!}</td>
            <td>{!! $media->tipo_media_id !!}</td>
            <td>{!! $media->propiedad_id !!}</td>
            <td>
                {!! Form::open(['route' => ['admin.media.destroy', $media->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.media.show', [$media->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.media.edit', [$media->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>