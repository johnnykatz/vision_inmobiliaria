@include('pagina.header')
<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="{!! url("/") !!}">Home</a> / Listado</span>
        <h2>Listado</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">
            <div class="col-lg-3 col-sm-4 ">
                {!! Form::model(Request::all(),['route'=>'pagina.list','method'=>'GET','class'=>'form-horizontal','id'=>'form_listado']) !!}

                <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Buscar por</h4>
                    {!! Form::text('comodin',null,['class'=>'form-control','placeholder'=>'Buscar']) !!}
                    <div class="row">
                        <div class="col-lg-5">
                            {!! Form::select('tipo_operacion_id',($tiposOperaciones)?$tiposOperaciones:[null=>null],null,['class'=>'form-control','placeholder'=>'Operacion']) !!}
                        </div>
                        <div class="col-lg-7">
                            {!! Form::select('precio',($precios)?$precios:[null=>null],null,['class'=>'form-control','placeholder'=>'Precio']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::select('tipo_propiedad_id',($tiposPropiedades)?$tiposPropiedades:[null=>null],null,['class'=>'form-control','placeholder'=>'Propiedad']) !!}
                        </div>
                    </div>
                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}

                </div>


                <div class="hot-properties hidden-xs">
                    <h4>Propiedades destacadas</h4>
                    @if(count($destacadas)>0)
                        @foreach($destacadas as $destacada)
                            <div class="row">
                                <div class="col-lg-4 col-sm-5">
                                    @if(isset($destacada->imagen->url))

                                        <img src="{!! asset("imagenes/propiedades/")."/".$destacada->imagen->url !!}"
                                             class="img-responsive img-circle"
                                             alt="properties"/>
                                    @else
                                        <img src="{!! asset("imagenes/propiedades/defecto.jpg")!!}"
                                             class="img-responsive img-circle"
                                             alt="properties"/>
                                    @endif
                                </div>
                                <div class="col-lg-8 col-sm-7">
                                    <h5>
                                        <a href="{!! route('pagina.property-detail', [$destacada->id]) !!}">{!! $destacada->nombre or null !!}</a>
                                    </h5>
                                    <p class="price">$ {!! number_format($destacada->precio,2,".",",") !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


            </div>

            <div class="col-lg-9 col-sm-8">
                {{--<div class="sortby clearfix">--}}
                {{--<div class="pull-left result">Showing: 12 of 100</div>--}}
                {{--<div class="pull-right">--}}
                {{--<select class="form-control">--}}
                {{--<option>Sort by</option>--}}
                {{--<option>Price: Low to High</option>--}}
                {{--<option>Price: High to Low</option>--}}
                {{--</select></div>--}}

                {{--</div>--}}
                <div class="row">
                @if(count($propiedades)>0)
                    @foreach($propiedades as $propiedad)
                        <!-- properties -->
                            <div class="col-lg-4 col-sm-6">
                                <div class="properties">
                                    <div class="image-holder">
                                        @if(isset($propiedad->imagen->url))

                                            <img src="{!! asset("imagenes/propiedades/")."/".$propiedad->imagen->url !!}"
                                                 class="img-responsive"
                                                 alt="properties"/>
                                        @else
                                            <img src="{!! asset("imagenes/propiedades/defecto.jpg")!!}"
                                                 class="img-responsive"
                                                 alt="properties"/>
                                        @endif
                                        <div class="status sold">Disponible</div>
                                    </div>
                                    <h4>
                                        <a href="{!! route('pagina.property-detail', [$propiedad->id]) !!}">{!! $propiedad->nombre !!}</a>
                                    </h4>
                                    <p class="price">$ {!! number_format($propiedad->precio,2,".",",") !!}</p>
                                    <div class="listing-detail">
                                <span data-toggle="tooltip" data-placement="bottom"
                                      data-original-title="Dormitorio">{!! $propiedad->cant_habitaciones or 0 !!}</span>
                                        <span data-toggle="tooltip" data-placement="bottom"
                                              data-original-title="Baño">{!! $propiedad->cant_banios or 0 !!}</span>
                                        <span data-toggle="tooltip" data-placement="bottom"
                                              data-original-title="Living">{!! $propiedad->cant_living or 0 !!}</span>
                                        <span data-toggle="tooltip" data-placement="bottom"
                                              data-original-title="Garage">{!! $propiedad->cant_garage or 0 !!}</span>
                                        <span data-toggle="tooltip" data-placement="bottom"
                                              data-original-title="Cocina">{!! $propiedad->cant_cocina or 0 !!}</span>
                                    </div>
                                    {{--<a href="{!! route('pagina.property-detail', [$propiedad->id]) !!}" class="more">Mas--}}
                                    {{--Detalles...</a></div>--}}
                                    <a class="btn btn-primary"
                                       href="{!! route('pagina.property-detail', [$propiedad->id]) !!}">Mas Detalles</a>


                                </div>
                            </div>
                            <!-- properties -->
                    @endforeach
                @endif

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/2.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/3.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/1.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/4.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/1.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/4.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/3.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/2.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}
                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/1.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/4.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<!-- properties -->--}}

                {{--<!-- properties -->--}}
                {{--<div class="col-lg-4 col-sm-6">--}}
                {{--<div class="properties">--}}
                {{--<div class="image-holder"><img src="images/properties/3.jpg" class="img-responsive"--}}
                {{--alt="properties">--}}
                {{--<div class="status sold">Sold</div>--}}
                {{--</div>--}}
                {{--<h4><a href="property-detail.blade.php">Royal Inn</a></h4>--}}
                {{--<p class="price">Price: $234,900</p>--}}
                {{--<div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Bed Room">5</span> <span--}}
                {{--data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room">2</span>--}}
                {{--<span data-toggle="tooltip" data-placement="bottom"--}}
                {{--data-original-title="Parking">2</span> <span data-toggle="tooltip"--}}
                {{--data-placement="bottom"--}}
                {{--data-original-title="Kitchen">1</span>--}}
                {{--</div>--}}
                {{--<a class="btn btn-primary" href="property-detail.blade.php">View Details</a>--}}
                {{--</div>--}}
                {{--</div>--}}
                <!-- properties -->
                    <div class="text-center">
                        {!! $propiedades->appends(Request::all())->render() !!}
                    </div>
                    {{--<div class="center">--}}
                    {{--<ul class="pagination">--}}
                    {{--<li><a href="#">«</a></li>--}}
                    {{--<li><a href="#">1</a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">3</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#">5</a></li>--}}
                    {{--<li><a href="#">»</a></li>--}}
                    {{--</ul>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>
    </div>
</div>

@include('pagina.footer')
