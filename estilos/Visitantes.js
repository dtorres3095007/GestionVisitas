//MODULO DE VISITANTES


//DECLARO LAS VARIABLES NECESARIAS
// ESTA VARIABLE LA UTILIZO PARA SABER QUE EL USUARIO A TOMADO UNA FOTO AL MOMENTO DE REGISTRAR UNA VISITA
foto = 0;
//ESTA VARIABLE LA UTILIZO PARA SABER SI EL USUARIO NO HA CAMBIADO DE FOTO AL MOMENTO DE MODIFICAR UN VISITANTE
MismaFoto = 1;
//EN VARIABLE ESTA GUARDO EL NOMBRE DE LA FOTO ANTERIOR A MODIFICACION
NameFotoVieja = "";
// VARIABLE PARA EL ESTILO DE TABLA
var estilotablavisitante = 0;
//VARIABLE QUE ME INDICA QUE VISITANTE ESTA SELECCIONADO
var visitante = 0;

//FUNCIONES QUE SE EJECUTAN CUANDO SE INICIA EL MODULO DE VISITANTES
$(document).ready(function () {
    $("#Recargar").click(function () {
        listarVisitantes();

    });
    $("#btn_buscar_visitante").click(function () {
        var dato = $("#txt_buscar_visitante").val().trim();
        if (dato.length > 5) {
            $(".error_busqueda").hide('fast');
            listarVisitantes(dato);
        } else {
            $(".error_busqueda").html("Ingrese Dato de la persona a buscar con mas informacion.!")
            $(".error_busqueda").show('fast');
        }
    });

    // CUANDO LE DAN CLICK AL ID DE CambiarTabla DEL MODULO DE VISITANTES EJECUTO LA FUNCION LISTAR VIISITANTES Y COMBIO LA VARIABLE ESTILOTABLAVISITANTE
    $("#CambiarTabla").click(function () {
        if (estilotablavisitante == 0) {
            estilotablavisitante = 1;
        } else {
            estilotablavisitante = 0;
        }

        listarVisitantes();
    });
    // AL DAL CLICK EN EL ID btnRecargar ME ACTUALIZA LA INFOMACION DEL VISITANTE A MODIFICAR
    $('#btnRecargar').click(function () {

        visitante = $("#idSeleccionado").val().trim();

        mostrarInfoCompletaVisitanteModificar(visitante);
        $(".videomodi").hide('fast');
        $(".canvasmodi").hide('fast');
        $(".imagenactual").show('fast');
        $(".error").hide('fast');
        MismaFoto = 1;

    });

    // AL DAR CLICK AQUI HABILITO EL BOTON TOMAR FOTO DEL FORMULARIO VISITANTES.PHP
    $('#fotomodi2').click(function () {

        if (foto == 1) {

            foto = 0;
            $(".videomodi").hide('fast');
            $(".imagenactual").hide('fast');
            $(".canvasmodi").show('fast');
            MismaFoto = 0;
            $("#fotomodi2").html("Nueva Foto!");


        } else {

            foto = 1;

            $(".imagenactual").hide('fast');
            $(".canvasmodi").hide('fast');
            $(".videomodi").show('fast');
            $("#fotomodi2").html("Tomar Foto!");

            MismaFoto = 0;
        }

    });
    $(".close").click(function () {
        $(".error").hide('fast');

    });
    $(".btn").click(function () {
        $(".error").hide('fast');
    });
    // CUANDO SE ENVIA EL FORMULARIO MODIFICAR VISITANTE LLAMO A LA FUNCION DE MODIFICAR Y LE PASO EL PARAMETRO
    $("#form-modificar-visitante").submit(function () {
        visitante = $("#idSeleccionado").val().trim();
        ModificarVisitante(visitante);

        return false;
    });

    // VALIDO QUE TENGO UN VISITNTE SELECCIONADO ANTES DE MODIFICAR
    $("#modificar").click(function () {
        visitante = $("#idSeleccionado").val().trim();
        if (visitante.length == 0) {
            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar<br> El Visitante a Modificar</p>");
            $("#ModalMensaje").modal();
        } else {
            Cargaridentificacion();
            $("#error").hide('fast');
            mostrarInfoCompletaVisitanteModificar(visitante);
            $("#ModificarVisitante").modal();
        }
    })
    // VALIDO QUE TENGO UN VISITNTE SELECCIONADO ANTES DE ELIMINAR
    $("#eliminar").click(function () {
        visitante = $("#idSeleccionado").val().trim();
        if (visitante.length == 0) {
            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar<br> El Visitante a Eliminar</p>");
            $("#ModalMensaje").modal();
        } else {
            $(".mc").html("¿ Esta Seguro de Desea Eliminar el Visitante ?");
            $("#salirEliminar").hide("fast");
            $(".botonesEliminar").show("slow");
            $("#ModalConfirmacionEliminar").modal();
        }
    });
    // ENVIO MENSAJE DE CONFIRMACION DE ELIMINACION
    $("#btnEliminarVisitante").click(function () {
        visitante = $("#idSeleccionado").val().trim();
        EliminarVisitante(visitante)
    });

    $('#vehiculomodi').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('#divplacamodi').show('slow');
            $('#txtPlacaVehiculoModi').attr('required', 'true');
        } else {
            $('#divplacamodi').hide('fast');
            $('#txtPlacaVehiculoModi').removeAttr('required', 'false');
        }
    });
});



