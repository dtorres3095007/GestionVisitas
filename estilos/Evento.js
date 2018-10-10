var estilotablaEvento = 1;
var participante = 0;
var evento = 0;
var participantesele = 0;
var om = 0;
var idparticipante = 0;
var agrega = 1;
estilotablaeventore = 1;
var fecha = new Date();
var corrido = 0;
var x = 0;
var p = 0;
var capacidad = 0;
var Eventos_Filtro = [];
var fecha_buscada = "";
var nombre_coin = "",
    hentrada_coin = "",
    hsalida_coin = "",
    recurso_coin = "",
    id_coin = "";
var fechaentrada_coin = "";
var fechasalida_coin = "";
var Mensajes = ["Estamos Migrando Los Eventos", "No Tardamos", "Ya Casi Terminamos", "Espera Por favor...", "Ya puedes Trabajar..."];
$(document).ready(function () {

    $('.vehiculoevento1').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('.divplacaevento1').show('slow');
            $('#txTAcompanantesevento1').val(0);
            $('.placaevento1').val('');


        } else {
            $('.divplacaevento1').hide('fast');
            $('#txTAcompanantesevento1').val('');
            $('.placaevento1').val(0);


        }
    });
    $("#form-ingresar-visitante2").submit(function () {

        registrarVisitante2();

        return false;
    });
    $('.vehiculoevento2').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('.divplacaevento2').show('slow');
            $('#txTAcompanantesevento2').val(0);
            $('.placaevento2').val('');
            $('#txTAcompanantesevento2').attr("required", "true");
            $('.placaevento2').attr("required", "true");
        } else {
            $('.divplacaevento2').hide('fast');
            $('#txTAcompanantesevento2').val('');
            $('.placaevento2').val(0);
            $('#txTAcompanantesevento2').removeAttr("required", "true");
            $('.placaevento2').removeAttr("required", "true");

        }
    });
    EventosDeldiaGuardados(0);
    $("#tablaParticipantes").DataTable({
        //"processing": true,
        searching: false,
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $("#Mostar_Mis_Eventos").click(function () {
        listarEventosusuario("n", 2);
    })
    $(".buscarvisitante_evento").on('keyup', function (e) {

        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form

            var valor = $(this).val().trim();
            if (valor.length != 0) {
                MostrarParticipantes(valor);
            } else {

                $("#tablaParticipantes").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesDepar"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

                $("#tablaParticipantes").DataTable({
                    //"processing": true,
                    searching: false,
                    destroy: true,
                    "language": idioma,
                    dom: 'Bfrtip',
                    "buttons": []

                });
            }

        }
    });


    $("#Buscar_Eve_Nombre").keyup(function () {

        BuscarNombreFiltro($(this).val().trim());
    });

    $("#Habilitar_eve").click(function () {

        if (id_coin.trim().length == 0) {
            MensajeConClase("Seleccione Evento", ".error_eve")
        } else {


            GuardarEventosDesdeSiru(nombre_coin, recurso_coin, fechaentrada_coin, fechasalida_coin, id_coin, "1", capacidad);
        }
    });

    $("#Filtrar_fecha").click(function () {
        var fecha = $("#fecha_filtrar").val();

        listarEventosusuario(fecha, 1);
    });
    $("#Buscar_Evento_fecha").click(function () {
        $(".error_eve").hide("fast");
        var fecha = $("#fecha_filtrar_siru").val();
        fecha_buscada = fecha;

        if (fecha_buscada.trim().length == 0) {

            MensajeConClase("Seleccione Fecha", ".error_eve")
        } else {
            p = 0;
            MostrarMensajes();
            BuscarEventosSiruFecha("fecha=" + fecha);
        }
    })
    $("#Recargar").click(function () {
        var fecha = $("#fecha_filtrar").val();

        listarEventosusuario(fecha, 1);

    });
    // VALIDO QUE TENGO UN EVENTO SELECCIONADO ANTES DE CANCELAR
    $(".cerrarForPar").click(function () {
        $(".TablaEvenPar").show("slow");;
        $(".RegistrarParticipante").hide("slow");
        $(".foterMP").show("slow");
        $(".NuevoPartEv").show("slow");

    });
    $(".NuevoPartEv").click(function () {

        $(".RegistrarParticipante").show("slow");
        $(".TablaEvenPar").hide("slow");
        $(".foterMP").hide("slow");
        $(".NuevoPartEv").hide("slow");
    });
    $("#eliminar").click(function () {
        visitante = $("#idSeleccionado").val().trim();
        if (evento == 0) {
            $("#ModalMe").html("<p class='mc' style='text-align: center'>Antes de Continuar Debe Seleccionar<br> El Evento a Cancelar</p>");
            $("#ModalMensaje").modal();
        } else if (estadoevento == "EveCan") {
            $("#ModalMe").html("<p class='mc' style='text-align: center'>El evento ya esta cancelado</p>");
            $("#ModalMensaje").modal();
        } else {
            $(".mc").html("¿ Esta Seguro de Desea Cancelar el Evento ?");
            $("#salirEliminar").hide("fast");
            $(".botonesEliminar").show("slow");
            $("#ModalConfirmacionEliminar").modal();
        }
    });
    $("#btnEliminarEvento").click(function () {

        CancelarEvento(evento);
    });
    $("#modificar").click(function () {

        if (evento == 0) {
            $("#ModalMe").html("<p class='mc' style='text-align: center'>Antes de Continuar Debe Seleccionar<br> El Evento a Modificar</p>");
            $("#ModalMensaje").modal();
        } else {
            //  BuscarDepartamentoNombre(NombreEve);
            $("#modalModificarEvento").modal("show");
        }
    });

    $("#registrar-evento").submit(function () {

        GuardarEvento();
        return false;
    });
    $("#Modificar-evento").submit(function () {

        ModificarEvento();
        return false;
    });
    $("#cerrarinfo").click(function () {

        $("#tablaParticipantesmodal").hide("slow");


    });
    $("#marcarentrada").click(function () {
        if (participantesele == 0) {

            MensajeConClase("Debe seleccionar el participante", ".error");
        } else if (evento == 0) {
            MensajeConClase("Debe seleccionar el evento", ".error");
        } else {
            MarcarHoraEntrada(participantesele, evento);
        }

    });
    $("#retirarsi").click(function () {
        $(".confirmar").hide('fast');
        RetirarPaticipante(idparticipante);

    });
    $("#retirarno").click(function () {
        $(".confirmar").hide('fast');

    });
    $("#retirar").click(function () {
        if (idparticipante == 0) {

            MensajeConClase("Debe seleccionar el participante", ".error");

        } else {
            $(".error").hide('fast');
            $(".confirmar").show('fast');
        }

    });
    $("#cerrarinfoeve").click(function () {

        $("#tablaParticipanteeventosmodal").hide("slow");

    });
    $("#CambiarTabla").click(function () {
        var fecha = $("#fecha_filtrar").val();
        if (estilotablaEvento == 0) {
            estilotablaEvento = 1;
        } else {
            estilotablaEvento = 0;
        }

        listarEventosusuario(fecha, 1);

    });
    $("#AgregarParticipante").click(function () {
        if (participante == 0) {

            MensajeConClase("Antes de continuar debes Seleccionar el visitante", ".error");
        } else {
            var tipo_ingreso = $("#tipo_par").val();
            if ($('.vehiculoevento1').is(':checked')) {
                var placa = $("#txtPlacaVehiculoevento1").val();
                var acompa = $("#txTAcompanantesevento1").val();

                if (placa.length == 6) {
                    if (acompa.length == 0) {
                        acompa = 0;
                    }
                    if (tipo_ingreso.length != 0) {

                        registrarPaticipante(participante, evento, placa, acompa, tipo_ingreso);
                    } else {
                        MensajeConClase("Seleccione Tipo de Participante", ".error");
                    }
                    return false;
                } else {
                    MensajeConClase("Numero de Placa Invalida", ".error");

                }
            } else {
                if (tipo_ingreso.length != 0) {

                    registrarPaticipante(participante, evento, "------", 0, tipo_ingreso);
                } else {
                    MensajeConClase("Seleccione Tipo de Participante", ".error");
                }
            }
        }
    });

});

