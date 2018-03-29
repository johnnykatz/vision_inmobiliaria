@include('pagina.header')

<div class="">

    <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">
            @foreach($propiedadesSlide as $slide)
                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25"
                     data-slice2-rotation="-25"
                     data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        @if(isset($slide->imagen->url))
                            <div class="bg-img center"
                                 style="opacity:1;background-image:url({{asset("/imagenes/propiedades/").'/'.$slide->imagen->url }})">

                                {{--<img src="{{asset("/imagenes/propiedades/").'/'.$slide->imagen->url }}"--}}
                                     {{--alt="">--}}
                            </div>

                        @endif
                        <h2><a href="{!! route('pagina.property-detail', [$slide->id]) !!}">{!! $slide->nombre !!}</a>
                        </h2>
                        <blockquote>
                            <p class="location"><span class="glyphicon glyphicon-map-marker"></span>
                                {!! $slide->direccion !!}
                            </p>
                            <cite>$ {!! number_format($slide->precio,2,".",",") !!}</cite>
                        </blockquote>
                    </div>
                </div>
            @endforeach

        </div><!-- /sl-slider -->


        <nav id="nav-dots" class="nav-dots">
            @foreach($propiedadesSlide as $slide)
                {{--<span class="nav-dot-current"></span>--}}
                {{--<span></span>--}}
                {{--<span></span>--}}
                {{--<span></span>--}}
                <span></span>
            @endforeach
        </nav>

    </div><!-- /slider-wrapper -->
</div>

{!! Form::model(Request::all(),['route'=>'pagina.list','method'=>'GET','class'=>'form-horizontal','id'=>'form_listado']) !!}
<div class="banner-search">
    <div class="container">
        <!-- banner -->
        <h3>Busqueda</h3>
        <div class="searchbar">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <input type="text" name="comodin" class="form-control" placeholder="Buscar">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 ">
                            {!! Form::select('tipo_operacion_id',($tiposOperaciones)?$tiposOperaciones:[null=>null],null,['class'=>'form-control','placeholder'=>'Operacion']) !!}
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            {!! Form::select('precio',($precios)?$precios:[null=>null],null,['class'=>'form-control','placeholder'=>'Precio']) !!}
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            {!! Form::select('tipo_propiedad_id',($tiposPropiedades)?$tiposPropiedades:[null=>null],null,['class'=>'form-control','placeholder'=>'Propiedad']) !!}
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>

                </div>
                {{--<div class="col-lg-5 col-lg-offset-1 col-sm-6 ">--}}
                {{--<p>Join now and get updated with all the properties deals.</p>--}}
                {{--<button class="btn btn-info" data-toggle="modal" data-target="#loginpop">Login</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="properties-listing spacer">
        <a href="{!! route('pagina.list') !!}" class="pull-right viewall">Ver todas</a>
        <h2>Nuevas propiedades</h2>
        <div id="owl-example" class="owl-carousel">
            @foreach($ultimas as $ultima)
                <div class="properties">
                    <div class="image-holder">
                        @if(isset($ultima->imagen->url))
                            <img src="{!! asset("imagenes/propiedades/")."/".$ultima->imagen->url !!}"
                                 class="img-responsive" alt="properties"
                            />
                        @else
                            <img src="{!! asset("imagenes/propiedades/defecto.jpg")!!}"
                                 class="img-responsive" alt="properties"/>
                        @endif
                        <div class="status sold">Disponible</div>
                    </div>
                    <a href="{!! route('pagina.property-detail', [$ultima->id]) !!}">{!! $ultima->nombre !!}</a>
                    <p class="price">$ {!! number_format($ultima->precio,2,".",",") !!}</p>
                    <div class="listing-detail">
                        <span data-toggle="tooltip" data-placement="bottom"
                              data-original-title="Dormitorio">{!! $ultima->cant_habitaciones or 0 !!}</span>
                        <span data-toggle="tooltip" data-placement="bottom"
                              data-original-title="Baño">{!! $ultima->cant_banios or 0 !!}</span>
                        <span data-toggle="tooltip" data-placement="bottom"
                              data-original-title="Living">{!! $ultima->cant_living or 0 !!}</span>
                        <span data-toggle="tooltip" data-placement="bottom"
                              data-original-title="Garage">{!! $ultima->cant_garage or 0 !!}</span>
                        <span data-toggle="tooltip" data-placement="bottom"
                              data-original-title="Cocina">{!! $ultima->cant_cocina or 0 !!}</span>
                    </div>
                    <a href="{!! route('pagina.property-detail', [$ultima->id]) !!}"
                       class="btn btn-primary">Mas Detalles</a>
                </div>
            @endforeach
        </div>

    </div>
    {{--</div>--}}
    <div class="spacer">
        <div class="row">
            <div class="col-lg-6 col-sm-9 recent-view">
                <h3>Acerca de</h3>
                <p>somos un grupo de amigos que nos gusta la bara<br><a href="{!! route('pagina.about') !!}">Leer
                        Mas</a></p>

            </div>
            <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
                <h3>Propiedades Recomendadas</h3>
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        @php($i=0)
                        @foreach($destacadas as $destacada)
                            <li data-target="#myCarousel" data-slide-to="{!! $i !!}"
                                class="{!! ($i==0)?"active":"" !!}"></li>
                            @php($i++)
                        @endforeach
                    </ol>
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        @php($i=0)
                        @foreach($destacadas as $destacada)
                            <div class="item {!! ($i==0)?"active":"" !!}">
                                <div class="row">
                                    <div class="col-lg-4">
                                        @if(isset($destacada->imagen->url))
                                            {{--@php(dd($destacada->imagen->url))--}}
                                            <img src="{!! asset("imagenes/propiedades/")."/".$destacada->imagen->url !!}"
                                                 class="img-responsive" alt="properties"/>
                                        @else
                                            <img src="{!! asset("imagenes/propiedades/defecto.jpg")!!}"
                                                 class="img-responsive" alt="properties"/>
                                        @endif
                                    </div>
                                    <div class="col-lg-8">
                                        <h5>
                                            <a href="{!! route('pagina.property-detail', [$destacada->id]) !!}">{!! $destacada->nombre !!}</a>
                                        </h5>
                                        <p class="price">$ {!! number_format($destacada->precio,2,".",",") !!}</p>
                                        <a href="{!! route('pagina.property-detail', [$destacada->id]) !!}"
                                           class="more">Mas Detalles</a></div>
                                </div>
                            </div>
                            @php($i++)
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pagina.footer')
<?php //include 'footer.blade.php';?>