// MIS FUNCIONES



// FUNCION LISTAR VISITANTE
var listarVisitantes = function (datos) {

    // BORRO LAS FUNCIONES QUE TENIA LA TABLA ANTERIORMENTE PARA NO TENER PROBLEMAS CON LOS DATOS ESTO ES PROPIO DE LA LIBRERIA DATA TABLE
    $('#tablavisitantes tbody').off('click', 'tr');
    $('#tablavisitantes tbody').off('dblclick', 'tr');
    // DEPENDIENDO DEL VALOR QUE TENGA LA VARIABLE SE CAMBIA EL TIPO DE TABLA
    // ESTE ES EL TIPO DE TABLA CON PAGINACION
    if (estilotablavisitante == 0) {
        // INSTANCIO LA TABLA A LA CUAL VOY A PASARLE LOS DATOS
        var table = $("#tablavisitantes").DataTable({
            //ELIMINO CUALQUIER RASTRO DE DATOS QUE ESTEN EN LA TABLA
            "destroy": true,
            "searching": false,
            // LLAMADA AJAX
            "ajax": {
                //ENVIO POR GET EL TIPO DE FUNCION QUE VOY A EJECUTAR A VisitantesMetodos.php Y LE DIGO QUE ME MUESTRE LOS VISITANTES 
                url: "../model/visitantesMetodos.php?mostrar=si",
                // RECIBO UN JSON
                dataType: "json",
                data: {
                    datos
                },
                // EN DADO CASO NECESITE ENVIAR UN DATO LO ENVIO POR POST
                type: "post",
                "dataSrc": function (json) {
                    if (json.length == 0) {
                        return Array();
                    }
                    return json.data;
                },
            },
            "processing": true,
            // ESTO ES PROPIO DEL DATA TABLE PARA QUE CUANDO EXISTAN MUCHOS DATOS Y SE TARDE UN POCO AL TRAER LOS DATOS SE  LE INFORME AL USUARIO QUE LOS DATOS ESTAN CARGANDO
            //  "processing": true,
            // PASOS LOS DATOS A LA TABLA
            "columns": [{
                    "data": "persona"
                },

                {
                    "data": "Tipo"
                },
                {
                    "data": "identificacion"
                },
            ],
            //SELECCIONO EL TIPO DE LENGUAJE QUE TENDRA LA TABLA
            "language": idioma,
            //DECLARO LOS BOTONES PARA EXPORTAR LOS DATOS DE LA TABLA
            dom: 'Bfrtip',
            "buttons": [

            ]

        });
        //DECLARO LAS FUNCIONES QUE TENDRAN CADA FILA

        //AL MOMENTO DE HACER CLICK SE SELECCIONARA UNA FILA Y SE CAMBIA DE COLOR
        $('#tablavisitantes tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[5]);

        });

        //AL MOMENTO DE DAR DOBLE CLICK SE MUESTRA LA INFORMACION COMPLETA DEL VISITANTE
        $('#tablavisitantes tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();
            mostrarInfoCompletaVisitante(data[5])

        });

    } else {
        // INSTANCIO LA TABLA A LA CUAL VOY A PASARLE LOS DATOS
        var table = $("#tablavisitantes").DataTable({
            //ELIMINO CUALQUIER RASTRO DE DATOS QUE ESTEN EN LA TABLA
            "destroy": true,
            // LLAMADA AJAX
            "ajax": {
                //ENVIO POR GET EL TIPO DE FUNCION QUE VOY A EJECUTAR A VisitantesMetodos.php Y LE DIGO QUE ME MUESTRE LOS VISITANTES 
                url: "../model/visitantesMetodos.php?mostrar=si",
                // RECIBO UN JSON
                dataType: "json",
                // EN DADO CASO NECESITE ENVIAR UN DATO LO ENVIO POR POST
                type: "post",
            },
            // ESTO ES PROPIO DEL DATA TABLE PARA QUE CUANDO EXISTAN MUCHOS DATOS Y SE TARDE UN POCO AL TRAER LOS DATOS SE  LE INFORME AL USUARIO QUE LOS DATOS ESTAN CARGANDO
            //  "processing": true,
            // PASOS LOS DATOS A LA TABLA
            paging: false,
            scrollY: 300,
            "columns": [{
                    "data": "nombre"
                },
                {
                    "data": "Segundo_Nombre"
                },
                {
                    "data": "apellido"
                },
                {
                    "data": "Segundo_Apellido"
                },
                {
                    "data": "Tipo"
                },
                {
                    "data": "identificacion"
                },
                {
                    "data": "celular"
                },
                {
                    "data": "correo"
                },
            ],
            //SELECCIONO EL TIPO DE LENGUAJE QUE TENDRA LA TABLA
            "language": idioma,
            //DECLARO LOS BOTONES PARA EXPORTAR LOS DATOS DE LA TABLA
            dom: 'Bfrtip',
            "buttons": [
                //BOTON DE EXCEL
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',
                    className: 'btn btn-success',
                },
                //BOTON CSV
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV',
                    className: 'btn btn-default',
                },
                //BOTON PDF
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    className: 'btn btn-danger',
                }
            ]

        });
        //DECLARO LAS FUNCIONES QUE TENDRAN CADA FILA

        //AL MOMENTO DE HACER CLICK SE SELECCIONARA UNA FILA Y SE CAMBIA DE COLOR
        $('#tablavisitantes tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[5]);

        });

        //AL MOMENTO DE DAR DOBLE CLICK SE MUESTRA LA INFORMACION COMPLETA DEL VISITANTE
        $('#tablavisitantes tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();

            mostrarInfoCompletaVisitante(data[5])

        });
    }
}

