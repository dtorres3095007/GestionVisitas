//DECLARO LAS VARIABLES 
// ESTAS VARIABLES CAPTURAN EL USUARIO SELECCIONADO
var usuario = 0;
var usuariosele = 0;
// EN ESTAS VARIABLES GUARDO LA CONTRASEÑA,TIPOUSUAIRO Y EL CORREO DEL USUARIO QUE VOY A MODIFICAR
var Password = 0;
var tipoUsuario = "";
var Correo = "";
PerfilQuitar = 0;
//EN ESTA VARIABLE CONTROLO EL ESTILO DE LA TABLA
var estilotablaUsuarios = 0;
$(document).ready(function() {
    $("#Recargar").click(function() {
        listarUsuarios();

    });
    $("#Modificar-Contra").click(function() {
        var contra = $("#contra").val();
        var rcontra = $("#rcontra").val();

        ModificarContraseña(contra, rcontra);
        return false;
    });
    $("#verificar-Contra").click(function() {
        var contra = $("#contraactual").val();
        ValidarContra(contra)
        return false;
    });
    $("#retirarsi").click(function() {
        $(".confirmar").hide('fast');
        EliminarPerfilUsuario(PerfilQuitar);

    });
    $("#retirarno").click(function() {
        $(".confirmar").hide('slow');

    });
    $("#EliminarPerfil").click(function() {
        if (PerfilQuitar == 0) {
            MensajeConClase("Seleccione El perfil a Eliminar", ".error")
        } else {
            $(".error").hide('fast');
            $(".confirmar").show('slow');
        }

    });

    // AL DAR CLICK EN CAMBIARTABLA CAMBIO EL VALOR DE LA VARIABLE ESTILOTABLA Y LLAMO A LA FUNCION listarUsuarios
    $("#CambiarTabla").click(function() {
        if (estilotablaUsuarios == 0) {
            estilotablaUsuarios = 1;
        } else {
            estilotablaUsuarios = 0;
        }
        listarUsuarios();
    });
    /**
     *  AL DAR CLICK perfilesUsuariot CARGO LLAMO A LA FUNCION cargarPerfilesUser Y CargartiposPerfilesPorusuario A LAS CUALES
     *  LE PASO COMO PARAMETRO EL ID DEL USUARIO
     */
    $("#perfilesUsuariot").DataTable();
    $("#Asignar").click(function() {
        $(".error").hide('fast');
        var id = $("#idSeleccionado").val();

        cargarPerfilesUser(id);
        CargartiposPerfilesPorusuario(id);
    });
    $("#chbxReestablecerPassword").click(function() {
        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            Password = 1;
        } else {
            Password = 0;
        }
    });
    $("#AsignarPerfilusuario").click(function() {
        var usuario = $("#idSeleccionado").val();
        var perfil = $("#cbxdperfil").val();

        AsignarPerfilUsuario(perfil, usuario)
        return true;
    });

    /**
     * AL DAR CLICK EN modificar LLAMO A LA FUNCION cargarUsuario 
     */
    $("#modificar").click(function() {
        $("input:checkbox").prop('checked', false);
        $(".error").hide('fast');
        $("#txtNuevoUsuario").val("");
        usuario = $("#idSeleccionado").val().trim();

        if (usuario.length == 0) {
            $("#ModalMe").html("<p ><b>Antes de Continuar Debe Seleccionar El Usuario</b></p>");
            $("#ModalMensaje").modal();
        } else {
            $("#txtNuevoUsuario").focus();

            cargarUsuario(usuario);
            $("#modalModificar").modal();
        }
    });

    /**
     * AL PRESIONARL eliminar VALIDO QUE YA ESTE SELECIONADO UN USUAIRO EN LA TABLA
     * SI YA ESTA SELECIONADO LLAMO AL MODAL DE CONFIRMACION DE ELIMINAR
     */
    $("#eliminar").click(function() {

        usuario = $("#idSeleccionado").val().trim();

        if (usuario.length == 0) {
            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar<br> El Usuario a Eliminar</p>");
            $("#ModalMensaje").modal();
        } else {
            $(".mc").html("¿ Esta Seguro de Desea Eliminar el Usuario ?");
            $("#salirEliminar").hide("fast");
            $(".botonesEliminar").show("slow");
            $("#ModalConfirmacionEliminar").modal();
        }
    });
    $("#Asignar").click(function() {

        usuario = $("#idSeleccionado").val().trim();

        if (usuario.length == 0) {
            $("#ModalMe").html("<p >Antes de Continuar Debe Seleccionar El Usuario</p>");
            $("#ModalMensaje").modal();
        } else {

            $("#AsignarPerfil").modal();
        }
    });
    /*
     * AL PRESIONAR  btnEliminarUsuario LLAMO A LA FUNCION EliminarUsuario QUE ES LA ENCARGADA DE ELIMINAR
     */
    $("#btnEliminarUsuario").click(function() {
        var idUsuario = $("#idSeleccionado").val().trim();
        EliminarUsuario(idUsuario)
    });

    $("#btnModificarUsuario").click(function() {

        $(".error").hide('fast');
        var id = $("#idSeleccionado").val().trim();
        var usuarioActual = $("#txtUsuario1").val();
        var nuevoUsuario = $("#txtNuevoUsuario").val();


        if (nuevoUsuario != "" && nuevoUsuario != usuarioActual) {
            buscarUsuario(id, nuevoUsuario);
        } else if (nuevoUsuario == "" && Password == 0) {

            MensajeConClase("Escribe Nombre de  Usuario", ".error");
            $("#txtNuevoUsuario").focus();
        } else if (nuevoUsuario == usuarioActual) {

            MensajeConClase("No se realizaron cambios en el usuario", ".error");
            $("#txtNuevoUsuario").focus().select();
        } else if (nuevoUsuario == "" && Password == 1) {
            correoCambioPassword(id, tipoUsuario, Correo);

            MensajeConClase("Contraseña Reestablecida Correctamente", ".error");
        }
        return false;


    });
});

