<div class="table-responsive">
    <table class="table table-bordered table-striped" id="propiedads-table">
        <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Estado</th>
        <th>Tipo Propiedad</th>
        <th>Tipo Operacion</th>
        <th>Precio</th>
        <th>Descripcion</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Cant Habitaciones</th>
        <th>Cant Banios</th>
        <th>Cant Living</th>
        <th>Cant Garage</th>
        <th>Cant Cocina</th>
        <th>Orden</th>
        <th>Destacada</th>
        <th>Slide</th>
        <th colspan="3">Acciones</th>
        </thead>
        <tbody>
        @foreach($propiedades as $propiedad)
            <tr>
                <td>{!! $propiedad->id !!}</td>
                <td>{!! $propiedad->nombre !!}</td>
                <td>{!! $propiedad->direccion !!}</td>
                <td>{!! $propiedad->estadoPropiedad->nombre or null !!}</td>
                <td>{!! $propiedad->tipoPropiedad->nombre or null !!}</td>
                <td>{!! $propiedad->tipoOperacion->nombre !!}</td>
                <td>{!! "$ ".number_format($propiedad->precio,"2",".",",") !!}</td>
                <td>{!! $propiedad->descripcion !!}</td>
                <td>{!! $propiedad->latitud !!}</td>
                <td>{!! $propiedad->longitud !!}</td>
                <td>{!! $propiedad->cant_habitaciones !!}</td>
                <td>{!! $propiedad->cant_banios !!}</td>
                <td>{!! $propiedad->cant_living !!}</td>
                <td>{!! $propiedad->cant_garage !!}</td>
                <td>{!! $propiedad->cant_cocina !!}</td>
                <td>{!! $propiedad->orden !!}</td>
                <td>
                    @if($propiedad->destacada)
                        <span class="label label-success">Sí</span>
                    @else
                        <span class="label label-danger">No</span>
                    @endif
                </td>
                <td>
                    @if($propiedad->slide)
                        <span class="label label-success">Sí</span>
                    @else
                        <span class="label label-danger">No</span>
                    @endif
                </td>
                <td>
                    {!! Form::open(['route' => ['admin.propiedads.destroy', $propiedad->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('admin.propiedads.show', [$propiedad->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('admin.propiedads.edit', [$propiedad->id]) !!}"
                           class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Desea eliminar la propiedad?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>