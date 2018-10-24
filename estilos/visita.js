// DECLAR LAS VARIABLES NECESARIAS 
// ESTA VARIABLE GUARDA EL ID DE LA VISITA SELECCIOANDA
fotof = 0;
var ideVisitante;
var datos_identidades = "";
var listaRe = 0;
var esreser = 0;
participanteVisita = 0;
var idVisita = 0;
var visita = 0;
var bclase = "";
var idVisitante = 0;
var infovisitantevisitas = 0;
var tiporecarga = 0;
var idSancion = 0;
var perfiles = [];
var infVisitante = [];
// EN ESTA VARIABLE GUARDO EL ESTILO DE LA TABLA DEL MODULO DE VISITAS
var estilotablavisitas = 0;
// EN ESTA VARIABLE GUARDO EL ESTILO DE LA TABLA DEL MODULO DE RESERVAS
var estilotablareserva = 0;
var VisitantesVisita = 0;
var cargo = 0;
var reporteSele = -1;
var empresa = "cuc";
var listorep = 0;
var Reportes = ["Los Mas Visitados", "Departamentos Mas Visitados", "Los Mas Visitados Por departamento", "Visitantes Con Mas Visitas", "Meses Mas Visitados", "Visitantes Por Departamento"];
$(document).ready(function () {

    $('.vehiculo4').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('.divplaca4').show('slow');
            $('#txtAcompanantes4').val('');
            $('.placa4').val('');
            $('.placa4').attr('required', 'true');
            $('#txtAcompanantes4').attr('required', 'true');

        } else {
            $('.divplaca4').hide('fast');
            $('#txtAcompanantes4').val('');
            $('.placa4').val('');
            $('.placa4').removeAttr('required', 'false');
            $('#txtAcompanantes4').removeAttr('required', 'false');

        }
    });

    $("#btnAsignarPersona").click(function () {
        var empleado = false;
        var ic = perfiles[0];
        $.each(perfiles, function (index, value) {
            if (value.toUpperCase() == "EMPLEADO") {
                empleado = true;
            }
        });
        if (empleado) {
            DepartaSeleccionado = 128;
        } else {
            DepartaSeleccionado = 127;
        }
        var docPersona = $("#txtBuscarPersona").val();
        existeVisitante(docPersona);
    })

    $("#btn_buscar_visitante_san").click(function () {
        var dato = $("#txt_buscar_visitante_san").val().trim();
        if (dato.length > 5) {
            listarVisitantesSanciones(dato);
        } else {
            MensajeConClase("Ingrese Dato de la persona a buscar con mas informacion", ".error_busqueda");
        }
    });

    $("#btnBuscarPersona").click(function () {
        if ($("#txtBuscarPersona").val() != "") {
            buscarPersona($("#txtBuscarPersona").val());

        } else {
            MensajeConClase("Ingrese #identificación de la persona a buscar", ".error_depar");
        }
    });
    $("#btnBuscarentradas").click(function () {
        if ($("#txtBuscarPersona").val() != "") {
            MostrarParticipantesDepartamentoEsp("", $("#txtBuscarPersona").val())
        } else {
            MensajeConClase("Ingrese #identificación de la persona a buscar", ".error_depar");
        }
    });

    $('.filtrarfecha').on('click', function () {

        if ($(this).is(':checked')) {
            $('.fechasFiltro').show('slow');
        } else {
            $('.fechasFiltro').hide('slow');

        }
    });


    $("#tiporeporte").change(function () {
        reporteSele = $("#tiporeporte").val();
        if (reporteSele == 6 || reporteSele == 3) {
            $(".departamentos").show("slow");
        } else {
            $(".departamentos").hide("slow");
        }
    });



    $("#GenerarReporte").click(function () {
        var finicio = $("#finicio").val().trim();
        var ffinal = $("#ffinal").val().trim();

        if (reporteSele == -1) {
            MensajeConClase("Seleccione Tipo de Reporte", ".error");
        } else {

            var val = 0;
            if ($(".filtrarfecha").is(':checked')) {
                if (finicio.length == 0 || ffinal.length == 0) {
                    MensajeConClase("Por favor ingresar las fechas para el filtro", ".error");
                    return false;
                }
            } else {
                ffinal = "";
                finicio = "";
            }



            $("#TituloGrafico").html("");
            $("#TituloGrafico").html(" " + Reportes[reporteSele - 1]);

            if (reporteSele == 1) {
                listarlosmasVisitados(finicio, ffinal);
                EnviarSql("1", finicio, ffinal, 0);
                $(".tablareportesVisitantes").hide("slow");
                $(".tablareportesEmpleados").show("slow");
            } else if (reporteSele == 6) {
                var dep = $(".departamentos").val();
                if (dep == "") {
                    MensajeConClase("Seleccione Departamento", ".error");
                } else {
                    listarVisitantesDepartamento(dep, finicio, ffinal);
                    EnviarSql("6", finicio, ffinal, dep);
                    $(".tablareportesEmpleados").hide("slow");
                    $(".tablareportesVisitantes").show("slow");

                }
            } else if (reporteSele == 3) {
                var dep = $(".departamentos").val();
                if (dep == "") {
                    MensajeConClase("Seleccione Departamento", ".error");
                } else {

                    listarlosmasVisitadosDepartamento(dep, finicio, ffinal);
                    EnviarSql("3", finicio, ffinal, dep);
                    $(".tablareportesEmpleados").hide("slow");
                    $(".tablareportesVisitantes").show("slow");

                }
            } else if (reporteSele == 2) {
                listarDepartamentosMasVisitados(finicio, ffinal)
                EnviarSql("2", finicio, ffinal, 0);
                $(".tablareportesEmpleados").hide("slow");
                $(".tablareportesVisitantes").show("slow");
            } else if (reporteSele == 4) {
                listarVisitantesMasVisitas(finicio, ffinal);
                EnviarSql("4", finicio, ffinal, 0);
                $(".tablareportesEmpleados").hide("slow");
                $(".tablareportesVisitantes").show("slow");
            }

        }
    });
    $("#MostrarGraficas").click(function () {
        if (listorep != 1) {


            $("#mensajed").html("<p><b>No ha Generado el reporte</b></p>");
            $("#ModalMensajevisita").modal("show")
        } else {
            $("#myModalGrafica").modal("show");
        }
    })

    $(".buscarvisitante2").on('keyup', function (e) {

        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            participanteVisita = 0;
            var valor = $(this).val().trim();
            if (valor.length != 0) {
                MostrarParticipantesVisita(valor);

            } else {
                participanteVisita = 0;
                $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

                $("#tablaParticipantesVisita").DataTable({
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

    canvasf = document.getElementById("canvasf");
    $('#fotof').click(function () {
        if (fotof == 0) {
            $(".videof").hide('fast');
            $(".canvasf").show('fast');
            $("#fotof").html("Nueva Foto!");
            fotof = 1;
        } else {
            $(".canvasf").hide('fast');
            $(".videof").show('fast');
            $("#fotof").html("Tomar Foto!");
            fotof = 0;
        }
    });



    $("#tablaParticipantesVisita").DataTable({
        //"processing": true,
        searching: false,
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });

    $("#Recargarreserva").click(function () {
        if (listaRe == 0) {
            listarVisitasid();
        } else {
            NuevaVisitaTodo();
            MostrarVisitadosVisita();
            MostrarVisitantesVisita()
        }

    });
    $(".asignarvisitante").click(function () {
        if (participanteVisita == 0) {
            MensajeConClase("Antes de continuar debes Seleccionar el visitante", ".error");
        } else {
            $(".error").hide("fast");
            AgregarVisitanteVisita(participanteVisita, idVisita);
        }
    });

    $("#form-ingresar-visitante5").submit(function () {
        registrarVisitante5();
        return false;
    });
    $("#form-ingresar-visitante6").submit(function () {
        registrarVisitante6();
        return false;
    });
    $(".nuevovisitante").click(function () {
        $(".cerrarinfo").hide("slow");
        $(".RegistrarParticipantevisita").show("fast");
        $(".modalvisitaRegistro").hide("slow");
        $("#tablaVisitanteVisitaModal").hide("slow");

    });
    $(".cerrarForParvisita").click(function () {

        $(".cerrarinfo").hide("slow");
        $(".modalvisita").hide("slow");
        $("#tablaVisitanteVisitaModal").hide("slow");
        $(".RegistrarParticipantevisita").hide("slow");
        $(".modalvisitaRegistro").show("slow");


    });

    $("#AgregarVisitantes").click(function () {
        $(".cerrarinfo").hide("slow");
        $(".modalvisita").hide("slow");
        $(".modalvisitaRegistro").show("slow");
        $("#tablaVisitanteVisitaModal").hide("slow");

    });
    $("#retirarVisitante").click(function () {

        if (VisitantesVisita == 0) {
            MensajeConClase("Antes de continuar debes Seleccionar el visitante", ".error");

        } else {
            $(".error").hide("fast");
            $(".confirmarvisitaparti").show("fast");
        }
    });
    $("#retirarnovisitaparti").click(function () {

        $(".confirmarvisitaparti").hide("slow");

    });
    $("#retirarsivisitaparti").click(function () {

        if (VisitantesVisita == 0) {
            MensajeConClase("Antes de continuar debes Seleccionar el visitante", ".error");

        } else {

            retirarVisitanteVisita(VisitantesVisita, idVisita);

        }

    });
    $(".cancelarasignacon").click(function () {
        $(".cerrarinfo").show("slow");
        $(".modalvisita").show("slow");
        $(".modalvisitaRegistro").hide("slow");
        $("#tablaVisitanteVisitaModal").hide("slow");

        $("input").val("");
        $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

        $("#tablaParticipantesVisita").DataTable({
            //"processing": true,
            "destroy": true,
            searching: false,
            "language": idioma,
            dom: 'Bfrtip',
            "buttons": []

        });
    });


    $("#Recargarvisita").click(function () {
        if (tiporecarga == 1) {

            listarVisitas();
        } else if (tiporecarga == 0) {
            empresa = TraerValorEmpre();
            ListarDepartamentos(empresa);

        } else if (tiporecarga == 3) {


            EventosDeldiaGuardados(1);

        } else {

            listarVisitantesSanciones("5D4EW5F7W8E7");
        }

    });
    $("#RecargarReporte").click(function () {
        listarlosmasVisitados();;

    });
    $('#btnRecargar2').click(function () {

        visitantesele = $("#txtidVisitante").val();

        mostrarInfoCompletaVisitanteModificarVisita(visitantesele);
        $(".videomodi").hide('fast');
        $(".canvasmodi").hide('fast');
        $(".imagenactual").show('fast');
        $(".error").hide('fast');
        MismaFoto = 1;

    });



    $('#mostrarinfovisitante').click(function () {


        if (infovisitantevisitas == 0) {
            $('.MostrarVisitantesInfo').show('slow');
            infovisitantevisitas = 1;
            $('#mostrarinfovisitante').removeAttr('class', 'glyphicon glyphicon-eye-open');
            $('#mostrarinfovisitante').attr('class', 'glyphicon glyphicon-eye-close');
        } else {
            $('.MostrarVisitantesInfo').hide('slow');
            infovisitantevisitas = 0;
            $('#mostrarinfovisitante').removeAttr('class', 'glyphicon glyphicon-eye-close');
            $('#mostrarinfovisitante').attr('class', 'glyphicon glyphicon-eye-open');

        }
    });

    // CUANDO SE CARGA LA PAGINA DE VISITAS LISTO LAS VISITAS


    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


    // UNA VES PRECIONADO #CambiarTabla CAMBIO EL ESTILO DE LA TABLA Y LLAMO NUEVAMENTE AL listarVisitas


    $("#CambiarTabla").click(function () {
        if (estilotablavisitas == 0) {
            estilotablavisitas = 1;
        } else {
            estilotablavisitas = 0;
        }
        if (tiporecarga == 1) {

            listarVisitas();
        } else if (tiporecarga == 0) {

            CambiarEstiloTablaDepa();
        } else if (tiporecarga == 3) {

            CambiarEstiloTablaEve();
        } else {

            CambiarEstiloTablasanci();
        }



    });
    /*
     * CON ESTE LLAMADO SE MUESTRA EL FORMULARIO PARA MODIFICAR EL ESTADO DE LA VISITA
     * 
     * 
     */


    $(".opciones").click(function () {
        $(".Modalme").html("");
        $(".error").html("");

    });
    $("#modificar").click(function () {

        var visita = $("#idSeleccionado").val().trim();

        if (visita.length == 0) {

            $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar la Visita</b></p>");
            $("#ModalMensaje").modal();
        } else {
            $("#ModalModificar").modal();
        }
    });

    $("#modificarVisitante2").click(function () {

        var visita = $("#idSeleccionado").val().trim();

        if (visita.length == 0) {

            $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar la Visita</b></p>");


            $("#ModalMensajevisita").modal();
        } else {
            $("#ModalModificar").modal();

        }
    });

    $('#Guardarcomentario').click(function () {

        guardarComentario(idVisita);

    });


    $('#btnComentarios').click(function () {

        var visita = $("#idSeleccionado").val().trim();

        if (visita.length == 0) {

            $("#mensajed").html("<b>Antes de Continuar Debe Seleccionar la Visita</b>");
            $("#mensajed2").html("<b>Antes de Continuar Debe Seleccionar la Visita</b>");
            $("#ModalMensajevisita").modal();
        } else {
            ListarComentarios(visita);
            $('#modalComentarios').modal('show');
        }

    });


    // UNA VES PRECIONADO #CambiarTabla2 CAMBIO EL ESTILO DE LA TABLA Y LLAMO NUEVAMENTE AL LISTAR listarVisitasid
    $("#CambiarTabla2").click(function () {
        if (estilotablareserva == 0) {
            estilotablareserva = 1;
        } else {
            estilotablareserva = 0;
        }

        listarVisitasid();
    });
    // LLAMO AL FORMULARIO DE MODIFICAR
    $("#modficarvisitamodal").click(function () {

        $(".visimodi").show("fast");
        $(".modalvisita").hide("fast");
    });


    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    //AL PRESIONAR EL BOTON MODIFICARRESERVA SE LLAMA A LA FUNCION DE MODIFICARRESERVA
    $("#modificarReserva").click(function () {


        var visita = $("#idSeleccionado").val().trim();

        if (visita.length == 0) {

            $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar la Visita</b></p>");
            $("#ModalMensaje").modal();
            $("#ModalMensajevisita").modal();
        } else {
            cargarInfoReserva(visita);
        }

    });

    $("#btnModificarReserva").click(function () {

        horaEntrada = $("#txtHoraEntradamodi").val();
        horaSalida = $("#txtHoraSalidamodi").val();
        tipoIngreso = $("#cbxTipoIngresomodi").val();

        observaciones = $("#txtObservacionesmodi").val();
        acompanantes = $('#txtAcompanantes4').val();
        var visita = $("#idSeleccionado").val();
        placa = $('.placa4').val();

        if (acompanantes.trim().length == 0) {
            acompanantes = 0;
        }
        if (placa.trim().length == 0) {
            acompanantes = 0;
            placa = "------";
        } else {
            if (placa.trim().length != 6) {
                MensajeConClase("El numero de caracteres valido para la placa son 6", ".error");
                return false;
            }
        }


        modificarReserva(visita, horaEntrada, horaSalida, tipoIngreso, acompanantes, observaciones, visitado, placa);
    });
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    //AL PRESIONAR EL BOTON MODIFICAR SE LLAMA A LA FUNCION DE MODIFICAR

    $("#ModificarEstadoVisita").click(function () {


        actualizarEstado(idVisita, "VisiCancel");


    });


    // REPORTE DE LOS MAS VISITADOS LE PASO COMO TITULO EL REPORTE SELECCIONADO

    $("#listar").click(function () {
        tiporecarga = 1;
        listarVisitas();
        $(".completarvisitanteDatos").hide("fast");
        $("#registrovisita").hide('fast');
        $(".tablausuDeparta").hide('fast');
        $(".tablausuevennto").hide('fast');
        $(".tablausuSanciones").hide('fast');
        $(".tablausu").show('fast');

    });
    $("#agregar").click(function () {
        MostrarVisitantesVisita();
        MostrarVisitadosVisita();
        $(".completarvisitanteDatos").hide("fast");
        $("#idSeleccionado").val("");
        $(".tablausu").hide('fast');
        $(".tablausuevennto").hide('fast');
        $(".tablausuDeparta").hide('fast');
        $(".tablausuSanciones").hide('fast');

        $("#registrovisita").show('fast');


    });

    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    $('#agregarSancion').click(function () {
        tiporecarga = 4;
        listarVisitantesSanciones("ED65EF845");
        /*  var visita = $("#idSeleccionado").val().trim();
         if (visita.length == 0) {
         $("#mensajed").html("<p ><b>Antes de Continuar Debe Seleccionar la Visita</b></p>");
         $("#ModalMensajevisita").modal();
         } else {
         
         
         cargarSancionesPorUsuario2(idVisitante);
         infoVisitante(visita);
         CargarTiposSanciones();
         
         } */

        $(".completarvisitanteDatos").hide("fast");
        $("#idSeleccionado").val("");
        $(".tablausu").hide('fast');
        $(".tablausuevennto").hide('fast');
        $(".tablausuDeparta").hide('fast');
        $("#registrovisita").hide('fast');
        $(".tablausuSanciones").show('fast');

    });
    $("#btneventos").click(function () {
        tiporecarga = 3;
        $(".tablausu").hide('fast');
        $(".tablausuDeparta").hide('fast');
        $("#registrovisita").hide('fast');
        $(".tablausuSanciones").hide('fast');
        $(".tablausuevennto").show('slow');
        listarEventos();
        CargartiposParticipantes();
    });
    $("#btnDepartamentos").click(function () {
        tiporecarga = 0;
        empresa = TraerValorEmpre();

        ListarDepartamentos(empresa);
        $(".tablausu").hide('fast');
        $(".tablausuevennto").hide('fast');
        $("#registrovisita").hide('fast');
        $(".tablausuSanciones").hide('fast');
        $(".tablausuDeparta").show('fast');

    });

    $("#listar2").click(function () {

        listarVisitasid();
        $("#reservavisita").hide('fast');
        $(".tablausu").show('fast');
        listaRe = 0;
    });
    $("#agregar2").click(function () {
        if (cargo == 0) {
            MostrarVisitantesVisita();
            MostrarVisitadosVisita();
            cargo = 1;
        }
        $("#idSeleccionado").val("");
        $(".tablausu").hide('fast');
        $("#reservavisita").show('fast');
        listaRe = 1;
    });

    $('#vehiculo').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('#divplaca').show('slow');
            $('.placa').attr('required', 'true');
        } else {
            $('#divplaca').hide('fast');
            $('.placa').removeAttr('required', 'false');
        }
    });

    $("#txtBuscarPersona").keydown(function (tecla) {
        if (tecla.keyCode == 13) {
            buscarPersona($(this).val());
        }
    });

});

