<table class="record_properties">
    <tbody>
    <tr>
        <th>Id</th>
        <td>{!! $user->id!!}</td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td>{!! $user->name!!}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{!! $user->email!!}</td>
    </tr>

    <tr>
        <th>Roles</th>
        <td>
            @foreach($user->roles as $role)
              {{$role->name}}
            @endforeach
        </td>
    </tr>
    <tr>
        <th>Compañia</th>
        <td>{!!$user->compania->nombre or null !!}</td>
    </tr>
    <tr>
        <th>Distribuidor</th>
        <td>{!!$user->distribuidor->nombre or null !!}</td>
    </tr>
    <tr>
        <th>Fecha creado</th>
        <td>{!!date('d-m-Y', strtotime($user->created_at)) !!}</td>
    </tr>
    <tr>
        <th>Fecha actualizado</th>
        <td>{!!date('d-m-Y', strtotime($user->updated_at)) !!}</td>
    </tr>
    </tbody>
</table>

