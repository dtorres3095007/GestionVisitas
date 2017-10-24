

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">

        <link rel="stylesheet" href="../estilos/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/font-awesome.min.css">


        <link rel="stylesheet" href="../estilos/MiEstilo3.css">

        <link href="../estilos/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <script src="../estilos/js/push.min.js"></script>
        <title>Control de Acceso</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />

    </head>
    <body class="inicio opcionesVisita" style="display: none">

        <div class="opciones ">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
                <button type="button" id="Recargarvisita" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>

                <button  id="agregar" type="button" class="btn btn-link active btnAgregar " ><span class="sagregar glyphicon glyphicon-floppy-disk" title="Agregar Visita" data-toggle="popover" data-trigger="hover"></span></button>

                <button  type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-user" title="Agregar Visitante" data-toggle="popover" data-trigger="hover"></span></button>
                <button  id="agregarSancion" class="btn btn-link active btnAgregar "><span class="smodificar glyphicon glyphicon-ban-circle" title="Agregar Sanción" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="listar" type="button" class="btn btn-link active " ><span class="smodificar glyphicon glyphicon-list-alt" title="Listar Visitas" data-toggle="popover" data-trigger="hover"></span></button>
                <button class="btn btn-link active" id="btnDepartamentos">  <span class=" smodificar glyphicon glyphicon-th-list"    title="Mostrar Departamentos" data-toggle="popover" data-trigger="hover"></span></button>
                <button class="btn btn-link active" id="btneventos" >  <span class=" smodificar glyphicon glyphicon-calendar"   title="Mostrar Eventos" data-toggle="popover" data-trigger="hover"></span></button>

                <button type="button" id="CambiarTabla" class="btn btn-link active btnCambiaTabla " ><span class="smodificar glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>

                <button  type="button" class="btn btn-link active alertas "><span id="aler" class="glyphicon glyphicon-bell"></span></button>
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>


                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="Visita.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Administracion de Visita</h5>
            </div>
        </div>

        <div class="container col-md-12 " id="cusuarios">
            <input type="hidden" id="idSeleccionado">



            <div class="tablausu col-md-12 tablavisitas" >

                <div class="completarvisitanteDatos"  style=" text-align: center;font-family: sans-serif;">Si desea Cambiar el estado de la Visita Por Favor Completar Los Datos del Visitante <span class="glyphicon glyphicon-share-alt completarvisitante"></span> </span><span  style="color: #990000;  font-weight: bold">Completar</span>
                </div>
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">

                    <table class="table table-bordered table-hover  table-responsive" id="tablavisitas"  style="width: 100%;">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal" ><td colspan="6">Tabla Visitas </td><td><div class="opcioenstabla opcioenstablavisitas"><div class="glyphicon glyphicon-comment" id="btnComentarios"  title="Mostrar Todos Los comentarios" data-toggle="popover" data-trigger="hover"></div><div class=" glyphicon glyphicon-remove btnModifica " title="Cancelar Visita" data-toggle="popover" data-trigger="hover" id="modificarVisitante2"></div><div id="modificarReserva"  class="glyphicon glyphicon-wrench btnModifica" title="Modificar Reserva" data-toggle="popover" data-trigger="hover" ></div>
                                    </div>
                                </td></tr>
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="">Visitado</td><td class="">Hora Entrada</td><td class="">Hora Salida</td><td class="">Duracion</td><td class="">Tipo Ingreso</td><td class="">Estado Visita</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tablausuevennto col-md-12" >
                <div class="Mensaje nomostrar" id="MensajeEje"><p id="mensajeEvento"></p></div>

                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover  table-responsive" id="tablaeventos"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal"><td colspan="11">Tabla Eventos</td></tr>
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="" >Nombre</td><td class="">Hora Inicio</td><td class="">Hora Fin</td><td class="">Duracion</td><td class="">Ubicacion</td><td class=""></td><td>Cupos</td><td>En Evento</td><td>Pre-Incripcion</td><td>Descripcion</td><td>Estado Evento</td><td>****</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalPersona" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Informacion de la Persona</h4>
                        </div>
                        <div id="body_modal_personas" class="modal-body">

                        </div>
                        <div class="error"></div>
                        <div class="modal-footer">
                            <button id="btnAsignarPersona" class="btn btn-danger">Registrar</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Modal -->

            <div class="tablausuDeparta col-md-12" >
                <div id="capa" style="height: 130px; width: 100%; padding-top: 80px;">
                    <label>Buscar Persona:<br><input type="number" id="txtBuscarPersona" class="form-control input-sm" required></label>
                    <button id="btnBuscarPersona" type="button" class="btn btn-danger" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </div>
                <div class="table-responsive col-sm-12 col-md-12  tablauser tabedepa" style="text-align: left;width: 100%">
                    <table class="table table-bordered table-hover  table-responsive" id="tablaDepar"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal"><td colspan="10">Tabla Departamentos :  <select class="form-control Empresas " id="Empresas" style="width: 30%"></select>
                                </td></tr>
                            <tr class="filaprincipal"><td class="indice" style="">No.</td><td class="" >Nombre</td><td>Ubicacion</td><td>No.Visitas</td><td class="indice">***</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="tablausuSanciones col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover  " id="tablavisitantesSanciones"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal"><td class="" id='nombrevisitante'>Primer Nombre</td><td class="">Segundo Nombre</td><td class="">Primer Apellido</td><td class="">Segundo Apellido</td><td class="">Tipo Identificacion</td><td class="">identificacion</td><td class="">Celular</td><td class="">Correo Personal</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>


            <div class="modal fade" id="InfoVisitado" role="dialog">
                <div class="modal-dialog">


                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitado</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div class="row2">
                                <table class="table" id="datosvisi" style="width: 500px; margin:  0 auto">

                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitado</th></tr>
                                    <tr><td rowspan="10"  class="fotoVisitado" style="width: 150px;text-align: center"></td></tr>

                                    <tr><td class="primero1">Nombre Completo</td><td class="nombrevisitados"></td></tr>
                                    <tr><td class="primero1">Tipo Identificacion</td><td class="Tipoidentificacionvisitado"></td></tr>

                                    <tr><td class="primero1">Identificacion</td><td class="identificacionvisitado"> </td></tr>
                                    <tr><td class="primero1">Celular</td><td class="celularvisitado"></td></tr>
                                    <tr><td class="primero1">Correo</td><td class="correovisitado"></td></tr>
                                    <tr><td class="primero1">Cargo</td><td class="cargo"></td></tr>
                                    <tr><td class="primero1">Departamento</td><td class="departamentovisitado"></td></tr>
                                    <tr><td class="primero1">Ubicacion</td><td class="ubicacionvisitado"></td></tr>

                                </table>  
                            </div> </div>
                        <div class="modal-footer" id="footermodal">
                        </div>


                    </div>


                </div>
            </div> 

            <div class="modal fade" id="InfoVisitante" role="dialog">
                <div class="modal-dialog">


                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title" style="text-align: left"><span class="glyphicon glyphicon-random"></span> Visitas Anteriores</h4>
                        </div>
                        <div class="modal-body " id="bodymodal">
                            <div class="row2 table-responsive">
                                <div class="tablaVisitanteInfo">
                                    <span style="color: #990000;" id="mostrarinfovisitante"class="glyphicon glyphicon-eye-open smodifica" title="Informacion del Visitante" data-toggle="popover" data-trigger="hover"></span>
                                    <div class="MostrarVisitantesInfo" style="">
                                        <table class="table" id="datosvisi" style="width: 50%;margin: 0 auto">
                                            <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitante</th></tr>
                                            <tr><td rowspan="7"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                            <tr><td class="primero">Nombre Completo</td><td class="nombrevisitante"></td></tr>

                                            <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                            <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                            <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                            <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>

                                            <tr id="txtplacavisitante"><td class="primero" >Placa</td><td class="placaVisitante"></td></tr>
                                            <tr><td colspan="3"> <table class="table sancionesVisitanteInfo" style="width: 100% ;">
                                                        <thead class="ttitulo">
                                                            <tr class="filaprincipal"><td  colspan="6" style="color: #990000; text-align: center">Sanciones del Visitante</td></tr>
                                                            <tr class="filaprincipal"><td>No.</td><td>Usuario</td><td>Sanción</td><td>Fecha</td></tr>
                                                        </thead>
                                                    </table></td></tr>

                                        </table>    
                                    </div>
                                    <div class="table-responsive col-sm-12 col-md-12  visitas" style="text-align: left;">
                                        <table class="table table-bordered table-hover  table-responsive" id="tablavisitasvisitante"  cellspacing="0" width="100%" style="">
                                            <thead class="ttitulo ">
                                                <tr class="filaprincipal"><td>No.</td><td class="medio">Nombre Visitado</td><td class="largo">identificacion Visitado</td><td class="largo">Hora Entrada</td><td class="largo">Hora Salida</td><td class="medio">Duracion Visita</td><td class="medio">Numero Acompañante</td><td class="medio">Tipo Visita</td><td class="medio">Estado Visita</td></tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>



                            </div> </div>


                    </div>


                </div>
            </div> 


            <div id="registrovisita">

                <form class="form-horizontal" id="registrar-visita">    
                    <div class="rowvisita">
                        <div class="error"></div>
                        <div class="panel panel-default active" id="panelvisitante">
                            <div class="panel-heading" id="tpanel">
                                <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitante</h3></center>
                            </div>
                            <div class="panel-body">
                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculo micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                <div class=" oculto divplaca"  style="width: 50%;margin:  0 auto">
                                    <input type="text" name="placa" id="txtPlacaVehiculo" maxlength="6" class="form-control placa" placeholder="Número Placa del Vehículo">
                                </div>
                                <table class="table table-bordered table-hover  table-responsive" id="tablaVisitantesVisita"  cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>***</td></tr>


                                    </thead>

                                </table>
                            </div> 
                            <div class="panel-footer danger" id="foterpanel">
                                <div class="izquivisitante"><span class="glyphicon glyphicon-arrow-left" id="izquivisitante"></span></div><div class="derevisitante"><span id="derevisitante" class="glyphicon glyphicon-arrow-right"></span></div>  


                            </div>
                        </div> 

                        <div class="panel panel-default active" id="panelvisitado">
                            <div class="panel-heading" id="tpanel" >
                                <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitado</h3></center>
                            </div>
                            <div class="panel-body">
                                <input type="text" id="txtidVisitado" name="idVisitado" hidden required="">
                                <table class="table table-bordered table-hover  table-responsive" id="tablaVisitadosVisita"  cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>***</td></tr>


                                    </thead>

                                </table>
                            </div>
                            <div class="panel-footer danger" id="foterpanel">
                                <div class="izquivisitado"><span class="glyphicon glyphicon-arrow-left" id="izquivisitado"></span></div><div class="derevisitado"><span id="derevisitado" class="glyphicon glyphicon-arrow-right"></span></div>  


                            </div>
                        </div>    

                        <div class="panel panel-default active" id="panelvisita" style="width: 70%;margin: 0 auto">
                            <div class="panel-heading" id="tpanel">
                                <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> Datos de la Visita</h3></center>
                            </div>
                            <div class="panel-body" >
                                <div class="horas">




                                    <select class="form-control tipo_ingreso tipoIngreso" name="tipoIngreso" id="cbxtipovisita" required>
                                        <option value="">Seleccione Tipo de Ingreso</option>
                                    </select>
                                    <input  type="number" id="txTAcompanantes" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" >

                                    <textarea rows="3" cols="100" class="form-control" id="oberservaciones" placeholder="Observaciones" name="observaciones" ></textarea>

                                </div> 
                            </div>
                            <div class="panel-footer danger" id="foterpanelb1">
                                <div class="botones">
                                    <span  id="izquivisita"><span  class="btn btn-default active" >Atras</span></span>
                                    <button type="submit" class="btn btn-danger active">Guardar</button>
                                </div>

                            </div>
                        </div>

                        <div class="panel panel-default active" id="panelmuestrovisita">
                            <div class="panel-heading" id="tpanel" >
                                <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Visita Registrada</h3></center>
                            </div>
                            <div class="panel-body">

                                <table class="table">

                                    <tr><td class="primero">Visitado:</td><td class="nombrevisitado" ></td></tr>
                                    <tr><td class="primero">Departamento/Ubicacion:</td><td class="ubicacionvisitado"></td></tr>
                                    <tr><td class="primero">Hora Entrada:</td><td class="horaentradavisita"></td></tr>
                                    <tr><td class="primero">Hora Salida:</td><td class="horasalidavisita"></td></tr>
                                    <tr><td class="primero">Duracion Visita:</td><td class="duracionvisita"></td></tr>
                                    <tr><td class="primero">Tipo Ingreso:</td><td class="tipoingresovisita"></td></tr>
                                    <tr><td class="primero">Acompañantes:</td><td class="acompanantesvisita"></td></tr>
                                    <tr><td class="primero">Placa Visitante:</td><td class="placavisitainfo"></td></tr>
                                    <tr><td class="primero">Estado Visita:</td><td class="estadovisita"></td></tr>
                                    <tr><td class="primero">Obervaciones:</td><td  class="observacionesvisita"></td></tr>

                                </table>

                                <table class="table table-bordered table-hover  table-responsive "  id="tablaVisitantesVisitaMostrar" cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td colspan="5">Visitantes</td></tr>
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>***</td></tr>


                                    </thead>

                                </table>






                            </div><div class="panel-footer danger" id="foterpanelb">
                                <div class="botones">
                                    <span  id="nuevavisita"><input  type="reset" class="btn btn-danger active" value="Nuevo"></span>

                                </div>

                            </div>
                        </div>
                    </div>
                </form>   
            </div>

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-ingresar-visitante" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Registro de Visitante</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row">





                                    <div class="TomarFoto">
                                        <table class="table">
                                            <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                            <tr><td class="video"><video id="video"  autoplay="autoplay"></video></td><td class="canvas"><canvas id="canvas" width="300" height="208" ></canvas></td></tr>

                                            <tr><td colspan="2">  <span  id="foto" class="btn btn-danger active form-control">
                                                        Tomar Foto!
                                                    </span></td></tr>
                                        </table>    

                                    </div>

                                    <select name="tipo_identificacion"   required class="form-control cbxtipoIdentificacion">

                                    </select>   
                                    <input min="1" type="number" name="identificacion" id="txtIdentificacion" class="form-control inputt" placeholder="No. Identificación" required>


                                    <input type="text" name="apellido" id="txtApellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                    <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>


                                    <input type="text" name="nombre" id="txtNombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombre" class="form-control inputt2" placeholder="Segundo Nombre" >

                                    <input min="1" type="number" name="celular" id="txtCelular" class="nomostrar form-control inputt " placeholder="Celular" >
                                    <input type="email" name="correo" id="txtCorreo" class="nomostrar form-control inputt" placeholder="Correo Eléctronico">
                          <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                    -->   

                                    <div class="error"></div>
                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <button type="submit" id="btnGuardarVisitante" class="btn btn-danger active">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div>
            <div class="modal fade" id="ModificarVisitante" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-modificar-visitante-visita" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Completar Datos</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <span  style="color: #990000" id="btnRecargar2" class="glyphicon glyphicon-refresh"></span>
                                    <div class="TomarFoto">
                                        <table class="table" style="">
                                            <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                            <tr><td class="imagenactual"></td><td class="videomodi"><video id="videomodi"  autoplay="autoplay"></video></td><td class="canvasmodi"><canvas id="canvasmodi" width="300" height="208" ></canvas></td></tr>

                                            <tr><td colspan="2">  <span id="fotomodi" class="btn btn-danger active form-control">
                                                        Nueva Foto!
                                                    </span></td></tr>
                                        </table>    
                                    </div>
                                    <select name="tipo_identificacion"  id="cbxtipoIdentificacionModi" required class="form-control  cbxtipoIdentificacion">

                                    </select>   
                                    <input min="1" type="number" name="identificacion" id="txtIdentificacionModi" class="form-control inputt" placeholder="No. Identificación" required>
                                    <input type="text" name="apellido" id="txtApellidoModi" class="form-control inputt2" placeholder="Primer Apellido"  required>

                                    <input type="text" name="segundoapellido" id="txtsegundoapellidomodi" class="form-control inputt2" placeholder="Segundo Apellido" required>

                                    <input type="text" name="nombre" id="txtNombreModi" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombremodi" class="form-control inputt2" placeholder="Segundo Nombre" >


                                    <input min="1" type="number" name="celular" id="txtCelularModi" class="form-control inputt " placeholder="Celular" >
                                    <input type="email" name="correo" id="txtCorreoModi" class="form-control inputt" placeholder="Correo Eléctronico" >
                          <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                    -->  
                                </div>

                                <div class="error"></div>
                            </div>
                            <div class="modal-footer" id="footermodal">

                                <button type="submit" id="btnmodificarVisitante" class="btn btn-danger active">Modificar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div>

            <div class="modal fade" id="Modaldetallevisita" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-eye-open"></span>  Datos de la Visita</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <input type="hidden" id="idvisita">
                            <div  style="text-align: center" class="modalvisita">
                                <table class="table">

                                    <tr><td class="primero">Visitado:</td><td class="nombrevisitado" ></td></tr>
                                    <tr><td class="primero">Departamento/Ubicacion:</td><td class="ubicacionvisitado"></td></tr>
                                    <tr><td class="primero">Hora Entrada:</td><td class="horaentradavisita" id="hentradamodi"></td></tr>
                                    <tr><td class="primero">Hora Salida:</td><td class="horasalidavisita" id="hsalidamodi"></td></tr>
                                    <tr><td class="primero">Duracion Visita:</td><td class="duracionvisita" id="duramodi"></td></tr>
                                    <tr><td class="primero">Tipo Ingreso:</td><td class="tipoingresovisita" id="tingresomodi"></td></tr>
                                    <tr><td class="primero">Acompañantes:</td><td class="acompanantesvisita" id="companantesmodui"></td></tr>
                                    <tr><td class="primero">Placa Visitante:</td><td class="placavisita" id="placavisita"></td></tr>

                                    <tr><td class="primero">Estado Visita:</td><td class="estadovisita" id="estadovisimodi"></td></tr>
                                    <tr><td class="primero">Obervaciones:</td><td  class="observacionesvisita" id="observamodi"></td></tr>
                                    <tr class="btnAgregar"><td class="primero ">Comentario:</td><td  class="comentariovisita" id="comentamodi" style="text-align: right"><textarea id="txtComentario" class="form-control" placeholder="Escriba Aqui su Comentario de la Visita"></textarea>
                                            <span class="sagregar glyphicon glyphicon-floppy-disk " id="Guardarcomentario" title="Guardar Comentario" data-toggle="popover" data-trigger="hover" style="color: #990000;padding-left: 15px; padding-top: 5px"></span>
                                            <div class="error1"></div>
                                        </td> </tr>

                                </table>
                                <div class="confirmarvisitaparti" style="color: #990000">Esta Seguro que desea Retirar al Participante..? <span id="retirarsivisitaparti" class="btn btn-link">Si</span>-<span id="retirarnovisitaparti" class="btn btn-link">No</span></div>
                                <div class="error"></div>
                                <table class="table table-bordered table-hover  table-responsive" id="tablaVisitantesVisitaMostrar2"   cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="opcioenstabla"><td id="AgregarVisitantes"  title='Agregar Visitantes' data-toggle='popover' data-trigger='hover' style='  color: #990000; ' class='glyphicon glyphicon-plus btnAgregar'></td><td id="retirarVisitante" title='Retirar Visitante' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class=' glyphicon glyphicon-remove btnElimina'></td></tr>
                                        <tr class="filaprincipal"><td colspan="5">Visitantes</td></tr>
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr>
                                    </thead>

                                </table>


                            </div>
                            <div  style="text-align: center" class="modalvisitaRegistro">
                                <div class="panel panel-default active" id="">
                                    <div class="panel-heading" id="tpanel">
                                        <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>Visitantes Registrados</h3></center>
                                    </div>
                                    <div class="error"></div>
                                    <div class="panel-footer danger" id="foterpanels" style="text-align: left">
                                        <span class="btn btn-default asignarvisitante glyphicon glyphicon-ok"  title='Asignar Visitantes' data-toggle='popover' data-trigger='hover'></span>
                                        <span class="btn btn-default nuevovisitante glyphicon glyphicon-user"  title='Nuevo Visitantes' data-toggle='popover' data-trigger='hover'></span>
                                        <span class="btn btn-danger cancelarasignacon glyphicon glyphicon-remove"  title='Cancelar Registro' data-toggle='popover' data-trigger='hover'></span>
                                    </div>
                                    <div class="panel-body">
                                        <div ><input  type="search" class="form-control buscarvisitante2" placeholder="Buscar Visitante" style="width: 50%;float: right"><label style="width: 20%;float: right;padding: 5px">Buscar: </label></div>
                                        <table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesVisita"  cellspacing="0" width="100%" style="width: 100%">
                                            <thead class="ttitulo ">

                                                <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr>


                                            </thead>

                                        </table>
                                    </div> 

                                </div> 




                            </div>
                            <div class="RegistrarParticipantevisita">


                                <div class="panel panel-default active">
                                    <form  id="form-ingresar-visitante5" enctype="multipart/form-data" method="post">

                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Nuevo Visitante</h3></center>
                                        </div>
                                        <div class="panel-body">


                                            <div class="row">
                                                <div class="TomarFoto">
                                                    <table class="table">
                                                        <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                                        <tr><td class="videof"><video id="videof"  autoplay="autoplay"></video></td><td class="canvasf"><canvas id="canvasf" width="300" height="208" ></canvas></td></tr>

                                                        <tr><td colspan="2">  <span  id="fotof" class="btn btn-danger active form-control">
                                                                    Tomar Foto!
                                                                </span></td></tr>
                                                    </table>    

                                                </div>

                                                <select name="tipo_identificacion"  required class="form-control  cbxtipoIdentificacion">

                                                </select>   
                                                <input min="1"  type="number" name="identificacion"  class="form-control inputt" placeholder="No. Identificación" required>

                                                <input type="text" name="apellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                                <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>


                                                <input type="text" name="nombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                                <input type="text" name="segundonombre"  class="form-control inputt2" placeholder="Segundo Nombre" >


                                                <input  min="1"  type="number" name="celular"  class="form-control inputt celularlectura nomostrar" placeholder="Celular" >
                                                <input type="email" name="correo"  class="form-control inputt nomostrar " placeholder="Correo Eléctronico">

                                                <div class="error"></div>
                                            </div>



                                        </div><div class="panel-footer danger" id="foterpanels">
                                            <div class="botones">
                                                <button type="submit" id="btnGuardarVisitante" value="Guardar" class="btn btn-danger active">Guardar</button>
                                                <button type="reset" class="btn btn-default cerrarForParvisita" >Cancelar</button>

                                            </div>

                                        </div>
                                    </form>  
                                </div>
                            </div>





                            <div id="tablaVisitanteVisitaModal">  <table class="table" id="InfoVisitante" >
                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Participante - <a href="#" id="cerrarinfoVisitante"> Cerrar </a></th></tr>
                                    <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                    <tr><td class="primero">Nombre Completo</td><td class="nombrevisitante"></td></tr>

                                    <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                    <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                    <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                    <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>


                                </table> </div>
                        </div>
                        <div class="modal-footer cerrarinfo" id="footermodal">
                            <button type="button" class="btn btn-danger" id="listo" hidden>Listo</button>
                            <button type="button" class="btn btn-default" id="btnCerrar" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>




            <div class="modal fade" id="modalComentarios" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close cerracomentarios" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-comment"></span>  Comentarios</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div class="row2">
                                <table id="tblComentarios" class="table" style=" margin:  0 auto; width: 100%;">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td class="">No.</td><td class="" >Usuario</td><td class="">Comentario</td><td class="">Fecha</td></tr>
                                    </thead>



                                </table>  
                            </div> </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default cerracomentarios"  data-dismiss="modal" >Cerrar</button>
                        </div>
                    </div>
                </div>
            </div> 

            <!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
            <div class="modal fade" id="Modaldetallevisitante" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-ban-circle"></span> Administrador de Sanciones</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div class="tablausuSancionesVisitante">
                                <table class="table ">

                                    <tr><td colspan="2"> 
                                            <table class="table" id="datosvisi">
                                                <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitante</th></tr>
                                                <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                                <tr><td class="primero">Nombre</td><td class="nombrevisitante"></td></tr>
                                                <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                                <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                                <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                                <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                                <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>



                                            </table>      

                                            <div class="error"></div>

                                        </td>
                                    </tr>
                                    <tr class="btnAgregar">
                                        <td class="primero btnAgregar">Agregar Tipo de Sanción:</td><td class="" >
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <select id="cbxSanciones" class="form-control sanciones1"></select>
                                                </div>
                                                <div class="col-md-3 " style="padding-top: 10px;">
                                                    <button id="btnAgregarSancion" class="btn btn-danger active "><span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="confirmarSancion">¿ Esta seguro que desea eliminar la sancion ? <span class="btn btn-link" id="eliminarsi"> Si</span> - <span class="btn btn-link"  id="eliminarno"> No</span>
                                </div>  
                                <table class="table sancionesVisitante" id="sancionesVisitante" style="width: 100%;">
                                    <thead class="ttitulo">
                                        <tr class="opcioenstabla"><td  title='Eliminar Sancion' data-toggle='popover' data-trigger='hover' class='rSancion fa fa-trash btnElimina '></td></tr>

                                        <tr class="filaprincipal"><td  colspan="6" style="color: #990000; text-align: center">Sanciones del Visitante</td></tr>
                                        <tr class="filaprincipal"><td>No.</td><td>Usuario</td><td>Sanción</td><td>Fecha</td></tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <button type="button" class="btn btn-default" id="btnCerrar" data-dismiss="modal">Cerrar</button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <!--:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->




        </div>
        <div class="modal fade" id="ModalMensajevisita" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">

                        <p id="mensajed"></p>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>


                </div>


            </div>
        </div>



        <div class="modal fade" id="ModalModificar" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-remove"></span>   Cancelar Visita</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">
                        <div class="error"></div>
                        <div id="ModalEliminar" style="text-align: center">
                            <p class="mc">¿ Esta Seguro de Desea Cancelar la Visita ?</p>

                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="submit" class="btn btn-danger btnCancelo" id="ModificarEstadoVisita" >Modificar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>


                </div>


            </div>

        </div>


        <div class="modal fade" id="ModalModificarReserva" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Modificar Información de la Visita</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">
                        <div class="error"></div>
                        <div class="panel-body divmodifica" style="width: 78%;margin:  0 auto">
                            <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculo4 micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                            <div class="oculto divplaca4"  style="">
                                <input type="text" name="placa" id="txtPlacaVehiculo4" maxlength="6" class="form-control placa4" placeholder="Número Placa del Vehículo">
                                <input type="number" id="txtAcompanantes4" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" required>

                            </div>
                            <div class="horas">
                                <div class='entrada input-group date datetimepicker'>
                                    <input  placeholder="Hora de Entrada" type='text' class="form-control" name='horaEntrada' readonly required id="txtHoraEntradamodi">
                                    <span class="input-group-addon  ">
                                        <span style="color: #990000" class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                                <div class='salida input-group date datetimepicker' >
                                    <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Salida" id="txtHoraSalidamodi">
                                    <span class="input-group-addon " >
                                        <span style="color: #990000"  class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>

                                <select id="cbxTipoIngresomodi" class="form-control tipoIngreso" name="tipoIngreso" required>
                                </select>

                                <textarea style="margin-top:2%;"rows="3" cols="100" class="form-control" id="txtObservacionesmodi" placeholder="Observaciones" name="observaciones" required></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="submit" class="btn btn-danger divmodifica" id="btnModificarReserva" >Modificar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="participantes" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Agregar Participantes</h4>
                    </div>

                    <div class="modal-body" id="bodymodal" >
                        <div class="row row2 tablausup" >
                            <div class="NuevoPartEv btnAgregar"style="width: 100%;text-align: left" title="Nuevo Participante" data-toggle="popover" data-trigger="hover"> <span class=" glyphicon glyphicon-user">Nuevo</span></div>
                            <div class="RegistrarParticipante">
                                <div class="panel panel-default active">
                                    <form  id="form-ingresar-visitante3" enctype="multipart/form-data" method="post">

                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Nuevo Participante</h3></center>
                                        </div>
                                        <div class="panel-body">


                                            <div class="row">
                                                <div class="TomarFoto">
                                                    <table class="table">
                                                        <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                                        <tr><td class="video2"><video id="video2"  autoplay="autoplay"></video></td><td class="canvas2"><canvas id="canvas2" width="300" height="208" ></canvas></td></tr>

                                                        <tr><td colspan="2">  <span  id="foto2" class="btn btn-danger active form-control">
                                                                    Tomar Foto!
                                                                </span></td></tr>
                                                    </table>    

                                                </div>
                                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculoevento2 micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                                <div class="oculto divplacaevento2">
                                                    <input type="text" name="placa" id="txtPlacaVehiculoevento2" maxlength="6" class="inputt form-control placaevento2" placeholder="Número Placa del Vehículo">
                                                    <input type="number"  id="txTAcompanantesevento2" class=" inputt form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes">

                                                </div>
                                                <select name="tipo_identificacion"  required class="form-control  cbxtipoIdentificacion">

                                                </select>   
                                                <input min="1" type="number" name="identificacion"  class="form-control inputt" placeholder="No. Identificación" required>
                                                <input type="text" name="apellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                                <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>


                                                <input type="text" name="nombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                                <input type="text" name="segundonombre"  class="form-control inputt2" placeholder="Segundo Nombre" >


                                                <input min="1" type="number" name="celular"  class="form-control inputt nomostrar" placeholder="Celular" >
                                                <input type="email" name="correo"  class="form-control inputt nomostrar" placeholder="Correo Eléctronico">
                                                <input type="email" name="correo" id="txtCorreo" class="form-control inputt nomostrar" placeholder="Correo Eléctronico">
                                                <select  name="tipo"class="form-control tipo_par" id="tipo_par_reg" required=""></select>

