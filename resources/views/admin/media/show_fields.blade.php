<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $media->id !!}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{!! $media->url !!}</p>
</div>

<!-- Descripcion Field -->
<div class="form-group">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    <p>{!! $media->descripcion !!}</p>
</div>

<!-- Tipo Media Id Field -->
<div class="form-group">
    {!! Form::label('tipo_media_id', 'Tipo Media Id:') !!}
    <p>{!! $media->tipo_media_id !!}</p>
</div>

<!-- Propiedad Id Field -->
<div class="form-group">
    {!! Form::label('propiedad_id', 'Propiedad Id:') !!}
    <p>{!! $media->propiedad_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $media->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $media->updated_at !!}</p>
</div>