function GuardarEvento() {

    var formData = new FormData(document.getElementById("registrar-evento"));


    $.ajax({
        url: "../model/Evento.php?guardarevento=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == 1) {
            MensajeConClase("Error Fechas Incorrectas, Favor validar que la fecha de salida no sea inferior a la de entrada", ".error");

        } else if (datos == 2) {
            MensajeConClase("Complete Todos los Campos", ".error");
        } else if (datos == 3) {
            MensajeConClase("Evento Guardado", ".error");
            var fecha = $("#fecha_filtrar").val();
            listarEventosusuario(fecha, 1);
        } else if (datos == 4) {
            MensajeConClase("El departamento o area en la cual desea registrar el evento ya se encuentra reservado", ".error");

        } else if (datos == 5) {
            MensajeConClase("El Nombre del Evento ya existe en el sistema", ".error");

        } else if (datos == 6) {

            MensajeConClase("La Fecha de entrada debe ser mayor a la Fecha actual", ".error");
        } else if (datos == 7) {

            MensajeConClase("Ingrese Solo Numeros en los cupos disponibles", ".error");
        } else {

            MensajeConClase("Error Al Registrar el evento", ".error");
        }
    });


    return false;
}

function ModificarEvento() {

    var formData = new FormData(document.getElementById("Modificar-evento"));
    formData.append('id', evento);;

    $.ajax({
        url: "../model/Evento.php?modificarevento=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == 1) {

            MensajeConClase("Error Fechas Incorrectas, Favor validar que la fecha de salida no sea inferior a la de entrada", ".error");

        } else if (datos == 2) {

            MensajeConClase("Complete Todos los Campos", ".error");
        } else if (datos == 3) {

            var fecha = $("#fecha_filtrar").val();
            MensajeConClase("Evento Modificado", ".error");
            DesHabilitarModifica(".divmodifica");
            listarEventosusuario(fecha, 1);
        } else if (datos == 4) {

            MensajeConClase("El departamento o area en la cual desea registrar el evento ya se encuentra reservado", ".error");
        } else if (datos == 5) {

            MensajeConClase("El Nombre del Evento ya existe en el sistema", ".error");


        } else if (datos == 6) {

            MensajeConClase("La Fecha de entrada debe ser mayor a la Fecha actual", ".error");
        } else if (datos == 7) {

            MensajeConClase("Ingrese Solo Numeros en los cupos disponibles", ".error");
        } else if (datos == 10) {

            MensajeConClase("El Evento Solo lo puede modificar el usuario que lo crea", ".error");
        } else {

            MensajeConClase("Error Al Modificar el evento", ".error");
        }
    });


    return false;
}

