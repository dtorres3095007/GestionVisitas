<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <title>Control de Acceso</title><link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
        <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">

        <link rel="stylesheet" href="../estilos/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/font-awesome.min.css">
        <link rel="stylesheet" href="../estilos/dropzone.css">

        <link href="Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
        <link rel="stylesheet" href="../estilos/MiEstilo3.css">

    </head>
    <body  class="opcionesManejo_Versiones" style="display: none">   
        <div class="opciones    ">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
           
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>


                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '
                            
   <button type="button" id="Recargar9" class="btn btn-link active" ><a class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover" href="Manejo_Versiones.php?cerrar=yes" target="ventana"></a></button>

<button id="ampliar" type="button" class="btn btn-link active btnAmplia btnAmplia2"><a href="Manejo_Versiones.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }else{
  echo '                          
   <button type="button" id="Recargar9" class="btn btn-link active" ><a class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover" href="Manejo_Versiones.php"></a></button>
    ';
                  
                    }
                ?> </div><div class="moduloname"><h5>Administrar Archivos</h5>
            </div>
        </div>


        <div class="container col-md-12  divdrop btnAgregar" >
              <div class="error"></div>
                   <div style="width: 50%;margin: 0 auto;"><div style="width: 50%;float: left"><select class="form-control rutas"  required="" id="Ruta" name="ruta">
                   </select> </div> <div style="width: 20%;float: left;padding:10px">   <input type="button" value="Enviar" id="montar" class="btn btn-danger btn-md form-control">
               </div>
                     </div> 
            <div class="tablausu col-md-12 btnAgregar" >
                
                 
                <form class="dropzone needsclick dz-clickable" id="Subir">
                    <input type="hidden" value="" required="" name="ruta" id="MyrutaFinal">
                <div class="dz-message needsclick" id="Mydropzone">
                    
                    Arrastrar Archivo aqui o dar click para seleccionarlo
                    
                </div>
                  
            </form>
                 
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
                        <div id="ModalMe2" style="text-align: center">

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
        <script src="../estilos/dropzone.js"></script>
        <script src="../estilos/dropzone-config.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/Parametros.js"></script>
        <script src="../estilos/Visitados.js"></script>
        <script src="../estilos/Usuarios.js"></script>
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
MostrarRutas();
            BuscarPermisosActividadPerfil("Manejo_Versiones");
        </script>


    </body>
</html>