// FUNCIONES MOSTRAR INFORMACION COMPLETA DEL VISITANTE
function mostrarInfoCompletaVisitante(id) {

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
            $('#InfoVisitantep').modal('show');

            $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
            $('.correovisitante').html(datos[0].correo);
            $('.celularvisitante').html(datos[0].celular);
            $('.identificacionevisitante').html(datos[0].identificacion);
            $('.tipoidvisitante').html(datos[0].tipo);
            $('.sanciones').html(datos[0].id_tipo_sancion);
            if (datos[0].placa != '') {
                $('.placaVisitante').html(datos[0].placa);
                $('#txtplacavisitante').show('fast');
            } else {
                $('#txtplacavisitante').hide('fast');

            }
            $('.nombrevisitante').html(datos[0].nombre + " " + datos[0].Segundo_Nombre);
            $('.apellidovisitante').html(datos[0].apellido + " " + datos[0].Segundo_Apellido);

        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * FUNCION ELIMINAR VISITANTES PIDO COMO PARAMETRO AL ID DEL VISITANTE A ELIMINAR
 */
function EliminarVisitante(id) {
    $.ajax({
        // LLAMO AL AJAS Y ENVIO POR POST EL ID DEL VISITANTE A ELIMINAR Y POR GET LA FUNCION QUE VA A JECUTAR A VisitantesMetodos.php
        url: "../model/visitantesMetodos.php?eliminar=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            // DEPENDIENDO DEL DATO QUE ME RETORNE LA FUNCION QUE EJECUTE EN EL PHP LE INFORMO AL USUARIO
            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Visitante Eliminado Con Exito");
                $(".mc").show("slow");
                $("#idSeleccionado").val("");
                visitante = 0;
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
                listarVisitantes();
            } else {
                $(".mc").hide("fast");
                $(".mc").html("Error Al Eliminar El Visitante");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
            }
        },
        error: function () {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Eliminar El Visitante");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
    });

}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * FUNCION MOSTRAR INFORMACION COMPLETA DEL VISITANTES A MODIFICAR LE PASO POR PARAMETRO AL ID DEL VISITANTES
 */
