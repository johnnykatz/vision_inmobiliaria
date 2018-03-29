<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Media Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_media_id', 'Tipo Media Id:') !!}
    {!! Form::text('tipo_media_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Propiedad Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('propiedad_id', 'Propiedad Id:') !!}
    {!! Form::text('propiedad_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.media.index') !!}" class="btn btn-default">Cancel</a>
</div>
