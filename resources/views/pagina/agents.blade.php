@include('pagina.header')
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="{!! url("/") !!}">Home</a> / Agentes</span>
        <h2>Agentes</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="spacer agents">

        {{--<div class="row">--}}
        <div class="col-lg-8  col-lg-offset-2 col-sm-12">
            <!-- agents -->
            <div class="row">
                <div class="col-lg-3 col-sm-3 ">
                    <a href="#"><img src="{!! asset("imagenes/javier.jpg")!!}" class="img-responsive"
                                     alt="agent name"></a>
                </div>
                <div class="col-lg-7 col-sm-7 ">
                    <h4>Javier Garcete</h4>
                    <p>Martillero Publico Mat. Nº 576<br>
                        Corredor de Comercio Mat. Nº 297</p>
                </div>
                <div class="col-lg-4 col-sm-4 "><span class="glyphicon glyphicon-envelope"></span> <a
                            href="visioninmobiliariapos@gmail.com">visioninmobiliariapos@gmail.com</a><br>
                    <span class="glyphicon glyphicon-earphone"></span> (0376)4436353<br>
                    <span class="glyphicon glyphicon-earphone"></span> (3764)606695
                </div>
            </div>
            <!-- agents -->

            <!-- agents -->
        {{--<div class="row">--}}
        {{--<div class="col-lg-2 col-sm-2 ">--}}
        {{--<a href="#"><img src="{!! asset("imagenes/fernando.jpg")!!}" class="img-responsive" alt="agent name"></a></div>--}}
        {{--<div class="col-lg-7 col-sm-7 "><h4>Fernando Gueret</h4><p>Socio gerente</p></div>--}}
        {{--<div class="col-lg-3 col-sm-3 "><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:abc@realestate.com">fernando@gmail.com</a><br>--}}
        {{--<span class="glyphicon glyphicon-earphone"></span> (9009) 899 889</div>--}}
        {{--</div>--}}
        <!-- agents -->


            {{--</div>--}}
        </div>


        {{--</div>--}}
    </div>
</div>

@include('pagina.footer')
