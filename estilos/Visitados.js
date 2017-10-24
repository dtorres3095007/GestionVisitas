// DECLARO LAS VARIABLES QUE NECESITO
// ESTA VARIABLE ME GUARDA EL ID DEL VISITADO QUE SELECCIONO DE LA TABLA
var visitado = 0;
// ESTA VARIABLE ME GUARDA EL ESTILO DE LA TABLA
var estilotablaVisitados = 0;

$(document).ready(function () {


    $("#CambiarContra").click(function () {
        $("#contra").val("");
        $("#rcontra").val("");
        $("#contraactual").val("");
        $("#ModalMe").html("<p>Buen dia " + $(".nombrevisitados").html() + ", para continuar ingresa contraseña actual..!</p>")

        $(".contraseñas").hide("fast");
        $("#contraactual").show("fast");
        $("#Modificar-Contra").hide("fast");
        $("#verificar-Contra").show("fast");
        $("#ModalMe").html("<p>Buen dia " + $(".nombrevisitados").html() + ", para continuar ingresa contraseña actual..!</p>")
        $("#ModalContraseña").modal();

    });
    $("#Recargar").click(function () {
        listarVisitados();

    });
    $("#Recargar2").click(function () {

        mostrarInfoCompletaVisitadosesion();

    });

    // AL DAR CLICK EN CAMBIARTABLA CAMBIO EL VALOR DE LA VARIABLE ESTILOTABLA Y LLAMO A LA FUNCION ListarVisitados
    $("#CambiarTabla").click(function () {
        if (estilotablaVisitados == 0) {
            estilotablaVisitados = 1;
        } else {
            estilotablaVisitados = 0;
        }

        listarVisitados();
    });

    $('#btnRecargar').click(function () {

        visitado = $("#idSeleccionado").val().trim();

        mostrarInfoCompletaVisitadoModificar(visitado);

        $(".error").hide('fast');


    });
    $('#btnRecargar2').click(function () {



        mostrarInfoCompletaVisitadoModificar(-1);

        $(".error").hide('fast');


    });

    /**
     * AL DAR CLICK EN btnModificarVisitado LLAMO A LA FUNCION ModificarVisitado 
     */
    $("#form-modificar-visitado").submit(function () {

        var id = $("#idSeleccionado").val();

        ModificarVisitado(id, "form-modificar-visitado");
        return false;
    });
    $("#form-modificar-visitado2").submit(function () {
        ModificarVisitado(-1, "form-modificar-visitado2");
        return false;
    });
    /**
     * AL PRESIONARL modificar VALIDO QUE YA ESTE SELECIONADO UN VISITANTE EN LA TABLA
     * SI YA ESTA SELECIONADO LLAMO A LA FUNCON mostrarInfoCompletaVisitadoModificar EL CUAL SE LE PASA POR PARAMETRO EL ID DEL 
     * VISITADO Y LUEGO MUESTRO EL MODAL
     */

    $("#modificar").click(function () {
        visitado = $("#idSeleccionado").val().trim();
        if (visitado.length == 0) {
            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar<br> El visitado a Modificar</p>");
            $("#ModalMensaje").modal();
        } else {

            $(".error").hide('fast');
            mostrarInfoCompletaVisitadoModificar(visitado);
            $("#ModificarVisitado").modal();
        }
    })

    $("#modificar2").click(function () {

        mostrarInfoCompletaVisitadoModificar(-1);
        $("#ModificarVisitado").modal();

    })

    /**
     * AL PRESIONARL eliminar VALIDO QUE YA ESTE SELECIONADO UN VISITANTE EN LA TABLA
     * SI YA ESTA SELECIONADO LLAMO AL MODAL DE CONFIRMACION DE ELIMINAR
     */
    $("#eliminar").click(function () {

        visitado = $("#idSeleccionado").val().trim();


        if (visitado.length == 0) {

            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar<br> El Visitado a Eliminar</p>");
            $("#ModalMensaje").modal();
        } else {
            $(".mc").html("¿ Esta Seguro de Desea Eliminar el Visitado ?");
            $("#salirEliminar").hide("fast");
            $(".botonesEliminar").show("slow");
            $("#ModalConfirmacionEliminar").modal();
        }
    });
    /*
     * AL PRESIONAR  btnEliminarVisitado LLAMO A LA FUNCION EliminarVisitado QUE ES LA ENCARGADA DE ELIMINAR
     */
    $("#btnEliminarVisitado").click(function () {
        visitado = $("#idSeleccionado").val().trim();

        EliminarVisitado(visitado)
    });


});


