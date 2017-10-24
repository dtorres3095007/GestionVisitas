/*
 * 
 * @type Number
 * DECLARO LAS VARIABELS GLOBALES QUE NECESITO PARA CADA FUNCION
 */

/*
 * 
 * @type Number
 * ESTAS  VARIABLES SE UTIIZAN EN EL FORMULARIO DE REGISTRO DE VISITAS
 */

/*
 * 
 * @type Number
 * CON ESTAS VARIABLES ME REGRESO O CONTINUO DEPENDIENDO SI YA REAIZO LO QUE CORESPONDIA EN EL PASO ANTERIOR
 */
//ESTA VARIABLE LA UTILIZO PARA SABER SI EL USUARIO NO HA CAMBIADO DE FOTO AL MOMENTO DE MODIFICAR UN VISITANTE
estiloTablasanciones = 0;
MismaFoto = 1;
tiporecarga = 0;
VisitadosVisita = 0;
//EN VARIABLE ESTA GUARDO EL NOMBRE DE LA FOTO ANTERIOR A MODIFICACION
NameFotoVieja = "";
visitantedere = 0;
visitanteizqui = 0;
visitadoizqui = 0;
visitadodere = 0;
visitaizqui = 0;
visi1 = 0;
visidatos = 0;
Listo = 0;
var reservaEs = 0;
var DesdeVisita = 0;
var VisitantesVector = [];
var VisitanteSancion = 0;
idSancion = 0;
/*
 * 
 * @type Number
 * EN ESTAS DOS VARIABLES GUARDO EL ID DE LOS VISITANTESY VISITADOS PARA EL FORMULARI ODE VISITAS
 */
visitadoencontrado = 0;
visitanteencontrado = 0;
var idvisitante = "";
var idvisitado = "";
/*
 * 
 * @type Number
 * CON LA VARIABLE MODO DE BUSQUEDA CAMBIO LA BUSQUEDA DEL VISITANTE 
 * SE PUEDE BUSCAR YA SEA POR CEDULA  O POR NOMBRE Y APELLIDO
 */
var modobusqueda = 0;
/*
 * 
 * @type Number
 * CON LA VARIABLE MbusquedaVisitado CAMBIO LA BUSQUEDA DEL VISITADO
 * SE PUEDE BUSCAR YA SEA POR CEDULA  O POR NOMBRE Y APELLIDO
 */
var busquedaVisitado = 1;
foto = 0;
foto2 = 0;
foto3 = 0;
/*
 * 
 * @type Number
 * ESTAS  VARIABLES SE UTIIZAN EN EL FORMULARIO DE REGISTRO DE USUARIOS
 */

/*
 * 
 * @type Number
 * ESTAS DOS VARIABLES SE USAN PARA OBTENER LA INFORMACION DEL USUARIO
 */
identificacionpersona = 0;
mostrarpersona = 0;
MismaFoto = 0;
$(document).ready(function () {
    $(".omitir").click(function () {

        $('#derevisitante').css('color', '#cccccc');
        $('#izquivisitado').css('color', '#cccccc');
        visitantedere = 1;
        visitadoizqui = 1;
        visitanteencontrado = 1;
        visi1 = 1;
        mostrarFormVisitado();

    });
    $("input").change(function () {

        $(".celularlectura").focus(function () {

            var value = $(this).val();
            $(this).val(value.trim());
            $(this).blur();
            return false;

        });

        var value = $(this).val();
        $(this).val(value.trim());

    })
    $(".celularlectura").click(function () {

        $(this).focus();
    });

    $("#txtPlacaVehiculo").change(function () {


        var value = $(this).val().length;
        if (value != 6) {
            MensajeConClase("El numero de caracteres valido para la placa son 6", ".error")
        } else {
            $("#tablaVisitantesVisita tbody tr").removeClass("success");
            VisitantesVector = [];
            EliminarEnVectorVisitantes(0);
            $(".error").hide("fast")
        }

    })


    $("#btnAgregarSancion").click(function () {
        idSancion = $('#cbxSanciones').val();
        if (idSancion != 0) {

            agregarSancion(idSancion, VisitanteSancion);
        } else {
            MensajeConClase('Escoja un Tipo de Sanción', ".error");
        }
    });
    $('.rSancion').click(function () {


        if (idSancion == 0) {
            MensajeConClase('Antes de Continuar Debe Seleccionar la Sancion', ".error");
        } else {
            $(".error").html("");
            $(".confirmarSancion").show("fast");
        }
    });



    $("#eliminarsi").click(function () {
        eliminarSancion(VisitanteSancion, idSancion);

        $('.confirmar').hide('fast');
        idSancion = 0;
    });

    $("#eliminarno").click(function () {
        $(".confirmarSancion").hide("fast");
    });
    $(".opciones").click(function () {
        $(".Modalme").html("");
        $(".error").html("");
        $("#error1").html("");
        $("#error").html("");
    });

    $(".completarvisitanteDatos").click(function () {
        visitante = $("#txtidVisitante").val().trim();
        mostrarInfoCompletaVisitanteModificarVisita(visitante);
        $("#ModificarVisitante").modal("show");
    });

    $('.vehiculo2').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('.divplaca2').show('slow');
            $('.placa2').val('');
            $('.placa2').attr('required', 'true');
            $('#txTAcompanantes2').val('');
        } else {
            $('.divplaca2').hide('fast');
            $('#txTAcompanantes2').val('');
            $('.placa2').val('');
            $('.placa2').removeAttr('required', 'false');
        }
    });

    $('.vehiculo3').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $('.divplaca3').show('slow');
            $('.placa3').val('');
            $('.placa3').attr('required', 'true');
            $('#txTAcompanantes3').attr('required', 'true');
            $('#txTAcompanantes3').val('');
        } else {
            $('.divplaca3').hide('fast');
            $('#txTAcompanantes3').val('');
            $('.placa3').val('');
            $('.placa3').removeAttr('required', 'false');
            $('#txTAcompanantes3').removeAttr('required', 'false');

        }
    });
    $("btnAgregar").click(function () {
        $(".error").hide("fast");
        $("#error").hide("fast");
        $("#error1").hide("fast");
    });
    $('#fotomodi').click(function () {
        if (foto == 1) {
            $(".videomodi").hide('fast');
            $(".imagenactual").hide('fast');
            $(".canvasmodi").show('fast');
            MismaFoto = 0;
            $("#fotomodi").html("Nueva Foto!");
            foto = 0;
        } else {
            $(".imagenactual").hide('fast');
            $(".canvasmodi").hide('fast');
            $(".videomodi").show('fast');
            $("#fotomodi").html("Tomar Foto!");
            foto = 1;
            MismaFoto = 0;
        }

    });
    $('#foto2').click(function () {
        if (foto2 == 0) {
            $(".video2").hide('fast');

            $(".canvas2").show('fast');

            $("#foto2").html("Nueva Foto!");
            foto2 = 1;
        } else {

            $(".canvas2").hide('fast');
            $(".video2").show('fast');
            $("#foto2").html("Tomar Foto!");
            foto2 = 0;

        }

    });
    $('#foto3').click(function () {
        if (foto3 == 0) {
            $(".video3").hide('fast');

            $(".canvas3").show('fast');

            $("#foto3").html("Nueva Foto!");
            foto3 = 1;
        } else {

            $(".canvas3").hide('fast');
            $(".video3").show('fast');
            $("#foto3").html("Tomar Foto!");
            foto3 = 0;

        }

    });



    /*   $(".btnElimina").click(function() {
     $(".error").hide("fast");
     $("#error").hide("fast");
     $("#error1").hide("fast");
     });
     
     $(".btnModifica").click(function() {
     $(".error").hide("fast");
     $("#error").hide("fast");
     $("#error1").hide("fast");
     });
     */


    // CUANDO SE ENVIA EL FORMULARIO MODIFICAR VISITANTE LLAMO A LA FUNCION DE MODIFICAR Y LE PASO EL PARAMETRO
    $("#form-modificar-visitante-visita").submit(function () {
        visitante = $("#txtidVisitante").val().trim();
        ModificarVisitantevisita(visitante);

        return false;
    });
    $("#ayuda_form").click(function () {
        EnviarAyuda();

        return false;
    });

    $('.vehiculo').on('click', function () {

        if ($(this).is(':checked')) {
            // Hacer algo si el checkbox ha sido seleccionado
            $("#tablaVisitantesVisita tbody tr").removeClass("success");
            VisitantesVector = [];
            EliminarEnVectorVisitantes(0);

            $('.divplaca').show('slow');
            $('.placa').attr('required', 'true');
            $('#txTAcompanantes').show('slow');
            $('#txTAcompanantes').attr('required', 'true');
        } else {

            $('.divplaca').hide('fast');
            $('.placa').removeAttr('required', 'false');
            $('#txTAcompanantes').hide('slow');
            $('#txTAcompanantes').removeAttr('required', 'true');


        }
    });

    // ESTA FUNCION SIRVE PARA QUITAR EL FOCUS DE ALGUN CAMPO
    $("button").click(function () {
        $(this).blur();
    });
    // PARA OCULTAR LOS MENSAJES DE ERROR O INFORMACION
    $("#agregar").click(function () {
        $(".error").hide('fast');
    });
    //PARA MOSTRAR LA PERSONA BUSCADA EN EL FORMULARIO AGREGAR USUARIO
    $("#btnmostrarpersona").click(function () {
        if (mostrarpersona == 1) {
            $('#Infopersona').modal('show');

        } else {

            MensajeConClase("Debe Buscar la persona antes de continuar", ".error")

        }
    });
    // FUNCION QUE LLAMA AL  BUSCAR PERSONA PARA EL FORMULARIO REGISTRO DE USUAIROS
    $('#btnBuscarpersona').click(function () {

        tipopersona = $("#cbxtipopersona").val();
        identificacion = $("#txtIdentificacionpersona").val();
        tipoidentificacion = $("#cbxtipoIdentificacion").val();
        BuscarPersona(tipopersona, identificacion, tipoidentificacion)
    });