<!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                                -->  

                                            </div>







                                        </div><div class="panel-footer danger" id="foterpanelb">
                                            <div class="botones">
                                                <button type="submit" id="btnGuardarVisitante"  class="btn btn-danger active">Guardar</button>
                                                <button type="reset" class="btn btn-default cerrarForPar" style="margin-top: 10px">Cancelar</button>

                                            </div>

                                        </div>
                                    </form>  
                                </div>
                            </div>
                            <div class="TablaEvenPar">
                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculoevento1 micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                <div class="oculto divplacaevento1"  style="width: 50%;margin:  0 auto">
                                    <input type="text" name="placa" id="txtPlacaVehiculoevento1" maxlength="6" class="form-control placaevento1" placeholder="Número Placa del Vehículo">
                                    <input type="number"  id="txTAcompanantesevento1" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" required>

                                </div>
                                <div ><input  type="search" class="form-control buscarvisitante_evento" placeholder="Buscar Visitante" style="width: 50%;float: right"><label style="width: 20%;float: right;padding: 3%">Buscar: </label></div>
                                <table class="table table-bordered table-hover  table-responsive" id="tablaParticipantes"  cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td colspan="4">Tipo Participante: <select  class="form-control tipo_par" id="tipo_par"></select></td></tr>
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr>


                                    </thead>

                                </table>
                                <div id="tablaParticipantesmodal">  <table class="table" id="InfoVisitante" >
                                        <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Participante - <a href="#" id="cerrarinfo"> Cerrar </a></th></tr>
                                        <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                        <tr><td class="primero">Nombres</td><td class="nombrevisitante"></td></tr>
                                        <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                        <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                        <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                        <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                        <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>

                                        <tr id="txtplacavisitante"><td class="primero" >Placa</td><td class="placaVisitante"></td></tr>
                                        <tr><td class="primero">Sanciones</td><td class="sanciones"></td></tr>

                                    </table> </div>
                            </div>




                        </div>
                        <div class="error"></div>
                    </div>
                    <div class="modal-footer foterMP" id="footermodal">
                        <span  id="AgregarParticipante"  class="btn btn-danger active btnAgregar">Asignar</span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>







        <!---------------------------------------------------------------------------------------------------------------------------------------->
        <div class="modal fade" id="participantesDepartamentos" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Agregar Visitantes</h4> 
                    </div>

                    <div class="modal-body" id="bodymodal" >
                        <div class="row row2 tablausup" >
                            <div class="NuevoPartDepart btnAgregar"style="width: 100%;text-align: left" title="Nuevo Participante" data-toggle="popover" data-trigger="hover"> <span class=" glyphicon glyphicon-user">Nuevo</span></div>
                            <div class="RegistrarParticipanteDepa">


                                <div class="panel panel-default active">
                                    <form  id="form-ingresar-visitante4" enctype="multipart/form-data" method="post">

                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Nuevo Participante</h3></center>
                                        </div>
                                        <div class="panel-body">


                                            <div class="row">
                                                <div class="TomarFoto">
                                                    <table class="table">
                                                        <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                                        <tr><td class="video3"><video id="video3"  autoplay="autoplay"></video></td><td class="canvas3"><canvas id="canvas3" width="300" height="208" ></canvas></td></tr>

                                                        <tr><td colspan="2">  <span  id="foto3" class="btn btn-danger active form-control">
                                                                    Tomar Foto!
                                                                </span></td></tr>
                                                    </table>    

                                                </div>
                                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculo3 micheckbox " style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                                <div class="oculto divplaca3">
                                                    <input type="text" name="placa" id="txtPlacaVehiculo3" maxlength="6" class="form-control placa3" placeholder="Número Placa del Vehículo">
                                                    <input type="number" id="txTAcompanantes3" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" >

                                                </div>
                                                <select name="tipo_identificacion"  required class="form-control  cbxtipoIdentificacion">

                                                </select>   
                                                <input min="1"  type="number" name="identificacion"  class="form-control inputt" placeholder="No. Identificación" required>

                                                <input type="text" name="apellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                                <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>


                                                <input type="text" name="nombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                                <input type="text" name="segundonombre"  class="form-control inputt2" placeholder="Segundo Nombre" >


                                                <input  min="1"  type="number" name="celular"  class="form-control inputt celularlectura nomostrar" placeholder="Celular" >
                                                <input type="email" name="correo"  class="form-control inputt nomostrar " placeholder="Correo Eléctronico">


                                            </div>







                                        </div><div class="panel-footer danger" id="foterpanelb">
                                            <div class="botones">
                                                <input type="submit" id="btnGuardarVisitante" value="Guardar" class="btn btn-danger active">
                                                <button type="reset" class="btn btn-default cerrarForParDepa" style="margin-top: 10px">Cancelar</button>

                                            </div>

                                        </div>
                                    </form>  
                                </div>
                            </div>

                            <div class="TablaDepaPar">
                               
                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculo2 micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                <div class="oculto divplaca2"  style="width: 50%;margin:  0 auto">
                                    <input type="text" name="placa" id="txtPlacaVehiculo2" maxlength="6" class="form-control placa2" placeholder="Número Placa del Vehículo">
                                    <input type="number" id="txTAcompanantes2" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" required>

                                </div>
                                <div ><input  type="search" class="form-control buscarvisitante" placeholder="Buscar Visitante" style="width: 50%;float: right"><label style="width: 20%;float: right;padding: 3%">Buscar: </label></div>
                                <table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesDepar"  cellspacing="0" width="100%" style="width: 100%">
                                    <thead class="ttitulo ">
                                        <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td></tr>


                                    </thead>

                                </table>
                                <div id="participantesDeparta">  <table class="table" id="InfoVisitante" >
                                        <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Participante - <a href="#" id="cerrarinfoDepar"> Cerrar </a></th></tr>
                                        <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                        <tr><td class="primero">Nombres</td><td class="nombrevisitante"></td></tr>
                                        <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                        <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                        <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                        <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                        <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>


                                    </table> </div>
                            </div>
                            <div class="Visitantesfoto">
                                <div class="TomarFoto">
                                    <table class="table">
                                        <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                        <tr><td class="videov"><video id="videov"  autoplay="autoplay"></video></td><td class="canvasv nomostrar"><canvas id="canvasv" width="300" height="208" ></canvas></td></tr>

                                        <tr><td colspan="2">  <span  id="fotov" class="btn btn-danger active form-control">
                                                    Tomar Foto!
                                                </span></td></tr>
                                    </table>    

                                </div>
                            </div>


                        </div>
                        <div class="sancionado-error col-lg-12 oculto"><img src="../Imagenes/Sancionado.png" style="width: 20%"></div>
                        <div class="error"></div>
                    </div>
                    <div class="modal-footer foterMPde" id="footermodal">
                        <span  id="AgregarParticipanteDepartamento"  class="btn btn-danger active btnAgregar ">Asignar</span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>





        <div class="modal fade" id="participantesevento" role="dialog">
            <div class="modal-dialog" style="width: 60%">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-calendar"></span> Datos del Evento</h4>
                    </div>

                    <div class="modal-body" id="bodymodal" >
                        <div class="row row2 tablausup" >
                            <div id="tablainfoevento">  <table class="table" id="Infoevento" >
                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Evento </th></tr>

                                    <tr><td class="primero">Nombre</td><td class="nombreevento"></td></tr>
                                    <tr><td class="primero">Hora Inicio</td><td class="HoraInicioEvento"></td></tr>
                                    <tr><td class="primero">Hora Fin</td><td class="HoraFinEvento"></td></tr>
                                    <tr><td class="primero">Duracion</td><td class="DuracionEvento"></td></tr>
                                    <tr><td class="primero" >Cupos</td><td class="cuposEvento"></td></tr>
                                    <tr><td class="primero">Pre-Incripcion</td><td class="preinsevento"></td></tr>
                                    <tr><td class="primero">Ubicacion</td><td class="UbicacionEvento"></td></tr>
                                    <tr><td class="primero">Estado</td><td class="EstadoEvento"></td></tr>
                                    <tr><td class="primero">Descripcion</td><td class="descripcionevento"></td></tr>
                                </table> </div>

                            <div class="error"></div>
                            <div class="confirmar" style="color: #990000">Esta Seguro que desea Retirar al Participante..? <span id="retirarsi" class="btn btn-link">Si</span>-<span id="retirarno" class="btn btn-link">No</span></div>
                            <table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesevento"  cellspacing="0" width="100%" style="width: 100%">
                                <thead class="ttitulo ">
                                    <tr class="opcioenstabla"><td id="marcarentrada"  title='Marcar Entrada' data-toggle='popover' data-trigger='hover' style='  color: #990000; ' class='glyphicon glyphicon-time btnAgregar'></td><td id="retirar" title='Retirar del Evento' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class=' glyphicon glyphicon-remove btnElimina'></td></tr>
                                    <tr><th class="filaprincipal" colspan="6" style="color: #990000; text-align: center"> Participantes </th></tr>
                                    <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>Hora Entrada</td><td>Tipo</td></tr>


                                </thead>
                            </table>
                            <div id="tablaParticipanteeventosmodal">
                                <table class="table" id="InfoVisitante" >

                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Participante - <a href="#" id="cerrarinfoeve"> Cerrar </a></th></tr>
                                    <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                    <tr><td class="primero">Nombres</td><td class="nombrevisitante"></td></tr>
                                    <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                    <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                    <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                    <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                    <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>

                                </table> </div>



                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>










        <div class="modal fade" id="participantesDepartamentoInfo" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-calendar"></span> Visitas Del Dia</h4>
                    </div>

                    <div class="modal-body EsteModal" id="bodymodal" >
                        <div class="row row2 tablausup" >


                            <div class="error"></div>
                            <div class="confirmarVisita" style="color: #990000">Esta Seguro que desea Cancelar la Visita..? <span id="retirarsiVisitante" class="btn btn-link">Si</span>-<span id="retirarnoVisitante" class="btn btn-link">No</span></div>
                            <table class="table table-bordered table-hover  table-responsive" id="tablaParticipantesDepartamentos"  cellspacing="0" width="100%" style="width: 100%">
                                <thead class="ttitulo ">
                                    <tr class="opcioenstabla"><td  id="retirarVisi"  title='Cancelar Visita' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class='glyphicon glyphicon-remove btnElimina'></td><td id="SalidaVisi" title='Marcar Hora Salida' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class='btnAgregar  glyphicon glyphicon-time'></td></tr>
                                    <tr><th class="filaprincipal" colspan="8" style="color: #990000; text-align: center"> Participantes </th></tr>
                                    <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>Placa</td><td>Acompañantes</td><td>Hora Entrada</td><td>Hora Salida</td></tr>


                                </thead>
                            </table>
                            <div id="tablaParticipanteDepartamento">
                                <table class="table" id="InfoVisitante" >

                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Participante - <a href="#" id="cerrarinfoDeparPer"> Cerrar </a></th></tr>
                                    <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                    <tr><td class="primero">Nombres</td><td class="nombrevisitante"></td></tr>
                                    <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                    <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                    <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                    <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                    <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>

                                </table> </div>



                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>

        <script src="../estilos/jquery-2.2.1.js"></script>

        <script>
            $(function() {
                var x1 = 0;
                var cxt = canvas.getContext("2d");
                var cxv = canvasv.getContext("2d");
                var cxt2 = canvasmodi.getContext("2d");
                var cxt3 = canvas2.getContext("2d");
                var cxt4 = canvas3.getContext("2d");
                var cxtf = canvasf.getContext("2d");
                canvas = document.getElementById("canvas");
                canvasv = document.getElementById("canvasv");
                canvasmodi = document.getElementById("canvasmodi");
                canvas2 = document.getElementById("canvas2");
                canvas3 = document.getElementById("canvas3");
                video = document.getElementById("video");
                video2 = document.getElementById("video2");
                video3 = document.getElementById("video3");
                videov = document.getElementById("videov");
                videomodi = document.getElementById("videomodi");
                canvasf = document.getElementById("canvasf");
                videof = document.getElementById("videof");
                if (!navigator.getUserMedia)
                    navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
                if (!window.URL)
                    window.URL = window.webkitURL;

                if (navigator.getUserMedia) {
                    navigator.getUserMedia({
                        "video": true,
                        "audio": false
                    }, function(stream) {
                        video.src = window.URL.createObjectURL(stream);
                        video.play();
                        video3.src = window.URL.createObjectURL(stream);
                        video3.play();
                        video2.src = window.URL.createObjectURL(stream);
                        video2.play();
                        videomodi.src = window.URL.createObjectURL(stream);
                        videomodi.play();
                        videof.src = window.URL.createObjectURL(stream);
                        videof.play();
                        videov.src = window.URL.createObjectURL(stream);
                        videov.play();
                    }, function(err) {
                        console.log("Ocurrió el siguiente error: " + err);
                    });
                } else {
                    alert("getUserMedia no disponible");
                    return;
                }

                // Evento click para capturar una foto.
                $("#foto").click(function() {
                    cxt.drawImage(video, 0, 0, 300, 208);
                });

                $("#fotomodi").click(function() {

                    cxt2.drawImage(videomodi, 0, 0, 300, 208);

                });
                $("#foto2").click(function() {

                    cxt3.drawImage(video2, 0, 0, 300, 208);

                });
                $("#foto3").click(function() {

                    cxt4.drawImage(video2, 0, 0, 300, 208);

                });
                $("#fotof").click(function() {
                    cxtf.drawImage(videof, 0, 0, 300, 208);
                });
                $("#fotov").click(function() {
                    cxv.drawImage(videov, 0, 0, 300, 208);
                });
            });
        </script>
        <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>

        <script src="../estilos/visita.js"></script>
        <script src="../estilos/Parametros.js"></script>
        <script src="../estilos/Registros.js"></script>

        <script src="../estilos/Inicio.js"></script>
        <script src="../estilos/Evento.js"></script>


        <script src="../estilos/Notificaciones.js"></script>
        <script src="../estilos/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
        <script src="../estilos/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>


        <script src="../estilos/js/jquery.dataTables.min.js"></script>
        <script src="../estilos/js/dataTables.bootstrap.js"></script>
        <!--botones DataTables-->	
        <script src="../estilos/js/dataTables.buttons.min.js"></script>
        <script src="../estilos/js/buttons.bootstrap.min.js"></script>
        <!--Libreria para exportar Excel-->
        <script src="../estilos/js/jszip.min.js"></script>
        <!--Librerias para exportar PDF-->
        <script src="../estilos/js/pdfmake.min.js"></script>
        <script src="../estilos/js/vfs_fonts.js"></script>
        <!--Librerias para botones de exportación-->
        <script src="../estilos/js/buttons.html5.min.js"></script>

        <script>



            ListarDepartamentos("cuc");

            CargarTiposSanciones();
            CargarEmpresas();

            BuscarPermisosActividadPerfil("Visita");</script>
    </body>
</html>
