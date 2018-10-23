/*
 * 
 * @type String|ListarValorParametros.Parametros_L212.data|Number
 * DECLARO LAS VARIABLES NECESARIAS
 */

ActiReti = 0;
var DepartaSeleccionado = 0;
var modificapermisos = 1;
var valorseleccionado = "";
var parametroseleccionado = "";
var myTablevalor = "";
var estilotablaparametros = 1;
var valorEmpresa = "cuc";
estilotabla2 = 0;
perfilsele = 0;
estilotperfil = 1;
id = 0;
valor = 0;
operacion = 0;
var icono = "";
var modulosele = 0;
var perfilseleaux = 0;
DepartaSele = 0;
participanteDepar = 0;
participanteseledepa = 0;
HoraSalida = 0;
agrega = 1;
estiloDepar = 0;
tablaMenup = 0;
fotov = 0;
var HtmlFoto = ' <div class="TomarFoto"><table class="table"> <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead><tr><td class="videov"><video id="videov"  autoplay="autoplay"></video></td><td class="canvasv nomostrar"><canvas id="canvasv" width="300" height="208" ></canvas></td></tr><tr><td colspan="2">  <span  id="fotov" class="btn btn-danger active form-control">Tomar Foto! </span></td></tr> </table>  </div>';
$(document).ready(function () {
    $("input[type=number]").attr("min", "0");
    $("#Ruta").change(function () {
        $("#MyrutaFinal").val($("#Ruta").val());
    });
    $("#Empresas").change(function () {
        valorEmpresa = $(this).val();
        ListarDepartamentos(valorEmpresa);
    });

    //-----------------------------------------------------------------------

    //-----------------------------------------------------------------------

    $(".buscarvisitante").on('keyup', function (e) {
        participanteDepar = 0;
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            var valor = $(this).val().trim();
            if (valor.length != 0) {
                MostrarParticipantesDepartamentos(valor);
            } else {
                participanteDepar = 0;
                $("#tablaParticipantesDepar").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesDepar"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

                $("#tablaParticipantesDepar").DataTable({
                    //"processing": true,
                    "destroy": true,
                    searching: false,
                    "language": idioma,
                    dom: 'Bfrtip',
                    "buttons": []

                });
            }

        }
    });



    $("#Recargar2").click(function () {
        listarParametros();
        ListarValorParametros(0);
        $(".opcioenstablaparametros").css("display", "none");

    });

    $("#Recargar3").click(function () {
        MostrarTiposUsuarios();
        $(".opcioenstablaacividades").css("display", "none");
        MostrarActividadesAsignar("x")
    });
    $("#Recargar4").click(function () {

        CargarMenuTabla();
    });


    $("#form-ingresar-visitante4").submit(function () {
        canvas2 = document.getElementById("canvas3");

        registrarVisitante4();

        return false;
    });

    canvasv = document.getElementById("canvasv");
    $('#fotov').click(function () {
        if (fotov == 0) {
            $(".videov").hide('fast');

            $(".canvasv").show('fast');

            $("#fotov").html("Nueva Foto!");
            fotov = 1;
            var data = canvasv.toDataURL("image/jpeg");
            ActualizarFoto(participanteDepar, data)

        } else {

            $(".canvasv").hide('fast');
            $(".videov").show('fast');
            $("#fotov").html("Tomar Foto!");
            fotov = 0;

        }

    });

    $("#AgregarParticipanteDepartamento").click(function () {

        if (participanteDepar == 0) {

            MensajeConClase("Antes de continuar debes Seleccionar el visitante", ".error");
        } else {
            var value = $("#txtPlacaVehiculo2").val().length;
            var value2 = $("#txtPlacaVehiculo2").val();
            var acompa = $("#txTAcompanantes2").val();
            if ($(".vehiculo2").is(':checked')) {
                if (value != 6) {
                    MensajeConClase("El numero de caracteres valido para la placa son 6", ".error")
                } else if (acompa < 0) {
                    MensajeConClase("Ingrese datos mayores o iguales a 0 en el numero de acompñantes", ".error")
                } else if (acompa.length == 0) {
                    MensajeConClase("Ingrese Numero de acompañantes", ".error")
                } else {
                    registrarPaticipanteDepartamento(participanteDepar, DepartaSele, value2, acompa);
                    return false;
                }
            } else {
                var value2 = "------";
                registrarPaticipanteDepartamento(participanteDepar, DepartaSele, value2, acompa);
                return false;
            }
        }
    });

    $("#retirarsiVisitante").click(function () {
        $(".confirmarVisita").hide('fast');
        RetirarPaticipanteDepartamento(participanteseledepa);

    });
    $("#retirarnoVisitante").click(function () {
        $(".confirmarVisita").hide('fast');

    });
    $("#retirarVisi").click(function () {

        if (participanteseledepa == 0) {

            MensajeConClase("Debe seleccionar el participante", ".error");

        } else {
            $(".error").hide('fast');
            $(".confirmarVisita").show('fast');
        }

    });
    $("#SalidaVisi").click(function () {

        if (participanteseledepa == 0) {

            MensajeConClase("Debe seleccionar el participante", ".error");

        } else {

            if (HoraSalida != "0000-00-00 00:00:00") {
                MensajeConClase("El Visitante ya tiene Marcada la Hora de salida", ".error");
            } else {
                MarcarHoraSalida(participanteseledepa);
            }
        }

    });
    $(".cerrarForParDepa").click(function () {
        $(".TablaDepaPar").show("slow");;
        $(".RegistrarParticipanteDepa").hide("slow");
        $(".foterMPde").show("slow");
        $(".NuevoPartDepart").show("slow");

    });

    $(".NuevoPartDepart").click(function () {

        $(".RegistrarParticipanteDepa").show("slow");
        $(".TablaDepaPar").hide("slow");
        $(".foterMPde").hide("slow");
        $(".NuevoPartDepart").hide("slow");
    });
    $("#cerrarinfoDepar").click(function () {
        $("#participantesDeparta").hide("slow");

    });
    $("#cerrarinfoDeparPer").click(function () {
        $("#tablaParticipanteDepartamento").hide("slow");

    });
    $("#cerrarinfoVisitante").click(function () {
        $("#tablaVisitanteVisitaModal").hide("slow");

    });
    $("#btnModificar").click(function () {
        $(".error").hide();
        if (valorseleccionado.length == 0) {
            $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar un Valor Parametro</b></p>");
            $("#ModalMensaje").modal();
        } else {

            $('#txtPassword').hide();
            cargarValorParametro(valorseleccionado);
            $("#ModalModificarParametro").modal();
        }
    });


    $("#btnModificarParametro").click(function () {
        $(".error").hide();
        if (valorseleccionado.length == 0) {
            $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar un Valor Parametro</b></p>");
            $("#ModalMensaje").modal();
        } else {
            var txtValor = $("#txtValor").val();
            var txtDescripcion = $("#txtDescripcion").val();
            var txtPassword = $("#txtPassword").val();
            modificarValorParametro(valorseleccionado, txtValor, txtDescripcion, txtPassword);



        }

    });
    //-----------------------------------------------------------------------



    $("#retirarsiact").click(function () {
        $(".confirmarAct").hide('fast');
        EliminarActividad(ActiReti);

    });
    $("#retirarnoAct").click(function () {
        $(".confirmarAct").hide('fast');

    });
    $(".RetirarSctividad").click(function () {
        if (ActiReti == 0) {
            MensajeConClase("Seleccione Actividad a Retirar", ".error")
        } else {
            $(".error").hide('fast');
            $(".confirmarAct").show('fast');
        }

    });

    $("#CambiarTabla").click(function () {
        if (estilotablaparametros == 0) {
            estilotablaparametros = 1;
        } else {
            estilotablaparametros = 0;
        }

        listarParametros();
    });
    $(".CambiarTabla").click(function () {

        if (estilotperfil == 0) {
            estilotperfil = 1;
        } else {
            estilotperfil = 0;
        }

        MostrarTiposUsuarios();
    });
    $("#CambiarTablaPerfiles").click(function () {

        if (tablaMenup == 0) {
            tablaMenup = 1;
        } else {
            tablaMenup = 0;
        }
        CargarMenuTabla();
    });

    $(".modificaricono").click(function () {

        if (modulosele == 0) {
            $("#ModalMe").html("<p >Antes de Continuar debe seleccionar el perfil</p>");
            $("#ModalMensaje").modal();
        } else {
            icono = "";
            $("#myModal").modal("show");
        }

    });
    $("#asignaricono").click(function () {
        if (icono == "") {

            MensajeConClase("Debe Seleccionar Un Icono", "#error1");
        } else {
            CambiarIcono(modulosele, icono);
        }
    });


    $("#tablaiconos tbody td").click(function () {
        $("#tablaiconos td").css("color", "black");
        $(this).css("color", "#990000");
        icono = $(this).attr('class');
    });

    $("#GuardarActividadPerfil").click(function () {
        actividad = $("#idactividades").val();

        if (actividad == "") {

            MensajeConClase("Debe Seleccionar Una Actividad", "#error1");
        } else {
            registrarPermisoPorUsuario(perfilseleaux, actividad);
        }
    });
    $("#btnCambiarPermiso").click(function () {
        CambiarEstado();
    });
    $(".agregaractividad").click(function () {

        if (perfilsele == 0) {
            $("#ModalMe").html("<p >Antes de Continuar debe seleccionar el perfil</p>");
            $("#ModalMensaje").modal();
        } else {
            MostrarActividadesAsignarcombo(perfilseleaux);
            $("#ActividadPerfil").modal("show");
        }

        listarParametros();
    });
    CargarMenuTabla();
    CargartiposEstadosEventos();

    Cargaridentificacion();
    CargarParametros();
    CargarTipoVisita();
    CargarEstadoVisita();
    CargartiposCargos();
    CargartiposDepartamentos();
    CargartiposPersonas();

    $("#tablaactividades").DataTable({
        //"processing": true,
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $("#tablavalorparametros").DataTable({
        //"processing": true,
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $("#tablaParticipantesDepar").DataTable({
        //"processing": true,
        searching: false,
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });

    /*
     * AL DAR CLICK EN EL BOTON ELIMINAR LLAMO A MI FUNCION EliminarValorParametro
     */
    $("#btnEliminarParametro").click(function () {

        EliminarValorParametro(valorseleccionado)
    });
    $(".btnEliminarvalorparametro").click(function () {
            if (valorseleccionado == "") {
                $("#btnEliminarParametro").hide("fast");
                $("#ModalEliminar").hide("fast");
                $("#ModalEliminar").html('<p class="mc">Antes de Continuar Debe Seleccionar el Parametro a Eliminar</p>')
                $("#ModalEliminar").show("fast");
                $("#ModalConfirmacionEliminar").modal("show")
            } else {
                $("#btnEliminarParametro").show("fast");
                $("#ModalEliminar").hide("fast");
                $("#ModalEliminar").html('<p class="mc">¿ Esta Seguro de Desea Eliminar el Parametro ?</p>')
                $("#ModalEliminar").show("fast");
                $("#ModalConfirmacionEliminar").modal("show");
            }

        }

    )
    /*
     * OCULTO LOS MENSAJES DE ERROR O DE INFORMACION
     */
    $(".operaciones").click(function () {
        $('#error1').hide('fast');
        $('#error').hide('fast');

    });
    /*
     * HAY CIERTOS PARAMETROS QUE REQUIEREN CIERTOS VALORES ESPECILES 
     * CON ESTA FUNCION MUESTRO DEPENDIENDO DEL PARAMETRO SELECCIONADO EL VALOR QUE ES NECESARIO
     */
    $('#idParametros').change(function () {
        $('#valorparametro').attr("type", "text");
        $('#valorparametro').attr("placeholder", "valor");
        $('#id_aux').attr("placeholder", "codigo");
        $('#id_aux').attr("type", "text")
        $('#Empresa').removeAttr('required', 'false');
        $('.Empresas').html("");
        idparametro = $('#idParametros').val();

        if (idparametro == 13 || idparametro == 14 || idparametro == 7 || idparametro == 8 || idparametro == 4 || idparametro == 11 || idparametro == 10 || idparametro == 12) {

            $('#Empresa').hide("fast");
            $('.div_id_aux').show('slow');
            $('#id_aux').attr('required', 'true');
        } else if (idparametro == 9) {
            $('#Empresa').hide("fast");
            $('.div_id_aux').show('slow');
            $('#id_aux').attr('required', 'true');
            $('#valorparametro').attr("type", "email");
            $('#id_aux').attr("placeholder", "Contraseña");
            $('#id_aux').attr("type", "password")
            $('#valorparametro').attr("placeholder", "Correo");
        } else if (idparametro == 3) {
            CargarEmpresas();

            $('.div_id_aux').hide('slow');
            $('#Empresa').show("slow");
            $('#id_aux').removeAttr('required', 'false');
            $('#Empresa').attr('required', 'true');

        } else {
            $('#Empresa').hide("fast");
            $('.div_id_aux').hide('fast');
            $('#id_aux').removeAttr('required', 'false');
        }
    });

});
// este metodo carga cada uno de los parametros al combo
function CargarParametros() {
    $.ajax({
        url: "../model/Parametros.php?mostrarParametro2=si",
        dataType: "json",
        type: "post",
        success: function (datos) {


            $('.idParametros').html("");
            $('.idParametros').append("<option value=" + '' + ">" + 'Seleccione Un Parametro' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.idParametros').append("<option value=" + datos[i].id + ">" + datos[i].nombre + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
} // este metodo me permite mostrar los parametros en una tabla


/**
 * 
 * @returns {undefined}
 * EN ESTA FUNCION MUESTRO LOS PARAMETROS EN UNA TABLA LA CUAL SE CARGA POR HACIENDO EL LLAMADO DE EL ARCHIVO Parametros.php
 * PASANDOLE COMO PARAMETRO LA FUNCION MOSTRAR
 * EL ESTILO DE LA TABLA SE CARGA DEPENDIENDO DEL VALOR DE LA VARIABLE QUE SE DEFINIDO ANTERIORMENTE
 * EL PRIMER ESTILO DE TABLA ES CON PAGINACION
 * EL SEGUNDO ESTILO DE LA TABLA ES CON SCROLL
 */
var listarParametros = function () {

    $('#tablaparametros tbody').off('click', 'tr');
    if (estilotablaparametros == 0) {
        var myTable = $("#tablaparametros").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrarParametro=si",
                dataType: "json",
                type: "post",
            },
            //"processing": true,
            paging: false,
            scrollY: 300,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "descripcion"
                },
            ],
            "language": idioma,
            "lengthMenu": [5, 25, 50, 75, 100],
            dom: 'Bfrtip',
            "buttons": [],
        });
        $('#tablaparametros tbody').on('click', 'tr', function () {

            var data = myTable.row(this).data();
            parametroseleccionado = data[3];
            if (parametroseleccionado == 9) {
                $(".valortabla").html("Correo");
                $(".codigotabla").html("Contraseña");
            } else if (parametroseleccionado == data[3]) {
                $(".valortabla").html("Valor");
                $(".codigotabla").html("Codigo");

            } else {
                $(".valortabla").html("Nombre");
                $(".codigotabla").html("Codigo");
            }
            ListarValorParametros(data[3]);
            $("#tablaparametros tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            $(".opcioenstablaparametros").show("fast");

        });

    } else {
        var myTable = $("#tablaparametros").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrarParametro=si",
                dataType: "json",
                type: "post",
            },
            //"processing": true,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "descripcion"
                },
            ],
            "language": idioma,
            "lengthMenu": [5, 25, 50, 75, 100],
            dom: 'Bfrtip',
            "buttons": [],
        });
        $('#tablaparametros tbody').on('click', 'tr', function () {

            var data = myTable.row(this).data();
            parametroseleccionado = data[3];
            if (parametroseleccionado == 9) {
                $(".valortabla").html("Correo");
                $(".codigotabla").html("Contraseña");
            } else if (parametroseleccionado == data[3]) {
                $(".valortabla").html("Valor");
                $(".codigotabla").html("Codigo");

            } else {
                $(".valortabla").html("Nombre");
                $(".codigotabla").html("Codigo");
            }
            ListarValorParametros(data[3]);
            $("#tablaparametros tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            $(".opcioenstablaparametros").show("fast");

        });

    }
}
/*
 * 
 * @param {type} id
 * @returns {undefined}
 * CON ESTA FUNCION DEPENDIENDO DEL PARAMETRO SELECIONADO MUESTRO LOS VALORES QUE LE CORRESPONDEN
 */