// ESTE CANVA ES PARA CAPTURAR LA FOTO DEL VISITANTES
    canvas = document.getElementById("canvas");
    canvas2 = document.getElementById("canvas2");
    $('#foto').click(function () {
        if (foto == 0) {
            $(".video").hide('fast');
            $(".canvas").show('fast');

            $("#foto").html("Nueva Foto!");
            foto = 1;
        } else {
            $(".canvas").hide('fast');
            $(".video").show('fast');
            $("#foto").html("Tomar Foto!");
            foto = 0;

        }

    });
//  SI SELECCIONA UN VISITANTE PUEDE SEGUIR CON EL FORMULARIO DE VISITA
    $('#cbxlistadovisitantes').change(function () {

        idvisitante = $('#cbxlistadovisitantes').val();
        if (idvisitante.length == 0) {
            $('#txtidVisitante').val("");
            $(".error").hide('fast');
            $('#derevisitante').css('color', '#990000');
            $('#izquivisitado').css('color', '#990000');
            $('#btnmostrarvisitante').css('color', 'white');
            visitantedere = 0;
            visitadoizqui = 0;
            visitanteencontrado = 0;
            visi1 = 0;
        } else {

            BuscarVisitanteid(idvisitante);

            $('#txtidVisitante').val(idvisitante);

        }
    });
// SI SELECCIONA UN VISITADO PUEDE CONTINUAR CON EL FORMULARI ODE VISITA
    $('#cbxlistadovisitado').change(function () {

        idvisitado = $('#cbxlistadovisitado').val();

        if (idvisitado.length == 0) {
            $('#txtidVisitado').val('');
            $(".error").hide('fast');
            $('#derevisitado').css('color', '#990000');
            $('#izquivisita').css('color', '#990000');
            visitadodere = 0;
            visitaizqui = 0;
            visi1 = 1;
            visitadoencontrado = 0;
            $('#btnmostrarvisitado').css('color', 'white');
        } else {

            BuscarVisitadoid(idvisitado);

            $('#txtidVisitado').val(idvisitado);

        }
    });

// CON ESTA FUNCION CAMBIO EL MODO DE BUSQUEDA DE VISITADOS EN EL FORMULARIO DE VISITA
    /*
     * SE PUEDE BUSCAR YA SEA POR NOMBRE COMPLETO O POR LA CEDULA
     */
    $('.chec2').click(function () {
        if (busquedaVisitado == 1) {

            busquedaVisitado = 0;

            $('#cbxlistadovisitado').html('');

            $('#txtIdentificacionvisitado').val('');
            $('#ubicacion').val('');
            $('#txtNombreVisitado').val('');
            $('#txtidVisitado').val('');
            $('#derevisitado').css('color', '#990000');
            $('#izquivisita').css('color', '#990000');
            visitadodere = 0;
            visitaizqui = 0;
            visi1 = 1;
            visitadoencontrado = 0;
            $('#btnmostrarvisitado').css('color', 'white');
            $('#busquedavisitado').css('color', '#990000');
            $('#cbxtipoIdentificacionVisitado').removeAttr('required', 'false');
            $('#txtIdentificacionvisitado').removeAttr('required', 'true');
            $('#apellidovisitado').hide('fast');
            $('#nombrevisitado').hide('fast');
            $('#cbxlistadovisitado').hide('fast');
            $('#apellidovisitado').val('');
            $('#nombrevisitado').val('');
            $('#cbxlistadovisitado').val('');
            $('#cbxtipoIdentificacionVisitado').show('slow');
            $('#txtIdentificacionvisitado').show('slow');
            $('#ubicacion').show('slow');
            $('#txtNombreVisitado').show('slow');
        } else {
            $('#busquedavisitado').css('color', 'black');
            $('#cbxtipoIdentificacionVisitado').hide('fast');
            $('#txtIdentificacionvisitado').hide('fast');
            $('#ubicacion').hide('fast');
            $('#txtNombreVisitado').hide('fast');


            $('#txtIdentificacionvisitado').val('');
            $('#ubicacion').val('');
            $('#txtNombreVisitado').val('');

            $('#apellidovisitado').show('slow');
            $('#nombrevisitado').show('slow');
            $('#cbxlistadovisitado').show('slow');

            $('#cbxtipoIdentificacionVisitado').removeAttr('required', 'false');
            $('#txtIdentificacionvisitado').removeAttr('required', 'false');


            $('#cbxlistadovisitado').html('');
            $('#txtidVisitado').val('');
            $('#derevisitado').css('color', '#990000');
            $('#izquivisita').css('color', '#990000');
            visitadodere = 0;
            visitaizqui = 0;
            visi1 = 1;
            visitadoencontrado = 0;
            $('#btnmostrarvisitado').css('color', 'white');

            busquedaVisitado = 1;
        }
    });

    // CON ESTA FUNCION CAMBIO EL MODO DE BUSQUEDA DE VISITANTE  EN EL FORMULARIO DE VISITA
    /*
     * SE PUEDE BUSCAR YA SEA POR NOMBRE COMPLETO O POR LA CEDULA
     */
    $('.chec').click(function () {
        if (modobusqueda == 0) {
            $(".error").hide('fast');
            $('#txtidVisitante').val("");

            $('#derevisitante').css('color', '#990000');
            $('#izquivisitado').css('color', '#990000');
            $('#btnmostrarvisitante').css('color', 'white');
            $('#txtNombreVisitante').val('');
            $('#txtIdentificacionvisitante').val('');
            $('#txtidVisitante').val('');
            visitantedere = 0;
            visitadoizqui = 0;
            visitanteencontrado = 0;
            visi1 = 0;
            modobusqueda = 1;
            $('#busqueda').css('color', '#990000');
            $('#txtIdentificacionvisitante').removeAttr('required', 'false');
            $('#cbxtipoIdentificacionVisitante').removeAttr('required', 'false');
            $('#txtNombreVisitante').removeAttr('required', 'false');

            $('#txtIdentificacionvisitante').hide('fast');
            $('#cbxtipoIdentificacionVisitante').hide('fast');
            $('#txtNombreVisitante').hide('fast');

            $('#nombrevisi').show('slow');
            $('#apellidovisi').show('slow')
            $('#cbxlistadovisitantes').show('slow')


            $('#cbxlistadovisitantes').Attr('required', 'true');



        } else if (modobusqueda == 1) {

            $('#nombrevisi').val('');
            $('#apellidovisi').val('');
            $('#cbxlistadovisitantes').html('<opcion>Seleccione Visitantes</opcion>')
            $('#txtidVisitante').val("");
            $(".error").hide('fast');
            $('#derevisitante').css('color', '#990000');
            $('#izquivisitado').css('color', '#990000');
            $('#btnmostrarvisitante').css('color', 'white');
            visitantedere = 0;
            visitadoizqui = 0;
            visitanteencontrado = 0;
            visi1 = 0;
            $('#busqueda').css('color', 'black');
            modobusqueda = 0;
            $('#nombrevisi').removeAttr('required', 'false');
            $('#apellidovisi').removeAttr('required', 'false');
            $('#cbxlistadovisitantes').removeAttr('required', 'false');

            $('#nombrevisi').hide('fast');
            $('#apellidovisi').hide('fast');
            $('#cbxlistadovisitantes').hide('fast');

            $('#txtIdentificacionvisitante').show('slow');
            $('#cbxtipoIdentificacionVisitante').show('slow');
            $('#txtNombreVisitante').show('slow');

            $('#txtIdentificacionvisitante').Attr('required', 'true');
            $('#cbxtipoIdentificacionVisitante').Attr('required', 'true');
            $('#txtNombreVisitante').Attr('required', 'true');
            $('#cbxlistadovisitantes').RemoveAttr('required', 'false');


        }
    });


    $('#btnmostrarvisitado').click(function () {
        if (visitadoencontrado == 1) {
            $('#InfoVisitado').modal('show');
        }
    });
    $('#btnmostrarvisitante').click(function () {
        if (visitanteencontrado == 1) {
            $('#InfoVisitante').modal('show');
        }
    });

    $('#cbxtipoIdentificacionVisitante').focus();
    $('#cbxtipoIdentificacionVisitante').focusout(function () {
        visi1 = 0
    });
    $('#txtIdentificacionvisitante').change(function () {
    });

    $("#txtIdentificacionvisitante").on('keyup', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            $('#txtIdentificacionvisitante').focus();
        } else {
            visi1 = 0
        }
    });
    $("#txtIdentificacionvisitado").on('keyup', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            $('#txtIdentificacionvisitado').focus();
        } else {
            visi1 = 1;
        }
    });

    if ($('#txtIdentificacionvisitante').change()) {

        visi1 = 0;
    }
    $(document.body).delegate('#cbxtipoIdentificacionVisitante', 'keypress', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            $('#txtIdentificacionvisitante').focus();
        }
    });
    $(document.body).delegate('#cbxtipoIdentificacionVisitado', 'keypress', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            $('#txtIdentificacionvisitado').focus();
        }
    });

    $(document.body).delegate('#txtIdentificacionvisitante', 'keypress', function (e) {
        if (e.which === 13) { // if is enter
            e.preventDefault(); // don't submit form
            if (visi1 == 0) {
                BuscarVisitante();
                visi1 = 1;
            } else {
                mostrarFormVisitado();
                $('#cbxtipoIdentificacionVisitado').focus();
                visi1 = 0;
            }
        }
    });

    $(document.body).delegate('#txtIdentificacionvisitado', 'keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            if (visi1 == 1) {
                BuscarVisitado();
                visi1 = 2;
                ;
            } else {
                mostrarFormVisita();
                visi1 = 1;
            }
        }
    });
    function mostrarFormVisitado() {
        if (visitantedere == 1) {
            $(".error").hide('fast');
            $('#panelvisitante').hide('fast');
            $('#panelvisitado').show('slow');
        }
    }

    function mostrarFormVisita() {
        if (visitadodere == 1) {
            $(".error").hide('fast');
            $('#panelvisitado').hide('fast');
            $('#panelvisita').show('slow');
        }
    }

    $('#derevisitante').click(function () {
        if ($(".vehiculo").is(':checked')) {
            var value = $("#txtPlacaVehiculo").val().trim().length;
            if (value != 6) {
                MensajeConClase("El numero de caracteres valido para la placa son 6", ".error")
            } else {
                mostrarFormVisitado();
                visi1 = 1;
            }

        } else {
            mostrarFormVisitado();
            visi1 = 1;
        }
    });
    $('#izquivisitante').click(function () {
        if (visitanteizqui == 1) {
            $(".error").hide('fast');
            $('#panelvisitante').hide('fast');
            $('#panelvisita').show('slow');
            visi1 = 1;
        }
    });
    $('#izquivisitado').click(function () {
        if (visitadoizqui == 1) {
            $(".error").hide('fast');
            $('#panelvisitado').hide('fast');
            $('#panelvisitante').show('slow');
            visi1 = 0;
            $('#cbxtipoIdentificacionVisitante').focus();
        }
    });
    $('#derevisitado').click(function () {
        mostrarFormVisita();
        visi1 = 2;
    });
    $('#izquivisita').click(function () {
        if (visitaizqui == 1) {
            $(".error").hide('fast');
            $('#panelvisita').hide('fast');
            $('#panelvisitado').show('slow');
            $('#cbxtipoIdentificacionVisitado').focus();
        }
    });
    $('#nuevavisita').click(function () {

        $(".error").hide('fast');
        $('#panelmuestrovisita').hide('fast');
        $('#panelvisitante').show('slow');
        $('#derevisita').css('color', '#990000');
        $('#izquivisita').css('color', '#990000');
        $('#derevisitado').css('color', '#990000');
        $('#izquivisitado').css('color', '#990000');
        $('#derevisitante').css('color', '#990000');
        $('#izquivisitante').css('color', '#990000');
        visitantedere = 0;
        visitanteizqui = 0;
        visitadoizqui = 0;
        visitadodere = 0;
        visitaizqui = 0;
        visi1 = 0;
        visitanteencontrado = 0;
        visitadoencontrado = 0;
        $('#btnmostrarvisitante').css('color', 'white');
        $('#btnmostrarvisitado').css('color', 'white');
        $("#cbxlistadovisitantes").html("");
        $("#cbxlistadovisitado").html("");
        $('#cbxtipoIdentificacionVisitante').focus();
        $('.divplaca').hide('fast');
        $('.placa').removeAttr('required', 'false');
        $('#txTAcompanantes').hide('slow');
        $('#txTAcompanantes').removeAttr('required', 'true');
        MostrarVisitadosVisita();
        MostrarVisitantesVisita();
        perfilensession();
    });

    $('#btnBuscarVisitante').click(function () {

        BuscarVisitante();

        return true;
    });
    $('#btnBuscarVisitado').click(function () {
        BuscarVisitado();

        return true;
    });

    $('#busqueda').popover();
    $('#busquedavisitado').popover();
    $('.sagregar').popover();
    $('.seliminar').popover();
    $('.smodificar').popover();
    $('.sasignar').popover();
    $('.sampliar').popover();
    $(".Asignarperfil").popover();



    $(function () {
        var dateToday = new Date();
        $('.datetimepicker').datetimepicker({
            /*daysOfWeekDisabled: [0, 6],*/
            language: 'es',
            weekStart: 1,
            /*todayBtn:  1,*/
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: true
        });
    });
    // esta funcion no permite el ingreso de numeros en los campos con la clase inputt2
    $(".inputt2").keypress(function (key) {
        window.console.log(key.charCode)
        if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 45) //retroceso
                && (key.charCode != 241) //ñ
                && (key.charCode != 209) //Ñ
                && (key.charCode != 32) //espacio
                && (key.charCode != 225) //á
                && (key.charCode != 233) //é
                && (key.charCode != 237) //í
                && (key.charCode != 243) //ó
                && (key.charCode != 250) //ú
                && (key.charCode != 193) //Á
                && (key.charCode != 201) //É
                && (key.charCode != 205) //Í
                && (key.charCode != 211) //Ó
                && (key.charCode != 218) //Ú

                )
            return false;

    });
    //Llamo al metodo Guardar Visita cuando envien el formulario
    $("#registrar-visita").submit(function () {
        GuardarVisita();

        return false;
    });