/**
 * 
 * @returns {undefined}
 * ESTE METODO ES EL ENCARGADO DE CARGAR LAS VISITAS EN UNA TABLA DEPENDIENDO DEL ESTILO DE TABLA
 * EL PRIMER ESTILO DE LA TABAL ES CON PAGINACION ESTE ESTILO ES EL UQE TIENE POR DEFECTO
 * EL SEGUNDO ES CON SCROLL
 * PARA TRAER LOS DATOS LLAMO A MI FUNCION MOSTRAR DE MI ARCHIVO visitas.php EL CUAL ME RETORNO POR JSON LOS DATOS
 * LUEGO MESTRO LOS DATOS EN LAS COLUMNAS QUE LE CORRESPONDEN
 */
var listarVisitas = function () {

    $('#tablavisitas tbody').off('click', 'tr');
    $('#tablavisitas tbody').off('dblclick', 'tr');
    if (estilotablavisitas == 0) {
        var table = $("#tablavisitas").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visita.php?mostrar=si",
                dataType: "json",
                type: "post",
            }, //paging: false,
            //scrollY: 400,
            //  "processing": true,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombrevisitado"
                },
                {
                    "data": "HoraEntrada"
                },
                {
                    "data": "HoraSalida"
                },
                {
                    "data": "DuracionVisita"
                },
                {
                    "data": "Id_TipoIngreso"
                },
                {
                    "data": "Id_EstadoVisita"
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
            ]

        });



        $('#tablavisitas tbody').on('click', 'tr', function () {
            HabilitarModifica(".divmodifica");
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            idVisita = data[0];
            if (data[13] != "VisiCancel") {
                $(".mc").hide("fast");
                $(".mc").html("¿ Esta Seguro de Desea Cancelar la Visita ?");
                $(".mc").show("fast");
                $(".btnCancelo").show("fast");
            } else if (data[13] == "VisiTer") {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra Terminada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            } else {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra cancelada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            }
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);
            $(".error").hide("fast");
            $("#cbxestadovisitamodfi").val(data[13]);

            $(".completarvisitanteDatos").hide("fast");
            $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

            $("#tablaParticipantesVisita").DataTable({
                //"processing": true,
                "destroy": true,
                searching: false,
                "language": idioma,
                dom: 'Bfrtip',
                "buttons": []

            });

        });
        $('#tablavisitas tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();
            $("#tablaVisitanteVisitaModal").hide("fast");
            //  $('#paises > option[value="3"]').attr('selected', 'selected');
            MostrarDetalleVisita(data[0])

        });
    } else {
        var table = $("#tablavisitas").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visita.php?mostrar=si",
                dataType: "json",
                type: "post",
            },
            paging: false,
            scrollY: 400,
            "processing": true,
            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombrevisitado"
                },
                {
                    "data": "HoraEntrada"
                },
                {
                    "data": "HoraSalida"
                },
                {
                    "data": "DuracionVisita"
                },
                {
                    "data": "Id_TipoIngreso"
                },
                {
                    "data": "Id_EstadoVisita"
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
            ]

        });



        $('#tablavisitas tbody').on('click', 'tr', function () {
            HabilitarModifica(".divmodifica");
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            idVisita = data[0];
            if (data[13] != "VisiCancel") {
                $(".mc").hide("fast");
                $(".mc").html("¿ Esta Seguro de Desea Cancelar la Visita ?");
                $(".mc").show("fast");
                $(".btnCancelo").show("fast");
            } else if (data[13] == "VisiTer") {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra Terminada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            } else {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra cancelada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            }
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);
            $(".error").hide("fast");
            $("#cbxestadovisitamodfi").val(data[13]);

            $(".completarvisitanteDatos").hide("fast");
            $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

            $("#tablaParticipantesVisita").DataTable({
                //"processing": true,
                "destroy": true,
                searching: false,
                "language": idioma,
                dom: 'Bfrtip',
                "buttons": []

            });

        });
        $('#tablavisitas tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();
            $("#tablaVisitanteVisitaModal").hide("fast");
            //  $('#paises > option[value="3"]').attr('selected', 'selected');
            MostrarDetalleVisita(data[0])

        });
    }
}
/*
 * 
 * @param {INT} id
 * @returns {undefined}
 * ESTA FUNCION ES LA ENCARGADA DE MOSTRAR EN UN MODAL EL DETALLE DE LA VISITA EL CUAL LA INFORMACION
 * SE CARGA POR LA FUNCION MostrarVisitaporid LA CUAL SE LE PASA COMO PARAMETRO EL ID DE LA VISITA
 */
