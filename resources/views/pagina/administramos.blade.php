@include('pagina.header')
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="{!! url("/") !!}">Home</a> / Administramos tu Propiedad</span>
        <h2>Administramos tu Propiedad</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="spacer agents">

        <div class="row">
            <div class="col-lg-8  col-lg-offset-2">
                <img src="{!! asset("imagenes/administramos-propiedad.jpg") !!}" class="img-responsive thumbnail" alt="realestate">
                <h3>Administramos tu Propiedades</h3>
                <p>Tenemos una larga trayectoria administrando propiedades.</p>
                <h3>Contacto</h3>
                <p>
                <div class="col-lg-4 col-sm-4 "><span class="glyphicon glyphicon-envelope"></span> <a
                            href="mailto:abc@realestate.com">visioninmobiliariapos@gmail.com</a><br>
                    <span class="glyphicon glyphicon-earphone"></span> (0376)4436353<br>
                    <span class="glyphicon glyphicon-earphone"></span> (3764)606695
                </div>
                </p>

            </div>
        </div>


    </div>
</div>

@include('pagina.footer')
