<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vision Inmobiliaria</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="{!! asset("assets/bootstrap/css/bootstrap.css")!!}"/>

    <link rel="stylesheet" href="{!! asset("assets/style.css")!!}"/>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="{!! asset("assets/bootstrap/js/bootstrap.js")!!}"></script>
    <script src="{!! asset("assets/script.js")!!}"></script>


    <!-- Owl stylesheet -->
    <link rel="stylesheet" href="{!! asset("assets/owl-carousel/owl.carousel.css")!!}">
    <link rel="stylesheet" href="{!! asset("assets/owl-carousel/owl.theme.css")!!}">
    <script src="{!! asset("assets/owl-carousel/owl.carousel.js")!!}"></script>
    <!-- Owl stylesheet -->


    <!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="{!! asset("assets/slitslider/css/style.css")!!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset("assets/slitslider/css/custom.css")!!}"/>
    <script type="text/javascript" src="{!! asset("assets/slitslider/js/modernizr.custom.79639.js")!!}"></script>
    <script type="text/javascript" src="{!! asset("assets/slitslider/js/jquery.ba-cond.min.js")!!}"></script>
    <script type="text/javascript" src="{!! asset("assets/slitslider/js/jquery.slitslider.js")!!}"></script>
    <!-- slitslider -->


    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.12&appId=455035108161053&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>




</head>






<body>


<!-- Header Starts -->
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{!! route('pagina.index') !!}">Inicio</a></li>
                    <li><a href="{!! route('pagina.about') !!}">Acerca de Nosotros</a></li>
                    <li><a href="{!! route('pagina.agents') !!}">Agentes</a></li>
                    {{--                <li><a href="{!! route('pagina.blog') !!}">Blog</a></li>--}}
                    <li><a href="{!! route('pagina.contact') !!}">Contacto</a></li>
                </ul>
            </div>
            <!-- #Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->


<div class="container">

    <!-- Header Starts -->
    <div class="header">
        {{--<div class="col-sm-12 col-sm-12">--}}

        <a href="{!! route('pagina.index') !!}"><img style="width: 350px;height: 100px"
                                                     src="{!! asset("imagenes/logo-nuevo.jpeg")!!}" alt="Realestate"></a>
        <ul class="pull-right">
            <li><a href="{!! route('pagina.list', ['tipo_operacion_id'=>2]) !!}">Ventas</a></li>
            <li><a href="{!! route('pagina.list', ['tipo_operacion_id'=>1]) !!}">Alquileres</a></li>
            <li><a href="{!! route('pagina.tasaciones') !!}">Tasaciones</a></li>
            <li><a href="{!! route('pagina.administramos') !!}">Administramos tu Propiedad</a></li>
        </ul>
        {{--</div>--}}
    </div>
    <!-- #Header Starts -->
</div>