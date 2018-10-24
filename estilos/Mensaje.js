var timer;
var timer2;

function MensajeConClase(mensaje, atributo) {
    clearTimeout(timer);
    $(atributo).hide('fast');
    $(atributo).html('<p><b>' + mensaje + "..!" + '</b></p>')
    $(atributo).show('slow');
    timer = setTimeout(function () {
        $(atributo).hide('fast');
        $(".sancionado-error").hide("fast");
        $(".error_depar").hide("fast");
    }, 5000);
}

function HabilitarModifica(capa) {
    $(capa).show('fast');
}

function DesHabilitarModifica(capa) {
    clearTimeout(timer2);
    $(capa).hide('fast');
    timer2 = setTimeout(function () {
        $(".modal").modal('hide');
    }, 5000);
}