// LLAMO AL METODO REGISTRAR VISITADO
    $("#form-ingresar-visitado").submit(function () {
        registrarVisitado();
        return false;
    });
    //Llamo al metodo Guardar Visitantes cuando envien el formulario
    $("#form-ingresar-visitante").submit(function () {

        registrarVisitante();
        return false;
    });
    $("#form-ingresar-visitante22").submit(function () {

        registrarVisitante22();

        return false;
    });
    $("#form-ingresar-visitante3").submit(function () {

        registrarVisitante3();

        return false;
    });

//Cuando envien el Formulario de guardar Parametro Llamo a la funcion
    $("#GuardarParametro").submit(function () {
        registrarParametro();
        return false;
    });
// CUANDO SE ENVIA EL FORMULARIO LLAMO AL METODO registrarValorParametro
    $("#GuardarValorParametro").submit(function () {
        registrarValorParametro();
        return false;
    });
    //Llamda al Guardar Usuario
    $("#GuardarUsuario").submit(function () {
        registrarusuario();
        return false;
    });
//LLAMA AL METODO RESERVAR VISITA
    $("#reservar-visita").submit(function () {
        ReservarVisita();

        return false;
    });
});
//En este metodo Guardo los parametros que maneja el sistema
function registrarParametro() {
    //obtengo el formulario de registro de parametros
    var formData = new FormData(document.getElementById("GuardarParametro"));
// Envio los datos a mi archivo PHP y le envio por get la funcion que va a realizar
    $.ajax({
        url: "../model/Parametros.php?GuardarParametro=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        //Recibo los datos del php
        //si es un quiere decir que los campos estan vacios
        if (datos == 1) {

            MensajeConClase("Todos Los Campos Son Obligatorios", "#error")
            return  true;
            //si es dos es por que guardo el parametro
        } else if (datos == 2) {

            MensajeConClase("Parametro Guardado con exito", "#error")
            $('.inputt2').val('');


            listarParametros();
            CargarParametros();
            return true;
            // si es tres es por que el nombre del parametro existe
        } else if (datos == 3) {

            MensajeConClase("El Nombre del Parametro ya esta en el sistema", "#error")
            return true;
        } else {
            // en dado caso que ocurra un error

            MensajeConClase("Error al Guardar el Parametro", "#error")
        }
    });
}
function registrarValorParametro() {

    //obtengo el formulario  registro valor  parametros
    var formData = new FormData(document.getElementById("GuardarValorParametro"));
// Envio los datos a mi archivo PHP y le envio por get la funcion que va a realizar
    $.ajax({
        url: "../model/Parametros.php?GuardarValorParametro=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        //Recibo los datos del php
        //si es un quiere decir que los campos estan vacios
        if (datos == 1) {

            MensajeConClase("Todos Los Campos Son Obligatorios", "#error1")
            return  true;
            //si es dos es por que guardo el parametro
        } else if (datos == 2) {

            MensajeConClase("Valor Parametro Registrado Con exito", "#error1")
            $('.inputt2').val('');
            $('.inputt').val('');
            return true;
            // si es tres es por que el nombre del parametro existe
        } else if (datos == 3) {

            MensajeConClase("El Valor del Parametro ya esta en el sistema", "#error1")
            return true;
        } else if (datos == 4) {

            MensajeConClase("El Codigo ya esta registrado", "#error1")
            return true;
        } else if (datos == 5) {

            MensajeConClase("Para este parametro no se permiten el ingreso de letras", "#error1")
            return true;
        } else if (datos == 6) {

            MensajeConClase("Para El Parametro que Desea Registrar Solo se permiten Dos valor Si o No", "#error1")
            return true;
        } else {
            // en dado caso que ocurra un error

            MensajeConClase("Error al Guardar el Valor del Parametro", "#error1")
            return true;
        }
    });
}
function registrarusuario() {
    if (mostrarpersona == 0) {

        MensajeConClase("Antes de Guardar debe Buscar la Persona", ".error")
    } else {
        //obtengo los datos del formulario
        var formData = new FormData(document.getElementById("GuardarUsuario"));
        formData.append('contrasena', identificacionpersona);
// envio los datos al php y como parametro guardar
        $.ajax({
            url: "../model/esUsuario.php?guardar=si",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (datos) {
            //dependiendo del retorno muetsro el mensaje
            if (datos == 2) {

                MensajeConClase("Todos Los campos Son Obligatorios", ".error")

                return  true;
            } else if (datos == 3) {

                MensajeConClase("El Nombre Usuario  ya esta en el sistema", ".error")
                return true;
            } else if (datos == 4) {

                MensajeConClase("La persona ya tiene un Usuario Asignado", ".error")
                return true;
            } else {

                MensajeConClase("Usuario Guardado Con exito", ".error")
                $("#txtIdentificacionpersona").val('');
                $("#txtUsuario").val('');
                $("#txtUsuario").attr('readonly', 'true');
                mostrarpersona = 0;
                $("#btnmostrarpersona").css('color', 'black')
                listarUsuarios();
                return true;
            }
        });
    }
}
//Funcion guardar visitante
function registrarVisitante() {

    if (foto != 0) {
        //tomamos el formulairo ingresar visitante
        var formData = new FormData(document.getElementById("form-ingresar-visitante"));
        var data = canvas.toDataURL("image/jpeg");
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
                return  true;
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
                $(".canvas").hide('fast');
                $(".video").show('slow');
                $("#foto").html("Tomar Foto!");
                foto = 0;


                MostrarVisitantesVisita();
                listarVisitantes();

            } else {

                MensajeConClase("Error al Guardar al Visitante", ".error")
            }
        });
    } else {

        MensajeConClase("Antes de Guardar debe Tomar La Foto", ".error")
    }
}




