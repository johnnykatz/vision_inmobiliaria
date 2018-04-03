

{{--<li class="{{ Request::is('estadoPropiedads*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('admin.estadoPropiedads.index') !!}"><i class="fa fa-edit"></i><span>EstadoPropiedads</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('tipoOperacions*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('admin.tipoOperacions.index') !!}"><i class="fa fa-edit"></i><span>TipoOperacions</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('tipoMedia*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('admin.tipoMedia.index') !!}"><i class="fa fa-edit"></i><span>TipoMedia</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('media*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('admin.media.index') !!}"><i class="fa fa-edit"></i><span>Media</span></a>--}}
{{--</li>--}}

<li class="{{ Request::is('propiedads*') ? 'active' : '' }}">
    <a href="{!! route('admin.propiedads.index') !!}"><i class="fa fa-edit"></i><span>Propiedades</span></a>
</li>


<li class="{{ Request::is('tipoPropiedads*') ? 'active' : '' }}">
    <a href="{!! route('admin.tipoPropiedads.index') !!}"><i class="fa fa-edit"></i><span>Tipos Propiedades</span></a>
</li>

