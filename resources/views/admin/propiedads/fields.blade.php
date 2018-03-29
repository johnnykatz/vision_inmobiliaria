<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!--  estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_propiedad_id', 'Estado Propiedad:') !!}
    {!! Form::select('estado_propiedad_id',$estados,null,['class'=>'form-control','placeholder'=>'seleccione...']) !!}
</div>

<!-- Tipo Propiedad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_propiedad_id', 'Tipo Propiedad:') !!}
    {!! Form::select('tipo_propiedad_id',$tipos_propiedades,null,['class'=>'form-control','placeholder'=>'seleccione...']) !!}
</div>

<!-- Tipo Operacion Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_operacion_id', 'Tipo Operacion:') !!}
    {!! Form::select('tipo_operacion_id',$tipos_operaciones,null,['class'=>'form-control','placeholder'=>'seleccione...']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::textArea('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Latitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('latitud', 'Latitud:') !!}
    {!! Form::text('latitud', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longitud', 'Longitud:') !!}
    {!! Form::text('longitud', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Habitaciones Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_habitaciones', 'Cant Habitaciones:') !!}
    {!! Form::number('cant_habitaciones', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Cant Banios Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_banios', 'Cant Banios:') !!}
    {!! Form::number('cant_banios', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Cant Living Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_living', 'Cant Living:') !!}
    {!! Form::number('cant_living', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Cant Garage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_garage', 'Cant Garage:') !!}
    {!! Form::number('cant_garage', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Cant Cocina Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_cocina', 'Cant Cocina:') !!}
    {!! Form::number('cant_cocina', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Orden Field -->
<div class="form-group col-sm-6">
    {!! Form::label('orden', 'Orden:') !!}
    {!! Form::number('orden', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('destacada', 'Propiedad destacada:') !!}
    {!! Form::select('destacada',[1=>'Si',0=>'No'],(isset($propiedad) and $propiedad->destacada)?$propiedad->destacada:0,['class'=>'form-control input-sm','required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('slide', 'Se muestra en slide:') !!}
    {!! Form::select('slide',[1=>'Si',0=>'No'],(isset($propiedad) and $propiedad->slide)?$propiedad->slide:0,['class'=>'form-control input-sm','required']) !!}
</div>
{{--@if(!isset($propiedad))--}}
<div class="col-md-12">
    <div class="box box-default">
        <div class="box-header">
            Imagenes
        </div>
        <div class="box-body">
            <div id="medias">
                <div id="media" class="col-sm-6" style="display: none">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group col-sm-7">
                                {!! Form::label('imagen', 'Imagen:') !!}
                                {!! Form::file('imagen[]',['class'=>'form-control media','id'=>'media']) !!}

                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('principal', 'Principal:') !!}
                                {!! Form::select('principal[]',["si"=>"Si","no"=>"No"],'no',['class'=>'form-control','id'=>'principal']) !!}
                                {!! Form::text('imagen_old[]',null,['class'=>'form-control hidden','id'=>'imagen_old']) !!}

                            </div>
                            <div class="form-group col-sm-1">

                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"
                                          onClick="eliminarItemMedia(this)" title="Eliminar item"
                                          style="cursor: pointer"></span>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($propiedad))
                    @foreach($propiedad->medias as $media)
                        <div id="media1" class="col-sm-6" style="">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group col-sm-7">
                                        <img src="{{asset("/imagenes/propiedades/").'/'.$media->url }} " width="150px"
                                             height="150px"/>
                                        {!! Form::label('imagen', 'Imagen:') !!}
                                        {!! Form::file('imagen[]',['class'=>'form-control media','id'=>'media1']) !!}
                                        {!! Form::text('imagen_old[]',$media->id,['class'=>'form-control hidden','id'=>'imagen_old1']) !!}

                                    </div>
                                    <div class="form-group col-sm-4">
                                        {!! Form::label('principal', 'Principal:') !!}
                                        {!! Form::select('principal[]',["si"=>"Si","no"=>"No"],($media->descripcion=='principal')?'si':'no',['class'=>'form-control','id'=>'principal1']) !!}
                                    </div>
                                    <div class="form-group col-sm-1">

                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"
                                          onClick="eliminarItemMedia(this)" title="Eliminar item"
                                          style="cursor: pointer"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group col-sm-12">
    <a class="btn btn-default" onclick="agregarItemMedia();">Agregar imagen</a>
</div>
{{--@else--}}


{{--@endif--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.propiedads.index') !!}" class="btn btn-default">Cancelar</a>
</div>