/*
 * 
 * @returns {Boolean}
 * ESTA FUNCION ES LA ENCARGADA DE GUARDAR LAS VISITAS TOMA LOS DATOS DEL FORMULARIO registrar-visita
 * Y LO ENVIA POR POST AL ARCHIVO Visita.php 
 */
function GuardarVisita() {
    var formData = new FormData(document.getElementById("registrar-visita"));
    formData.append("Visitantes", VisitantesVector);

    $.ajax({
        url: "../model/Visita.php?guardar=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == -1) {

            MensajeConClase("Error Fechas Incorrectas, Favor validar que la fecha de salida no sea inferior a la de entrada ", ".error")

        } else if (datos == -2) {

            MensajeConClase("Complete Todos los Campos", ".error")
        } else if (datos == -3) {
            MostrarVisita();

            $(".error").hide('fast');
            $('#panelvisita').hide('fast');
            $('#panelmuestrovisita').show('slow');
            listarVisitas();


        } else if (datos > 0) {
            MensajeConClase('El visitado ya tiene una visita en curso o reservada <span class="glyphicon glyphicon-eye-open" onclick="javascript:MostrarDetalleVisita(' + datos + ');"></span>', ".error")

            MostrarDetalleVisita(datos);
        } else if (datos == -6) {

            MensajeConClase("La Fecha de entrada debe ser mayor a la Fecha actual", ".error")
        } else {
            MensajeConClase("Error Al Registrar La visita", ".error")

        }
    });


    return false;
}
/*
 * 
 * @returns {undefined}
 * CON ESTA FUNCION BUSCO EL VISITANTE DEPENDIENDO DEL MODO DE BUSQUEDA SELECCIONADO
 * SE PUEDE BUSCAR YA SEA POR NOMBRE Y APELLIDOS O POR CEDULA
 * PARA REALIZAR LA BUSQUEDA LLAMO AMI ARCHIVO visitantesMetodos Y LLLAMO A LA FUNCION BUSCAR 
 * LA CUAL ME RETORNA TODOS LOS DATOS DEL VISITANTES
 */
function BuscarVisitante() {
    if (modobusqueda == 0) {

        var id = $('#txtIdentificacionvisitante').val();
        var tipo = $('#cbxtipoIdentificacionVisitante').val();

        $.ajax({
            url: "../model/visitantesMetodos.php?buscar=si",
            dataType: "json", data: {
                tipo: tipo,
                identificacion: id,
                busqueda: modobusqueda,
            },
            type: "post",
            success: function (datos) {

                if (datos == 1) {
                    $(".completarvisitanteDatos").hide("fast");
                    MensajeConClase("Todos Los Campos Son Obligatorios", ".error")
                    $('#derevisitante').css('color', '#990000');
                    $('#izquivisitado').css('color', '#990000');
                    visitanteencontrado = 0;
                    $('#btnmostrarvisitante').css('color', 'white');
                    visitantedere = 0;
                    visitadoizqui = 0;
                    visi1 = 0;
                } else if (datos == 2) {
                    $(".completarvisitanteDatos").hide("fast");
                    MensajeConClase("Visitante No Encontrado", ".error")
                    $('#txtNombreVisitante').val('');
                    $('#txtIdentificacionvisitante').val('');
                    $('#txtidVisitante').val('');

                    $('#derevisitante').css('color', '#990000');
                    $('#izquivisitado').css('color', '#990000');
                    $('#btnmostrarvisitante').css('color', 'white');
                    visitantedere = 0;
                    visitadoizqui = 0;
                    visitanteencontrado = 0;
                    visi1 = 0;
                } else {

                    $('#txtidVisitante').val(datos.id)
                    if (reservaEs == 0 && (datos.Segundo_Apellido == null || datos.Segundo_Apellido == "" || datos.apellido == null || datos.apellido == "" || datos.nombre == null || datos.nombre == "" || datos.foto == "" || datos.foto == "Myfoto.png" || datos.foto == null)) {

                        $('#txtNombreVisitante').val(datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido);
                        ListarVisitasVisitante();
                        cargarSancionesPorVisitante(datos.id)
                        MensajeConClase("Al visitante le Faltan Algunos datos, Por favor completarlos", ".error")
                        $(".completarvisitante").css("-webkit-animation", " tiembla 0.2s infinite")
                        $(".completarvisitanteDatos").show("fast");
                        visidatos = 1;

                        $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos.foto + "'>");
                        $('.correovisitante').html(datos.correo);
                        $('.celularvisitante').html(datos.celular);
                        $('.identificacionevisitante').html(datos.identificacion);
                        $('.tipoidvisitante').html(datos.id_tipoIdentificacion);
                        $('.sanciones').html(datos.id_tipo_sancion);
                        if (datos.numPlacaCarro != '') {
                            $('.placaVisitante').html(datos.numPlacaCarro);
                            $('#txtplacavisitante').show('fast');
                        } else {
                            $('#txtplacavisitante').hide('fast');

                        }
                        $('.nombrevisitante').html(datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido);


                        $('#derevisitante').css('color', '#990000');
                        $('#izquivisitado').css('color', '#990000');
                        $('#btnmostrarvisitante').css('color', 'white');
                        visitantedere = 0;
                        visitadoizqui = 0;
                        visitanteencontrado = 0;
                        visi1 = 0;
                    } else {
                        cargarSancionesPorVisitante(datos.id)
                        $(".error").hide('fast');
                        $('#txtNombreVisitante').val(datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido);


                        $('#derevisitante').css('color', '#cccccc');
                        $('#izquivisitado').css('color', '#cccccc');

                        $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos.foto + "'>");
                        $('.correovisitante').html(datos.correo);
                        $('.celularvisitante').html(datos.celular);
                        $('.identificacionevisitante').html(datos.identificacion);
                        $('.tipoidvisitante').html(datos.id_tipoIdentificacion);
                        $('.sanciones').html(datos.id_tipo_sancion);
                        if (datos.numPlacaCarro != '') {
                            $('.placaVisitante').html(datos.numPlacaCarro);
                            $('#txtplacavisitante').show('fast');
                        } else {
                            $('#txtplacavisitante').hide('fast');

                        }
                        $('.nombrevisitante').html(datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido);


                        $('#btnmostrarvisitante').css('color', '#990000');
                        visitanteencontrado = 1;

                        visitantedere = 1;
                        visitadoizqui = 1;
                        visi1 = 1;
                        ListarVisitasVisitante();
                        return true;
                    }
                }

            },
            error: function () {

                console.log('Something went wrong', status, err);

            }
        });
    } else {

        var nombre = $('#nombrevisi').val();
        var apellido = $('#apellidovisi').val();
        $.ajax({
            url: "../model/visitantesMetodos.php?buscar=si",
            dataType: "json", data: {
                nombre: nombre,
                apellido: apellido,
                busqueda: modobusqueda,
            },
            type: "post",
            success: function (datos) {
                if (datos == 1) {
                    $(".completarvisitanteDatos").hide("fast");
                    MensajeConClase("Ingrese Nombre o apellido", ".error")
                    $('#derevisitante').css('color', '#990000');
                    $('#izquivisitado').css('color', '#990000');
                    visitantedere = 0;
                    visitadoizqui = 0;
                    visitanteencontrado = 0;
                    $('#btnmostrarvisitante').css('color', 'white');
                    $('#cbxlistadovisitantes').html('')
                    visi1 = 0;
                } else if (datos == 2) {
                    $(".completarvisitanteDatos").hide("fast");
                    MensajeConClase("Visitante No Encontrado", ".error")
                    $('#txtNombreVisitante').val('');
                    $('#txtIdentificacionvisitante').val('');
                    $('#txtidVisitante').val('');

                    $('#derevisitante').css('color', '#990000');
                    $('#izquivisitado').css('color', '#990000');
                    $('#btnmostrarvisitante').css('color', 'white');
                    visitantedere = 0;
                    visitadoizqui = 0;
                    visitanteencontrado = 0;
                    visi1 = 0;
                    $('#cbxlistadovisitantes').html('')
                } else {

                    visitanteencontrado = 0;
                    $('#btnmostrarvisitante').css('color', 'white');
                    $(".error").hide('fast');
                    if (Listo == 1) {
                        $('#btnmostrarvisitante').css('color', '#990000');
                        visitanteencontrado = 1;

                        visitantedere = 1;
                        visitadoizqui = 1;
                        visi1 = 1;
                    }

                    $('#cbxlistadovisitantes').html("");
                    $('#cbxlistadovisitantes').append("<option value=" + '' + ">" + 'Seleccione Visitante' + "</option>");
                    for (var i = 0; i <= datos.length - 1; i++) {
                        $('#cbxlistadovisitantes').append("<option value=" + datos[i].id + ">" + datos[i].nombre + " " + datos[i].Segundo_Nombre + " " + datos[i].apellido + " " + datos[i].Segundo_Apellido + "</option>");

                    }
                }
            },
            error: function () {

                console.log('Something went wrong', status, err);

            }
        });
    }
}
/*
 * 
 * @returns {undefined}
 * CON ESTA FUNCION BUSCO EL VISITADO DEPENDIENDO DEL MODO DE BUSQUEDA SELECCIONADO
 * SE PUEDE BUSCAR YA SEA POR NOMBRE Y APELLIDOS O POR CEDULA
 * PARA REALIZAR LA BUSQUEDA LLAMO AMI ARCHIVO visitado.PHP Y LLLAMO A LA FUNCION BUSCAR 
 * LA CUAL ME RETORNA TODOS LOS DATOS DEL VISITADO
 */