function MostrarDetalleVisita(id) {

    MostrarVisitaporid(id);

    $("#listo").hide("fast");
    $("#Modaldetallevisita").modal('show');

}
/**
 * 
 * @param {INT} id
 * @returns {undefined}
 * EN ESTE METODO ES EL ENCARGADO DE MOSTRAR LA INFORMACION DE LA VISITA CON LOS CAMPOS QUE ESTAN DENTRO DEL MODAL
 * LLAMO A LA FUNCION buscarid DE MI Visita.php EL CUAL ME RETORNA LA VISITA
 */
function MostrarVisitaporid(id) {


    $.ajax({
        url: "../model/Visita.php?buscarid=si",
        dataType: "json",
        data: {
            idvisita: id,
        },
        type: "post",
        success: function (datos) {

            $("#idvisita").val(id);
            MostrarVisitantesVisitaMostrar2(id);
            $('.acompanantesvisita').html(datos.NumAcompanantes);

            $('.nombrevisitado').html(datos.nombrevisitado);
            $('.ubicacionvisitado').html(datos.departamento + " / " + datos.ubicacion);
            $('.observacionesvisita').html(datos.observaciones);
            $('.horaentradavisita').html(datos.HoraEntrada);
            $('.horasalidavisita').html(datos.HoraSalida);
            $('.tipoingresovisita').html(datos.Id_TipoIngreso);
            $('.estadovisita').html(datos.Id_EstadoVisita);
            $('.duracionvisita').html(datos.DuracionVisita);
            $('.placavisita').html(datos.placa);



        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}

/**
 * 
 * @returns {undefined}
 * ESTE METODO ES EL ENCARGADO DE CARGAR LAS VISITAS POR PERSONA EN UNA TABLA DEPENDIENDO DEL ESTILO DE TABLA
 * EL PRIMER ESTILO DE LA TABAL ES CON PAGINACION ESTE ESTILO ES EL UQE TIENE POR DEFECTO
 * EL SEGUNDO ES CON SCROLL
 * PARA TRAER LOS DATOS LLAMO A MI FUNCION mostrarvisitasvisitado DE MI ARCHIVO visitas.php EL CUAL ME RETORNO POR JSON LOS DATOS
 * LUEGO MESTRO LOS DATOS EN LAS COLUMNAS QUE LE CORRESPONDEN
 */
var listarVisitasid = function () {

    $('#tablamisvisitas tbody').off('click', 'tr');
    $('#tablamisvisitas tbody').off('dblclick', 'tr');
    if (estilotablareserva == 0) {
        var table = $("#tablamisvisitas").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visita.php?mostrarvisitasvisitado=si",
                dataType: "json",
                type: "post",
            }, //paging: false,
            //scrollY: 400,
            // "processing": true,

            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombrevisitado"
                },
                {
                    "data": "HoraEntrada"
                },
                {
                    "data": "HoraSalida"
                },
                {
                    "data": "DuracionVisita"
                },
                {
                    "data": "Id_TipoIngreso"
                },
                {
                    "data": "Id_EstadoVisita"
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
            ]

        });




        $('#tablamisvisitas tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            HabilitarModifica(".divmodifica");
            $(".cerrarinfo").show("fast");
            $(".modalvisita").show("fast");
            $(".modalvisitaRegistro").hide("fast");
            $("#tablaVisitanteVisitaModal").hide("fast");

            if (data[13] != "VisiCancel") {

                $(".mc").hide("fast");
                $(".mc").html("¿ Esta Seguro de Desea Cancelar la Visita ?");
                $(".mc").show("fast");
                $(".btnCancelo").show("fast");

            } else if (data[13] == "VisiTer") {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra Terminada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            } else {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra cancelada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            }
            $("input").val("");
            $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

            $("#tablaParticipantesVisita").DataTable({
                //"processing": true,
                "destroy": true,
                searching: false,
                "language": idioma,
                dom: 'Bfrtip',
                "buttons": []

            });


            var data = table.row(this).data();
            $("tr").removeClass("warning");

            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);
            idVisita = data[0];
            $("#cbxestadovisitamodfi").val(data[13]);
        });
        $('#tablamisvisitas tbody').on('dblclick', 'tr', function () {






            var data = table.row(this).data();
            $("#tablaVisitanteVisitaModal").hide("fast");
            MostrarDetalleVisita(data[0])

        });
    } else {
        var table = $("#tablamisvisitas").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visita.php?mostrarvisitasvisitado=si",
                dataType: "json",
                type: "post",
            },
            paging: false,
            scrollY: 400,
            // "processing": true,

            "columns": [{
                    "data": "indice"
                },
                {
                    "data": "nombrevisitado"
                },
                {
                    "data": "HoraEntrada"
                },
                {
                    "data": "HoraSalida"
                },
                {
                    "data": "DuracionVisita"
                },
                {
                    "data": "Id_TipoIngreso"
                },
                {
                    "data": "Id_EstadoVisita"
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
            ]

        });




        $('#tablamisvisitas tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            HabilitarModifica(".divmodifica");
            $(".cerrarinfo").show("fast");
            $(".modalvisita").show("fast");
            $(".modalvisitaRegistro").hide("fast");
            $("#tablaVisitanteVisitaModal").hide("fast");

            $("input").val("");
            $("#tablaParticipantesVisita").html('<table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%"> <thead class="ttitulo "><tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr></thead>    </table>');

            $("#tablaParticipantesVisita").DataTable({
                //"processing": true,
                "destroy": true,
                searching: false,
                "language": idioma,
                dom: 'Bfrtip',
                "buttons": []

            });
            if (data[13] != "VisiCancel") {
                $(".mc").hide("fast");
                $(".mc").html("¿ Esta Seguro de Desea Cancelar la Visita ?");
                $(".mc").show("fast");
                $(".btnCancelo").show("fast");
            } else if (data[13] == "VisiTer") {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra Terminada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            } else {
                $(".mc").hide("fast");
                $(".mc").html("La Visita ya se encuentra cancelada");
                $(".mc").show("fast");
                $(".btnCancelo").hide("fast");
            }

            $("tr").removeClass("warning");

            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);
            idVisita = data[0];
            $("#cbxestadovisitamodfi").val(data[13]);
        });
        $('#tablamisvisitas tbody').on('dblclick', 'tr', function () {



            var data = table.row(this).data();
            $("#tablaVisitanteVisitaModal").hide("fast");
            MostrarDetalleVisita(data[0])

        });
    }
}
/**
 * 
 * @returns {undefined}
 * ESTA FUNCION ES LA QUE UTILIZO PARA EL REPORTE DE LOS MAS VISITADOS EN MI ARCHIVO Visitas.php YA ESTA LA FUNCION DEFINIDA COMO
 * mostrarMasVisitados, AL LLAMAR A DICHA FUNCION ME MUESTRA LA INFORMACION EN UNA TABLA
 */
