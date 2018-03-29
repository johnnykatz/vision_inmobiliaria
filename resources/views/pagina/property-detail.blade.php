@include('pagina.header')

<!-- banner -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="#">Home</a> / Buy</span>
        <h2>{!! $propiedad->tipoOperacion->nombre !!}</h2>
    </div>
</div>
<!-- banner -->


<div class="container">
    <div class="properties-listing spacer">

        <div class="row">
            <div class="col-lg-3 col-sm-4 hidden-xs">

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
                                    <h5><a href="{!! route('pagina.property-detail', [$destacada->id]) !!}">{!! $destacada->nombre or null !!}</a></h5>
                                    <p class="price">$ {!! number_format($destacada->precio,2,".",",") !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


                {{--<div class="advertisement">--}}
                    {{--<h4>Advertisements</h4>--}}
                    {{--<img src="images/advertisements.jpg" class="img-responsive" alt="advertisement">--}}

                {{--</div>--}}

            </div>

            <div class="col-lg-9 col-sm-8 ">

                <h2>{!! $propiedad->nombre or null !!}</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="property-images">
                        @if($propiedad->medias->count()>0)
                            <!-- Slider Starts -->
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators hidden-xs">
                                        @php($i=0)
                                        @foreach($propiedad->medias as $imagen)
                                            <li data-target="#myCarousel" data-slide-to="{!! $i !!}"
                                                class="{!! ($i==0)?"active":"" !!}"></li>
                                            @php($i++)
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                    @php($i=0)
                                    @foreach($propiedad->medias as $imagen)
                                        <!-- Item 1 -->
                                            <div class="item {!! ($i==0)?"active":"" !!}">
                                                <img src="{!! asset("imagenes/propiedades/".$imagen->url)!!}"
                                                     class="properties"
                                                     alt="properties"/>
                                            </div>
                                            <!-- #Item 1 -->
                                            @php($i++)
                                        @endforeach

                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span
                                                class="glyphicon glyphicon-chevron-left"></span></a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span
                                                class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <!-- #Slider Ends -->
                            @endif

                        </div>


                        <div class="spacer"><h4><span class="glyphicon glyphicon-th-list"></span> Descripcion</h4>
                            <p>{!! $propiedad->descripcion !!}</p>

                        </div>
                        {{--<div><h4><span class="glyphicon glyphicon-map-marker"></span> Ubicacion</h4>--}}
                            {{--<div class="well">--}}
                                {{--<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0"--}}
                                        {{--marginwidth="0"--}}
                                        {{--src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pulchowk,+Patan,+Central+Region,+Nepal&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Pulchowk,+Patan+Dhoka,+Patan,+Bagmati,+Central+Region,+Nepal&amp;ll=27.678236,85.316853&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe>--}}
                                        {{--src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;sll=-27.410944,-55.936168&amp;ie=UTF8&amp;hq=&amp;aq=0&amp;t=m&amp;z=14&amp;output=embed"></iframe>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>
                    <div class="col-lg-4">
                        <div class="col-lg-12  col-sm-6">
                            <div class="property-info">
                                <p class="price">$ {!! number_format($propiedad->precio,2,".",",") !!}</p>
                                <p class="area"><span
                                            class="glyphicon glyphicon-map-marker"></span> {!! $propiedad->direccion or null !!}
                                </p>

                                {{--<div class="profile">--}}
                                {{--<span class="glyphicon glyphicon-user"></span> Agent Details--}}
                                {{--<p>John Parker<br>009 229 2929</p>--}}
                                {{--</div>--}}
                            </div>

                            <h6><span class="glyphicon glyphicon-home"></span> Disponibilidad</h6>
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
                                      data-original-title="Cocina">{!! $propiedad->cant_lcocina or 0 !!}</span>
                            </div>

                        </div>
                        {{--<div class="col-lg-12 col-sm-6 ">--}}
                        {{--<div class="enquiry">--}}
                        {{--<h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry</h6>--}}
                        {{--<form role="form">--}}
                        {{--<input type="text" class="form-control" placeholder="Full Name"/>--}}
                        {{--<input type="text" class="form-control" placeholder="you@yourdomain.com"/>--}}
                        {{--<input type="text" class="form-control" placeholder="your number"/>--}}
                        {{--<textarea rows="6" class="form-control"--}}
                        {{--placeholder="Whats on your mind?"></textarea>--}}
                        {{--<button type="submit" class="btn btn-primary" name="Submit">Send Message</button>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pagina.footer')