function BuscarVisitado() {
    if (busquedaVisitado == 0) {
        var id = $('#txtIdentificacionvisitado').val();
        var tipo = $('#cbxtipoIdentificacionVisitado').val();

        $.ajax({
            url: "../model/visitado.php?buscar=si",
            dataType: "json", data: {
                tipo: tipo,
                identificacion: id,
                modo: busquedaVisitado,
            },
            type: "post",
            success: function (datos) {

                if (datos == 1) {

                    MensajeConClase("Todos Los Campos Son Obligatorios", ".error")
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    visitadodere = 0;
                    visitaizqui = 0;
                    visi1 = 1;
                    $('#txtidVisitado').val('');
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    visitadodere = 0;
                    visitaizqui = 0;
                    visi1 = 1;
                    visitadoencontrado = 0;
                    $('#btnmostrarvisitado').css('color', 'white');
                    return false;
                } else if (datos == 2) {

                    MensajeConClase("Visitado No Encontrado", ".error")
                    $('#txtNombreVisitado').val('');
                    $('#ubicacion').val('')
                    $('#txtIdentificacionvisitado').val('');
                    $('#txtidVisitado').val('');
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    visitadodere = 0;
                    visitaizqui = 0;
                    visi1 = 1;
                    visitadoencontrado = 0;
                    $('#btnmostrarvisitado').css('color', 'white');
                    return false;
                } else {
                    $(".error").hide('fast');
                    $('#txtNombreVisitado').val(datos.Nombre + " " + datos.Segundo_Nombre + " " + datos.Apellido + " " + datos.Segundo_Apellido);
                    $('#txtidVisitado').val(datos.Id);
                    $('#ubicacion').val(datos.departamento);
                    $('#derevisitado').css('color', '#cccccc');
                    $('#izquivisita').css('color', '#cccccc');
                    $('#btnmostrarvisitado').css('color', '#990000');
                    $('.nombrevisitados').html(datos.Nombre + " " + datos.Segundo_Nombre + " " + datos.Apellido + " " + datos.Segundo_Apellido);
                    $('.fotoVisitado').html("<img src='../ImagenesVisitados/" + datos.foto + "'>")
                    $('.correovisitado').html(datos.correo);
                    $('.celularvisitado').html(datos.telefono);
                    $('.ubicacionvisitado').html(datos.ubicacion);
                    $('.departamentovisitado').html(datos.departamento);
                    $('.cargo').html(datos.cargo);
                    $('.identificacionvisitado').html(datos.identificacion);
                    $('.Tipoidentificacionvisitado').html(datos.Id_TipoIdentificacion);
                    visitadodere = 1;
                    visitaizqui = 1;
                    visi1 = 2;
                    visitadoencontrado = 1;
                    return false;

                }
            },
            error: function () {

                console.log('Something went wrong', status, err);

            }
        });
    } else {

        var nombre = $('#nombrevisitado').val();
        var apellido = $('#apellidovisitado').val();

        $.ajax({
            url: "../model/visitado.php?buscar=si",
            dataType: "json", data: {
                nombre: nombre,
                apellido: apellido,
                modo: busquedaVisitado,
            },
            type: "post",
            success: function (datos) {

                if (datos == 1) {

                    MensajeConClase("Ingrese Nombre o Apellido", ".error")
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    $('#cbxlistadovisitado').html("");

                    $('#txtidVisitado').val('');
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    visitadodere = 0;
                    visitaizqui = 0;
                    visi1 = 1;
                    visitadoencontrado = 0;
                    $('#btnmostrarvisitado').css('color', 'white');
                } else if (datos == 2) {

                    MensajeConClase("Visitado No Encontrado", ".error")
                    $('#cbxlistadovisitado').html("<option value=" + '' + ">" + '' + "</option>");

                    $('#txtNombreVisitado').val('');
                    $('#ubicacion').val('')
                    $('#txtIdentificacionvisitado').val('');
                    $('#txtidVisitado').val('');
                    $('#derevisitado').css('color', '#990000');
                    $('#izquivisita').css('color', '#990000');
                    visitadodere = 0;
                    visitaizqui = 0;
                    visi1 = 1;
                    visitadoencontrado = 0;
                    $('#btnmostrarvisitado').css('color', 'white');
                    $('#cbxlistadovisitado').html("");
                    return false;
                } else {
                    visitadoencontrado = 0;
                    $('#btnmostrarvisitado').css('color', 'white');
                    $(".error").hide('fast');
                    $('#cbxlistadovisitado').html("");
                    $('#cbxlistadovisitado').append("<option value=" + '' + ">" + 'Seleccione Visitado' + "</option>");
                    for (var i = 0; i <= datos.length - 1; i++) {
                        $('#cbxlistadovisitado').append("<option value=" + datos[i].Id + ">" + datos[i].Nombre + " " + datos[i].Segundo_Nombre + " " + datos[i].Apellido + " " + datos[i].Segundo_Apellido + "</option>");

                    }
                    return false;

                }

            },
            error: function () {

                console.log('Something went wrong', status, err);

            }
        });
    }
}

/*
 * 
 * @returns {undefined}
 * CON ESTA FUNCION MUESTRO LA VISITA GUADADA SIEMPRE RETORNA EL ULTIMO REGISTRO
 */
