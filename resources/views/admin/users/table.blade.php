<div class="table-responsive">
    <table class="table table-bordered table-striped dataTable" id="ofertas-table">
        <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Email</th>
        {{--<th colspan="3">Acciones</th>--}}
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>

                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{--<a href="{!! route('admin.users.show', [$user->id]) !!}" class='btn btn-default'><i--}}
                                    {{--class="glyphicon glyphicon-eye-open"></i></a>--}}
                        {{--<a href="{!! route('admin.users.edit', [$user->id]) !!}" class='btn btn-warning'><i--}}
                                    {{--class="glyphicon glyphicon-edit"></i></a>--}}
                        {{--                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>