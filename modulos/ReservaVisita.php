<?php
session_start();
?>

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
            <title>Control de Acceso</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio opcionesReservaVisita" style="display: none">
        <div class="opciones ">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=ssiqwrd54h74swef14afkn" TARGET="_parent">salir</A>

            <div class="operaciones"> 
                <button type="button" id="Recargarreserva" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>


                <button id="agregar2" type="button" class="btn btn-link active btnAgregar" ><span class="sagregar glyphicon glyphicon-floppy-disk" title="Reservar Visita" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="modificarReserva" type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Reserva" data-toggle="popover" data-trigger="hover"></span></button>
                <button class="btn btn-link active btnModifica" id="modificar"><span class="smodificar modificarmisvisitas glyphicon glyphicon glyphicon-remove" title="Cancelar Visita" data-toggle="popover" data-trigger="hover" ></span></button>
                <button id="listar2" type="button" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-list-alt" title="Mis Visitas" data-toggle="popover" data-trigger="hover"></span></button>
                <button type="button" id="CambiarTabla2" class="btn btn-link active btnCambiaTabla" ><span class="smodificar glyphicon gglyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
               <button  class="btn btn-link active"><span class="glyphicon glyphicon-comment smodificar" id="btnComentarios"  title="Mostrar Todos Los comentarios" data-toggle="popover" data-trigger="hover"></span></button>
               <button  type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-user" title="Agregar Visitante" data-toggle="popover" data-trigger="hover"></span></button>
               
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
                 <a id="permiso" href="../modulos/inicio.php?permiso=no" target="ventana"></a>
                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="ReservaVisita.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Modulo Visitas </h5>
            </div>
        </div>
        <div class="container col-md-12 " id="cusuarios">

            <input type="hidden" id="idSeleccionado">

            <div class="tablausu col-md-12 " >
                <div class="table-responsisove col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover  table-responsive" id="tablamisvisitas"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal" ><td colspan="8">Mis Visitas </td></tr>

                            <tr class="filaprincipal"><td class="">No.</td><td class="">Visitado</td><td class="">Hora Entrada</td><td class="">Hora Salida</td><td class="">Duracion</td><td class="">Tipo Ingreso</td><td class="">Estado Visita</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>





            <div  id="reservavisita" >

                <div class="modal fade" id="InfoVisitante" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title" ><span class="glyphicon glyphicon-user"> </span> Informacion del Visitante</h4>
                            </div>
                            <div class="modal-body " id="bodymodal">


                                <table class="table" id="datosvisi" style="width: 500px;">
                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitante</th></tr>
                                    <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                    <tr><td class="primero">Nombre Completo</td><td class="nombrevisitante"></td></tr>

                                    <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                    <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                    <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                    <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>


                                </table>      

                            </div> 
                        </div>


                    </div>
                </div> 

                <div class="modal fade" id="InfoVisitado" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
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

                <div id="rowvisita">

                    <form class="form-horizontal" id="reservar-visita">    
                        <div class="rowvisita">
                            <div class="error"></div>
                            <div class="panel panel-default active" id="panelvisitante">
                                <div class="panel-heading" id="tpanel">
                                    <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitante</h3></center>
                                </div>
                                <div class="panel-body">
                                    <div class="omitir">Omitir</div>
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
                                    <div class="tablaVisitadosVisita"><table class="table table-bordered table-hover  table-responsive" id="tablaVisitadosVisita"  cellspacing="0" width="100%" style="width: 100%">
                                            <thead class="ttitulo ">
                                                <tr class="filaprincipal"><td>No.</td><td class="" >Nombres</td><td class="">Apellidos</td><td class="">Identificacion</td><td>***</td></tr>


                                            </thead>

                                        </table></div>
                                    <table class="table" id="datosvisi2" style=" margin:  0 auto">

                                        <tr><td rowspan="10"  class="fotoVisitado" style="width: 150px;text-align: center"></td></tr>

                                        <tr><td class="primero1">Nombre Completo</td><td class="nombrevisitados"></td></tr>
                                        <tr><td class="primero1">Tipo Identificacion</td><td class="Tipoidentificacionvisitado"></td></tr>

                                        <tr><td class="primero1">Identificacion</td><td class="identificacionvisitado"> </td></tr>
                                        <tr><td class="primero1">Celular</td><td class="celularvisitado"></td></tr>
                                        <tr><td class="primero1">Correo</td><td class="correovisitado"></td></tr>


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
                                        <div class='entrada input-group date datetimepicker'>
                                            <input  placeholder="Hora de Entrada" type='text' class="form-control" name='horaEntrada' readonly required id="hentrada">
                                            <span class="input-group-addon  ">
                                                <span style="color: #990000" class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>


                                        </div>


                                        <div class='salida input-group date datetimepicker' >
                                            <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Salida" id="hsalida">
                                            <span class="input-group-addon " >
                                                <span style="color: #990000"  class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>
                                        </div>




                                        <select class="form-control tipo_ingreso tipoIngreso" name="tipoIngreso" id="cbxtipovisita" required>
                                            <option value="">Seleccione Tipo de Ingreso</option>
                                        </select>
                                        <input type="number" id="txTAcompanantes" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes">

                                        <textarea rows="3" cols="100" class="form-control" id="oberservaciones" placeholder="Observaciones" name="observaciones" ></textarea>

                                    </div> 
                                </div>
                                <div class="panel-footer danger" id="foterpanelb1">
                                    <div class="botones">
                                        <span  id="izquivisita"><span  class="btn btn-default active" >Atras</span></span>
                                        <button type="submit" class="btn btn-danger active" >Guardar</button>
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
                                        <span  id="nuevavisita"><button  type="reset" class="btn btn-danger active">Nueva</button></span>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>   
                </div>


                <!--
                
                            <div class="rowvisita">
                               
                                <div class="error"></div>
                                <form class="form-horizontal" id="reservar-visita">    
                                      <div class="panel panel-default active" id="panelvisitante">
                                        <div class="panel-heading" id="tpanel">
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitante</h3></center>
                                        </div>
                                        <div class="panel-body">
                                            <div class="viistantesd">
                                                <div class="tipo">  <div class="select"><select id="cbxtipoIdentificacionVisitante" class="form-control tipoIdentificacion cbxtipoIdentificacion" name="tipoIdentificacion" required="">
                                                            <option value="">Seleccione Tipo de Identificacion</option>
                
                                                        </select> <input class="form-control" id="nombrevisi" placeholder="Nombres" > </div><div class="chec"><span class="glyphicon glyphicon-refresh" id="busqueda" style="color: black" title="Cambiar Modo de Busqueda" data-toggle="popover" data-trigger="hover"></span></div></div>
                                                <div class="identi"><input type="number" id="txtIdentificacionvisitante" class="form-control inputVisita" placeholder="No. Identificación Visitante" name="numIdentificacion" required="">
                                                    <input class="form-control" id="apellidovisi" placeholder="Apellidos" > 
                                                    <input type="text" id="txtidVisitante" name="idVisitante" hidden required=""></div><div class="busc">
                                                    <span id ="btnBuscarVisitante" class="glyphicon glyphicon-zoom-in btn btn-danger"></span>
                                                    <span id ="btnRegistrarVisitante" class="glyphicon glyphicon-user btn btn-default" data-toggle="modal" data-target="#myModal"></span>  <span id ="btnmostrarvisitante" class=" glyphicon glyphicon-eye-open btn btn-link" style="color: white"></span></div>
                                            </div>
                
                                            <select id="cbxlistadovisitantes" class="form-control" name="listavisitnte">
                                            </select>
                                            <input type="text" class="form-control letras" placeholder="Visitante" name="nombreVisitante" id="txtNombreVisitante" required readonly >
                
                                        </div> 
                                        <div class="panel-footer danger" id="foterpanel">
                                            <div class="izquivisitante"><span class="glyphicon glyphicon-arrow-left" id="izquivisitante"></span></div><div class="derevisitante"><span id="derevisitante" class="glyphicon glyphicon-arrow-right"></span></div>  
                
                
                                        </div></div>
                
                
                                    <div class="panel panel-default active" id="panelvisitado">
                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Datos del Visitado</h3></center>
                                        </div>
                                        <div class="panel-body">
                                            <div class="viistantesd">
                                                  <table class="table" id="datosvisi2" style=" margin:  0 auto">
                
                                                      <tr><td rowspan="10"  class="fotoVisitado" style="width: 150px;text-align: center"></td></tr>
                
                                                    <tr><td class="primero1">Nombre Completo</td><td class="nombrevisitados"></td></tr>
                                                         <tr><td class="primero1">Tipo Identificacion</td><td class="Tipoidentificacionvisitado"></td></tr>
                
                                                    <tr><td class="primero1">Identificacion</td><td class="identificacionvisitado"> </td></tr>
                                                    <tr><td class="primero1">Celular</td><td class="celularvisitado"></td></tr>
                                                    <tr><td class="primero1">Correo</td><td class="correovisitado"></td></tr>
                                                    
                
                                                </table> 
                                                
                                                <div class="datosvisitado">
                                                    <div class="pri">   
                                                        <select id="cbxtipoIdentificacionVisitado" class="form-control tipoIdentificacion cbxtipoIdentificacion" name="tipoIdentificacion" >
                                                            <option value="">Seleccione Tipo de Identificacion</option>
                                                        </select>
                                                        <input class="form-control" type="text" name="NombreVisitado" id="nombrevisitado" placeholder="Nombres">
                                                    </div><div class="chec2"><span class="glyphicon glyphicon-refresh" id="busquedavisitado" style="color: black" title="Cambiar Modo de Busqueda" data-toggle="popover" data-trigger="hover"></span></div>
                                                </div>
                
                
                                                <div class="identi">
                                                    <input class="form-control" placeholder="Apellidos" type="text" name="NombreVisitado" id="apellidovisitado">
                                                    <input type="number" id="txtIdentificacionvisitado" class="form-control" placeholder="No. Identificación Visitado" name="numIdentificacion">
                                                    <input type="text" id="txtidVisitado" name="idVisitado" hidden required=""></div><div class="busc">
                                                    <span id ="btnBuscarVisitado" class="glyphicon glyphicon-zoom-in btn btn-danger"></span>
                                                    <span id="btnmostrarvisitado" class="glyphicon glyphicon-eye-open btn btn-link" style="color: white"></span>
                
                                                </div>                  <input type="text" class="form-control letras" placeholder="Visitado" name="nombreVisitado" id="txtNombreVisitado" readonly>
                
                                                <input type="text" class="form-control letras" placeholder="Ubicacion Visita" name="Ubicacion" id="ubicacion"  readonly>
                                                <select id="cbxlistadovisitado" class="form-control tipoIdentificacion" name="visitado">
                                                    <option value=""></option>
                                                </select>
                                            </div>  </div><div class="panel-footer danger" id="foterpanel">
                                            <div class="izquivisitado"><span class="glyphicon glyphicon-arrow-left" id="izquivisitado"></span></div><div class="derevisitado"><span id="derevisitado" class="glyphicon glyphicon-arrow-right"></span></div>  
                
                
                                        </div>
                                    </div><div class="panel panel-default active" id="panelvisita">
                                        <div class="panel-heading" id="tpanel">
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-th-list"></span> Datos de la Visita</h3></center>
                                        </div>
                                        <div class="panel-body">
                                            <div class="horas">
                                                <div class='entrada input-group date datetimepicker'>
                                                    <input  placeholder="Hora de Entrada" type='text' class="form-control" name='horaEntrada' readonly required id="hentrada">
                                                    <span class="input-group-addon  ">
                                                        <span style="color: #990000" class="glyphicon glyphicon-calendar">
                                                        </span>
                                                    </span>
                
                
                                                </div>
                
                
                                                <div class='salida input-group date datetimepicker' >
                                                    <input type='text' class="form-control" name='horaSalida' readonly required placeholder="Hora de Salida" id="hsalida">
                                                    <span class="input-group-addon " >
                                                        <span style="color: #990000"  class="glyphicon glyphicon-calendar">
                                                        </span>
                                                    </span>
                                                </div>
                
                                                <select class="form-control tipo_ingreso tipoIngreso" name="tipoIngreso" id="cbxtipovisita" required>
                                                    <option value="">Seleccione Tipo de Ingreso</option>
                                                </select>
                                                <input type="number" id="txTAcompanantes" class="form-control acompanantes" placeholder="No. Acampañantes" name="acompanantes" required>
                                              
                                                <textarea rows="3" cols="100" class="form-control" id="oberservaciones" placeholder="Observaciones" name="observaciones" required></textarea>
                                               
                                            </div> 
                                        </div><div class="panel-footer danger" id="foterpanelb1">
                                            <div class="botones">
                                                <span  id="izquivisita"><span  class="btn btn-default active" >Atras</span></span>
                                                <input type="submit" class="btn btn-danger active" value="Reservar">
                
                                            </div>
                
                                        </div>
                                    </div><div class="panel panel-default active" id="panelmuestrovisita">
                                        <div class="panel-heading" id="tpanel" >
                                            <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Visita Reservada</h3></center>
                                        </div>
                                        <div class="panel-body">
                
                                            <table class="table">
                
                                                <tr><td colspan="2"> 
                                                    <table class="table" id="datosvisi">
                                                        <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitante</th></tr>
                                                      <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                                               
                                                        <tr><td class="primero">Nombre Completo</td><td class="nombrevisitante"></td></tr>
                                                       
                                                        <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                                        <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                                        <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                                        <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>
                
                                                    </table>      
                
                                             </td></tr>
                                                <tr><td class="primero">Visitado:</td><td class="nombrevisitado" ></td></tr>
                                                <tr><td class="primero">Ubicacion/Departamento:</td><td class="ubicacionvisitado"></td></tr>
                                                <tr><td class="primero">Hora Entrada:</td><td class="horaentradavisita"></td></tr>
                                                <tr><td class="primero">Hora Salida:</td><td class="horasalidavisita"></td></tr>
                                                <tr><td class="primero">Duracion Visita:</td><td class="duracionvisita"></td></tr>
                                                <tr><td class="primero">Tipo Ingreso:</td><td class="tipoingresovisita"></td></tr>
                                                <tr><td class="primero">Acompañantes:</td><td class="acompanantesvisita"></td></tr>
                                                <tr><td class="primero">Obervaciones:</td><td  class="observacionesvisita"></td></tr>
                
                                            </table>
                
                
                
                
                
                                        </div><div class="panel-footer danger" id="foterpanelb">
                                            <div class="botones">
                                                <span  id="nuevavisita"><input  type="reset" class="btn btn-danger active" value="Nuevo"></span>
                
                                            </div>
                
                                        </div>
                                    </div>
                
                
                                </form>
                            </div>
                -->
            </div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <form  id="form-ingresar-visitante22" enctype="multipart/form-data" method="post">
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Registro de Visitante</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div class="row">



                                <div class="error"></div>

                                <select name="tipo_identificacion" id="cbxtipoIdentificacion"  required class="form-control  cbxtipoIdentificacion">

                                </select>   
                                <input type="number" name="identificacion" id="txtIdentificacion" class="form-control inputt" placeholder="No. Identificación" required>
                             
                                 <input type="text" name="apellido" id="txtApellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>

                                <input type="text" name="nombre" id="txtNombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                <input type="text" name="segundonombre" id="txtSegundoNombre" class="form-control inputt2" placeholder="Segundo Nombre" >

                               
                                <input type="number" name="celular" id="txtCelular" class="form-control inputt nomostrar" placeholder="Celular" >
                                <input type="email" name="correo" id="txtCorreo" class="form-control inputt nomostrar" placeholder="Correo Eléctronico">
                      <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                -->   
                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="submit" id="btnGuardarVisitante"  class="btn btn-danger active">Guardar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>
                </form>

            </div>
        </div>



        <div class="modal fade" id="ModalModificar" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                       <h4 class="modal-title"><span class="glyphicon glyphicon-remove"></span>   Cancelar Visita</h4>      </div>
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

        <!------------------------------------------------------------------------------------------------------------------ -->
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
        <!------------------------------------------------------------------------------------------------------------------ -->
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
                                <form  id="form-ingresar-visitante6" enctype="multipart/form-data" method="post">

                                    <div class="panel-heading" id="tpanel" >
                                        <center>    <h3 class="panel-title"><span class="glyphicon glyphicon-floppy-disk"></span> Nuevo Visitante</h3></center>
                                    </div>
                                    <div class="panel-body">


                                        <div class="row">
                                          

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
        <div class="modal fade" id="ModalMensaje" role="dialog">
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
       <div class="modal fade" id="ModalMensajevisita" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>
                    </div>
                    <div class="modal-body" id="bodymodal">

                        <p id="mensajed2"></p>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
        
        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Mensaje.js"></script>

        <script src="../estilos/Parametros.js"></script>


        <script src="../estilos/visita.js"></script>
        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/Inicio.js"></script>
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

            listarVisitasid();
            perfilensession();
       
            BuscarPermisosActividadPerfil("ReservaVisita");</script>
    </body>
</html>
