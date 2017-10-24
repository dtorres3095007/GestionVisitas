

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
    <body class="inicio opcionesPersonalizar_Menu"  style="display: none" >
        <div class="opciones">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones">
              <button type="button" id="Recargar4" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
           
                 <button id="modificar" type="button" class="btn btn-link active modificaricono btnModifica" ><span class="sagregar glyphicon glyphicon-wrench" title="Modificar Icono" data-toggle="popover" data-trigger="hover"></span></button>
          

                <button type="button" id="CambiarTablaPerfiles" class="btn btn-link active CambiarTabla btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
                 <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
    
                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="Personalizar_Menu.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?>
            </div><div class="moduloname"><h5>Personalizar Menu</h5>
            </div>
        </div> 
        
      <div class="container tablausu col-md-12 TablaActividadesmenu">
                <div class="table-responsive col-sm-12 col-md-12 tablauser" >
                    <table class="table table-bordered table-condensed table-hover" id="TablaActividadesmenu" style="width: 100%">
                        <thead class="ttitulo">
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="indice">Icono</td><td>Nombre</td><td>Decripcion</td></tr>

                        </thead>
                    </table>
                </div>    </div>
         
 

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
    
   <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                   
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-random"> </span> Asignacion de Iconos</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="tablausu ">
                                    <div id="error1"></div>
                                    <div class="divmodifica">
                                    <table class="table table " id="tablaiconos">
                                        <thead class="ttitulo"> 
                                            <tr class=""><td colspan="10">Iconos Disponibles</td></tr>
                                       </thead>
  
                                        <tr><td class="glyphicon glyphicon-asterisk"></td><td class="glyphicon glyphicon-plus"></td><td class="glyphicon glyphicon-euro"></td><td class="glyphicon glyphicon-eur"></td><td class="glyphicon glyphicon-minus"></td><td class="glyphicon glyphicon-cloud"></td><td class="glyphicon glyphicon-envelope"></td><td class="glyphicon glyphicon-pencil"></td><td class="glyphicon glyphicon-glass"></td><td class="glyphicon glyphicon-music"></td></tr>
                                        <tr><td class="glyphicon glyphicon-search"></td><td class="glyphicon glyphicon-user"></td><td class="glyphicon glyphicon-th-large"></td><td class="glyphicon glyphicon-th"></td><td class="glyphicon glyphicon-th-list"></td><td class="glyphicon glyphicon-ok"></td><td class="glyphicon glyphicon-remove"></td><td class="glyphicon glyphicon-zoom-in"></td><td class="glyphicon glyphicon-cog"></td><td class="glyphicon glyphicon-home"></td></tr>
                                        <tr><td class="glyphicon glyphicon-file"></td><td class="glyphicon glyphicon-time"></td><td class="glyphicon glyphicon-road"></td><td class="glyphicon glyphicon-download-alt"></td><td class="glyphicon glyphicon-download"></td><td class="glyphicon glyphicon-upload"></td><td class="glyphicon glyphicon-inbox"></td><td class="glyphicon glyphicon-repeat"></td><td class="glyphicon glyphicon-refresh"></td><td class="glyphicon glyphicon-list-alt"></td></tr>
                                        <tr><td class="glyphicon glyphicon-flag"></td><td class="glyphicon glyphicon-tags"></td><td class="glyphicon glyphicon-book"></td><td class="glyphicon glyphicon-bookmark"></td><td class="glyphicon glyphicon-align-left"></td><td class="glyphicon glyphicon-edit"></td><td class="glyphicon glyphicon-check"></td><td class="glyphicon glyphicon-share-alt"></td><td class="glyphicon glyphicon-exclamation-sign"></td><td class="glyphicon glyphicon-calendar"></td></tr>
                                        <tr><td class="glyphicon glyphicon-random"></td><td class="glyphicon glyphicon-comment"></td><td class="glyphicon glyphicon-retweet"></td><td class="glyphicon glyphicon-shopping-cart"></td><td class="glyphicon glyphicon-folder-open"></td><td class="glyphicon glyphicon-certificate"></td><td class="glyphicon glyphicon-tasks"></td><td class="glyphicon glyphicon-globe"></td><td class="glyphicon glyphicon-wrench"></td><td class="glyphicon glyphicon-sort"></td></tr>
                                  
                                    </table></div>
                                </div> </div>
                            <div class="modal-footer" id="footermodal">
                                <span class="btn btn-danger active divmodifica" id="asignaricono">Asignar</span>
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
  <script>
          //CON ESTE LLAMADO CARGO LOS PERMISOS QUE TENGAN LOS TIPOS DE USUARIOS
    BuscarPermisosActividadPerfil("Personalizar_Menu");
    // EJECUTO LA FUNCION LISTAR VISITANTES CUANDO SE CARGA LA PAGINA
     CargarMenuTabla();
        </script>
    </body>
</html>
