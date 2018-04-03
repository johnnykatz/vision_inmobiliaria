<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vision Inmobiliaria</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="{!! asset("plugin/AdminLTE/bootstrap/css/bootstrap.min.css") !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">--}}
    <link rel="stylesheet" href="{!! asset("plugin/css/select2.min.css") !!}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/AdminLTE.min.css">--}}
    <link rel="stylesheet" href="{!! asset("plugin/AdminLTE/dist/css/AdminLTE.min.css") !!}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/skins/_all-skins.min.css">--}}
    <link rel="stylesheet" href="{!! asset("plugin/AdminLTE/dist/css/skins/_all-skins.min.css") !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{--<link rel="stylesheet" href="{!! asset("plugin/css/ionicons.min.css") !!}">--}}

    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>--}}
    <script src="{!! asset("plugin/js/jquery.min.js") !!}"></script><!-- jQuery 1.12 -->
    <script src="{!! asset("plugin/js/jquery-ui.min.js") !!}"></script><!-- jQuery 1.12 -->
    {{--    <script src="{!! asset("plugin/js/jquery-2.0.min.js") !!}"></script>--}}

    {{--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
    <script src="{!! asset("plugin/AdminLTE/bootstrap/js/bootstrap.min.js") !!}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>--}}
    <script src="{!! asset("plugin/AdminLTE/plugins/select2/select2.min.js") !!}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>--}}
    <script src="{!! asset("plugin/AdminLTE/plugins/iCheck/icheck.min.js") !!}"></script>

    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('plugin/AdminLTE/plugins/datepicker/datepicker3.css')}}">
    {{--<link rel="stylesheet" href="{{asset('plugin/datepicker/css/bootstrap-standalone.css')}}">--}}
    <script src="{{asset('plugin/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje Datepicker-->
    <script src="{{asset('plugin/AdminLTE/plugins/datepicker/locales/bootstrap-datepicker.es.js')}}"></script>
    <!-- DateRangePiker Files -->
    <script src="{{asset('plugin/AdminLTE/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('plugin/AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <link rel="stylesheet" href="{{asset('plugin/AdminLTE/plugins/daterangepicker/daterangepicker.css')}}">

    <!-- inputmask-->
    <script src="{{ asset('plugin/jquery.inputmask/js/inputmask.js') }}"></script>
    <script src="{{ asset('plugin/jquery.inputmask/js/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('plugin/jquery.inputmask/js/inputmask.numeric.extensions.js') }}"></script>

    <!-- AdminLTE App -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script>--}}
    <script src="{{ asset('plugin/AdminLTE/dist/js/app.min.js') }}"></script>

    <!-- Datatables -->
    {{--<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>--}}
    <script src="{{asset('plugin/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    {{--<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>--}}
    <script src="{{asset('plugin/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('plugin/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}">

    {!! Html::script('js/funciones.js') !!}
    {!! Html::script('js/app.js') !!}

    <script src="{{asset('Chart.js')}}"></script>


    @yield('scripts')
</head>


<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <a href="{{ url('/homeadmin') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>V</b>I</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Vision</b> Inmobiliaria</span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{asset('img-sistema/logo_user.png')}}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">
                                      @if (Auth::guest())
                                        InfyOm
                                    @else
                                        {{ ucwords(Auth::user()->name)}}
                                    @endif
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{asset('img-sistema/logo_user.png')}}"
                                         class="user-image" alt="User Image"/>
                                    <p>
                                        @if (Auth::guest())
                                            InfyOm
                                        @else
                                            {{ ucwords(Auth::user()->name)}}
                                        @endif
                                        {{--<small>Member since {!! Auth::user()->created_at->format('M, Y') !!}</small>--}}
                                        <small>{!! Auth::user()->email !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('admin/users/editPassword') }}"
                                           class="btn btn-default btn-flat">Cambiar password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2018 <a href="#">Vision Inmobiliaria</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/homeadmin') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endif

</body>
{{--<style>--}}
    {{--.navbar-static-top {--}}
        {{--height: 50px;--}}
    {{--}--}}

    {{--.logo {--}}
        {{--height: 100px !important;--}}
    {{--}--}}
{{--</style>--}}
</html>