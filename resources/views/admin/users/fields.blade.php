<!-- Nombre Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control','required']) !!}
</div>


{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('rol_id', 'Roles:') !!}--}}
{{--{!! Form::select('roles[]',$roles,isset($user)?$user->roles->lists('id')->toArray():null,['class'=>'form-control roles','required','multiple']) !!}--}}
{{--</div>--}}
<div class="form-group col-sm-6">
    {!! Form::label('rol_id', 'Roles:') !!}
    {!! Form::select('roles[]',$roles,isset($user)?$user->roles->lists('id')->toArray():null,['class'=>'form-control roles','placeholder'=>'seleccione...','required']) !!}
</div>

<div id="compania" class="form-group col-sm-6">
    {!! Form::label('compania_id', 'Compania:') !!}
    {!! Form::select('compania_id',$companias,null,['class'=>'form-control','required','placeholder'=>'seleccione...']) !!}
</div>

<div id="distribuidor" class="form-group col-sm-6">
    {!! Form::label('distribuidor_id', 'Distribuidor:') !!}
    {!! Form::select('distribuidor_id',$distribuidores,null,['class'=>'form-control','required','placeholder'=>'seleccione...']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.users.index') !!}" class="btn btn-default">Volver</a>
</div>