function ListarValorParametros(id) {

    elegido = id;
    $('#tablavalorparametros tbody').off('click', 'tr');
    myTablevalor = $("#tablavalorparametros").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Parametros.php?mostrarvalor=si",
            dataType: "json",
            type: "post",
            data: {
                data: elegido,
            }
        },
        // "processing": true,
        "lengthMenu": [5, 25, 50, 75, 100],
        "columns": [{
                "data": "indice"
            },
            {
                "data": "id_aux"
            },
            {
                "data": "valor"
            },
            {
                "data": "valorx"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });

    $('#tablavalorparametros tbody').on('click', 'tr', function () {
        var data = myTablevalor.row(this).data();
        valorseleccionado = data[0];
        $("#tablavalorparametros tbody tr").removeClass("warning");
        $(this).attr("class", "warning");
        $(".mc").html("¿ Esta Seguro de Desea Eliminar el parametro ?");

        $("#idParametrosmodi").val(data[3]);
        $("#salirEliminar").hide("fast");
        $(".botonesEliminar").show("slow");
        HabilitarModifica(".divmodifica");

    });
}

function MostrarTiposUsuarios() {

    $('#tablaperfilesusuairos tbody').off('click', 'tr');
    if (estilotperfil == 0) {
        var myTablevalor = $("#tablaperfilesusuairos").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrartiposusuarios=si",
                dataType: "json",
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [5, 25, 50, 75, 100],
            paging: false,
            scrollY: 300,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
            ],
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": []

        });

        $('#tablaperfilesusuairos tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            $("#tablaperfilesusuairos tbody tr").removeClass("warning");

            $(this).attr("class", "warning");
            perfilsele = data[0];
            perfilseleaux = data[1];
            $(".opcioenstablaacividades").show("slow");
            MostrarActividadesAsignar(perfilseleaux);

        });


    } else {

        var myTablevalor = $("#tablaperfilesusuairos").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrartiposusuarios=si",
                dataType: "json",
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [5, 25, 50, 75, 100],
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
            ],
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": []

        });

        $('#tablaperfilesusuairos tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            $("#tablaperfilesusuairos tbody tr").removeClass("warning");

            $(this).attr("class", "warning");
            perfilsele = data[0];
            perfilseleaux = data[1];
            $(".opcioenstablaacividades").show("slow");
            MostrarActividadesAsignar(perfilseleaux)

        });

    }
}