/**
 * 
 * @returns {undefined}
 * EN ESTA FUNCION MUESTRO LOS USUARIOS EN UNA TABLA LA CUAL SE CARGA POR HACIENDO EL LLAMADO DE EL ARCHIVO esUsuario.php
 * PASANDOLE COMO PARAMETRO LA FUNCION MOSTRAR
 * EL ESTILO DE LA TABLA SE CARGA DEPENDIENDO DEL VALOR DE LA VARIABLE QUE SE DEFINIDO ANTERIORMENTE
 * EL PRIMER ESTILO DE TABLA ES CON PAGINACION
 * EL SEGUNDO ESTILO DE LA TABLA ES CON SCROLL
 */
var listarUsuarios = function() {

    $('#tablausuarios tbody').off('click', 'tr');
    if (estilotablaUsuarios == 0) {
        var table = $("#tablausuarios").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/esUsuario.php?mostrar=si",
                dataType: "json",
                type: "post",
            }, //paging: false,
            //scrollY: 400,
            // "processing": true,
            "columns": [
                {"data": "nombre"},
                {"data": "apellido"},
                {"data": "tipoidentificacion"},
                {"data": "identificacion"},
                {"data": "usuario"},
                {"data": "correo"},
                {"data": "telefono"},
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
        $('#tablausuarios tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
  HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data["idusuario"]);
            $("input:checkbox").prop('checked', false);

            usuario = 1;
        });

    } else {
        var table = $("#tablausuarios").DataTable({
            "destroy": true,
            "ajax": {
                url: "../model/esUsuario.php?mostrar=si",
                dataType: "json",
                type: "post",
            }, paging: false,
            scrollY: 400,
            // "processing": true,
            "columns": [
                {"data": "nombre"},
                {"data": "apellido"},
                {"data": "tipoidentificacion"},
                {"data": "identificacion"},
                {"data": "usuario"},
                {"data": "correo"},
                {"data": "telefono"},
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
        $('#tablausuarios tbody').on('click', 'tr', function() {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
  HabilitarModifica(".divmodifica");
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data["idusuario"]);
            $("input:checkbox").prop('checked', false);

            usuario = 1;
        });



    }
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * ESTA FUNCION ES LA ENCARGADA DE ELIMINAR UN USUAIRO PARA REALIZAR ESTO LLAMO A MI ARCHIVO esUsuario.php
 * Y LE PASO COMO PARAMETRO eliminar
 * DEPENDIENDO DEL RETORNO LE INFORMO AL USUARIO EL RESULTADO DE LA OPERACION
 */
function EliminarUsuario(id) {
    $.ajax({
        url: "../model/esUsuario.php?eliminar=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function(datos) {

            if (datos == 1) {
                $(".mc").hide("fast");
                $(".mc").html("Usuario Eliminado Con Exito");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
                $("#idSeleccionado").val("");
                usuario = 0;
                listarUsuarios();
            } else {
                $(".mc").hide("fast");
                $(".mc").html("Error Al Eliminar El Usuario");
                $(".mc").show("slow");
                $(".botonesEliminar").hide("fast");
                $("#salirEliminar").show("slow");
            }
        },
        error: function() {

            $(".mc").hide("fast");
            $(".mc").html("Error Al Eliminar El Usuario");
            $(".mc").show("slow");
            $(".botonesEliminar").hide("fast");
            $("#salirEliminar").show("slow");
            console.log('Something went wrong', status, err);

        }
    });

}

/**
 * 
 * @param {type} idperfil
 * @param {type} idusuario
 * @returns {undefined}
 * ESTA FUNCION PERMITE ASIGNARLE UN PERFIL AL USUARIO
 * PARA ELLO HACE EL LLAMADO DE LAS FUNCIONES
 *  cargarPerfilesUser(idusuario);
 *   CargartiposPerfilesPorusuario(idusuario)
 */
function AsignarPerfilUsuario(idperfil, idusuario) {
    if (idperfil == "") {

        MensajeConClase("eleccione Perfil Asignar", ".error");
    } else {
        $.ajax({
            url: "../model/esUsuario.php?asignar=si",
            dataType: "json", data: {
                idperfil: idperfil,
                idusuario: idusuario,
            },
            type: "post",
            success: function(datos) {

                MensajeConClase("Perfil Asignado Con exito", ".error");
                cargarPerfilesUser(idusuario);
                CargartiposPerfilesPorusuario(idusuario)
            },
            error: function() {

                MensajeConClase("Error al asignar el perfil", ".error");
                console.log('Something went wrong', status, err);

            }
        });
    }
}
/*
 * EN ESTA FUNCION CARGO LOS PERFILES QUE NO TIENE ASIGNADO EL USUARIO EN UN COMBO
 * PARA ELLO LLAMO A MI ARCHIVO esUsuario.php Y LE PASO COMO PARAMETRO perfilesusuariossinasignar
 */
function CargartiposPerfilesPorusuario(id) {

    $.ajax({
        url: "../model/esUsuario.php?perfilesusuariossinasignar=si",
        dataType: "json", data: {
            idusuario: id,
        },
        type: "post",
        success: function(datos) {

            $('#cbxdperfil').html("");
            $('#cbxdperfil').append("<option value=" + '' + ">" + 'Seleccione Nuevo Perfil' + "</option>");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('#cbxdperfil').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            }
            ;
        },
        error: function() {

            console.log('Something went wrong', status, err);

        }
    });

}
/**
 * 
 * @param {type} id
 * @returns {undefined}
 * EN ESTA FUNCION CARGO LOS PERFILES QUE YA TIENE ASIGNADO EL USUARIO EN UNA TABLA PARO ELLO LLAMO A LA MI ARCHIVO perfilesusuarios
 * Y LE PASO COMO PARAMETRO perfilesusuarios
 * 
 */