function listarEventos() {

    $('#tablaeventos tbody').off('dblclick', 'tr');
    $('#tablaeventos tbody').off('click', 'tr');
    if (estilotablaeventore == 0) {
        var myTable = $("#tablaeventos").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Evento.php?mostrar=si",
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
                    "data": "Hora_Inicio"
                },
                {
                    "data": "Hora_Fin"
                },
                {
                    "data": "Duracion"
                },
                {
                    "data": "ubicacion"
                },
                {
                    "data": "idestado"
                },
                {
                    "data": "Cupos"
                },
                {
                    "data": "total"
                },
                {
                    "data": "Preinscripcion"
                },
                {
                    "data": "Descripcion"
                },
                {
                    "data": "estado_evento"
                },
                {
                    "data": "agrega"
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
        $('#tablaeventos tbody').on('click', 'tr', function () {
            var data = myTable.row(this).data();
            participante = 0;
            participantesele = 0;
            if (agrega == 1) {
                $(".NuevoPartEv").show("fast");

            } else {
                $(".NuevoPartEv").hide("fast");
            }

            $("#tablaeventos tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            evento = data[6];
            $("#tablaParticipantesmodal").hide("fast");
            $(".RegistrarParticipante").hide("fast");
            $(".TablaEvenPar").show("fast");
            $(".foterMP").show("fast");


            $("#tablaParticipantesmodal").hide("fast");
            $(".error").hide("fast");
            MostrarParticipantes("-1");
            $(".buscarvisitante_evento").val("");
        });
        $('#tablaeventos tbody').on('dblclick', 'tr', function () {

            var data = myTable.row(this).data();

            evento = data[6];

            $("#tablaParticipanteeventosmodal").hide("fast");
            $(".nombreevento").html(data[2]);
            $(".HoraInicioEvento").html(data[3]);
            $(".HoraFinEvento").html(data[4]);
            $(".DuracionEvento").html(data[5]);


            if (data[8] == 0) {
                $(".preinsevento").html("NO");
            } else {
                $(".preinsevento").html("SI");
            }

            $(".cuposEvento").html(data[7]);
            $(".UbicacionEvento").html(data[1]);
            $(".EstadoEvento").html(data[0]);
            $(".descripcionevento").html(data[9]);
            limpiarInfoCompletaparticipante("#participantesevento");
            MostrarParticipantesevento(evento);

        });

    } else {
        var myTable = $("#tablaeventos").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Evento.php?mostrar=si",
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
                    "data": "Hora_Inicio"
                },
                {
                    "data": "Hora_Fin"
                },
                {
                    "data": "Duracion"
                },
                {
                    "data": "ubicacion"
                },
                {
                    "data": "idestado"
                },
                {
                    "data": "Cupos"
                },
                {
                    "data": "total"
                },
                {
                    "data": "Preinscripcion"
                },
                {
                    "data": "Descripcion"
                },
                {
                    "data": "estado_evento"
                },
                {
                    "data": "agrega"
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
        $('#tablaeventos tbody').on('click', 'tr', function () {
            var data = myTable.row(this).data();
            participante = 0;
            participantesele = 0;
            if (agrega == 1) {
                $(".NuevoPartEv").show("fast");

            } else {
                $(".NuevoPartEv").hide("fast");
            }

            $("#tablaeventos tbody tr").removeClass("warning");
            $(this).attr("class", "warning");
            evento = data[6];

            $("#tablaParticipantesmodal").hide("fast");
            $(".RegistrarParticipante").hide("fast");
            $(".TablaEvenPar").show("fast");
            $(".foterMP").show("fast");


            $("#tablaParticipantesmodal").hide("fast");
            $(".error").hide("fast");
            MostrarParticipantes("-1");
            $(".buscarvisitante_evento").val("");
        });
        $('#tablaeventos tbody').on('dblclick', 'tr', function () {
            var data = myTable.row(this).data();

            evento = data[6];

            $("#tablaParticipanteeventosmodal").hide("fast");
            $(".nombreevento").html(data[2]);
            $(".HoraInicioEvento").html(data[3]);
            $(".HoraFinEvento").html(data[4]);
            $(".DuracionEvento").html(data[5]);


            if (data[8] == 0) {
                $(".preinsevento").html("NO");
            } else {
                $(".preinsevento").html("SI");
            }

            $(".cuposEvento").html(data[7]);
            $(".UbicacionEvento").html(data[1]);
            $(".EstadoEvento").html(data[0]);
            $(".descripcionevento").html(data[9]);
            limpiarInfoCompletaparticipante("#participantesevento");
            MostrarParticipantesevento(evento);

        });
    }
}

function MostrarParticipantes(evento) {

    $('#tablaParticipantes tbody').off('click', 'tr');
    $('#tablaParticipantes tbody').off('dblclick', 'tr');
    var table = $("#tablaParticipantes").DataTable({
        "destroy": true,
        searching: false,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarparticipantes=si",
            dataType: "json",
            data: {
                dato: evento,
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
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $('#tablaParticipantes tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaParticipantes tbody tr").removeClass("warning");

        $(this).attr("class", "warning");
        participante = data[3];
        mostrarInfoCompletaparticipante(participante, "#participantes")

    });
    $('#tablaParticipantes tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        $("#tablaParticipantesmodal").show("slow");

    });

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
// CON ESTA FUNCION LIMPIO LA TABLA DONDE MUESTRO LA INFORMACION DEL VISITANTES
function limpiarInfoCompletaparticipante(tabla) {


    $(' ' + tabla + ' .fotoVisitante').html("");
    $(' ' + tabla + ' .correovisitante').html("");
    $(' ' + tabla + ' .celularvisitante').html("");
    $(' ' + tabla + ' .identificacionevisitante').html("");
    $(' ' + tabla + ' .tipoidvisitante').html("");
    $(' ' + tabla + ' .sanciones').html("");

    $(' ' + tabla + ' .placaVisitante').html("");
    $(' ' + tabla + ' #txtplacavisitante').html("");

    $(' ' + tabla + ' #txtplacavisitante').html("");


    $(' ' + tabla + ' .nombrevisitante').html("");
    $(' ' + tabla + ' .apellidovisitante').html("");





}

//Funcion guardar un participante a un evento 
function registrarPaticipante(participante, evento, placa, acompa, tipo_ingreso) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/Evento.php?guardarparticipante=si",
        dataType: "json",
        data: {
            participante: participante,
            evento: evento,
            placa: placa,
            acompa: acompa,
            tipo: tipo_ingreso,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == 1) {
            MensajeConClase("Participante Agregado con exito", ".error");
            $("#txtPlacaVehiculoevento1").val("");
            $("#txTAcompanantesevento1").val(0);
            $('.vehiculoevento1').prop("checked", "");
            $('.divplacaevento1').hide('fast');
            return true;
        } else if (datos == 2) {
            MensajeConClase("El participante ya esta registrado en el evento", ".error");
            return true;
        } else if (datos == 3) {
            MensajeConClase("No se puede Agregar el participante ya que es necesario una Pre-Inscripcion por parte del responsable del evento", ".error");
            return true;
        } else if (datos == 4) {
            MensajeConClase("No hay Cupos disponibles", ".error");
            return true;
        } else if (datos == 5) {

            MensajeConClase("Aun no es el dia del evento", ".error");
            return true;
        } else if (datos == 6) {

            MensajeConClase("El evento ya ha terminado", ".error");
            return true;
        } else if (datos == 7) {

            MensajeConClase("El evento Esta cancelado", ".error");
            return true;
        } else {
            MensajeConClase("Error al Guardar al Participante", ".error");
        }
    });

}