function MostrarActividadesAsignar(id) {
    $(".confirmarAct").hide('fast');
    $('#tablaactividades tbody').off('click', 'tr');
    var myTablevalor = $("#tablaactividades").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Parametros.php?mostraractividadesasignadas=si",
            dataType: "json",
            data: {
                id: id,
            },
            type: "post",
        },
        // "processing": true,
        "lengthMenu": [5, 25, 50, 75, 100],
        "columns": [{
                "data": "indice"
            },
            {
                "data": "valor"
            },
            {
                "data": "agrega"
            },
            {
                "data": "modifica"
            },
            {
                "data": "elimina"
            },
            {
                "data": "amplia"
            },
            {
                "data": "cambia_tabla"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });

    $('#tablaactividades tbody').on('click', 'tr', function () {
        var data = myTablevalor.row(this).data();

        $("#tablaactividades tbody tr").removeClass("warning");

        $(this).attr("class", "warning");
        ActiReti = data[6];



    });

}

function AgregarPar() {
    agrega = 0;
}

function sombrear2(idp, valorp, operacionp) {

    if (modificapermisos == 1) {
        id = idp;
        valor = valorp;
        operacion = operacionp;
        $("#ModalEliminar").html("<p> ¿ Esta Seguro que desea Cambiar El Permiso? </p>")
        $("#CambiarPermiso").modal("show");
        $("#btnCambiarPermiso").show("fast");
    } else {
        $("#ModalEliminar").html("<p> No tiene los permisos necesarios para Modificar</p>")
        $("#CambiarPermiso").modal("show");
        $("#btnCambiarPermiso").hide("fast");
    }


}

