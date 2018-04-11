<div class="footer">

    <div class="container">


        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4>Informacion</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="{!! route('pagina.about') !!}">Acerca de
                            Nosotros</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="{!! route('pagina.agents') !!}">Agentes</a></li>
                    {{--<li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.php">Blog</a></li>--}}
                    <li class="col-lg-12 col-sm-12 col-xs-3"><a href="{!! route('pagina.contact') !!}">Contacto</a></li>
                </ul>
            </div>

            {{--<div class="col-lg-3 col-sm-3">--}}
            {{--<h4>Newsletter</h4>--}}
            {{--<p>Get notified about the latest properties in our marketplace.</p>--}}
            {{--<form class="form-inline" role="form">--}}
            {{--<input type="text" placeholder="Enter Your email address" class="form-control">--}}
            {{--<button class="btn btn-success" type="button">Notify Me!</button></form>--}}
            {{--</div>--}}

            <div class="col-lg-4 col-sm-4">
                <h4>Seguinos</h4>
                {{--<a href="https://www.facebook.com/VisionInmobiliariaPos/" target="_blank"><img style="width: 40px" src="{!! asset("images/face-icon.png") !!}"--}}
                                                                                               {{--alt="facebook"></a>--}}

                <div class="fb-page" data-href="https://www.facebook.com/visioninmobiliariapos/" data-tabs="timeline" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/visioninmobiliariapos/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/visioninmobiliariapos/">Vision Inmobiliaria</a></blockquote></div>

            </div>

            <div class="col-lg-3 col-sm-3">
                <h4>Contactanos</h4>
                <p><b>Vision Inmobiliaria</b><br>
                    <span class="glyphicon glyphicon-map-marker"></span> Av. Leandro N. Alem N° 2835 <br>
                    <span class="glyphicon glyphicon-envelope"></span> visioninmobiliariapos@gmail.com<br>
                    <span class="glyphicon glyphicon-earphone"></span> (0376)4436353<br>
                    <span class="glyphicon glyphicon-earphone"></span> (3764)606695</p>
            </div>
        </div>
        <p class="copyright">Copyright 2018. All rights reserved. </p>


    </div>
</div>


<!-- Modal -->
<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-6 login">
                    <h4>Login</h4>
                    <form class="" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword2"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h4>New User Sign Up</h4>
                    <p>Join today and get updated with all the properties deal happening around.</p>
                    <button type="submit" class="btn btn-info" onclick="window.location.href='register.php'">Join Now
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.modal -->


</body>
</html>



