//tipo hace referencia a si se muestra solo el nombre o mas campos concatenados
function selecComboConNombre(combo1, combo2, url, tipo) {
    if ($("#" + combo1).val() != '') {
        $.get(url + $("#" + combo1).val(), function (response, datos) {
            $("#" + combo2).empty();
            $("#" + combo2).append("<option value=''>Seleccione...</option>");
            for (i = 0; i < response.length; i++) {
                if (tipo == 1) {
                    $("#" + combo2).append("<option value='" + response[i].id + "'>" + response[i].nombre + " - " + response[i].variante + " - " + response[i].presentacion + " - " + response[i].tamanio + "</option>");
                } else {
                    $("#" + combo2).append("<option value='" + response[i].id + "'>" + response[i].nombre + "</option>");

                }

            }
        })
    } else {
        $("#" + combo2).empty();
        $("#" + combo2).append("<option value=''>Seleccione...</option>");
    }
}

function cargarComboProductosDistribuidores(combo1, combo2, distribuidor, url) {
    if ($("#" + combo1).val() != '') {
        $.get(url + $("#" + combo1).val() + "/" + $("#" + distribuidor).val(), function (response, datos) {
            $("#" + combo2).empty();
            $("#" + combo2).append("<option value=''>Seleccione...</option>");
            for (i = 0; i < response.length; i++) {
                $("#" + combo2).append("<option value='" + response[i].producto_distribuidor_id + "'>" + response[i].nombre + " - " + response[i].variante + " - " + response[i].presentacion + " - " + response[i].tamanio + "</option>");
            }
        })
    } else {
        $("#" + combo2).empty();
        $("#" + combo2).append("<option value=''>Seleccione...</option>");
    }
}

idMedia = 1000;

function agregarItemMedia() {
    idMedia++;
    var clon = document.getElementById('media').cloneNode(true);
    elemento = document.getElementById('medias').appendChild(clon);
    $(elemento).removeAttr("style");
    // $(elemento).children().children("#lista_precio").attr("required", "");
    // $(elemento).children().children("#lista_precio").attr("required", "");
    $(elemento).children().children("#media").attr("id", "media" + idMedia);
    $(elemento).children().children("#principal").attr("id", "principal" + idMedia);
}

function eliminarItemMedia(elemento) {
    $(elemento).parent().parent().parent().parent().remove();
}