function MostrarActividadesAsignarcombo(id) {

    $.ajax({
        url: "../model/Parametros.php?mostraractividades=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {


            $('.idactividades').html("");
            $('.idactividades').append("<option value=" + '' + ">" + 'Seleccione Actividad' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.idactividades').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

//este metodo me carga los tipos de identificaicon que he guardado ID 1 EN UN COMBO mostrarTiposVisitas


//este metodo me carga los tipos de identificaicon que he guardado ID 1 EN UN COMBO mostrarTiposVisitas
function Cargaridentificacion() {
    $.ajax({
        url: "../model/Parametros.php?mostrarTiposIdentificacion=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            $('.cbxtipoIdentificacion').html("");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.cbxtipoIdentificacion').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function CargartiposDepartamentos() {

    $.ajax({
        url: "../model/Parametros.php?mostrarDepartamen=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('.departamentos').html("");
            $('.departamentos').append("<option value=" + '' + ">" + 'Seleccione Departamento o Area' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('.departamentos').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function ListarDepartamentos(empresa) {
    if (estiloDepar == 0) {
        $('#tablaDepar tbody').off('click', 'tr');
        $('#tablaDepar tbody').off('dblclick', 'tr');
        myTablevalor = $("#tablaDepar").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrarDepartamen2=si",
                dataType: "json",
                data: {
                    empresa: empresa
                },
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
                {
                    "defaultContent": "<span data-toggle='modal' data-target='#participantesDepartamentos'style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link'></span>"
                }

            ],
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    className: 'btn btn-success',
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    className: 'btn btn-default',
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    className: 'btn btn-danger',
                }
            ],
        });

        $('#tablaDepar tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            DepartaSele = data[0];

            $("#tablaDepar tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            $(".TablaDepaPar").show("fast");
            $(".RegistrarParticipanteDepa").hide("fast");
            $("#participantesDeparta").hide("fast");
            $(".Visitantesfoto").hide("fast");

            $(".foterMPde").show("fast");
            if (agrega == 1) {
                $(".NuevoPartDepart").show("fast");
            }
            $('.vehiculo2').prop("checked", "");
            $('.divplaca2').hide('fast');
            $('.placa2').removeAttr('required', 'false');

        });
        $('#tablaDepar tbody').on('dblclick', 'tr', function () {

            $("#tablaParticipanteDepartamento").hide("fast")
            MostrarParticipantesDepartamentoEsp(DepartaSele);

            $(".error").hide("fast");
            $("#error1").hide("fast");
            $("#error").hide("fast");
        });
    } else {
        $('#tablaDepar tbody').off('click', 'tr');
        $('#tablaDepar tbody').off('dblclick', 'tr');
        myTablevalor = $("#tablaDepar").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?mostrarDepartamen2=si",
                dataType: "json",
                data: {
                    empresa: empresa
                },
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
                {
                    "defaultContent": "<span data-toggle='modal' data-target='#participantesDepartamentos'style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link'></span>"
                }

            ],
            "language": idioma,
            dom: 'Bfrtip',
            paging: false,
            scrollY: 300,
            "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    className: 'btn btn-success',
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    className: 'btn btn-default',
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    className: 'btn btn-danger',
                }
            ],
        });

        $('#tablaDepar tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            DepartaSele = data[0];

            $("#tablaDepar tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            $(".TablaDepaPar").show("fast");
            $(".RegistrarParticipanteDepa").hide("fast");
            $("#participantesDeparta").hide("fast");
            $(".foterMPde").show("fast");
            $(".Visitantesfoto").hide("fast");
            if (agrega == 1) {
                $(".NuevoPartDepart").show("fast");
            }
            $('.vehiculo2').val("");
            $('.divplaca2').hide('fast');
            $('.placa2').removeAttr('required', 'false');

        });
        $('#tablaDepar tbody').on('dblclick', 'tr', function () {
            $("#tablaParticipanteDepartamento").hide("fast")
            MostrarParticipantesDepartamentoEsp(DepartaSele);

            $(".error").hide("fast");
            $("#error1").hide("fast");
            $("#error").hide("fast");
        });
    }
}
/*
 * 
 * @returns {undefined}
 * 
 * APARTIR DE AQUI ESTAN LOS METETODOS CON LOS CUALES SE CARGAN LOS PARAMETROS EN UN COMBO O EN UNA TABLA 
 * LOS METETODOS UTILIZADOS SON
 *   CargartiposEstadosEventos();
 listarParametros();
 Cargaridentificacion();
 CargarParametros();
 CargarTipoVisita();
 CargarEstadoVisita();
 CargartiposCargos();
 CargartiposDepartamentos();
 CargartiposPersonas();
 
 */

