@include('pagina.header')

<script>
    function enviarMail() {
        if (checkEmail()) {
            $("#resultado_mail").attr('style', 'display:none');
            datos = $('#form_contacto').serialize();
            $.get("<?=env("APP_URL")?>"+"/enviar-mail-contacto" + '?' + datos, function (response) {
                if (response) {
                    $("#resultado_mail").removeAttr('style');
                    document.getElementById("form_contacto").reset();
                }
            })
        }
    }

    function checkEmail() {

        var email = document.getElementById('mail');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email.value)) {
            alert('El correo electr\u00F3nico no es correcto.');
            email.focus;
            return false;
        }
        return true;
    }
</script>
<!-- banner -->
<div class="inside-banner">
  <div class="container">
      <span class="pull-right"><a href="{!! url("/") !!}">Home</a> / Contacto</span>
    <h2>Contacto</h2>
</div>
</div>
<!-- banner -->


<div class="container">
<div class="spacer">
<div class="row contact">
  <div class="col-lg-6 col-sm-6 ">

      <form id="form_contacto" method="post">

                <input type="text" name="nombre" class="form-control" placeholder="Nombre Completo">
                <input type="text" id="mail" name="mail" class="form-control" placeholder="Email">
                <input type="text"  name="telefono" class="form-control" placeholder="Telefono">
                <textarea rows="6" name="mensaje" class="form-control" placeholder="Mensaje"></textarea>

          <label id="resultado_mail" style="display: none; background-color: green">
              Recibimos su mensaje, en breve nos comunicaremos con Usted.
          </label>
      <button type="button" onclick="enviarMail('mensaje')" class="btn btn-success" name="Submit">Enviar Mensaje</button>
          {{--<input type="button" class="button expanded" value="Enviar" onclick="enviarMail('mensaje')">--}}

      </form>
  </div>
      <div class="col-lg-6 col-sm-6 ">
          <div class="well">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3543.3882154618127!2d-55.90614898529092!3d-27.363588782935473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9457be3aca276eaf%3A0x53f5aaf5b4d3f78a!2sAv.+Leandro+N.+Alem+2835%2C+N3300PQD+Posadas%2C+Misi%C3%B3nes!5e0!3m2!1ses!2sar!4v1523570337036" width="500" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>


  </div>
  {{--<div class="col-lg-6 col-sm-6 ">--}}
  {{--<div class="well"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Pulchowk,+Patan,+Central+Region,+Nepal&amp;aq=0&amp;oq=pulch&amp;sll=37.0625,-95.677068&amp;sspn=39.371738,86.572266&amp;ie=UTF8&amp;hq=&amp;hnear=Pulchowk,+Patan+Dhoka,+Patan,+Bagmati,+Central+Region,+Nepal&amp;ll=27.678236,85.316853&amp;spn=0.001347,0.002642&amp;t=m&amp;z=14&amp;output=embed"></iframe></div>--}}
  {{--</div>--}}
</div>
</div>
</div>

@include('pagina.footer')
