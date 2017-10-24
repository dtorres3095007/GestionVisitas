<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
             <title>Control de Acceso</title><link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
      <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">

        <link rel="stylesheet" href="../estilos/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/font-awesome.min.css">

<link href="Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
        <link rel="stylesheet" href="../estilos/MiEstilo3.css">

    </head>
    <body style="display: none" class="opcionesVisitados">   
        <div class="opciones    ">
  <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
                <button type="button" id="Recargar" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
           
                <button id="agregar" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-floppy-disk" title="Agregar Visitado" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="eliminar" type="button" class="btn btn-link active btnElimina"><span class="seliminar glyphicon glyphicon-remove" title="Eliminar Visitado" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="modificar" type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Visitado" data-toggle="popover" data-trigger="hover"></span></button>
                 <button type="button" id="CambiarTabla" class="btn btn-link active btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
<button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
    
    

                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="visitados.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Administracion de Visitados</h5>
            </div>
        </div>

        <div class="modal fade" id="InfoVisitado" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Informacion Completa</h4>
                    </div>
                    <div class="modal-body " id="bodymodal">
                        <div class="row2 ">

                            <table class="table" id="datosvisi" style="width: 500px; margin:  0 auto">
                               
                                <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitado</th></tr>
                                  <tr><td rowspan="10"  class="fotoVisitado" style="width: 150px;text-align: center"></td></tr>
                              
                                <tr><td class="primero1">Nombre</td><td class="nombrevisitados"></td></tr>
                                <tr><td class="primero1">Apellido</td><td class="apellidovisitado"></td></tr>
                                <tr><td class="primero1">Tipo Identificacion</td><td class="Tipoidentificacionvisitado"></td></tr>

                                <tr><td class="primero1">Identificacion</td><td class="identificacionvisitado"> </td></tr>
                                <tr><td class="primero1">Celular</td><td class="celularvisitado"></td></tr>
                                <tr><td class="primero1">Correo</td><td class="correovisitado"></td></tr>
                                <tr><td class="primero1">Cargo</td><td class="cargo"></td></tr>
                                <tr><td class="primero1">Departamento</td><td class="departamentovisitado"></td></tr>
                                <tr><td class="primero1">Ubicacion</td><td class="ubicacionvisitado"></td></tr>

                            </table>    


                        </div> </div>


                </div>


            </div>
        </div>
        <div class="container col-md-12 " id="cusuarios">
           <input type="hidden" id="idSeleccionado">
        
      <div class="tablausu col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover table-condensed table-responsive" id="tablavisitado"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                        <tr class="filaprincipal"><td>Primer Nombre</td><td class="">Segundo Nombre</td><td class="">Primer Apellido</td><td class="">Segundo Apellido</td><td class="">Tipo Identificacion</td><td class="">identificacion</td><td class="">Departamento</td><td class="">Cargo</td><td class="">Celular</td><td class="">Correo Personal</td></tr>
                  </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-ingresar-visitado" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Registro de Visitados</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row">
                                    <div class="error"></div>
                                    <select name="tipo_identificacion" id="cbxtipoIdentificacion"  required class="form-control  cbxtipoIdentificacion">  </select>   
                                    <input min="1" type="number" name="identificacion" id="txtIdentificacion" class="form-control inputt" placeholder="No. Identificación" required>
                                  
                                      <input type="text" name="apellido" id="txtApellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                     <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>
                                  
                                    
                                    <input type="text" name="nombre" id="txtNombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombre" class="form-control inputt2" placeholder="Segundo Nombre" >
                       
                                   <select name="departamento" id="cbxdepartamento"   required class="form-control inputt departamentos">
                                        <option>Seleccione Departamento</option>
                                    </select>   
                                    <select name="cargo" id="cbxcargo"  required class="form-control inputt tiposcargo">  <option>Seleccione Cargo</option>  </select>   

                                    <input min="1" type="number" name="celular" id="txtCelular" class="form-control" placeholder="Celular" required>
                                    <input type="email" name="correo" id="txtCorreo" class="form-control inputt" placeholder="Correo Eléctronico">
                                   <label style="color: #990000; font-size: 13px;width: 100%;margin: 0 auto ">Imagen del Visitado</label>
                             
                                    <input class="form-control inputt" type="file" name="imagen"   id="FileImagen">

                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" id="btnGuardarVisitante" value="Guardar" class="btn btn-danger active">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div>
            <div class="modal fade" id="ModificarVisitado" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-modificar-visitado" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Modificar Visitados</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                      <div class="error"></div>
                                     <div class="row divmodifica">
                              
                                    <span  style="color: #990000" id="btnRecargar" class="glyphicon glyphicon-refresh"></span>
                                      <select name="tipo_identificacion" id="cbxtipoIdentificacionModi"  required class="form-control  cbxtipoIdentificacion">  </select>   
                                    <input  min="1" type="number" name="identificacion" id="txtIdentificacionModi" class="form-control inputt" placeholder="No. Identificación" required>
                                    <input type="text" name="nombre" id="txtNombreModi" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombremodi" class="form-control inputt2" placeholder="Segundo Nombre" >
                       
                                    <input type="text" name="apellido" id="txtApellidomodi" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                     <input type="text" name="segundoapellido" id="txtsegundoapellidomodi" class="form-control inputt2" placeholder="Segundo Apellido" required>
                                     <select name="departamento" id="cbxdepartamentomodi"  required class="form-control inputt departamentos">
                                        <option>Seleccione Departamento</option>
                                    </select>   
                                    <select name="cargo" id="cbxcargomodi"  required class="form-control inputt tiposcargo">  <option>Seleccione Cargo</option>  </select>   

                                    <input min="1" type="number" name="celular" id="txtCelularmodi" class="form-control inputt" placeholder="Celular" required>
                                    <input type="email" name="correo" id="txtCorreomodi" class="form-control inputt" placeholder="Correo Eléctronico">
                                     <label style="color: #990000; font-size: 13px;width: 100%;margin: 0 auto ">Imagen del Visitado</label>
                             
                                    <input class="form-control inputt" type="file" name="imagen"  id="FileImagen">
     
                                
                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <button type="submit" id="btnModificarVisitado"  class="btn btn-danger active divmodifica">Modificar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>


                        </div>
                    </form>

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
                            <p class="mc">¿ Esta Seguro de Desea Eliminar el Visitado ?</p>

                        </div>
                    </div>
                    <div class="modal-footer" id="footermodal">
                        <div class="botonesEliminar"> <span id="btnEliminarVisitado" class="btn btn-danger active">Eliminar</span>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>

                        <button type="button" class="btn btn-default" data-dismiss="modal" id="salirEliminar">Salir</button>

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
                            <div id="ModalMe" style="text-align: center">

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>
     

        <!-- -->




        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
           <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/Parametros.js"></script>
        <script src="../estilos/Visitados.js"></script>
            <script src="../estilos/Inicio.js"></script>
   
    
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
        
        // LISTO LOS VISITADOS EN LA TABLA UNA VES SE CARGA LA PAGINA
    BuscarPermisosActividadPerfil("Visitados");
    listarVisitados();</script>
    
    
    </body>
</html>