function CargartiposEstadosEventos() {

    $.ajax({
        url: "../model/Parametros.php?estadoeventos=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('.Estado-Evento').html("");
            $('.Estado-Evento').append("<option value=" + '' + ">" + 'Seleccione Estado del evento' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('.Estado-Evento').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

/*function CargartiposPerfiles(){ 
 
 $.ajax({
 url: "../model/Parametros.php?mostrarPerfiles=si",
 dataType: "json",
 type: "post",
 success: function (datos) {
 
 $('#cbxdperfil').html("");
 $('#cbxdperfil').append("<option value=" + '' + ">" + 'Seleccione Nuevo Perfil' + "</option>");
 
 for (var i = 0; i <= datos.length - 1; i++) {
 $('#cbxdperfil').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");
 
 }
 ;
 },
 error: function () {
 
 console.log('Something went wrong', status, err);
 
 }
 });
 
 }*/
function CargartiposCargos() {
    $.ajax({
        url: "../model/Parametros.php?mostrarcargos=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            $('.tiposcargo').html("");
            $('.tiposcargo').append("<option value=" + '' + ">" + 'Seleccione Cargo' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('.tiposcargo').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");
            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function CargartiposParticipantes() {
    $.ajax({
        url: "../model/Parametros.php?mostrarparti=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            $('.tipo_par').html("");
            $('.tipo_par').append("<option value=" + '' + ">" + 'Seleccione Tipo Participante' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('.tipo_par').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");
            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function CargarTipoVisita() {

    $.ajax({
        url: "../model/Parametros.php?mostrarTiposVisitas=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            $('.tipoIngreso').html("");
            $('.tipoIngreso').append("<option value=" + '' + ">" + 'Seleccione Tipo de Ingreso' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.tipoIngreso').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");
            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function CargarEmpresas() {

    $.ajax({
        url: "../model/Parametros.php?mostrarempresas=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('.Empresas').html("");
            $('.Empresas').append("<option value=" + '' + ">" + 'Seleccione Empresa' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {

                $('.Empresas').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");
            }
            $('#Empresas').val("cuc");;
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function CargarEstadoVisita() {

    $.ajax({
        url: "../model/Parametros.php?mostrarEstadosVisitas=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('.cbxestadovisita').html("");
            $('.cbxestadovisita').append("<option value=" + '' + ">" + 'Seleccione Estado Visita' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.cbxestadovisita').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");
            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
//este metodo me carga los tipos de identificaicon que he guardado ID 1 EN UN COMBO
function CargarValorParametros(id) {
    elegido = id;

    $.ajax({
        url: "../model/Parametros.php?mostrarvalor=si",
        dataType: "json",
        type: "post",
        data: {
            data: elegido,
        },
        success: function (datos) {



            if (datos != '') {
                $('#tblvalorparametro').html("");
                for (var i = 0; i <= datos.length - 1; i++) {
                    $('#tblvalorparametro').append("<tr><td class='id'>" + (i + 1) + "</td><td class='medio'>" + datos[i].valor + "</td><td class='largo'>" + datos[i].valorx + "</td></tr>");

                }
            } else {
                $("#ModalMe").html("<p >El Parametro no tiene Valores Asociados</p>");
                $("#ModalMensaje").modal();
            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function CargartiposPersonas() {

    $.ajax({
        url: "../model/Parametros.php?mostrarPersonas=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('#cbxtipopersona').html("");
            $('#cbxtipopersona').append("<option value=''>" + 'Seleccione Tipo de Persona' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('#cbxtipopersona').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            }
            $('#cbxtipopersona').val("tblvisitado");;
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function sombrear(id) {

    $("tr").css("background-color", "white");
    $("." + id).css("background-color", " #ffffcc");
    $("#idSeleccionado").val(id);
    CargarValorParametros(id);


}
var idioma = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Ningún dato disponible en esta tabla...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

function EliminarValorParametro(id) {
    $.ajax({
        url: "../model/Parametros.php?eliminar=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Valor parametro Eliminado Con Exito");
                $(".mc").show("slow");
                $("#idSeleccionado").val("");
                valorseleccionado = "";
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
                ListarValorParametros(parametroseleccionado);
            } else {
                $(".mc").hide("fast");
                $(".mc").html("Error Al Eliminar El Valor parametro");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
            }
        },
        error: function () {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Eliminar El Valor parametro");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
    });


}

function EliminarActividad(id) {

    $.ajax({
        url: "../model/Parametros.php?eliminarActividad=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                MensajeConClase("Actividad Eliminada Con exito", ".error");
                MostrarActividadesAsignar(perfilseleaux);
            } else {
                MensajeConClase("Error Al Eliminar la Actividad", ".error");
            }
        },
        error: function () {
            MensajeConClase("Error Al Eliminar la Actividad", ".error")
            console.log('Something went wrong', status, err);

        }
    });


}

function registrarPermisoPorUsuario(perfil, actividad) {

    $.ajax({
        url: "../model/Parametros.php?GuardarPermiso=si",
        dataType: "json",
        data: {
            perfil: perfil,
            actividad: actividad,
        },
        type: "post",
    }).done(function (datos) {

        //Recibo los datos del php
        //si es un quiere decir que los campos estan vacios
        if (datos == 1) {

            MensajeConClase("Debe Seleccionar Una Actividad", "#error1");
            return true;
            //si es dos es por que guardo el parametro
        } else if (datos == 2) {

            MensajeConClase("Actividad Registrada Con exito", "#error1");
            MostrarActividadesAsignar(perfilseleaux);
            MostrarActividadesAsignarcombo(perfilseleaux);
            return true;
            // si es tres es por que el nombre del parametro existe
        } else {
            // en dado caso que ocurra un error

            MensajeConClase("Error al Guardar el Valor del Parametro", "#error1");
            return true;
        }
    });
}

function CambiarEstado() {


    $.ajax({
        url: "../model/Parametros.php?ModificarPermiso=si",
        dataType: "json",
        data: {
            id: id,
            valor: valor,
            operacion: operacion,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == 2) {
            $('#ModalEliminar').hide('fast');
            $("#ModalEliminar").html("<p> Permiso Modificado Con Exito</p>")
            $('#ModalEliminar').show('slow');
            $("#btnCambiarPermiso").hide("fast");
            MostrarActividadesAsignar(perfilseleaux);
            return true;
            // si es tres es por que el nombre del parametro existe
        } else {
            // en dado caso que ocurra un error

            $('#ModalEliminar').hide('fast');
            $("#ModalEliminar").html("<p>Error al Modificar el permiso</p>")
            $('#ModalEliminar').show('slow');
            $("#btnCambiarPermiso").hide("fast");
            return true;
        }
    });
}

function ocultar() {
    $('#error1').hide('slow');

}

function CargarMenuTabla() {

    if (tablaMenup == 0) {

        $('#TablaActividadesmenu tbody').off('click', 'tr');
        var myTablevalor = $("#TablaActividadesmenu").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?menutabla=si",
                dataType: "json",
                data: {
                    id: id,
                },
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [20, 25, 50, 75, 100],
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valory"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
            ],
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": []

        });

        $('#TablaActividadesmenu tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            HabilitarModifica(".divmodifica");
            $("#TablaActividadesmenu tbody tr").removeClass("warning");

            $(this).attr("class", "warning");
            modulosele = data[0];


        });
    } else {

        $('#TablaActividadesmenu tbody').off('click', 'tr');
        var myTablevalor = $("#TablaActividadesmenu").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Parametros.php?menutabla=si",
                dataType: "json",
                data: {
                    id: id,
                },
                type: "post",
            },
            // "processing": true,
            "lengthMenu": [20, 25, 50, 75, 100],
            paging: false,
            scrollY: 300,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "valory"
                },
                {
                    "data": "valor"
                },
                {
                    "data": "valorx"
                },
            ],
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": []

        });

        $('#TablaActividadesmenu tbody').on('click', 'tr', function () {
            var data = myTablevalor.row(this).data();
            HabilitarModifica(".divmodifica");
            $("#TablaActividadesmenu tbody tr").removeClass("warning");

            $(this).attr("class", "warning");
            modulosele = data[0];


        });
    }
}

function CambiarIcono(id, icono) {

    $.ajax({
        url: "../model/Parametros.php?Modificaricono=si",
        dataType: "json",
        data: {
            id: id,
            icono: icono,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == 1) {

            MensajeConClase("Icono Modificado Con Exito", "#error1");
            DesHabilitarModifica(".divmodifica");
            CargarMenuTabla();
            return true;
            // si es tres es por que el nombre del parametro existe
        } else {
            // en dado caso que ocurra un error

            MensajeConClase("Error al Modificar el icono", "#error1");
            return true;
        }
    });
}

function PuedeModificarPermiso() {

    modificapermisos = 0;

}

function cargarValorParametro(id) {

    $.ajax({
        url: "../model/Parametros.php?cargarValorParametro=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            if (datos.idParametro == 9) {

                $('#txtPassword').show();
            }

            $('#txtPassword').val(datos.id_aux);
            $("#txtValor").val(datos.valor);
            $("#txtDescripcion").val(datos.valorx);
        },
        error: function () {
            console.log('Something went wrong', status, error);
        }
    });
}

function modificarValorParametro(id, valor, valorx, id_aux) {
    $.ajax({
        url: "../model/Parametros.php?modificarValorParametro=si",
        dataType: "json",
        data: {
            id: id,
            valor: valor,
            valorx: valorx,
            id_aux: id_aux,
            idparametro: parametroseleccionado
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {

                MensajeConClase("Todos Los Campos Son Obligatorios", ".error")
                return true;
                //si es dos es por que guardo el parametro
            } else if (datos == 2) {

                MensajeConClase("Valor Parametro Modificado Con exito", ".error");
                DesHabilitarModifica(".divmodifica");
                ListarValorParametros(parametroseleccionado);
                return true;
                // si es tres es por que el nombre del parametro existe
            } else if (datos == 3) {

                MensajeConClase("El Valor del Parametro ya esta en el sistema", ".error")
                return true;
            } else if (datos == 4) {

                MensajeConClase("El Codigo ya esta registrado", ".error")
                return true;
            } else if (datos == 5) {

                MensajeConClase("Para este parametro no se permiten el ingreso de letras", ".error")
                return true;
            } else if (datos == 6) {

                MensajeConClase("Para El Parametro que Desea Registrar Solo se permiten Dos valor Si o No", ".error")
                return true;
            } else {
                // en dado caso que ocurra un error

                MensajeConClase("Error al Guardar el Valor del Parametro", ".error")
                return true;
            }
        },
        error: function () {
            console.log('Something went wrong', status, error);
        }
    });

}

function MostrarParticipantesDepartamentos(dato) {

    $('#tablaParticipantesDepar tbody').off('click', 'tr');
    $('#tablaParticipantesDepar tbody').off('dblclick', 'tr');
    var table = $("#tablaParticipantesDepar").DataTable({
        "destroy": true,
        searching: false,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarparticipantesDepartamento1=si",
            dataType: "json",
            type: "post",
            data: {
                dato: dato
            },
        },
        //  "processing": true,
        "columns": [{
                "data": "indice"
            },
            {
                "data": "nombres"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "identificacion"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $('#tablaParticipantesDepar tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaParticipantesDepar tbody tr").removeClass("warning");

        $(this).attr("class", "warning");
        participanteDepar = data[3];

        mostrarInfoCompletaparticipante(participanteDepar, "#participantesDeparta")

    });
    $('#tablaParticipantesDepar tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        $("#participantesDeparta").show("slow");

    });

}


//Funcion guardar un participante a un departamento
function registrarPaticipanteDepartamento(participante, departamento, placa, acompa) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/Parametros.php?guardarparticipantedepartamento=si",
        dataType: "json",
        data: {
            participante: participante,
            departamento: departamento,
            placa: placa,
            acompa: acompa,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == -1) {
            MensajeConClase("El Visitante no cuenta con foto en el sistema, por favor tomar la foto <b class='tomar glyphicon glyphicon-camera'></b>", ".error");
            $(".tomar").css("-webkit-animation", " tiembla 0.3s infinite");
            $(".tomar").click(function () {

                $(".TablaDepaPar").hide("fast");

                $(".Visitantesfoto").show("fast");
                $(".error").hide("fast")

            });

            return false;
        } else if (datos == -20) {

            $(".Visitantesfoto").hide("fast");

            $(".sancionado-error").show("fast");
            $(".TablaDepaPar").show("slow");
            cargarSancionesPorUsuario3(participante);
            $("#Modal_mensaje_sancion").modal();

        } else {
            $(".Visitantesfoto").hide("fast");
            $(".TablaDepaPar").show("slow");
            MensajeConClase("Visitante Agregado con exito,Visita Numero: " + datos, ".error");
            return true;
        }

    });

}

function MostrarParticipantesDepartamentoEsp(evento) {

    $(".confirmarVisita").hide('fast');
    $('#tablaParticipantesDepartamentos tbody').off('click', 'tr');
    $('#tablaParticipantesDepartamentos tbody').off('dblclick', 'tr');
    var table = $("#tablaParticipantesDepartamentos").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarparDepa=si",
            dataType: "json",
            data: {
                id: evento,
            },
            type: "post",
        },
        "lengthMenu": [5, 25, 50, 75, 100],
        //  "processing": true,
        "columns": [{
                "data": "indice"
            },
            {
                "data": "nombres"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "identificacion"
            },
            {
                "data": "placa_visitante"
            },
            {
                "data": "Acompanantes"
            },
            {
                "data": "HoraEntrada"
            },
            {
                "data": "HoraSalida"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                className: 'btn btn-success',
            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                className: 'btn btn-default',
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                className: 'btn btn-danger',
            }
        ],
    });
    $('#tablaParticipantesDepartamentos tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaParticipantesDepartamentos tbody  tr").removeClass("warning");
        $(this).attr("class", "warning");
        participanteseledepa = data[6];
        HoraSalida = data[5];

        mostrarInfoCompletaparticipante(data[3], "#tablaParticipanteDepartamento")

    });
    $('#tablaParticipantesDepartamentos tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        $("#tablaParticipanteDepartamento").show("slow");

    });

    $("#participantesDepartamentoInfo").modal("show");
}

function RetirarPaticipanteDepartamento(participante) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/VisitantesMetodos.php?retirarVisitante=si",
        dataType: "json",
        data: {
            participante: participante,
        },
        type: "post",
    }).done(function (datos) {


        MensajeConClase("Participante Retirado con exito", ".error");
        MostrarParticipantesDepartamentoEsp(DepartaSele);

    });

}

function MarcarHoraSalida(participante) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/Parametros.php?marcarsalida=si",
        dataType: "json",
        data: {
            participante: participante,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == 6) {
            MostrarParticipantesDepartamentoEsp(DepartaSele);

            MensajeConClase("Hora de Salida Marcada con exito", ".error");
            return true;
        } else {


            MensajeConClase("Error al Marcar la hora de salida", ".error");
        }
    });

}

function CambiarEstiloTablaDepa() {
    if (estiloDepar == 0) {
        estiloDepar = 1;
    } else {
        estiloDepar = 0;
    }

    ListarDepartamentos(valorEmpresa);
}
//Funcion guardar visitante
function registrarVisitante4() {
    if (foto3 != 0) {
        //tomamos el formulairo ingresar visitante
        var formData = new FormData(document.getElementById("form-ingresar-visitante4"));
        var data = canvas2.toDataURL("image/jpeg");
        var info = data.split(",", 2);
        formData.append("data", info[1]);
        formData.append("departa", DepartaSele);

        var value = $("#txtPlacaVehiculo3").val().trim().length;
        var value2 = $("#txtPlacaVehiculo3").val();
        var acompa = $("#txTAcompanantes3").val();

        if ($(".vehiculo3").is(':checked')) {

            if (value != 6) {
                MensajeConClase("El numero de caracteres valido para la placa son 6", ".error")
                return false;
            } else if (acompa < 0) {

                MensajeConClase("Ingrese datos mayores o iguales a 0 en el numero de acompñantes", ".error")
                return false;
            } else if (acompa.length == 0) {

                MensajeConClase("Ingrese Numero de acompañantes", ".error")
                return false;
            } else {

                formData.append("placa", value2);
                formData.append("acompa", acompa);
            }

        } else {
            var value2 = "------";
            acompa = 0;

            formData.append("placa", value2);
            formData.append("acompa", acompa);
        }






        //  Enviamos el formulario a nuestro archivo php con parametro guardar     
        $.ajax({
            url: "../model/visitantesMetodos.php?guardar=si",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (datos) {

            if (datos == 1) {

                MensajeConClase("Todos Los campos son Obligatorios", ".error")
                return true;
            } else if (datos == 2) {

                MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error")
                return true;
            } else if (datos == 3) {

                MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error")
                return true;
            } else if (datos == 4) {


                MensajeConClase("Visitante Guardado Con exito", ".error")
                $(".inputt").val('');
                $(".inputt2").val('');
                $("#txtPlacaVehiculo").val('');
                $(".canvas3").hide('fast');
                $(".video3").show('fast');
                $("#foto3").html("Tomar Foto!");
                $("#txtPlacaVehiculo3").val("");
                $("#txTAcompanantes3").val("");
                foto3 = 0;

            } else {

                MensajeConClase("Error al Guardar al Visitante", ".error")
            }
        });
    } else {

        MensajeConClase("Antes de Guardar debe Tomar La Foto", ".error")
    }
}

function MostrarRutas() {

    $.ajax({
        url: "../model/Parametros.php?traerrutas=si",
        dataType: "json",
        type: "post",
        success: function (datos) {


            $('.rutas').html("");
            $('.rutas').append("<option value=" + '' + ">" + 'Seleccione Ruta' + "</option>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('.rutas').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            };
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
// FUNCIONES MOSTRAR INFORMACION COMPLETA DEL VISITANTE
function mostrarInfoCompletaparticipante(id, tabla) {

    $.ajax({
        //HAGO LA LLAMADA AJAX Y LE ENVIO POR POST EL ID DEL VISITANTE Y POR GET LA FUNCION A EJECUTAR
        url: "../model/visitantesMetodos.php?buscarporid=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            // MUESTRO LOS DATOS EN LOS CAMPOS QUE LE CORRESPONDE EN EL FORMULARIO


            $(' ' + tabla + ' .fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
            $(' ' + tabla + ' .correovisitante').html(datos[0].correo);
            $(' ' + tabla + ' .celularvisitante').html(datos[0].celular);
            $(' ' + tabla + ' .identificacionevisitante').html(datos[0].identificacion);
            $(' ' + tabla + ' .tipoidvisitante').html(datos[0].tipo);
            $(' ' + tabla + ' .sanciones').html(datos[0].id_tipo_sancion);
            $(' ' + tabla + ' #txtplacavisitante').hide('fast');


            $(' ' + tabla + ' .nombrevisitante').html(datos[0].nombre + " " + datos[0].Segundo_Nombre);
            $(' ' + tabla + ' .apellidovisitante').html(datos[0].apellido + " " + datos[0].Segundo_Apellido);

        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function TraerValorEmpre() {
    return valorEmpresa;
}

function ActualizarFoto(id, data) {

    var info = data.split(",", 2);


    $.ajax({
        url: "../model/visitantesMetodos.php?foto=si",
        dataType: "json",
        data: {
            data: info[1],
            id: id,
        },
        type: "post",
        success: function (datos) {


        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