function MostrarVisita() {


    $.ajax({
        url: "../model/Visita.php?buscar=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            VisitantesVector = [];
            MostrarVisitantesVisitaMostrar(datos[0].Id)
            $('.acompanantesvisita').html(datos[0].NumAcompanantes);

            $('.nombrevisitado').html(datos[0].nombrevisitado);
            $('.ubicacionvisitado').html(datos[0].departamento + " / " + datos[0].ubicacion);
            $('.observacionesvisita').html(datos[0].observaciones);
            $('.horaentradavisita').html(datos[0].HoraEntrada);
            $('.horasalidavisita').html(datos[0].HoraSalida);
            $('.tipoingresovisita').html(datos[0].Id_TipoIngreso);
            $('.estadovisita').html(datos[0].Id_EstadoVisita);
            $('.duracionvisita').html(datos[0].DuracionVisita);
            $('.placavisitainfo').html(datos[0].placa);
            $(".error").hide('fast');
            $('#panelvisita').hide('fast');
            $('#panelmuestrovisita').show('slow');

            EnviarCorreo(datos[0].Id)
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
//CON ESTA FUNCION SE LE NOTIFICA AL VISITADO QUE TIENE UNA VISITA 
function EnviarCorreo(id) {


    $.ajax({
        url: "../model/Visita.php?enviarcorreo=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            return false;
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}
/*
 * 
 * @returns {undefined}
 * CON ESTA FUNCION MUESTRO LAS VISITAS DEL VISITANTE BUSCADO
 */

function ListarVisitasVisitante(id) {

    var table = $("#tablavisitasvisitante").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarVisitasVisitante=si",
            dataType: "json",
            type: "post", data: {
                visitante: id,
            },
        }, //paging: false,
        //scrollY: 400,
        // "processing": true,

        "columns": [
            {"data": "indice"},
            {"data": "nombrevisitado"},
            {"data": "Identificacion"},
            {"data": "HoraEntrada"},
            {"data": "HoraSalida"},
            {"data": "DuracionVisita"},
            {"data": "NumAcompanantes"},
            {"data": "TipoVisita"},
            {"data": "EstadoVisita"},
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



    $('#tablavisitas tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        $("tr").removeClass("warning");

        $(this).attr("class", "warning");
        $("#idSeleccionado").val(data[0]);

    });
    $('#tablavisitas tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();

        //  $('#paises > option[value="3"]').attr('selected', 'selected');
        MostrarDetalleVisita(data[0])

    });
}
/*
 * 
 * @param {type} id
 * @returns {undefined}
 * CON ESTA FUNCION BUSCO AL VISITANTE POR SU ID
 * LA BSUQUEDA SE REALIZA POR MEDIO DEL ARCHIVO visitantesMetodos Y SE LE PASA COMO PARAMETRO buscarporid
 * LA CUAL ME RETORNA TODOS LOS DATOS DEL VISITANTE
 */
function BuscarVisitanteid(id) {
    $.ajax({
        url: "../model/visitantesMetodos.php?buscarporid=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            $('#txtidVisitante').val(id);
            if (reservaEs != 1 && (datos[0].Segundo_Apellido == null || datos[0].Segundo_Apellido == "" || datos[0].apellido == null || datos[0].apellido == "" || datos[0].nombre == null || datos[0].nombre == "" || datos[0].foto == "" || datos[0].foto == "Myfoto.png" || datos[0].foto == null)) {

                MensajeConClase("Al visitante le Faltan Algunos datos, Por favor completarlos", ".error")
                $(".completarvisitante").css("-webkit-animation", " tiembla 0.2s infinite")
                $(".completarvisitanteDatos").show("fast");
                visidatos = 1;
                $('#txtNombreVisitante').val('');
                $('#txtIdentificacionvisitante').val('');
                $('#derevisitante').css('color', '#990000');
                $('#izquivisitado').css('color', '#990000');
                $('#btnmostrarvisitante').css('color', 'white');


                cargarSancionesPorVisitante(id)

                $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
                $('.correovisitante').html(datos[0].correo);
                $('.celularvisitante').html(datos[0].celular);
                $('.identificacionevisitante').html(datos[0].identificacion);
                $('.tipoidvisitante').html(datos[0].tipo);
                $('.sanciones').html(datos[0].id_tipo_sancion);

                $('#txtplacavisitante').hide('fast');



                $('.nombrevisitante').html(datos[0].nombre + " " + datos[0].Segundo_Nombre + " " + datos[0].apellido + " " + datos[0].Segundo_Apellido);
                ListarVisitasVisitante(id);


                visitantedere = 0;
                visitadoizqui = 0;
                visitanteencontrado = 0;
                visi1 = 0;
            } else {


                $(".completarvisitanteDatos").hide("fast");

                cargarSancionesPorVisitante(id)

                $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos[0].foto + "'>");
                $('.correovisitante').html(datos[0].correo);
                $('.celularvisitante').html(datos[0].celular);
                $('.identificacionevisitante').html(datos[0].identificacion);
                $('.tipoidvisitante').html(datos[0].tipo);
                $('.sanciones').html(datos[0].id_tipo_sancion);

                $('#txtplacavisitante').hide('fast');



                $('.nombrevisitante').html(datos[0].nombre + " " + datos[0].Segundo_Nombre + " " + datos[0].apellido + " " + datos[0].Segundo_Apellido);




                ListarVisitasVisitante(id);


                return true;
            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });
}

/*
 * 
 * @param {type} id
 * @returns {undefined}
 * CON ESTA FUNCION BUSCO AL VISITADO POR SU ID
 * LA BSUQUEDA SE REALIZA POR MEDIO DEL ARCHIVO visitado Y SE LE PASA COMO PARAMETRO buscarporid
 * LA CUAL ME RETORNA TODOS LOS DATOS DEL VISITADO
 */
function  EsReserva() {

    reservaEs = 1;
}
function BuscarVisitadoid(id) {

    $.ajax({
        url: "../model/visitado.php?buscarid=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            $(".error").hide('fast');

            $('#ubicacion').val(datos.departamento);

            $('#btnmostrarvisitado').css('color', '#990000');
            $('.nombrevisitados').html(datos.Nombre + " " + datos.Segundo_Nombre + " " + datos.Apellido + " " + datos.Segundo_Apellido);
            $('.fotoVisitado').html("<img src='../ImagenesVisitados/" + datos.foto + "'>")
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
function registrarVisitado() {
    //tomamos el formulairo ingresar visitante
    var formData = new FormData(document.getElementById("form-ingresar-visitado"));

    //  Enviamos el formulario a nuestro archivo php con parametro guardar     
    $.ajax({
        url: "../model/visitado.php?guardar=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == 1) {

            MensajeConClase("Todos Los campos son Obligatorios", ".error")
            return  true;
        } else if (datos == 2) {

            MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error")
            return true;
        } else if (datos == 3) {

            MensajeConClase("El Visitado ya se encuentra en el Sistema", ".error")
            return true;
        } else if (datos == 4) {

            MensajeConClase("Visitado Guardado Con exito", ".error")
            $(".inputt").val('');
            $(".inputt2").val('');
            $("#txtPlacaVehiculo").val('');
            listarVisitados();
        } else if (datos == 5) {

            $("#FileImagen").val('');
            MensajeConClase("Formato de la Imagen No valido, Formatos validos JPG, PNG, GIF, JPEG ", ".error")

        } else {

            MensajeConClase("Error al Guardar al Visitado", ".error")
        }
    });



}
/*
 * 
 * @param {type} idtipopersona
 * @param {type} identificacion
 * @param {type} idtipoidentificacion
 * @returns {undefined}
 * ESTA FUNCION ME BUSCA LA PERSONA POR MEDIO DEL TIPO DE PERSONA YA SESA VISITANTE O VISITADO LA BUSQUEDA SE REALIZA POR MEDIO
 * DEL TIPO DE IDENTIFICACION Y LA IDENTIFICACION, PARA REALIZAR LA BUSQUEDA LLAMO A MI ARCHIVO esUsuario Y LE PASO
 * LA BUSQUEDA
 */
function BuscarPersona(idtipopersona, identificacion, idtipoidentificacion) {

    $.ajax({
        url: "../model/esUsuario.php?buscar2=si",
        dataType: "json", data: {
            tipopersona: idtipopersona,
            identificacion: identificacion,
            idtipoidentificacion: idtipoidentificacion,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {

                MensajeConClase("Todos Los campos son Obligatorios", ".error")
                $("#txtUsuario").attr("readonly", "true");
                $("#txtUsuario").val("");
                mostrarpersona = 0;
            } else if (datos == 2) {

                MensajeConClase("Persona no encontrada", ".error")
                mostrarpersona = 0;
                $("#btnmostrarpersona").css('color', 'black');
                $("#txtUsuario").attr("readonly", "true");
                $("#txtUsuario").val("");
            } else {
                $("#personabuscada").val(datos.id);

                $("#btnmostrarpersona").css('color', '#990000')
                mostrarpersona = 1;
                if (idtipopersona == "tblvisitado") {
                    $('.fotoVisitante').html("<img src='../ImagenesVisitados/" + datos.foto + "'>");

                } else if (idtipopersona == "tblvisitante") {
                    $('.fotoVisitante').html("<img src='../ImagenesVisitantes/" + datos.foto + "'>");
                }

                $('.correovisitante').html(datos.correo);
                $('.celularvisitante').html(datos.telefono);
                $('.identificacionevisitante').html(datos.identificacion);
                $('.tipoidvisitante').html(datos.tipoidentificacion);
                $('.nombrevisitante').html(datos.nombre + " " + datos.Segundo_Nombre);
                $('.apellidovisitante').html(datos.apellido + " " + datos.Segundo_Apellido);
                identificacionpersona = datos.identificacion;
                $(".error").hide('fast');

                $("#Infopersona").modal('show');
                $("#txtUsuario").removeAttr("readonly", "false");

            }
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}
/*
 * 
 * @returns {Boolean}
 * CON ESTA FUNCION RESERVO LAS VISITAS DE LOS VISITADOS 
 */
function ReservarVisita() {
    var formData = new FormData(document.getElementById("reservar-visita"));
    formData.append("Visitantes", VisitantesVector);

    $.ajax({
        url: "../model/Visita.php?reservar=si",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (datos) {

        if (datos == -1) {

            MensajeConClase("Error Fechas Incorrectas, Favor validar que la fecha de salida no sea inferior a la de entrada", ".error")

        } else if (datos == -2) {

            MensajeConClase("Complete Todos los Campos", ".error")
        } else if (datos == -3) {
            MostrarVisita();

            $(".error").hide('fast');
            $('#panelvisita').hide('fast');
            $('#panelmuestrovisita').show('slow');

            listarVisitasid();

        } else if (datos > 0) {
            idvisitado = $('#txtidVisitado').val();
            MensajeConClase('El visitado ya tiene una visita en curso o reservada <span class="glyphicon glyphicon-eye-open" onclick="javascript:MostrarDetalleVisita(' + datos + ');"></span>', ".error")

            MostrarDetalleVisita(datos);
        } else if (datos == -6) {

            MensajeConClase("La Fecha de entrada debe ser mayor a la Fecha actual", ".error")
        } else {

            MensajeConClase("Error Al Registrar La visita", ".error")
        }
    });


    return false;
}


function NoEssecretaria() {


    $.ajax({
        url: "../model/esUsuario.php?session=si",
        dataType: "json",
        type: "post",
        success: function (datos) {
            if (datos.tipo_persona == "tblvisitado") {

                $('#cbxlistadovisitado').html('');

                $('.tablaVisitadosVisita').hide('fast');
                $('#txtIdentificacionvisitado').val('');
                $('#ubicacion').val('');
                $('#txtNombreVisitado').val('');
                $('#txtidVisitado').val(datos.id_persona);
                $('#derevisitado').css('color', '#cccccc');
                $('#izquivisita').css('color', '#cccccc');
                visitadodere = 1;
                visitaizqui = 1;
                visi1 = 1;
                visitadoencontrado = 1;
                $('#btnmostrarvisitado').css('color', 'white');
                $('#busquedavisitado').css('color', '#990000');
                $('#cbxtipoIdentificacionVisitado').removeAttr('required', 'false');
                $('#txtIdentificacionvisitado').removeAttr('required', 'false');
                $('#apellidovisitado').hide('fast');
                $('#nombrevisitado').hide('fast');
                $('#cbxlistadovisitado').hide('fast');
                $('#cbxtipoIdentificacionVisitado').hide('fast');
                $('#txtIdentificacionvisitado').hide('fast');
                $(".chec2").hide('fast');
                $("#btnBuscarVisitado").hide("fast");
                $("#btnmostrarvisitado").hide("fast");

                $('#cbxlistadovisitado').val('');
                $('#datosvisi2').show('fast');
                $('#ubicacion').hide('fast');
                $('#txtNombreVisitado').hide('fast');
                $(".error").hide('fast');

                $('#ubicacion').val(datos.departamento);

                $('.nombrevisitados').html(datos.nombre + " " + datos.Segundo_Nombre + " " + datos.apellido + " " + datos.Segundo_Apellido);
                $('.fotoVisitado').html("<img src='../ImagenesVisitados/" + datos.foto + "'>")
                $('.correovisitado').html(datos.correo);
                $('.celularvisitado').html(datos.telefono);

                $('.identificacionvisitado').html(datos.identificacion);
                $('.Tipoidentificacionvisitado').html(datos.tipoidentificacion);
            } else {
                document.getElementById('permiso').click();
            }
        },
        error: function () {

            console.log('Something went wrong', status, err);

        }
    });



}

/*function ActualizarModificar() {
 busquedaVisitado = 1;
 modobusqueda = 0;
 BuscarVisitante();
 
 
 
 BuscarVisitadoid($('#txtidVisitado').val())
 }*/
/*function MostrarVisitaModificar(id) {
 document.getElementById('nuevavisita').click();
 
 $.ajax({
 url: "../model/Visita.php?buscarid=si",
 dataType: "json", data: {
 idvisita: id,
 },
 type: "post",
 success: function(datos) {
 
 $("#txtIdentificacionvisitante").val(datos.identificacion);
 $('#txtNombreVisitante').val(datos.nombrevisitante + " " + datos.apellidovisitante);
 $('#cbxtipoIdentificacionVisitante > option[value="' + datos.idtipoidentificacion + '"]').attr('selected', 'selected');
 $("#txtidVisitante").val(datos.idvisitante)
 $("#nombrevisitado").val(datos.nombrevisitado);
 $("#apellidovisitado").val(datos.apellidovisitado);
 $('#txtidVisitado').val(datos.idvisitado);
 $('#hentrada').val(datos.HoraEntrada);
 $('#hsalida').val(datos.HoraSalida);
 $('#txTAcompanantes').val(datos.NumAcompanantes);
 $('#oberservaciones').val(datos.observaciones);
 $('#cbxtipovisita > option[value="' + datos.tingreso + '"]').attr('selected', 'selected');
 $('#cbxestadovisita > option[value="' + datos.testado + '"]').attr('selected', 'selected');
 $('#cbxlistadovisitado').html("");
 $('#cbxlistadovisitado').append("<option value='" + datos.idvisitado + "'>" + datos.nombrevisitado + " " + datos.apellidovisitado + "<option>");
 ActualizarModificar();
 },
 error: function() {
 
 console.log('Something went wrong', status, error);
 
 }
 });
 }*/

/*
 * CON ESTA FUNCION LLAMO A MI FUNCION DE PHP MOSTRARCRUZES Y LO MUESTRO EN UN MODAL
 */
function MostrarCruzes(id) {

    $.ajax({
        url: "../model/Visita.php?mostrarcruzes=si",
        dataType: "json", data: {
            id: id,
        },
        type: "post",
        success: function (datos) {

            if (datos != -1) {
                MostrarDetalleVisita(datos)
            }

        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}
/**
 * 
 * @param {type} id
 * @returns {undefined}
 * FUNCION MOSTRAR INFORMACION COMPLETA DEL VISITANTES A MODIFICAR LE PASO POR PARAMETRO AL ID DEL VISITANTES
 */
function mostrarInfoCompletaVisitanteModificarVisita(id) {
// HAGO LA LLAMADA AJAX Y ENVIO EL ID DEL VISITANTES Y LA FUNCION QUE VA A EJECUTAR
    $.ajax({
        url: "../model/visitantesMetodos.php?buscarporid=si",
        dataType: "json", data: {
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
function ModificarVisitantevisita(id) {
    // EN ESTE CAVA ES DONDE GUARDO LA FOTO DEL VISITANTE 
    canvas = document.getElementById("canvasmodi");

    //OBTENGO EL FORMULARIO CON SUS RESPECTIVOS DATOS
    var formData = new FormData(document.getElementById("form-modificar-visitante-visita"));
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
            MensajeConClase("Todos Los campos son Obligatorios, excepto el Segundo Nombre", ".error");
            return  true;
        } else if (datos == 2) {
            MensajeConClase("Debe Ingresar Solo letras en el Nombre y Apellido", ".error");
            return true;
        } else if (datos == 3) {
            MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error");
            return true;
        } else if (datos == 4) {
            MensajeConClase("Datos Completados Con exito", ".error");
            $(".completarvisitanteDatos").hide("fast");
            if (DesdeVisita == 0) {
                $("#cbxlistadovisitantes").val(id);
                $('#btnmostrarvisitante').css('color', '#990000');
                visitanteencontrado = 1;

                visitantedere = 1;
                visitadoizqui = 1;
                visi1 = 1;
                MismaFoto = 1;
                $('#derevisitante').css('color', '#cccccc');
                $('#izquivisitado').css('color', '#cccccc');
                return false;
            } else {
                DesdeVisita = 0;
            }
        } else {

            $(".completarvisitanteDatos").hide("fast");
            MensajeConClase("Ha Ocurrido un error al Modificar el Visitante, la Foto No se Encuentra en el Servidor", ".error");



            return false;
        }
    });


}
function  ModificarDesdeVisita() {

    DesdeVisita = 1;
}
/*----------------------------------------------------------------------------------------------------------------------*/
function MostrarVisitantesVisita() {

    $('#tablaVisitantesVisita tbody').off('click', 'tr');
    $('#tablaVisitantesVisita tbody').off('dblclick', 'tr');
    var table = $("#tablaVisitantesVisita").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visitantesMetodos.php?mostrarparticipantesDepartamento=si",
            dataType: "json",
            type: "post",
        }, "lengthMenu": [5, 25, 50, 75, 100],
        //  "processing": true,
        "columns": [
            {"data": "indice"},
            {"data": "nombres"},
            {"data": "apellidos"},
            {"data": "identificacion"},
            {"defaultContent": "<span  onclick='javascript:MostrarDatosVisitante();' style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link '></span>"}

        ], "language": idioma,
        dom: 'Bfrtip',
        "buttons": [
        ]

    });
    $('#tablaVisitantesVisita tbody').on('click', 'tr', function () {
        var data = table.row(this).data();

        $('#tablaVisitantesVisita tbody tr').removeClass("active");

        VisitantesVisita = data[3];
        tiene = $(this).attr('class');
        if (tiene != "success") {
            $(this).attr("class", "active");
        }
        BuscarVisitanteid(VisitantesVisita);





    });
    $('#tablaVisitantesVisita tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();
        $("#tablaVisitantesVisita").show("slow");

        tiene = $(this).attr('class');


        if (tiene == "success") {

            $(this).removeClass("success");
            EliminarEnVectorVisitantes(VisitantesVisita);
        } else {
            if ($(".vehiculo").is(':checked')) {

                var value = $("#txtPlacaVehiculo").val().trim().length;
                if (value != 6) {
                    MensajeConClase("El Numero de caracteres validos para la placa son 6", ".error")
                } else {
                    $(".error").hide("fast");

                    if (VisitantesVector.length == 0) {
                        $(this).attr("class", "success");
                        GuardarEnVectorVisitante(VisitantesVisita);
                    } else {

                        $("#tablaVisitantesVisita tbody tr").removeClass("success");
                        $(this).attr("class", "success");
                        VisitantesVector = [];
                        GuardarEnVectorVisitante(VisitantesVisita);

                    }
                }
            } else {

                $("#txtPlacaVehiculo").val("");
                $(this).attr("class", "success");
                GuardarEnVectorVisitante(VisitantesVisita);
            }


        }
    });

}

function  GuardarEnVectorVisitante(id) {
    VisitantesVector.push(id);

    $('#derevisitante').css('color', '#cccccc');
    $('#izquivisitado').css('color', '#cccccc');
    visitantedere = 1;
    visitadoizqui = 1;
    visitanteencontrado = 1;
    visi1 = 1;
}


function EliminarEnVectorVisitantes(id) {

    for (var i = VisitantesVector.length; i--; ) {
        if (VisitantesVector[i] == id) {
            VisitantesVector.splice(i, 1);
        }
    }


    if (VisitantesVector.length == 0) {

        $('#derevisitante').css('color', '#990000');
        $('#izquivisitado').css('color', '#990000');
        visitantedere = 0;
        visitadoizqui = 0;
        visitanteencontrado = 0;
        visi1 = 0;
    }
}
function NuevaVisitaTodo() {

    for (var i = VisitantesVector.length; i--; ) {
        VisitantesVector.splice(i, 1);
    }
    VisitadosVisita1 = 0;
    $('#derevisitante').css('color', '#990000');
    $('#izquivisitado').css('color', '#990000');
    visitantedere = 0;
    visitadoizqui = 0;
    visitanteencontrado = 0;
    visi1 = 0;

    $("#txtidVisitado").val("");

    $(this).attr("class", "success");
    $('#derevisitado').css('color', '#990000');
    $('#izquivisita').css('color', '#990000');
    visitadodere = 0;
    visitaizqui = 0;
    visi1 = 0;
    visitadoencontrado = 0;
    $("#reservar-visita input").val("");
    $("#reservar-visita textArea").val("");

    $(".error").hide('fast');
    $('#panelvisitado').hide('fast');
    $('#panelvisita').hide('fast');
    $('#panelmuestrovisita').hide('fast');
    $('#panelvisitante').show('slow');

}
function MostrarDatosVisitante() {

    $("#InfoVisitante").modal("show")
}
function MostrarDatosVisitado() {

    $("#InfoVisitado").modal("show")
}
function MostrarVisitadosVisita() {

    $('#tablaVisitadosVisita tbody').off('click', 'tr');
    $('#tablaVisitadosVisita tbody').off('dblclick', 'tr');
    var table = $("#tablaVisitadosVisita").DataTable({
        "destroy": true,
        "ajax": {
            url: "../model/visitado.php?mostrarVisitadosVisitas=si",
            dataType: "json",
            type: "post",
        }, "lengthMenu": [5, 25, 50, 75, 100],
        //  "processing": true,
        "columns": [
            {"data": "indice"},
            {"data": "nombres"},
            {"data": "apellidos"},
            {"data": "Identificacion"},
            {"defaultContent": "<span  onclick='javascript:MostrarDatosVisitado();' style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link '></span>"}

        ], "language": idioma,
        dom: 'Bfrtip',
        "buttons": [
        ]

    });
    $('#tablaVisitadosVisita tbody').on('click', 'tr', function () {
        var data = table.row(this).data();

        $('#tablaVisitadosVisita tbody tr').removeClass("active");

        VisitadosVisita1 = data[3];
        tiene2 = $(this).attr('class');
        if (tiene2 != "success") {
            $(this).attr("class", "active");
        }
        BuscarVisitadoid(VisitadosVisita1);





    });
    $('#tablaVisitadosVisita tbody').on('dblclick', 'tr', function () {
        var data = table.row(this).data();
        VisitadosVisita = data[3];
        $("#tablaVisitantesVisita").show("slow");

        $('#tablaVisitadosVisita tbody tr').removeClass("success");

        $("#txtidVisitado").val(VisitadosVisita);

        $(this).attr("class", "success");
        $('#derevisitado').css('color', '#cccccc');
        $('#izquivisita').css('color', '#cccccc');
        visitadodere = 1;
        visitaizqui = 1;
        visi1 = 2;
        visitadoencontrado = 1;




    });

}


// FUNCION LISTAR VISITANTE
function listarVisitantesSanciones() {

    // BORRO LAS FUNCIONES QUE TENIA LA TABLA ANTERIORMENTE PARA NO TENER PROBLEMAS CON LOS DATOS ESTO ES PROPIO DE LA LIBRERIA DATA TABLE
    $('#tablavisitantesSanciones tbody').off('click', 'tr');
    $('#tablavisitantesSanciones tbody').off('dblclick', 'tr');
    // DEPENDIENDO DEL VALOR QUE TENGA LA VARIABLE SE CAMBIA EL TIPO DE TABLA
    // ESTE ES EL TIPO DE TABLA CON PAGINACION

    // INSTANCIO LA TABLA A LA CUAL VOY A PASARLE LOS DATOS
    if (estiloTablasanciones == 0) {
        var table = $("#tablavisitantesSanciones").DataTable({
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
            "columns": [
                {"data": "nombre"},
                {"data": "Segundo_Nombre"},
                {"data": "apellido"},
                {"data": "Segundo_Apellido"},
                {"data": "Tipo"},
                {"data": "identificacion"},
                {"data": "celular"},
                {"data": "correo"},
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
        $('#tablavisitantesSanciones tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            VisitanteSancion = data[8];
            cargarSancionesPorUsuario2(data[8]);
            mostrarInfoCompletaparticipante(data[8], "#Modaldetallevisitante")
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[8]);

        });

        //AL MOMENTO DE DAR DOBLE CLICK SE MUESTRA LA INFORMACION COMPLETA DEL VISITANTE
        $('#tablavisitantesSanciones tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();


            $("#Modaldetallevisitante").modal("show");

        });
    } else {
        var table = $("#tablavisitantesSanciones").DataTable({
            //ELIMINO CUALQUIER RASTRO DE DATOS QUE ESTEN EN LA TABLA
            "destroy": true,
            paging: false,
            scrollY: 300,
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
            "columns": [
                {"data": "nombre"},
                {"data": "Segundo_Nombre"},
                {"data": "apellido"},
                {"data": "Segundo_Apellido"},
                {"data": "Tipo"},
                {"data": "identificacion"},
                {"data": "celular"},
                {"data": "correo"},
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
        $('#tablavisitantesSanciones tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            $("tr").removeClass("warning");
            VisitanteSancion = data[8];
            cargarSancionesPorUsuario2(data[8]);
            mostrarInfoCompletaparticipante(data[8], "#Modaldetallevisitante")
            $(this).attr("class", "warning");
            $("#idSeleccionado").val(data[8]);

        });

        //AL MOMENTO DE DAR DOBLE CLICK SE MUESTRA LA INFORMACION COMPLETA DEL VISITANTE
        $('#tablavisitantesSanciones tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();


            $("#Modaldetallevisitante").modal("show");

        });
    }
}

function agregarSancion(idSancion, visitante) {
    $.ajax({
        url: "../model/Visita.php?agregarSancion=si",
        dataType: "json",
        data: {
            id: visitante,
            idSancion: idSancion,
        },
        type: "post",
        success: function (datos) {

            if (datos == 1) {
                $('#txtComentario').val("");
                MensajeConClase('Sanción Agregada Exitosamente', ".error");
                cargarSancionesPorUsuario2(visitante);

            } else {
                $('#txtComentario').val("");
                MensajeConClase('El Visitante ya tiene esta Sanción', ".error");

            }
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}
function cargarSancionesPorUsuario2(idUsuario) {
    $('.sancionesVisitante tbody').off('click', 'tr');
    var table = $(".sancionesVisitante").DataTable({
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

        "columns": [
            {"data": "indice"},
            {"data": "usuario"},
            {"data": "valor"},
            {"data": "fecha"},
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



    $('.sancionesVisitante tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        idSancion = data[3];
        $(".sancionesVisitante tbody tr").removeClass("warning");
        $(this).attr("class", "warning");

    });
}
function eliminarSancion(idVisitante, idSancion) {
    $.ajax({
        url: "../model/Visita.php?eliminarSancion=si",
        dataType: "json",
        data: {
            idVisitante: idVisitante,
            idSancion: idSancion,
        },
        type: "post",
        success: function (datos) {
            cargarSancionesPorUsuario2(idVisitante);
            MensajeConClase('Sanción Eliminada Exitosamente', ".error");
        },
        error: function () {

            console.log('Something went wrong', status, error);

        }
    });
}

function QuitarEspaciosBlanco() {
    limpio = $(this).val().trim();
    $(this).val(limpio);
}
function CambiarEstiloTablasanci() {
    if (estiloTablasanciones == 0) {
        estiloTablasanciones = 1;
    } else {
        estiloTablasanciones = 0;
    }
    listarVisitantesSanciones();
}
function registrarVisitante22() {

    //tomamos el formulairo ingresar visitante
    var formData = new FormData(document.getElementById("form-ingresar-visitante22"));

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
            return  false;
        } else if (datos == 2) {

            MensajeConClase("Debe Ingresar Solo letras en el Nombres y Apellidos", ".error")
            return false;
        } else if (datos == 3) {

            MensajeConClase("El Visitante ya se encuentra en el Sistema", ".error")
            return false;
        } else if (datos == 4) {


            MensajeConClase("Visitante Guardado Con exito", ".error")
            $(".inputt").val('');
            $(".inputt2").val('');
            $("#txtPlacaVehiculo").val('');


        } else {
            MensajeConClase("Error al Guardar al Visitante", ".error");
            return false;
        }
    });


}


function EnviarAyuda() {

    var nombre = $("#nombre").val().trim();
    var correo = $("#correo").val().trim();
    var tema = $("#tema").val().trim();
    var mensaje = $("#mensaje").val().trim();
  
    if (nombre.length == 0 || correo.length == 0 || tema.length == 0 || mensaje.length == 0) {

        MensajeConClase("Todos los Campos son obligatorios", "#error")
        return  true;
    } else {

        $.ajax({
            url: "../model/Visita.php?ayuda=si",
            dataType: "json",
            data: {
                nombre: nombre,
                correo: correo,
                tema: tema,
                mensaje: mensaje
            },
            type: "post",
        }).done(function (datos) {

            if (datos == 2) {

                MensajeConClase("El mensaje No Fue Enviado", "#error")
                return  true;

            } else if (datos == 1) {

                MensajeConClase("Mensaje Enviado Con Exito", "#error")
                $('inputt').val('');
                $('area').val('');
                return true;

            }
        });
    }
}