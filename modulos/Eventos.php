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

        <link href="../estilos/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../estilos/MiEstilo3.css">
        <!-- Buttons DataTables -->


            <title>Control de Acceso</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio opcionesEventos"  style="display: none">
        <div class="opciones ">

            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones">
                <button type="button" id="Recargar" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>

                <button id="agregar" type="button" class="btn btn-link active btnAgregar nomostrar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-floppy-disk" title="Agregar Evento" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="agregar_Siru" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#ModalBuscar" ><span class="sagregar glyphicon glyphicon-search" title="Habilitar Evento de Siru" data-toggle="popover" data-trigger="hover"></span></button>

                <button id="eliminar" type="button" class="btn btn-link active btnElimina nomostrar"><span class="seliminar glyphicon glyphicon-remove" title="Cancelar Evento" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="modificar"  type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Evento" data-toggle="popover" data-trigger="hover"></span></button>
                <button type="button" id="CambiarTabla" class="btn btn-link active btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>

                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="Eventos.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?>
            </div><div class="moduloname"><h5>Administracion de Eventos</h5>
            </div>
        </div>

        <div class="container col-md-12 " id="cusuarios">

            <input type="hidden" id="idSeleccionado">


            <div class="tablausu col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover  table-responsive" id="tablaeventosmodulo"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr><td colspan="12" class="filtar_Eventos">Filtar Por Fecha: <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fecha" class="form-control" id="fecha_filtrar">  <button id="Filtrar_fecha" type="button" class="btn btn-danger active" ><span class=" glyphicon glyphicon-search" title="Filtar" data-toggle="popover" data-trigger="hover"></span></button>
                                    <span id="Mostar_Mis_Eventos"title="Mis Eventos" data-toggle="popover" data-trigger="hover" class="glyphicon glyphicon-eye-open btn btn-default"></span> </td></tr>
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="" >Nombre</td><td class="">Hora Inicio</td><td class="">Hora Fin</td><td class="">Duracion</td><td class="">Ubicacion</td><td></td><td>Cupos</td><td>En Evento</td><td>Pre-Incripcion</td><td>Descripcion</td><td class="">Estado Evento</td><td>****</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>

        </div> 
        <div class="modal fade modalcrearevento" id="myModal" role="dialog">
            <div class="modal-dialog">
                <form action="#" id="registrar-evento" method="post">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Creacion de Eventos</h4>
                        </div>
                        <div class="modal-body modalevento" id="bodymodal">


                            <div id="error"  class="form-group has-error text-center oculto error"></div>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>

                            <select class="form-control  departamentos" name="ubicacion" id="cbxubicaicon" required>
                                <option value="">Seleccione Ubicacion</option>
                            </select>

                            <div class="horas horasevento">
                                <div class='entrada input-group date datetimepicker' >
                                    <input placeholder="Hora de Inicio" type='text' class="form-control" name='horaEntrada' readonly required id="hentrada">
                                    <span class="input-group-addon  " >
                                        <span style="color: #990000" class="glyphicon glyphicon-calendar" >
                                        </span>
                                    </span>


                                </div>


                                <div class='salida input-group date datetimepicker' >
                                    <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Fin" id="hsalida">
                                    <span class="input-group-addon " >
                                        <span style="color: #990000"  class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>

                            </div>
                            <div style="text-align: left">
                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox" id="preinscripcion" name="inscripcion" class="micheckbox" style="margin-right: 5px; margin-top: 5px;" value="1">Pre-Incripcion</label>

                                <input type="text" name="cupos" id="txtcupos"  class="form-control " placeholder="Cupos Disponibles">


                                <textarea class="form-control inputt2"  cols="1" rows="3" name="descripcion" placeholder="Descripcion" required="" ></textarea>

                            </div>


                        </div> 
                        <div class="modal-footer" id="footermodal">
                            <input type="submit" value="Guardar" class="btn btn-danger active">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>
                </form>

            </div>
        </div> 


        <div class="modal fade modalcrearevento" id="modalModificarEvento" role="dialog">
            <div class="modal-dialog">
                <form action="#" id="Modificar-evento" method="post">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-refresh"></span> Modificar Evento</h4>
                        </div>
                        <div class="modal-body modalevento" id="bodymodal">
                            <div  class="form-group has-error text-center oculto error"></div>
                            <div class="divmodifica">


                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required id="NombreModiEven" readonly="">

                              <!--  <select class="form-control  departamentos" name="ubicacion"  required>
                                    <option value="">Seleccione Ubicacion</option>
                                </select>-->
                                <input class="form-control" type="text" id="cbxubicacionModiEve" name="ubicacion" readonly="">
                                <select class="form-control  Estado-Evento" name="estadoevento" id="cbxEstadoEvModi" required style="display: none">

                                </select>
                                <div class="horas horasevento">
                                    <input placeholder="Hora de Inicio" type='text' class="form-control" name='horaEntrada' readonly required id="hentradaModi">
                                    <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Fin" id="hsalidaModi">

                                    <!--   <div class='entrada input-group date datetimepicker' >
                                           <input placeholder="Hora de Inicio" type='text' class="form-control" name='horaEntrada' readonly required id="hentradaModi">
                                           <span class="input-group-addon des_click " >
                                               <span style="color: #990000" class="glyphicon glyphicon-calendar" >
                                               </span>
                                           </span>
   
   
                                       </div>
   
   
                                       <div class='salida input-group date datetimepicker' >
                                           <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Fin" id="hsalidaModi">
                                           <span class="input-group-addon des_click " >
                                               <span style="color: #990000"  class="glyphicon glyphicon-calendar">
                                               </span>
                                           </span>
                                       </div>
                                    -->
                                </div>
                                <div style="text-align: left">
                                    <label style="color: #990000; font-size: 13px; "> <input type="checkbox" id="preinscripcionModi" name="inscripcion" class="micheckbox" style="margin-right: 5px; margin-top: 5px;" value="1">Pre-Incripcion</label>

                                    <input type="text" name="cupos" id="txtcuposModi"  class="form-control " placeholder="Cupos Disponibles" readonly="">


                                    <textarea class="form-control inputt2"  cols="1" rows="3" name="descripcion" placeholder="Descripcion" required=""id="DescricionModi"  ></textarea>

                                </div>

                            </div>
                        </div> 
                        <div class="modal-footer" id="footermodal">
                            <input type="submit" value="Modificar" class="btn btn-danger active divmodifica">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>
                </form>

            </div>
        </div> 








        <div class="modal fade" id="participantes" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Agregar Participantes</h4>
                    </div>

                    <div class="modal-body" id="bodymodal" >
                        <div class="row row2 tablausu" >


                            <div class="NuevoPartEv "style="width: 100%;text-align: left" title="Nuevo Participante" data-toggle="popover" data-trigger="hover"> <span class=" glyphicon glyphicon-user">Nuevo</span></div>
                            <div class="RegistrarParticipante">



                                <div class="panel panel-default active">
                                    <form  id="form-ingresar-visitante2" enctype="multipart/form-data" method="post">

                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Nuevo Participante</h3></center>
                                        </div>
                                        <div class="panel-body">


                                            <div class="row">
                                                <label style="color: #990000; font-size: 13px; "> <input type="checkbox"  class="vehiculoevento2 micheckbox" style="margin-right: 5px; margin-top: 5px;" >Visitante con Vehículo</label>
                                                <div class="oculto divplacaevento2">
                                                    <input type="text" name="placa" id="txtPlacaVehiculoevento2" maxlength="6" class="inputt form-control placaevento2" placeholder="Número Placa del Vehículo">
                                                    <input type="number"  id="txTAcompanantesevento2" class=" inputt form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes">

                                                </div>
                                                <select name="tipo_identificacion" id="cbxtipoIdentificacion"  required class="form-control  cbxtipoIdentificacion">

                                                </select>   
                                                <input type="number" name="identificacion" id="txtIdentificacion" class="form-control inputt " placeholder="No. Identificación" required>

                                                <input type="text" name="apellido" id="txtApellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                                <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>

                                                <input type="text" name="nombre" id="txtNombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                                <input type="text" name="segundonombre" id="txtSegundoNombre" class="form-control inputt2" placeholder="Segundo Nombre" >


                                                <input type="number" name="celular" id="txtCelular" class="form-control inputt nomostrar" placeholder="Celular" >
                                                <input type="email" name="correo" id="txtCorreo" class="form-control inputt nomostrar" placeholder="Correo Eléctronico">
                                                <select  name="tipo"class="form-control tipo_par" id="tipo_par_reg" required=""></select>
                                                <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                                -->   

                                            </div>







                                        </div>

                                        <div class="panel-footer danger" id="foterpanelb">
                                            <div class="botones">
                                                <button type="submit" id="btnGuardarVisitante" class="btn btn-danger active">Guardar</button>
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

        <div class="modal fade" id="participantesevento" role="dialog" > 
            <div class="modal-dialog" style="width: 80%">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-calendar"></span> Datos del Evento</h4>
                    </div>

                    <div class="modal-body" id="bodymodal" >
                        <div class="row row2 tablausu" >
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
                                    <tr class="opcioenstabla">
                                    <td id="marcarentrada"  title='Marcar Entrada' data-toggle='popover' data-trigger='hover' style='  color: #990000; ' class='glyphicon glyphicon-time btnAgregar'></td>
                                    <td id="retirar" title='Retirar del Evento' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class=' glyphicon glyphicon-remove btnElimina'></td></tr>
                                    <tr><th class="filaprincipal" colspan="7" style="color: #990000; text-align: center"> Participantes </th></tr>
                                    <tr class="filaprincipal"><td>No.</td><td class="" >Nombre</td><td class="">#Placas</td><td class="">Acompañantes</td><td class="">Identificacion</td><td>Hora Entrada</td><td>Tipo</td></tr>


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

                                    <tr id="txtplacavisitante"><td class="primero" >Placa</td><td class="placaVisitante"></td></tr>
                                    <tr><td class="primero">Sanciones</td><td class="sanciones"></td></tr>

                                </table> </div>



                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>


            </div>
        </div>

        <div class="modal fade" id="ModalMensaje" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">
                        <div id="ModalMe">

                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>


                </div>


            </div>
        </div>


        <div class="modal fade" id="ModalBuscar" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">
                        <div class="Mensaje nomostrar" id="MensajeEje" ><p id="mensajeEvento"></p></div>
                        <div id="Buscar_En_Filtro" class="nomostrar" style="padding-top: 5px">  <input style="width: 40%;float: right" class="form-control"  id="Buscar_Eve_Nombre" placeholder="Ingrese Nombre">   <label style="float: right;padding: 3px;">Buscar: </label></div>
                        <div class="error_eve"></div>
                        <div class="table-responsive" style="height: 500px;width: 100%; padding-top: 10px">

                            <table id="Coincidencias" class="table table-bordered  table-hover">


                                <thead class="ttitulo">
                                    <tr><td colspan="6" class=""><div style="width: 30%;float: left"><input value="<?php echo date("Y-m-d"); ?>"  type="date" name="fecha" class="form-control inputt2" id="fecha_filtrar_siru" ></div><div style="width: 10%;float: left;padding-left: 3px"><button class="btn btn-danger glyphicon glyphicon-search" id="Buscar_Evento_fecha"></button></div> </td></tr>

                                    <tr class="filaprincipal"><td class="largo">Nombre Evento</td><td class="medio">Hora Inicio</td><td class="medio">Hora Fin</td><td class="largo">Ubicacion</td><td class="corto">Codigo</td><td>Capacidad</td></tr></thead>
                                <tbody>
                                    <tr><td colspan="6">Ningun dato Disponible en la tabla</td></tr>
                                </tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="button" class="btn btn-danger" id="Habilitar_eve">Habilitar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>


                </div>


            </div>
        </div>


        <div class="modal fade" id="ModalConfirmacionEliminar" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal" id="EliminarSalir" > X</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Panel de Administracion</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">
                        <div id="ModalEliminar" style="text-align: center">
                            <p class="mc">¿ Esta Seguro de Desea Cancelar el Evento ?</p>

                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <div class="botonesEliminar"> <span id="btnEliminarEvento" class="btn btn-danger active">Eliminar</span>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>

                        <button type="button" class="btn btn-default" data-dismiss="modal" id="salirEliminar">Salir</button>

                    </div>


                </div>


            </div>
        </div>


        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Mensaje.js"></script>

        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/Evento.js"></script>
        <script src="../estilos/Parametros.js"></script>

        <script src="../estilos/Inicio.js"></script>
        <div id="datatime">   <script src="../estilos/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
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
            <script>fecha = $("#fecha_filtrar").val();
                listarEventosusuario(fecha, 1);
                CargartiposParticipantes();
                BuscarPermisosActividadPerfil("Eventos");</script>
    </body>
</html>