/**
 * 
 * @returns {undefined}
 * EN ESTA FUNCION MUESTRO LOS VISITADOS EN UNA TABLA LA CUAL SE CARGA POR HACIENDO EL LLAMADO DE EL ARCHIVO visitado.php
 * PASANDOLE COMO PARAMETRO LA FUNCION MOSTRAR
 * EL ESTILO DE LA TABLA SE CARGA DEPENDIENDO DEL VALOR DE LA VARIABLE QUE SE DEFINIDO ANTERIORMENTE
 * EL PRIMER ESTILO DE TABLA ES CON PAGINACION
 * EL SEGUNDO ESTILO DE LA TABLA ES CON SCROLL
 */
var listarVisitados = function () {

    $('#tablavisitado tbody').off('click', 'tr');
    $('#tablavisitado tbody').off('dblclick', 'tr');
    if (estilotablaVisitados == 0) {
        var table = $("#tablavisitado").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visitado.php?mostrar=si",
                dataType: "json",
                type: "post",
            }, //paging: false,
            //scrollY: 400,

            "columns": [
                {"data": "Nombre"},
                {"data": "Segundo_Nombre"},
                {"data": "Apellido"},
                {"data": "Segundo_Apellido"},
                {"data": "valor"},
                {"data": "Identificacion"},
                {"data": "Id_Departamento"},
                {"data": "cargo"},
                {"data": "Telefono"},
                {"data": "Correo"},
            ], "language": idioma,
            dom: 'Bfrtip',
            "buttons": [
                {
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
        $('#tablavisitado tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);

        });
        $('#tablavisitado tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();

            mostrarInfoCompletaVisitado(data[0])

        });
    } else {
        var table = $("#tablavisitado").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/visitado.php?mostrar=si",
                dataType: "json",
                type: "post",
            }, paging: false,
            scrollY: 400,
            "columns": [
                {"data": "Nombre"},
                {"data": "Segundo_Nombre"},
                {"data": "Apellido"},
                {"data": "Segundo_Apellido"},
                {"data": "valor"},
                {"data": "Identificacion"},
                {"data": "Id_Departamento"},
                {"data": "cargo"},
                {"data": "Telefono"},
                {"data": "Correo"},
            ], "language": idioma,
            dom: 'Bfrtip',
            "buttons": [
                {
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
        $('#tablavisitado tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[0]);

        });
        $('#tablavisitado tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();

            mostrarInfoCompletaVisitado(data[0])

        });

    }
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * ESTA FUNCION ME MUESTRA LA INFORMACION COMPLETA DEL VISITADO EN UN MODAL
 * PARA MOSTRAR LA INFORMACION LLAMO A MI ARCHIVO Visitado.php Y LE PASO COMO PARAMETRO buscarid 
 */