function MostrarParticipantesevento(evento) {

    $(".confirmar").hide('fast');
    $('#tablaParticipantesevento tbody').off('click', 'tr');
    $('#tablaParticipantesevento tbody').off('dblclick', 'tr');
    var table = $("#tablaParticipantesevento").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarparticipantesEvento=si",
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
                "data": "Hora_Ingreso"
            },
            {
                "data": "tipo_participante"
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
    $('#tablaParticipantesevento tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaParticipantesevento tbody  tr").removeClass("warning");
        $(this).attr("class", "warning");
        participantesele = data[3];
        idparticipante = data[5];
        mostrarInfoCompletaparticipante(participantesele, "#participantesevento")

    });
    $('#tablaParticipantesevento tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        $("#tablaParticipanteeventosmodal").show("slow");

    });

    $("#participantesevento").modal("show");
} //Con esta funcion marco la hora de entrada de un participante en un evento
function MarcarHoraEntrada(participante, evento) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/Evento.php?marcarentrada=si",
        dataType: "json",
        data: {
            participante: participante,
            evento: evento,
        },
        type: "post",
    }).done(function (datos) {

        if (datos == 1) {

            MensajeConClase("Error Al Cargar El evento", ".error");
            return true;
        } else if (datos == 2) {

            MensajeConClase("Aun no es el dia del evento", ".error");
            return true;
        } else if (datos == 3) {

            MensajeConClase("El evento ya ha terminado", ".error");
            return true;
        } else if (datos == 4) {

            MensajeConClase("Error al Cargar el participante", ".error");
            return true;
        } else if (datos == 5) {

            MensajeConClase("El Participante ya esta en el evento", ".error");
            return true;
        } else if (datos == 6) {
            MostrarParticipantesevento(evento);

            MensajeConClase("Hora de entrada Marcada con exito", ".error");
            return true;
        } else {


            MensajeConClase("Error al Marcar la hora de entrada", ".error");
        }
    });

}