function mostrarInfoCompletaVisitanteModificar(id) {
    // HAGO LA LLAMADA AJAX Y ENVIO EL ID DEL VISITANTES Y LA FUNCION QUE VA A EJECUTAR
    $.ajax({
        url: "../model/visitantesMetodos.php?buscarporid=si",
        dataType: "json",
        data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            //MUESTRO LOS DATOS DEL VISITANTE EN LOS CAMPOS QUE CORRESPONDEN
            $("#txtNombreModi").val(datos[0].nombre);
            $("#txtSegundoNombremodi").val(datos[0].Segundo_Nombre);
            $("#txtsegundoapellidomodi").val(datos[0].Segundo_Apellido);
            $("#txtApellidoModi").val(datos[0].apellido);
            $("#txtCorreoModi").val(datos[0].correo);
            $("#txtCelularModi").val(datos[0].celular);
            $("#txtPlacaVehiculoModi").val(datos[0].placa);
            $("#txtIdentificacionModi").val(datos[0].identificacion);
            $(".imagenactual").html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
            NameFotoVieja = datos[0].foto;
            $("#cbxtipoIdentificacionModi").val(datos[0].tipoid);


        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * FUNCION MODIFICAR VISITANTE PASO POR PARAMETRO AL ID DEL VISITANTE A MODIFICAR
 */
function ModificarVisitante(id) {
    // EN ESTE CAVA ES DONDE GUARDO LA FOTO DEL VISITANTE 
    canvas = document.getElementById("canvasmodi");

    //OBTENGO EL FORMULARIO CON SUS RESPECTIVOS DATOS
    var formData = new FormData(document.getElementById("form-modificar-visitante"));
    var data = canvas.toDataURL("image/jpeg");
    var info = data.split(",", 2);
    // LE AGREGO AL FORMULARIO LOS DATOS ADICIONALES QUE NECESITO
    formData.append("data", info[1]);
    formData.append("id", id);
    formData.append("misma", MismaFoto);
    formData.append("nameviejo", NameFotoVieja);

    $.ajax({
        // ENVIO EL FORMULARIO POR POST Y POR GET LA FUNCION A EJECUTAR A VisitantesMetodo.php   
        url: "../model/visitantesMetodos.php?modificar=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {
        // DEPENDIENDO DE LO QUE ME RETORNE LA FUNCION DEL PHP LE INFORMO AL USUARIO
        if (datos == 1) {
            MensajeConClase("Todos Los campos son Obligatorios", ".error");
            return true;
        } else if (datos == 2) {
            MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error");
            return true;
        } else if (datos == 3) {
            MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error");
            return true;
        } else if (datos == 4) {
            MensajeConClase("Visitante Modificado Con exito", ".error");
            DesHabilitarModifica(".divmodifica");
            listarVisitantes();
            visitante = id;
            MismaFoto = 1;

            return false;
        } else {

            MensajeConClase("Ha Ocurrido un error al Modificar el Visitante", ".error");
            return false;
        }
    });


}

// ESTA VARIABLE ES PARA EL IDIOMA DE LA TABLA, EL CODIGO DE ESTA ES PARTE DE LA LIBRERIA DATA TABLE
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
