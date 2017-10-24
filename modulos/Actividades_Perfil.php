

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">

        <link rel="stylesheet" href="../estilos/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/font-awesome.min.css">


        <link rel="stylesheet" href="../estilos/MiEstilo3.css">
        <title>Control de Acceso</title>
        <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio opcionesActividades_Perfil"  style="display: none">
        <div class="opciones">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones">
             <button type="button" id="Recargar3" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
             <button type="button" id="CambiarTabla" class="btn btn-link active CambiarTabla btnCambiaTabla" ><span class="smodificar glyphicon glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
                 <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
    
                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="Actividades_Perfil.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?>
            </div><div class="moduloname"><h5>Actividades Por Perfil</h5>
            </div>
        </div> 
        
      <div class="container tablausu col-md-12 perfilesusuariotabla" >
                <div class="table-responsive col-sm-12 col-md-12 tablauser" style=" margin:  0 auto;">
                    <table class="table table-bordered table-condensed table-hover" id="tablaperfilesusuairos" style="text-align: left;width: 100%">
                        <thead class="ttitulo">
                            <tr class="filaprincipal"><td class="indice">No.</td><td>Nombre</td><td>Decripcion</td></tr>

                        </thead>
                    </table>
                </div>    </div>
             <div class="container tablausu col-md-12 permisosperfilestabla" >
                 <div class="error"></div>
                    <div class="confirmarAct" style="color: #990000">Esta Seguro que desea Retirar la actividad..? <span id="retirarsiact" class="btn btn-link">Si</span>-<span id="retirarnoAct" class="btn btn-link">No</span></div>
                         
                <div class="table-responsive col-sm-12 col-md-12 tablauser" style=" margin:  0 auto;">
                    <table class="table table-bordered table-condensed table-hover" id="tablaactividades" style="text-align: left;width: 100%">
                        <thead class="ttitulo">
                            <tr class="opcioenstabla opcioenstablaacividades"><td id="agregar" class="sasignar glyphicon glyphicon-floppy-save agregaractividad btnAgregar" title="Asignar Actividades" data-toggle="popover" data-trigger="hover"> </td><td id="eliminar" title='Retirar Actividad' data-toggle='popover' data-trigger='hover' style='  color: #990000;' class=' glyphicon glyphicon-remove btnElimina sasignar RetirarSctividad'></td></tr>
                            <tr class="filaprincipal"><td colspan="7">Permisos Por Actividades</td></tr>
                            <tr class="filaprincipal"><td class="indice">No.</td><td>Modulo</td><td class="">Agrega</td><td class="">Modifica</td><td class="">Elimina</td><td class="">Amplia</td><td class="">Tabla</td></tr>

                        </thead>
                    </table>
                </div>    </div>
 

        <div class="modal fade" id="ActividadPerfil" role="dialog">
                <div class="modal-dialog">
                  
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Asignacion de Actividad</h4>
                            </div>

                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <div id="error1" class="form-group has-error text-center oculto" style="color : #990000;
 font-size: 15px;"></div>
                                    <select class="form-control idactividades" name="idParametro" id="idactividades" >
                                        <option value="">Seleccione Modulo</option>

                                    </select>
                        
                                </div> </div>
                            <div class="modal-footer" id="footermodal">
                                <span  class="btn btn-danger active" id="GuardarActividadPerfil"> Guardar</span>
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
                            <div id="ModalMe" style="text-align: center">

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>
     <div class="modal fade" id="CambiarPermiso" role="dialog">
                <div class="modal-dialog">
                 
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-refresh"></span> Cambiar Permiso</h4>
                            </div>

                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                   <div id="ModalEliminar" style="text-align: center">
                                <p class="mc">¿ Esta Seguro de Desea Eliminar el Parametro ?</p>

                            </div>
                                </div> </div>
                            <div class="modal-footer" id="footermodal">
                                <span class="btn btn-danger active" id="btnCambiarPermiso">Cambiar</span>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>

 </div>
        

                </div>
            </div>
  

        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
           <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/Parametros.js"></script>  
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
 <script>  BuscarPermisosActividadPerfil("Actividades_Perfil");
     MostrarTiposUsuarios();
          </script>
    </body>
</html>