function RetirarPaticipante(participante) {



    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/Evento.php?retirar=si",
        dataType: "json",
        data: {
            participante: participante,
        },
        type: "post",
    }).done(function (datos) {


        MensajeConClase("Participante Retirado con exito", ".error");
        MostrarParticipantesevento(evento);

    });

}

function listarEventosusuario(buscar, consulta) {

    $('#tablaeventosmodulo tbody').off('dblclick', 'tr');
    $('#tablaeventosmodulo tbody').off('click', 'tr');
    if (estilotablaEvento == 0) {
        var myTable = $("#tablaeventosmodulo").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Evento.php?mostrarusuario=si",
                dataType: "json",
                type: "post",
                data: {
                    buscar: buscar,
                    consulta: consulta,
                }
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
                    "data": "Hora_Inicio"
                },
                {
                    "data": "Hora_Fin"
                },
                {
                    "data": "Duracion"
                },
                {
                    "data": "ubicacion"
                },
                {
                    "data": "idestado"
                },
                {
                    "data": "Cupos"
                },
                {
                    "data": "total"
                },
                {
                    "data": "Preinscripcion"
                },
                {
                    "data": "Descripcion"
                },
                {
                    "data": "estado_evento"
                },
                {
                    "data": "agrega"
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
        $('#tablaeventosmodulo tbody').on('click', 'tr', function () {
            var data = myTable.row(this).data();
            participante = 0;
            participantesele = 0;
            estadoevento = data[10];

            if (agrega == 1) {
                $(".NuevoPartEv").show("fast");
                /* if (data[8] == 0) {
                     $("#marcarentrada").hide("fast");
                 } else {
                     $("#marcarentrada").show("fast");
                 }*/
            } else {
                $(".NuevoPartEv").hide("fast");
            }
            NombreEve = data[1];

            $("#NombreModiEven").val(data[2]);
            $("#hentradaModi").val(data[3]);
            $("#hsalidaModi").val(data[4]);
            $("#cbxubicacionModiEve").val(data[1]);
            $("#txtcuposModi").val(data[7]);
            $("#DescricionModi").val(data[9]);
            $("#preinscripcionModi").val(data[8]);
            $("#cbxEstadoEvModi").val(data[10]);

            if (data[8] == 0) {
                $('#preinscripcionModi').prop("checked", "");
            } else {
                $('#preinscripcionModi').prop("checked", "checked");
            }

            evento = data[6];

            $("#tablaeventosmodulo tbody tr").removeClass("warning");
            $(this).attr("class", "warning");


            $("#tablaParticipantesmodal").hide("fast");
            $(".error").hide("fast");
            HabilitarModifica(".divmodifica");
            MostrarParticipantes("-1");
            $(".buscarvisitante_evento").val("");
        });
        $('#tablaeventosmodulo tbody').on('dblclick', 'tr', function () {
            var data = myTable.row(this).data();

            evento = data[6];

            $("#tablaParticipanteeventosmodal").hide("fast");
            $(".nombreevento").html(data[2]);
            $(".HoraInicioEvento").html(data[3]);
            $(".HoraFinEvento").html(data[4]);
            $(".DuracionEvento").html(data[5]);


            if (data[8] == 0) {
                $(".preinsevento").html("NO");
            } else {
                $(".preinsevento").html("SI");
            }

            $(".cuposEvento").html(data[7]);
            $(".UbicacionEvento").html(data[1]);
            $(".EstadoEvento").html(data[0]);
            $(".descripcionevento").html(data[9]);

            limpiarInfoCompletaparticipante("#participantesevento");
            MostrarParticipantesevento(evento);

        });
    } else {
        var myTable = $("#tablaeventosmodulo").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/Evento.php?mostrarusuario=si",
                dataType: "json",
                type: "post",
                data: {
                    buscar: buscar,
                    consulta: consulta,
                }
            },
            //"processing": true,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "Hora_Inicio"
                },
                {
                    "data": "Hora_Fin"
                },
                {
                    "data": "Duracion"
                },
                {
                    "data": "ubicacion"
                },
                {
                    "data": "idestado"
                },
                {
                    "data": "Cupos"
                },
                {
                    "data": "total"
                },
                {
                    "data": "Preinscripcion"
                },
                {
                    "data": "Descripcion"
                },
                {
                    "data": "estado_evento"
                },
                {
                    "data": "agrega"
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
        $('#tablaeventosmodulo tbody').on('click', 'tr', function () {
            var data = myTable.row(this).data();
            participante = 0;
            participantesele = 0;
            estadoevento = data[10];
            if (agrega == 1) {
                $(".NuevoPartEv").show("fast");
                /* if (data[8] == 0) {
                     $("#marcarentrada").hide("fast");
                 } else {
                     $("#marcarentrada").show("fast");
                 }*/
            } else {
                $(".NuevoPartEv").hide("fast");
            }
            NombreEve = data[1];

            $("#NombreModiEven").val(data[2]);
            $("#hentradaModi").val(data[3]);
            $("#hsalidaModi").val(data[4]);
            $("#txtcuposModi").val(data[7]);
            $("#DescricionModi").val(data[9]);
            $("#preinscripcionModi").val(data[8]);
            $("#cbxEstadoEvModi").val(data[10]);
            $("#cbxubicacionModiEve").val(data[1]);



            if (data[8] == 0) {
                $('#preinscripcionModi').prop("checked", "");
            } else {
                $('#preinscripcionModi').prop("checked", "checked");
            }


            evento = data[6];

            $("#tablaeventosmodulo tbody tr").removeClass("warning");
            $(this).attr("class", "warning");


            $("#tablaParticipantesmodal").hide("fast");
            $(".error").hide("fast");
            HabilitarModifica(".divmodifica");
            MostrarParticipantes("-1");
            $(".buscarvisitante_evento").val("");
        });
        $('#tablaeventosmodulo tbody').on('dblclick', 'tr', function () {
            var data = myTable.row(this).data();

            evento = data[6];

            $("#tablaParticipanteeventosmodal").hide("fast");
            $(".nombreevento").html(data[2]);
            $(".HoraInicioEvento").html(data[3]);
            $(".HoraFinEvento").html(data[4]);
            $(".DuracionEvento").html(data[5]);

            if (data[8] == 0) {
                $(".preinsevento").html("NO");
            } else {
                $(".preinsevento").html("SI");
            }


            $(".cuposEvento").html(data[7]);
            $(".UbicacionEvento").html(data[1]);
            $(".EstadoEvento").html(data[0]);
            $(".descripcionevento").html(data[9]);
            limpiarInfoCompletaparticipante("#participantesevento");
            MostrarParticipantesevento(evento);

        });
    }
}

function estadoAgrega() {
    agrega = 0;
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * FUNCION ELIMINAR EVENTOS PIDO COMO PARAMETRO AL ID DEL EVENTO A CANCELAR
 */
function CancelarEvento(id) {

    $.ajax({
        // LLAMO AL AJAX Y ENVIO POR POST EL ID DEL VISITANTE A ELIMINAR Y POR GET LA FUNCION QUE VA A JECUTAR A VisitantesMetodos.php
        url: "../model/Evento.php?cancelar=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            // DEPENDIENDO DEL DATO QUE ME RETORNE LA FUNCION QUE EJECUTE EN EL PHP LE INFORMO AL USUARIO
            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Evento Cancelado Con Exito");
                $(".mc").show("slow");
                $("#idSeleccionado").val("");
                visitante = 0;
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");

                //  listarEventosusuario()
            } else {
                $(".mc").hide("fast");
                $(".mc").html("Error Al Cancelar El Evento");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
            }
        },
        error: function () {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Cancelar El Evento");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
    });

}

function BuscarDepartamentoNombre(nombre) {

    $.ajax({
        // LLAMO AL AJAX Y ENVIO POR POST EL ID DEL VISITANTE A ELIMINAR Y POR GET LA FUNCION QUE VA A JECUTAR A VisitantesMetodos.php
        url: "../model/Parametros.php?BuscarNombreParametro=si",
        dataType: "json",
        data: {
            nombre: nombre,
        },
        type: "post",
        success: function (datos) {
            $("#cbxubicacionModiEve").val(datos.id);
        },
        error: function () {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Buscar la Ubicacion del Evento");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
    });
}

function CambiarEstiloTablaEve() {
    if (estilotablaeventore == 0) {
        estilotablaeventore = 1;
    } else {
        estilotablaeventore = 0;
    }
    listarEventos();

}

function GuardarEventosDia(consulta) {
    MostrarMensajes()
    $.ajax({
        url: "../Admin/siru.php",
        dataType: "json",
        data: {
            consulta: consulta,
        },
        type: "post",
        success: function (datos) {


            for (var i = 0; i <= datos.length - 1; i++) {
                var fechaentrada = datos[i].dia + " " + datos[i].hora_inicial;
                var fechasalida = datos[i].dia + " " + datos[i].hora_final;
                var recurso = datos[i].recurso + ", " + datos[i].bloque;

                GuardarEventosDesdeSiru(datos[i].nombre_evento, recurso, fechaentrada, fechasalida, datos[i].reserva_id, "2", datos[i].capacidad);

            }
            p = 3;


        },
        error: function () {


            console.log('Something went wrong', status, err);

        }
    });

}

function GuardarEventosDesdeSiru(nombre, ubicacion, hentrada, hsalida, id, tipo, capacidad) {

    $.ajax({
        url: "../model/Evento.php?guardarevento2=si",
        dataType: "json",
        data: {
            nombre: nombre,
            ubicacion: ubicacion,
            horaEntrada: hentrada,
            horaSalida: hsalida,
            tipo: tipo,
            id: id,
            capacidad: capacidad,
        },
        type: "post",
        success: function (datos) {

            if (datos == 0) {
                MensajeConClase("El Evento ya fue Habilitado Anteriormente", ".error_eve");
            } else {
                MensajeConClase("Evento Habilitado Con Exito", ".error_eve");
            }



            return false;

        },
        error: function () {


            console.log('Something went wrong', status, err);

        }
    });

}

function EventosDeldiaGuardados(repetir) {
    return;
    $.ajax({
        url: "../model/Evento.php?BuscarDia=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth() + 1; //hoy es 0!
            var yyyy = hoy.getFullYear();

            if (dd < 10) {
                dd = '0' + dd
            }

            if (mm < 10) {
                mm = '0' + mm
            }
            hoy = yyyy + "-" + mm + "-" + dd;

            if (datos == hoy || repetir == 1) {

                GuardarEventosDia("fecha=" + hoy);
            }
            return false;

        },
        error: function () {


            console.log('Something went wrong', status, err);

        }
    });
}

function BuscarEventosSiruFecha(fecha) {

    $.ajax({
        url: "../Admin/siru.php",
        dataType: "json",
        data: {
            consulta: fecha,
        },
        type: "post",
        success: function (datos) {

            Eventos_Filtro = datos;
            $('#Coincidencias tbody').html("");

            for (var i = 0; i <= datos.length - 1; i++) {
                var fechaentrada = datos[i].dia + " " + datos[i].hora_inicial;
                var fechasalida = datos[i].dia + " " + datos[i].hora_final;

                var recurso = datos[i].recurso + ", " + datos[i].bloque;
                $('#Coincidencias tbody').append("<tr onclick='javascript:myScript();'><td class='largo'>" + datos[i].nombre_evento + "</td><td class='medio'>" + datos[i].hora_inicial + "</td><td class='medio'>" + datos[i].hora_final + "</td><td class='largo'>" + recurso + "</td><td class='corto'>" + datos[i].reserva_id + "</td><td>" + datos[i].capacidad + "</td></tr>");


            }
            if (datos.length == 0) {

                $('#Coincidencias tbody').html(" <tr><td colspan='6'>Ningun dato Disponible en la tabla</td></tr>");
                $('#Buscar_En_Filtro').hide("fast")
            } else {
                $("#Coincidencias tbody tr").on("click", function () {})
                $('#Buscar_En_Filtro').show("fast")
            }
            p = 3;

            ;


        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

var timerEv;

function BuscarNombreFiltro(nombre) {
    var encontro = 0;
    if (nombre.trim().length == 0) {
        BuscarTodo()
    } else {
        $('#Coincidencias tbody').html("");

        for (var i = 0; i <= Eventos_Filtro.length - 1; i++) {

            var mensaje = Eventos_Filtro[i].nombre_evento.trim().toLowerCase();
            var posicion = mensaje.indexOf(nombre.trim().toLowerCase());


            if (posicion >= 0) {
                encontro = 1;
                var fechaentrada = Eventos_Filtro[i].dia + " " + Eventos_Filtro[i].hora_inicial;
                var fechasalida = Eventos_Filtro[i].dia + " " + Eventos_Filtro[i].hora_final;

                var recurso = Eventos_Filtro[i].recurso + ", " + Eventos_Filtro[i].bloque;
                $('#Coincidencias tbody').append("<tr onclick='javascript:myScript();'><td class='largo'>" + Eventos_Filtro[i].nombre_evento + "</td><td class='medio'>" + Eventos_Filtro[i].hora_inicial + "</td><td class='medio'>" + Eventos_Filtro[i].hora_final + "</td><td class='largo'>" + recurso + "</td><td class='corto'>" + Eventos_Filtro[i].reserva_id + "</td><td>" + Eventos_Filtro[i].capacidad + "</td></tr>");

            }
        }
        $("#Coincidencias tbody tr").on("click", function () {})
        if (encontro == 0) {
            $('#Coincidencias tbody').html(" <tr><td colspan='6'>Ningun dato Disponible en la tabla</td></tr>");
        }
    }
}

function BuscarTodo(nombre) {
    $('#Coincidencias tbody').html("");

    for (var i = 0; i <= Eventos_Filtro.length - 1; i++) {
        var fechaentrada = Eventos_Filtro[i].dia + " " + Eventos_Filtro[i].hora_inicial;
        var fechasalida = Eventos_Filtro[i].dia + " " + Eventos_Filtro[i].hora_final;

        var recurso = Eventos_Filtro[i].recurso + ", " + Eventos_Filtro[i].bloque;
        $('#Coincidencias tbody').append("<tr onclick='javascript:myScript();'><td class='largo'>" + Eventos_Filtro[i].nombre_evento + "</td><td class='medio'>" + Eventos_Filtro[i].hora_inicial + "</td><td class='medio'>" + Eventos_Filtro[i].hora_final + "</td><td class='largo'>" + recurso + "</td><td class='corto'>" + Eventos_Filtro[i].reserva_id + "</td><td>" + Eventos_Filtro[i].capacidad + "</td></tr>");


    }
    $("#Coincidencias tbody tr").on("click", function () {})
}

function MostrarMensajes() {

    if (p < Mensajes.length && x == 0) {

        $('#mensajeEvento').html(Mensajes[p]);
        $('#MensajeEje').css("height", "10px");
        $('#MensajeEje').fadeIn(1000);
        clearTimeout(timerEv);
        $('#mensajeEvento').hide('fast');
        $('#mensajeEvento').fadeIn(3000);


        timerEv = setTimeout(function () {
            $('#mensajeEvento').hide("fast");

            p++;

            MostrarMensajes(p);
        }, 4000);
    } else {
        listarEventos();
        $('#MensajeEje').hide("fast");

    }
}

function myScript() {
    var i = 0;

    $("#Coincidencias tbody tr").on("click", function () {
        $("#Coincidencias tbody tr").css("background-color", "white");
        $(this).css("background-color", "#fdfdd3");
        if (i == 0) {
            $(this).each(function (index) {


                $(this).children("td").each(function (index2) {
                    switch (index2) {
                        case 0:
                            nombre_coin = $(this).text();
                            break;
                        case 1:
                            hentrada_coin = $(this).text();
                            fechaentrada_coin = fecha_buscada + " " + hentrada_coin;
                            break;
                        case 2:
                            hsalida_coin = $(this).text();
                            fechasalida_coin = fecha_buscada + " " + hsalida_coin;
                            break;
                        case 3:
                            recurso_coin = $(this).text();

                            break;
                        case 4:
                            id_coin = $(this).text();

                            break;
                        case 5:
                            capacidad = $(this).text();

                            break;
                    }


                })

            })

            i = 1;
        }
    });

}

//Funcion guardar visitante
function registrarVisitante3() {
    if (foto2 != 0) {

        var s = 0;
        if ($('.vehiculoevento2').is(':checked')) {
            var placa = $("#txtPlacaVehiculoevento2").val();
            if (placa.length != 6) {
                MensajeConClase("Numero de Placa Invalida", ".error");
                s = 1;
            }
        }
        if (s == 0) {
            //tomamos el formulairo ingresar visitante
            var formData = new FormData(document.getElementById("form-ingresar-visitante3"));
            var data = canvas2.toDataURL("image/jpeg");
            var info = data.split(",", 2);

            formData.append("data", info[1]);
            formData.append("evento", evento);
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
                    $(".canvas2").hide('fast');
                    $(".video2").show('fast');
                    $("#foto2").html("Tomar Foto!");
                    foto2 = 0;
                    listarVisitantes();
                } else if (datos == -1) {
                    MensajeConClase("Participante Agregado con exito", ".error");

                    return true;
                } else if (datos == -2) {
                    MensajeConClase("El participante ya esta registrado en el evento", ".error");
                    return true;
                } else if (datos == -3) {
                    MensajeConClase("No se puede Agregar el participante ya que es necesario una Pre-Inscripcion por parte del responsable del evento", ".error");
                    return true;
                } else if (datos == -4) {
                    MensajeConClase("No hay Cupos disponibles", ".error");
                    return true;
                } else if (datos == -5) {

                    MensajeConClase("Aun no es el dia del evento", ".error");
                    return true;
                } else if (datos == -6) {

                    MensajeConClase("El evento ya ha terminado", ".error");
                    return true;
                } else if (datos == -7) {

                    MensajeConClase("El evento Esta cancelado", ".error");
                    return true;
                } else {
                    MensajeConClase("Error al Guardar al Participante", ".error");
                }
            });
        }
    } else {

        MensajeConClase("Antes de Guardar debe Tomar La Foto", ".error")
    }
}

function registrarVisitante2() {

    var s = 0;
    if ($('.vehiculoevento2').is(':checked')) {
        var placa = $("#txtPlacaVehiculoevento2").val();
        if (placa.length != 6) {
            MensajeConClase("Numero de Placa Invalida", ".error");
            s = 1;
        }
    }
    if (s == 0) {
        //tomamos el formulairo ingresar visitante
        var formData = new FormData(document.getElementById("form-ingresar-visitante2"));
        formData.append("evento", evento);
        //  Enviamos el formulario a nuestro archivo php con parametro guardar     
        $.ajax({
            url: "../model/visitantesMetodos.php?guardar2=si",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (datos) {

            if (datos == 1) {

                MensajeConClase("Los campos Nombres, Apellidos e identificacion son obligatorios", ".error")
                return true;
            } else if (datos == 2) {

                MensajeConClase("Debe Ingresar Solo letras en el Nombres y Apellidos", ".error")
                return true;
            } else if (datos == 3) {

                MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error")
                return true;
            } else if (datos == 4) {


                MensajeConClase("Visitante Guardado Con exito", ".error")
                $(".inputt").val('');
                $(".inputt2").val('');
                $("#txtPlacaVehiculo").val('');


            } else if (datos == -1) {
                MensajeConClase("Participante Agregado con exito", ".error");

                return true;
            } else if (datos == -2) {
                MensajeConClase("El participante ya esta registrado en el evento", ".error");
                return true;
            } else if (datos == -3) {
                MensajeConClase("No se puede Agregar el participante ya que es necesario una Pre-Inscripcion por parte del responsable del evento", ".error");
                return true;
            } else if (datos == -4) {
                MensajeConClase("No hay Cupos disponibles", ".error");
                return true;
            } else if (datos == -5) {

                MensajeConClase("Aun no es el dia del evento", ".error");
                return true;
            } else if (datos == -6) {

                MensajeConClase("El evento ya ha terminado", ".error");
                return true;
            } else if (datos == -7) {

                MensajeConClase("El evento Esta cancelado", ".error");
                return true;
            } else {
                MensajeConClase("Error al Guardar al Participante", ".error");
            }
        });

    }
}