function cargarPerfilesUser(id) {
    $(".confirmar").hide('fast');
    $('#perfilesUsuariot tbody').off('click', 'tr');
    var table = $("#perfilesUsuariot").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/esUsuario.php?perfilesusuarios=si",
            dataType: "json", data: {
                idusuario: id,
            },
            type: "post",
        },
        "lengthMenu": [5, 25, 50, 75, 100],
        // "processing": true,
        "columns": [
            {"data": "indice"},
            {"data": "valor"},
            {"data": "valorx"},
        ], "language": idioma,
        dom: 'Bfrtip',
        "buttons": [
        ]

    });
    $('#perfilesUsuariot tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
        $("#perfilesUsuariot tr").removeClass("warning");

        $(this).attr("class", "warning");


        PerfilQuitar = data[4];
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
 * EN ESTA FUNCION CARGO LOS DATOS DEL USUARIO QUE VOY A MODIFICAR
 */
function cargarUsuario(id) {

    $.ajax({
        url: "../model/esUsuario.php?cargarUsuario=si",
        dataType: "json",
        data: {
            idusuario: id,
        },
        type: "post",
        success: function(datos) {

            $("#txtUsuario1").val(datos.usuario);
            Correo = datos.correo;
            tipoUsuario = datos.id_tipo_persona;
            $("#txtNuevoUsuario").focus();
        },
        error: function() {

            console.log('Something went wrong', status, err);

        }
    });
}
/**
 * 
 * @param {type} id
 * @param {type} usuario
 * @returns {undefined}
 * EN ESTA FUNCION ACTUALIZO LOS DATOS DEL USUARIO LLAMANDO A MI ARCHIVO esUsuario.php Y PASANDOLE COMO PARAMETRO actualizarUsuario
 */
function actualizarUsuario(id, usuario) {

    $.ajax({
        url: "../model/esUsuario.php?actualizarUsuario=si",
        dataType: "json",
        data: {
            id: id,
            usuario: usuario,
        },
        type: "post",
    });
    listarUsuarios();
        DesHabilitarModifica(".divmodifica");
  
}
/**
 * 
 * @param {type} id
 * @param {type} usuario
 * @returns {undefined}
 * EN ESTA FUNCION BUSCO EL USUARIO POR EL ID Y EL NOMBRE DEL USUARIO
 * PARA REALIZAR ESTO LLAMO A MI ARCHIVO esUsuario.php PASNADOLE COMO PARAMETRO  buscarUsuario
 */
function buscarUsuario(id, usuario) {
    $.ajax({
        url: "../model/esUsuario.php?buscarUsuario=si",
        dataType: "json",
        data: {
            usuario: usuario,
        },
        type: "post",
        success: function(datos) {
            if (datos == 1) {

                MensajeConClase("Nombre de Usuario Existente", ".error");

                $('#txtNuevoUsuario').focus().select();
            } else {
                actualizarUsuario(id, usuario);
                if (Password == 1) {
                    correoCambioPassword(id, tipoUsuario, Correo);
                }

                MensajeConClase("Nombre de Usuario Actualizado", ".error");
                $("#txtUsuario1").val(usuario);
                $("#txtNuevoUsuario").val("");
            }
            ;
            return datos;
        },
        error: function() {

            console.log('Something went wrong', status, err);
        }
    });
}
/**
 * 
 * @param {type} id
 * @param {type} tipoUsuario
 * @param {type} correo
 * @returns {undefined}
 */
function correoCambioPassword(id, tipoUsuario, correo) {
    $.ajax({
        url: "../model/esUsuario.php?correoPassword=si",
        dataType: "json",
        data: {
            id: id,
            tipoUsuario: tipoUsuario,
            correo: Correo,
        },
        type: "post",
        success: function(datos) {
            return 1;
        },
        error: function() {
            return 2;
            console.log('Something went wrong', status, err);

        }
    });
}

/**
 * 
 * @param {type} id
 * @returns {undefined}
 * ESTA FUNCION ES LA ENCARGADA DE ELIMINAR UN PERFIL ASIGNADO MEDIEANTE EL ARCHIVO esUsuario.php
 * Y LE PASO COMO PARAMETRO eliminar y el id del usuario
 * DEPENDIENDO DEL RETORNO LE INFORMO AL USUARIO EL RESULTADO DE LA OPERACION
 */
function EliminarPerfilUsuario(id) {
    $.ajax({
        url: "../model/esUsuario.php?eliminarPerfil=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function(datos) {

            if (datos == 1) {

                MensajeConClase("Perfil Eliminado Con Exito", ".error");
                var id = $("#idSeleccionado").val();
                cargarPerfilesUser(id);
                CargartiposPerfilesPorusuario(id);
                PerfilQuitar = 0;
            } else {

                MensajeConClase("Error Al Eliminar El Perfil", ".error");
            }
        },
        error: function() {

            MensajeConClase("Error Al Eliminar El Perfil", ".error");
            console.log('Something went wrong', status, err);

        }
    });

}

function ModificarContraseña(contra, rcontra) {
    if (contra === rcontra) {


        $.ajax({
            url: "../model/esUsuario.php?modicontra=si",
            dataType: "json", data: {
                contra: contra,
                rcontra: rcontra,
            },
            type: "post",
            success: function(datos) {

                if (datos == 1) {

                    MensajeConClase("Contraseña Actualizada", ".error");
                    $("#contra").val("");
                    $("#rcontra").val("");
                    $("#contraactual").val("");
                    $("#ModalMe").html("<p>Buen dia " + $(".nombrevisitados").html() + ", para continuar ingresa contraseña actual..!</p>")

                    $(".contraseñas").hide("fast");
                    $("#contraactual").show("fast");
                    $("#Modificar-Contra").hide("fast");
                    $("#verificar-Contra").show("fast");
                } else if (datos == 2) {
                    MensajeConClase("Las contraseñas no coinciden", ".error");

                } else {

                    MensajeConClase("Error Al Actualizar la contraseña", ".error");
                    $("#contra").val("");
                    $("#rcontra").val("");
                }
            },
            error: function() {

                MensajeConClase("Error Al Actualizar la contraseña", ".error");
                $("#contra").val("");
                $("#rcontra").val("");
                console.log('Something went wrong', status, err);

            }
        });
    } else {
        MensajeConClase("Las contraseñas no coinciden", ".error");
    }
}
function ValidarContra(contra) {
    $.ajax({
        url: "../model/esUsuario.php?validarusu=si",
        dataType: "json", data: {
            contra: contra,
        },
        type: "post",
        success: function(datos) {

            if (datos == 1) {

                MensajeConClase("Ingrese Contraseña", ".error");


            } else if (datos == 2) {
                MensajeConClase("Contraseña Incorrecta", ".error");

            } else if (datos == 3) {
                MensajeConClase("La persona fue eliminada del sistema, comuniquese con el administrador", ".error");

            } else if (datos == 4) {
                MensajeConClase("La persona no tiene perfiles asociados, comuniquese con el administrador", ".error");

            } else {
                $("#ModalMe").html("<p>Buen dia " + $(".nombrevisitados").html() + ", para Terminar ingresa la Nueva contraseña..!</p>")

                $(".error").hide("fast");
                $(".contraseñas").show("fast");
                $("#contraactual").hide("fast");
                $("#Modificar-Contra").show("fast");
                $("#verificar-Contra").hide("fast");
            }
        },
        error: function() {

            MensajeConClase("Error Al confirmar la contraseña", ".error");

            console.log('Something went wrong', status, err);

        }
    });

}