var listarlosmasVisitantes = function () {

    var table = $("#tablareportes").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrarMasVisitantes=si",
            dataType: "json",
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "NombreCompleto"
            },
            {
                "data": "TipoIdentificacion"
            },
            {
                "data": "Identificacion"
            },
            {
                "data": "correo"
            },
            {
                "data": "celular"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}




/**
 * 
 * @returns {undefined}
 * ESTA FUNCION ES LA QUE UTILIZO PARA EL REPORTE DE LOS MAS VISITADOS EN MI ARCHIVO Visitas.php YA ESTA LA FUNCION DEFINIDA COMO
 * mostrarMasVisitados, AL LLAMAR A DICHA FUNCION ME MUESTRA LA INFORMACION EN UNA TABLA
 */
var listarlosmasVisitados = function (inicio, final) {


    var table = $("#tablareportesEmpleados").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrarMasVisitados=si",
            dataType: "json",
            data: {
                inicio: inicio,
                final: final,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "NombreCompleto"
            },
            {
                "data": "Identificacion"
            },
            {
                "data": "Id_Departamento"
            },
            {
                "data": "cargo"
            },
            {
                "data": "Telefono"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}
var listarlosmasVisitadosDepartamento = function (id, inicio, final) {

    $(".n1").html("Nombre Completo");
    $(".n2").html("Identificacion");
    var table = $("#tablareportesVisitantes").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrarMasvisitdosdepar=si",
            dataType: "json",
            data: {
                id: id,
                inicio: inicio,
                final: final,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "NombreCompleto"
            },
            {
                "data": "Identificacion"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}


var listarVisitantesDepartamento = function (id, inicio, final) {

    $(".n1").html("Nombre");
    $(".n2").html("Ubicacion");
    var table = $("#tablareportesVisitantes").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrarpordepartamento=si",
            dataType: "json",
            data: {
                id: id,
                inicio: inicio,
                final: final,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "NombreCompleto"
            },
            {
                "data": "identificacion"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}
var listarVisitantesMasVisitas = function (inicio, final) {
    $(".n1").html("Nombre Completo");
    $(".n2").html("Identificacion");

    var table = $("#tablareportesVisitantes").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrarMasvisitantes=si",
            dataType: "json",
            data: {
                inicio: inicio,
                final: final,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "NombreCompleto"
            },
            {
                "data": "identificacion"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}
var listarDepartamentosMasVisitados = function (inicio, final) {
    $(".n1").html("Nombre");
    $(".n2").html("Ubicacion");
    var table = $("#tablareportesVisitantes").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visita.php?mostrardepartamentosr=si",
            dataType: "json",
            data: {
                inicio: inicio,
                final: final,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        ordering: false,
        "columns": [{
                "data": "nombre"
            },
            {
                "data": "ubicacion"
            },
            {
                "data": "NumVisitas"
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
        ]

    });

}
/**
 * 
 * @type type
 * ESTA VARIABLE ME DEFINE EL IDIOMA DE LA TABLA
 */
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
/*
 * CON ESTA FUNCION MODIFICO EL ESTADO DE LA VISITA, SE LE PASA POR PARAMETRO EL ID DE LA VISITA Y EL ESTADO
 * LUEGO SE ENVIAN LOS DATOS A visita.php Y SE LLAMA A LA FUNCION ModificarVisita QUE ES LA ENCARGADA DE REALIZAR LA 
 * OPERACION
 *
 */


function actualizarEstado(id, estado) {

    $.ajax({
        // ENVIO EL FORMULARIO POR POST Y POR GET LA FUNCION A EJECUTAR A ModificarVisita.php   
        url: "../model/visita.php?ModificarVisita=si",
        dataType: "json",
        data: {
            estado: estado,
            id: id,
        },
        type: "post",
        success: function (datos) {
            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Visita Cancelada Con Exito");
                $(".mc").show("slow");
                $(".btnCancelo").hide("fast");
                $("#idSeleccionado").val('');
                if (esreser == 1) {

                    listarVisitasid();
                } else {

                    listarVisitas();
                }
            } else {
                MensajeConClase('La visita solo puede ser modificada por el usuario que la crea', ".error");
            }
        },
        error: function () {
            MensajeConClase('Error al modificar el estado de la visita', ".error");

            console.log('Something went wrong', status, error);

        }
    })


}

function guardarComentario(idVisita) {

    comentario = $('#txtComentario').val();
    if (comentario.trim().length == 0) {
        $('#txtComentario').val("");
        MensajeConClase("Ingrese Comentario", ".error");

    } else {
        $('#txtComentario').html("");
        if (comentario.trim().length > 0) {
            $.ajax({
                url: "../model/Visita.php?comentario=si",
                dataType: "json",
                data: {
                    id: idVisita,
                    comentario: comentario,
                },
                type: "post",
                success: function (datos) {
                    $('#txtComentario').val("");

                    MensajeConClase("Comentario Guardado", ".error1");

                },
                error: function () {

                    console.log('Something went wrong', status, error);

                }
            });
        }
    }
}

function cargarComentarios(idVisita) {


    $.ajax({
        url: "../model/Visita.php?cargarComentarios=si",
        dataType: "json",
        data: {
            id: idVisita,
        },
        type: "post",
        success: function (datos) {
            $('#tblComentarios').html("<tr><th class='filaprincipal' colspan='3' style='color: #990000; text-align: center'>Datos de Comentarios</th></tr>");
            for (var i = 0; i <= datos.length - 1; i++) {
                $('#tblComentarios').append('<tr><td class="primero1">' + datos[i].usuario + '</td><td class="identificacionvisitado">' + datos[i].comentario + ' </td><td class="primero1">' + datos[i].fecha + ' </td></tr>');
            }
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });

}

function ListarComentarios(idVisita) {

    var table = $("#tblComentarios").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Visita.php?cargarComentarios=si",
            dataType: "json",
            data: {
                id: idVisita,
            },
            type: "post",
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,
        "lengthMenu": [5, 25, 50, 75, 100],
        "columns": [{
                "data": "indice"
            },
            {
                "data": "usuario"
            },
            {
                "data": "comentario"
            },
            {
                "data": "fecha"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });

}


function cargarSancionesPorVisitante(idUsuario) {

    $('.sancionesVisitanteInfo tbody').off('click', 'tr');
    var table = $(".sancionesVisitanteInfo").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Visita.php?cargarSancionesPorUsuario=si",
            dataType: "json",
            data: {
                id: idUsuario,
            },
            type: "post",
        },
        // "processing": true,

        "columns": [{
                "data": "indice"
            },
            {
                "data": "usuario"
            },
            {
                "data": "valor"
            },
            {
                "data": "fecha"
            },
        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });



}

function prueba() {

    $(".confirmar").show("fast");
}






function infoVisitante(idVisita) {
    $.ajax({
        url: "../model/Visita.php?infoVisitante=si",
        dataType: "json",
        data: {
            id: idVisita,
        },
        type: "post",
        success: function (datos) {
            $(".fotoVisitante").html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
            $(".nombrevisitante").html(datos[0].nombre + " " + datos[0].Segundo_Nombre + " " + datos[0].apellido + " " + datos[0].Segundo_Apellido);
            $(".tipoidvisitante").html(datos[0].valor);
            $(".identificacionevisitante").html(datos[0].identificacion);
            $(".correovisitante").html(datos[0].correo);
            $(".celularvisitante").html(datos[0].celular);

            $("#Modaldetallevisitante").modal('show');
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}

function CargarTiposSanciones() {

    $.ajax({
        url: "../model/Visita.php?cargarTiposSanciones=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            $('.sanciones1').html("");
            $('.sanciones1').append("<option value=0>" + 'Seleccione Sanción' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('.sanciones1').append("<option value=" + datos[i].id + ">" + datos[i].valor + "</option>");
            };
        },
        error: function () {
            console.log('Something went wrong', status, err);
        }
    });
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


function cargarInfoReserva(idVisita) {
    $.ajax({
        url: "../model/Visita.php?infoVisita=si",
        dataType: "json",
        data: {
            id: idVisita,
        },
        type: "post",
        success: function (datos) {
            $("#cbxTipoIngresomodi").val(datos.Id_TipoIngreso);
            $("#txtHoraEntradamodi").val(datos.HoraEntrada);
            $("#txtHoraSalidamodi").val(datos.HoraSalida);

            placa = datos.Visita_Placa;
            if (placa == "" || placa == "------") {
                $('.vehiculo4').prop("checked", "");
                $('.divplaca4').hide('fast');
                $('#txTAcompanantes4').val('');
                $('.placa4').val('');
                $('.placa4').removeAttr('required', 'false');
                $('#txTAcompanantes4').removeAttr('required', 'false');
            } else {
                $('.vehiculo4').prop("checked", "checked");
                $('.divplaca4').show('fast');

                $('.placa4').attr('required', 'true');
                $('#txTAcompanantes4').attr('required', 'true');

                $("#txtPlacaVehiculo4").val(placa);
                $("#txtAcompanantes4").val(datos.NumAcompanantes);
            }

            $("#txtObservacionesmodi").val(datos.Observaciones);
            visitado = datos.Id_Visitado;
            $("#ModalModificarReserva").modal();
        },
        error: function () {
            console.log('Something went wrong', status, error);

        }
    });
}

function modificarReserva(id, horaEntrada, horaSalida, tipoIngreso, numAcompanantes, observaciones, visitado, placa) {
    $.ajax({
        url: "../model/Visita.php?modificarReserva=si",
        dataType: "json",
        data: {
            id: id,
            horaEntrada: horaEntrada,
            horaSalida: horaSalida,
            tipoIngreso: tipoIngreso,
            numAcompanantes: numAcompanantes,
            observaciones: observaciones,
            visitado: visitado,
            placa: placa,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {

                MensajeConClase("Error Fechas Incorrectas, Favor validar que la fecha de salida no sea inferior a la de entrada ", ".error")

            } else if (datos == 2) {

                MensajeConClase("Complete Todos los Campos", ".error")
            } else if (datos == 3) {

                MensajeConClase("Visita Modificada", ".error")
                DesHabilitarModifica(".divmodifica");
                if (esreser == 1) {
                    listarVisitasid();
                } else {
                    listarVisitas();
                }

                $("#idSeleccionado").val('');
            } else if (datos == 4) {


                MensajeConClase(' El visitado ya tiene una visita en curso o reservada', ".error")
            } else if (datos == 5) {


                MensajeConClase('La visita solo puede ser modificada por el usuario que la crea', ".error")
            } else {

                MensajeConClase("Error Al Registrar La visita", ".error")
            }
        },
        error: function () {
            MensajeConClase("Error Al Registrar La visita", ".error")
            console.log('Pailas', status, error);

        }
    });

}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function BuscarVisitanteid2(id) {
    $.ajax({
        url: "../model/visitantesMetodos.php?buscarporid=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            $('#txtidVisitante').val(id);
            if (datos[0].Segundo_Apellido == null || datos[0].Segundo_Apellido == "" || datos[0].apellido == null || datos[0].apellido == "" || datos[0].nombre == null || datos[0].nombre == "" || datos[0].correo == null || datos[0].foto == "" || datos[0].foto == "Myfoto.png" || datos[0].foto == null) {
                $(".completarvisitante").css("-webkit-animation", " tiembla 0.2s infinite");
                $(".completarvisitanteDatos").show("slow");
                ModificarDesdeVisita();
            } else {
                $(".completarvisitanteDatos").hide("fast");

            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function AgregarVisitanteVisita(id, visita) {
    $.ajax({
        url: "../model/Visita.php?AsignarVisita=si",
        dataType: "json",
        data: {
            id: id,
            visita: visita,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                MensajeConClase("Visitante Agregado con exito", ".error");
                MostrarVisitantesVisitaMostrar2(idVisita);
            } else {
                MensajeConClase("El Visitante ya se encuentra Asignado", ".error");
            }


        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function retirarVisitanteVisita(id, visita) {

    $.ajax({
        url: "../model/Visita.php?retirarVisita=si",
        dataType: "json",
        data: {
            id: id,
            visita: visita,
        },
        type: "post",
        success: function (datos) {

            MensajeConClase("Visitante Retirado con exito", ".error");
            MostrarVisitantesVisitaMostrar2(idVisita);
            $(".confirmarvisitaparti").hide("slow");


        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function MostrarVisitantesVisitaMostrar(id) {

    $('#tablaVisitantesVisitaMostrar tbody').off('click', 'tr');
    $('#tablaVisitantesVisitaMostrar tbody').off('dblclick', 'tr');
    var table = $("#tablaVisitantesVisitaMostrar").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Visita.php?mostrarparticipantesVisita=si",
            dataType: "json",
            data: {
                id: id,
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
                "defaultContent": "<span  onclick='javascript:MostrarDatosVisitante();' style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link '></span>"
            }

        ],
        "language": idioma,
        dom: 'Bfrtip',
        "buttons": []

    });
    $('#tablaVisitantesVisitaMostrar tbody').on('click', 'tr', function () {
        var data = table.row(this).data();

        $('#tablaVisitantesVisitaMostrar tbody tr').removeClass("warning");
        $(this).attr("class", "warning");
        VisitantesVisita = data[3];

        BuscarVisitanteid(VisitantesVisita);





    });
    $('#tablaVisitantesVisitaMostrar tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();






    });

}

function MostrarVisitantesVisitaMostrar2(id) {

    $('#tablaVisitantesVisitaMostrar2 tbody').off('click', 'tr');
    $('#tablaVisitantesVisitaMostrar2 tbody').off('dblclick', 'tr');
    var table = $("#tablaVisitantesVisitaMostrar2").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/Visita.php?mostrarparticipantesVisita=si",
            dataType: "json",
            data: {
                id: id,
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
    $('#tablaVisitantesVisitaMostrar2 tbody').on('click', 'tr', function () {
        var data = table.row(this).data();

        $('#tablaVisitantesVisitaMostrar2 tbody tr').removeClass("warning");
        $(this).attr("class", "warning");
        VisitantesVisita = data[3];

        BuscarVisitanteid(VisitantesVisita);





    });
    $('#tablaVisitantesVisitaMostrar2 tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();



        $("#tablaVisitanteVisitaModal").show("slow");


    });

}

function MostrarParticipantesVisita(dato) {

    $('#tablaParticipantesVisita tbody').off('click', 'tr');
    $('#tablaParticipantesVisita tbody').off('dblclick', 'tr');
    var table = $("#tablaParticipantesVisita").DataTable({
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
    $('#tablaParticipantesVisita tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaParticipantesVisita tbody tr").removeClass("warning");

        $(this).attr("class", "warning");
        participanteVisita = data[3];

        mostrarInfoCompletaparticipante(participanteVisita, "#tablaVisitanteVisitaModal")

    });
    $('#tablaParticipantesVisita tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        $("#tablaVisitanteVisitaModal").show("slow");

    });

}

function registrarVisitante5() {
    if (fotof != 0) {
        //tomamos el formulairo ingresar visitante
        var formData = new FormData(document.getElementById("form-ingresar-visitante5"));
        var data = canvasf.toDataURL("image/jpeg");
        var info = data.split(",", 2);

        formData.append("data", info[1]);
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
                $(".inputt").val('');
                $(".inputt2").val('');
                $("#txtPlacaVehiculo").val('');
                $(".canvasf").hide('fast');
                $(".videof").show('fast');
                $("#fotof").html("Tomar Foto!");
                fotof = 0;
                AgregarVisitanteVisita(-1, idVisita);
            } else {

                MensajeConClase("Error al Guardar al Visitante", ".error")
            }
        });
    } else {

        MensajeConClase("Antes de Guardar debe Tomar La Foto", ".error")
    }
}

function reserv() {
    esreser = 1;
}

function registrarVisitante6() {

    //tomamos el formulairo ingresar visitante
    var formData = new FormData(document.getElementById("form-ingresar-visitante6"));

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

            MensajeConClase("Todos Los campos son Obligatorios", ".error")
            return true;
        } else if (datos == 2) {

            MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error")
            return true;
        } else if (datos == 3) {

            MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error")
            return true;
        } else if (datos == 4) {



            $(".inputt").val('');
            $(".inputt2").val('');
            $("#txtPlacaVehiculo").val('');


            AgregarVisitanteVisita(-1, idVisita);
        } else {

            MensajeConClase("Error al Guardar al Visitante", ".error")
        }
    });
}

function EnviarSql(sql, inicio, final, id) {

    listorep = 1;
    $("#link-grafica").attr("href", "../modulos/Graficos.php?sql=" + sql + "&id=" + id + "&final=" + final + "&inicio=" + inicio + "")

}

function buscarPersona(id) {
    $.ajax({
        url: "../model/Visita.php?buscarPersona=si",
        dataType: "json",
        data: {
            idPersona: id,
        },
        type: "post",
        success: function (datos) {
            datos_identidades = datos;
            if (datos != ",") {
                perfiles = [];
                $("#modalPersona").modal("show");
                $("#body_modal_personas").html("<table class='table' style='width:100%'>" +
                    "<tr class='filaprincipal ttitulo'><td colspan='2'> Datos Personales</td></tr>" +
                    "<tr><th class='primero2'>Identificación:</th><td>" + datos[0].num_documento + "</td></tr>" +
                    "<tr><th class='primero2'>Nombre Completo:</th><td>" + datos[0].nombres + " " + datos[0].primer_apellido + " " + datos[0].segundo_apellido + "</td></tr>" +
                    "<tr><th class='primero2'>Fecha de Nacimiento:</th><td>" + datos[0].fecha_nacimiento + "</td></tr>" +
                    "<tr><th class='primero2'>Telefono:</th><td>" + datos[0].telefonos + "</td></tr>" +
                    "<tr><th class='primero2'>Dirección:</th><td>" + datos[0].celular + "</td></tr>" +
                    "<tr><th class='primero2'>Correo Personal:</th><td>" + datos[0].correo_personal + "</td></tr>" +
                    "<tr><th class='primero2'>Usuario:</th><td>" + datos[0].logon_name + "</td></tr>" +
                    "<tr><th class='primero2'>Código:</th><td>" + datos[0].codigo_barras + "</td></tr>" +
                    "</table>");
                $("#body_modal_personas").append("<br><table id='TablaDatos' class='table'><thead class='' ><tr class='filaprincipal' style='color:#990000; text-align:center'><th  style='text-align:center'>Empresa</th><th style='text-align:center'>Tipo</th><th style='text-align:center'>Departamento</th><th style='text-align:center'>Cargo</th><th style='text-align:center'>Código - Unidad Académica</th><th style='text-align:center'>Estado</th></tr></thead><tbody></tbody></table>");
                for (var i = 0; i <= datos[1].length - 1; i++) {
                    color = "red";
                    if (datos[1][i].estado == 1) {
                        estado = "Activo";
                        color = "green";
                    } else if (datos[1][i].estado == 2) {
                        estado = "Inactivo";
                    } else {
                        estado = "Eliminado";
                    }
                    $("#TablaDatos tbody").append("<tr style='text-align:center'>" +
                        "<td>" + datos[1][i].nombre_empresa + "</td>" +
                        "<td>" + datos[1][i].descripcion + "</td>" +
                        "<td>" + datos[1][i].nom_departamento + "</td>" +
                        "<td>" + datos[1][i].nombre_cargo + "</td>" +
                        "<td>" + datos[1][i].nombre_unidad_aca + "</td>" +
                        "<td style='background-color:" + color + "; color: white';><b>" + estado + "</b></td>" +
                        "</tr>");
                    perfiles[i] = datos[1][i].descripcion;
                    infVisitante['num_documento'] = datos[0].num_documento;
                    infVisitante['nombres'] = datos[0].nombres;
                    infVisitante['primer_apellido'] = datos[0].primer_apellido;
                    infVisitante['segundo_apellido'] = datos[0].segundo_apellido;
                    infVisitante['nombres'] = datos[0].nombres;
                    infVisitante['celular'] = datos[0].celular;
                    infVisitante['correo_personal'] = datos[0].correo_personal;
                }
            } else {
                $("#mensajed").html("<h4><b>Esta Persona no existe</b></h4>");
                $("#ModalMensajevisita").modal("show");
            }
        },
        error: function () {
            $("#mensajed").html("<h4><b>Error en la Consulta</b></h4>");
            $("#ModalMensajevisita").modal("show");
            console.log('Something went wrong', status, error);

        }
    });
}

function existeVisitante(id) {
    $.ajax({
        url: "../model/visitantesMetodos.php?existeVisitante=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            if (datos != false) {
                registrarPaticipanteDepartamento(datos.id, DepartaSeleccionado, "------", 0);
                MensajeConClase("Persona Registrada exitosamente", ".error_depar");
            } else {
                nombre = infVisitante['nombres'];
                var myarr = nombre.split(" ");
                $.ajax({
                    url: "../model/visitantesMetodos.php?guardar=si",
                    dataType: "json",
                    type: "post",
                    data: {
                        departa: DepartaSeleccionado,
                        identificacion: infVisitante['num_documento'],
                        tipo_identificacion: infVisitante['tipo_identificacion'],
                        nombre: myarr[0],
                        segundonombre: myarr[1],
                        apellido: infVisitante['primer_apellido'],
                        celular: infVisitante['celular'],
                        correo: infVisitante['correo_personal'],
                        tipo_identificacion: 43,
                        segundoapellido: infVisitante['segundo_apellido'],
                        placa: "------",
                        acompa: 0,
                        xxx: 1
                    },
                    success: function (datos) {
                        MensajeConClase("Persona Registrada exitosamente", ".error_depar");
                    },
                    error: function () {
                        MensajeConClase("Error al registrar a la persona", ".error_depar");
                        console.log('Something went wrong', status, err);
                    }
                });
            }
            $("#txtBuscarPersona").val("").focus();
            $("#modalPersona").modal("hide");
        },
        error: function () {
            console.log('Something went wrong', status, err);
        }
    });
}
