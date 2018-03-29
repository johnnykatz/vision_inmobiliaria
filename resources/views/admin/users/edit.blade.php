@extends('layouts.app')
@section('scripts')
    <script>
        $(document).ready(function () {

            @if(isset($user) and (in_array(1,$user->roles->lists('id')->toArray())or in_array(5,$user->roles->lists('id')->toArray())))
             $("#compania").hide();
            $("#compania_id").val("");
            $("#compania_id").removeAttr("required");

            $("#distribuidor").hide();
            $("#distribuidor_id").val("");
            $("#distribuidor_id").removeAttr("required");
            @elseif(isset($user) and in_array(2,$user->roles->lists('id')->toArray()))
$("#distribuidor").hide();
            $("#distribuidor_id").val("");
            $("#distribuidor_id").removeAttr("required");

            $("#compania").show();
            $("#compania_id").attr("required", "required");
            @elseif(isset($user) and in_array(6,$user->roles->lists('id')->toArray()))
$("#compania").hide();
            $("#compania_id").val("");
            $("#compania_id").removeAttr("required");

            $("#distribuidor").show();
            $("#distribuidor_id").attr("required", "required");
            @endif
             $(".roles").change(function (event) {
                if ($(".roles").val() == 1 || $(".roles").val() == 5) {
                    $("#compania").hide();
                    $("#compania_id").val("");
                    $("#compania_id").removeAttr("required");

                    $("#distribuidor").hide();
                    $("#distribuidor_id").val("");
                    $("#distribuidor_id").removeAttr("required");
                } else if ($(".roles").val() == 2) {
                    $("#distribuidor").hide();
                    $("#distribuidor_id").val("");
                    $("#distribuidor_id").removeAttr("required");

                    $("#compania").show();
                    $("#compania_id").attr("required", "required");
                } else if ($(".roles").val() == 6) {
                    $("#compania").hide();
                    $("#compania_id").val("");
                    $("#compania_id").removeAttr("required");

                    $("#distribuidor").show();
                    $("#distribuidor_id").attr("required", "required");


                }
            })
        })

    </script>

@endsection
@section('content')
    <section class="content-header">
        <h1>
            Usuario
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'patch']) !!}

                    @include('admin.users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection