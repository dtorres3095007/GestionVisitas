var usuario = 0;
var perfil;
var menu = 0;
$(document).ready(function () {

    $(".ver").click(function () {
        $(".MenusAlterno").hide("fast");
        $("#MyFrame").show("fast");
        menu = 0;
    });


    $(window).resize(function () {
        var ventana_ancho = $(window).width();

        if (ventana_ancho > 860) {

            $(".MenusAlterno").hide("fast");
            $("#MyFrame").show("fast");
            menu = 0;
        }

    });
    $(".menuresposi").click(function () {
        if (menu == 0) {
            $(".MenusAlterno").show("slow");
            $("#MyFrame").hide("fast");
            $(".Open").hide("fast");
            menu = 1;
        } else {
            $(".MenusAlterno").hide("slow");
            $("#MyFrame").show("fast");
            menu = 0;
        }
    });
    $(document.body).delegate('#inputPassword', 'keypress', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            Logear();
            return true;
        }
    });

    $(document.body).delegate('#inputEmail', 'keypress', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            Logear();
            return true;
        }
    });

    ValidarUsuario();
    CargarPerfiles();
    PerfilSesion();
    setInterval(function () {
        ValidarUsuario();
    }, 5000);
    var cerro = $("#cerro").val();
    if (cerro != '') {
        $("#ModalMensaje1").modal();
    }

    $("#perfilesUsuario").change(function () {
        var id = $("#perfilesUsuario").val();

        CambiarPerfiles(id);


    });
    $(".micuenta").click(function () {
        var id = $("#idusuario").val();
        $('#perfilesUsuario').val(perfil);
        Micuenta(id);
        return true;
    });
    $("#btnentrar").click(function () {

        Logear();

        return true;
    });
});

function Micuenta(id) {
    $.ajax({
        url: "../model/esUsuario.php?session=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            $(".nombre").html("<span class='primero'>Nombre:</span><br>" + datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido + "</td>")
            $(".tipoidentificacion").html("<span class='primero'>Tipo de Identificacion:</span><br>" + datos.tipoidentificacion + "</td>")
            $(".identificacion").html("<span class='primero'>Identificacion:</span><br>" + datos.identificacion + "</td>")
            $(".usuariosesion").html("<span class='primero'>Usuario:</span><br>" + datos.usuario + "</td>")

        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function ValidarUsuario() {
    $.ajax({
        url: "../model/ValidarUsuario.php?validar=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                document.getElementById('sinsesion').click();

            }
        },
        error: function () {
            document.getElementById('sinsesion').click();
            console.log('Something went wrong', status, err);

        }
    });
}
function Logear() {

    var usuario = $("#inputEmail").val();
    var contrasena = $("#inputPassword").val();
    $.ajax({
        url: "model/ValidarUsuario.php?logear=si",
        dataType: "json", data: {
            usuario: usuario,
            contrasena: contrasena,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                MensajeConClase("Ingrese Usuario y contraseña", ".error")
            } else if (datos == 2) {

                MensajeConClase("Usuario o contraseña Incorrectos", ".error")
            } else if (datos == 3) {

                MensajeConClase("La persona a la cual esta asociado el usuario ha sido eliminado", ".error")
            } else if (datos == 4) {

                MensajeConClase("El usuario No tiene Ningun Perfil Asociado", ".error")
            }else if (datos == 5) {

                MensajeConClase("El usuario esta Inactivo", ".error")
            } else if (datos == 6) {

                MensajeConClase("El usuario No existe en el software GESTION DE VISITAS", ".error")
            }  else {

                window.location = "Admin/Principal.php";
            }

        },
        error: function () {
            $("#ModalMe").html("<p>Error Al Ingresar al sistema</p>");
            $("#ModalMensaje1").modal();

            console.log('Something went wrong', status, error);

        }
    });
}
function CargarPerfiles() {


    $.ajax({
        url: "../model/esUsuario.php?perfiles=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $('#perfilesUsuario').html("");

            for (var i = 0; i <= datos.length - 1; i++) {
                $('#perfilesUsuario').append("<option value=" + datos[i].id_aux + ">" + datos[i].valor + "</option>");

            }



        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function sinPerfiles() {


    $.ajax({
        url: "../model/esUsuario.php?perfiles=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            if (datos == "") {

                document.getElementById('cerrars').click();
            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

function CambiarPerfiles(id) {

    $.ajax({
        url: "../model/esUsuario.php?cambiarperfiles=si",
        dataType: "json", data: {
            perfil: id,
        },
        type: "post",
        success: function (datos) {
            CargarMenu2();
            PerfilSesion();
            document.getElementById('permiso').click();

        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
function perfilensession() {

    $.ajax({
        url: "../model/ValidarUsuario.php?validarperfil=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            if (datos == "") {
                document.getElementById('sinsesion').click();
            } else if (datos != 'SecreUser' && datos != 'Admin') {
                NoEssecretaria();

            }
        },
        error: function () {
            document.getElementById('sinsesion').click();
            console.log('Something went wrong', status, err);

        }
    });
}

function CargarMenu() {

    $.ajax({
        url: "../model/ValidarUsuario.php?menu=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            $("#tablamenu").html("");
            for (var i = 0; i <= datos.length - 1; i++) {

                $("#tablamenu").append(' <tr> <td> <a href="../modulos/' + datos[i].id_aux + '.php?cerrar=yes" target="ventana"><span style="color: #990000;" class="' + datos[i].valory + '" ></span><span>' + datos[i].valor + '</span></a></td></tr>');

            }

        },
        error: function () {
            document.getElementById('sinsesion').click();
            console.log('Something went wrong', status, err);

        }
    });
}
function CargarMenu2() {
  
       $('.tablamenu tbody').off('click', 'tr');
    var myTable = $(".tablamenu").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/ValidarUsuario.php?menu2=si",
            dataType: "json",
            type: "post",
        },
        //"processing": true,
        paging: false,
        scrollY: 400,
        "columns": [
            {"data": "indice"},
        ], "language": idioma2,
        "lengthMenu": [5, 25, 50, 75, 100],
        dom: 'Bfrtip',
        "buttons": [
        ],
    });
   
}
function PerfilSesion() {
    $.ajax({
        url: "../model/ValidarUsuario.php?validarperfil=si",
        dataType: "json",
        type: "post",
        success: function (datos) {

            perfil = datos;


        },
        error: function () {
            document.getElementById('sinsesion').click();
            console.log('Something went wrong', status, err);

        }
    });
}
function BuscarPermisosActividadPerfil(actividad) {
    i = 0;
// HAGO LA LLAMADA AJAX Y ENVIO EL ID DEL VISITANTES Y LA FUNCION QUE VA A EJECUTAR
    $.ajax({
        url: "../model/Parametros.php?BuscarPermisosActi_per=si",
        dataType: "json", data: {
            actividad: actividad,
        },
        type: "post",
        success: function (datos) {
            if (datos == null) {
                $("body").css("display", "none");
                alert("No cuenta con los permisos para esta actividad")
            } else {
                var ventana = ".opciones" + actividad;
                var sw = 0;
                if (actividad == "ReservaVisita") {
                    EsReserva();
                    reserv();
                }
                if (datos.agrega == 0) {

                    if (actividad == "Eventos") {

                        estadoAgrega();
                    }

                    if (actividad == "Visita") {

                        AgregarPar();
                        estadoAgrega();
                    }


                    $("" + ventana + " .btnAgregar").hide("fast");
                    sw = sw + 1;
                }
                if (datos.elimina == 0) {

                    $("" + ventana + " .btnElimina").hide("fast");
                    sw = sw + 1;
                }
                if (datos.modifica == 0) {

                    if (actividad == "Actividades_Perfil") {
                        PuedeModificarPermiso();
                    }

                    $("" + ventana + " .btnModifica").hide("fast");
                    sw = sw + 1;
                }
                if (datos.amplia == 0) {

                    $("" + ventana + " .btnAmplia").hide("fast");

                }
                if (datos.cambia_tabla == 0) {

                    $("" + ventana + " .btnCambiaTabla").hide("fast");
                    sw = sw + 1;
                }

                if (sw == 4) {
                    $("" + ventana + " .bntLectura").show("fast");

                }

                $("body").show("fast")

            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });

}
var idioma2 = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "",
    "sInfoEmpty": "",
    "sInfoFiltered": "",
    "sInfoPostFix": "",
    "sSearch": "Buscar: ",
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
function saluda(){$(".Open").hide("slow")
        $(".Open").show("slow")}