function mostrarInfoCompletaVisitado(id) {

    $.ajax({
        url: "../model/visitado.php?buscarid=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            $('#InfoVisitado').modal('show');
            $('.fotoVisitado').html("<img src='../ImagenesVisitados/" + datos.foto + "'>");
            $('.nombrevisitados').html(datos.Nombre + " " + datos.Segundo_Nombre);
            $('.apellidovisitado').html(datos.Apellido + " " + datos.Segundo_Apellido);
            $('.correovisitado').html(datos.correo);
            $('.celularvisitado').html(datos.telefono);
            $('.ubicacionvisitado').html(datos.ubicacion);
            $('.departamentovisitado').html(datos.departamento);
            $('.cargo').html(datos.cargo);
            $('.identificacionvisitado').html(datos.identificacion);
            $('.Tipoidentificacionvisitado').html(datos.Id_TipoIdentificacion);

        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}

function mostrarInfoCompletaVisitadosesion() {

    $.ajax({
        url: "../model/visitado.php?buscarid2=si",
        dataType: "json", data: {
        },
        type: "post",
        success: function (datos) {

            $('.fotoVisitado').html("<img src='../ImagenesVisitados/" + datos.foto + "'>");
            $('.nombrevisitados').html(datos.Nombre + " " + datos.Segundo_Nombre);
            $('.apellidovisitado').html(datos.Apellido + " " + datos.Segundo_Apellido);
            $('.correovisitado').html(datos.correo);
            $('.celularvisitado').html(datos.telefono);
            $('.ubicacionvisitado').html(datos.ubicacion);
            $('.departamentovisitado').html(datos.departamento);
            $('.cargo').html(datos.cargo);
            $('.identificacionvisitado').html(datos.identificacion);
            $('.Tipoidentificacionvisitado').html(datos.Id_TipoIdentificacion);

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
 * ESTA FUNCION ES LA ENCARGADA DE ELIMINAR UN VISITADO PARA REALIZAR ESTO LLAMO A MI ARCHIVO Visitados.php
 * Y LE PASO COMO PARAMETRO eliminar
 * DEPENDIENDO DEL RETORNO LE INFORMO AL USUARIO EL RESULTADO DE LA OPERACION
 */

function EliminarVisitado(id) {

    $.ajax({
        url: "../model/visitado.php?eliminar=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Visitado Eliminado Con Exito");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
                $("#idSeleccionado").val("");
                visitado = 0;
                listarVisitados();
            } else {
                $(".mc").hide("fast");
                $(".mc").html("Error Al Eliminar El Visitado");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
            }
        },
        error: function () {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Eliminar El Visitado");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
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
/**
 * 
 * @param {type} id
 * @returns {undefined}
 * EN ESTA FUNCION MUESTRO LA INFORMACION COMPLETA DEL VISITANTE QUE VOY A MODIFICAR
 */
function mostrarInfoCompletaVisitadoModificar(id) {

    $.ajax({
        url: "../model/visitado.php?buscarid=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {
            $("#txtNombreModi").val(datos.Nombre);
            $("#txtSegundoNombremodi").val(datos.Segundo_Nombre);
            $("#txtsegundoapellidomodi").val(datos.Segundo_Apellido);
            $("#txtApellidomodi").val(datos.Apellido);
            $("#txtCorreomodi").val(datos.correo);
            $("#txtCelularmodi").val(datos.telefono);
            $("#cbxcargomodi").val(datos.placa);
            $("#txtIdentificacionModi").val(datos.identificacion);

            $("#cbxtipoIdentificacionModi").val(datos.idtipoidenti);
            $("#cbxcargomodi").val(datos.idcargo);
            $("#cbxdepartamentomodi").val(datos.departamentoid);
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
 * ESTA FUNCION ES LA ENCARGADA MODIFICAR EL VISITADO 
 */
function ModificarVisitado(id, form) {

    //tomamos el formulairo ingresar visitante
    var formData = new FormData(document.getElementById(form));
    formData.append("id", id);
    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/visitado.php?modificar=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == 1) {

            MensajeConClase("Todos Los campos son Obligatorios", ".error");
            return false;
        } else if (datos == 2) {

            MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error");
            return false;
        } else if (datos == 3) {

            MensajeConClase("El Visitado ya se encuentra en el Sistema", ".error");
            return false;
        } else if (datos == 4) {


            if (id != -1) {

                MensajeConClase("Visitado Modificado Con exito", ".error");
                DesHabilitarModifica(".divmodifica");
                listarVisitados();
            } else {
                MensajeConClase("Datos Modificados Con exito", ".error");
                DesHabilitarModifica(".divmodifica");
                mostrarInfoCompletaVisitadosesion();
            }
        } else if (datos == 5) {

            MensajeConClase("Formato de la Imagen No valido, Formatos validos JPG, PNG, GIF, JPEG", ".error");
            $("#FileImagen").val('');
            return false;

        } else {

            MensajeConClase("Error al Modificar al Visitado", ".error");
            return false;
        }
    });



}