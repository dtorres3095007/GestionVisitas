<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
          <title>Control de Acceso</title>
        <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
        <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">

        <link rel="stylesheet" href="../estilos/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/buttons.bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/css/font-awesome.min.css">


        <link rel="stylesheet" href="../estilos/MiEstilo3.css">

    </head>
    <body style="display: none" class="opcionesVisitantes">   
        <div class="opciones opcionesVisitantes">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
          <button type="button" id="Recargar" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
           
                <button id="agregar" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-floppy-disk" title="Agregar Visitante" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="eliminar" type="button" class="btn btn-link active btnElimina"><span class="seliminar glyphicon glyphicon-remove" title="Eliminar Visitante" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="modificar" type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Visitante" data-toggle="popover" data-trigger="hover"></span></button>
                <button type="button" id="CambiarTabla" class="btn btn-link active  btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random " title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>


                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="visitantes.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Administracion de Visitantes</h5>
            </div>
        </div>

        <div class="modal fade" id="InfoVisitantep" role="dialog">
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
                                <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Visitante</th></tr>
                                <tr><td rowspan="9"  class="fotoVisitante" style="width: 150px;text-align: center"></td></tr>
                                <tr><td class="primero">Nombres</td><td class="nombrevisitante"></td></tr>
                                <tr><td class="primero">Apellidos</td><td class="apellidovisitante"></td></tr>
                                <tr><td class="primero">Tipo identificacion</td><td class="tipoidvisitante"></td></tr>
                                <tr><td class="primero">Identificacion</td><td class="identificacionevisitante"></td></tr>
                                <tr><td class="primero">Correo</td><td class="correovisitante"></td></tr>
                                <tr><td class="primero">Celular</td><td class="celularvisitante"></td></tr>

                            </table>    


                        </div> </div>


                </div>


            </div>
        </div>
        <div class="container col-md-12 " id="cusuarios">
            <input type="hidden" id="idSeleccionado">


            <div class="tablausu col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover  " id="tablavisitantes"  cellspacing="0" width="100%" style="">
                    <br>
                    <div class="error error_busqueda oculto"></div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <input class="form-control " id="txt_buscar_visitante" value="" placeholder="Ingrese Nombre, Apellido o Identificacion">
                                <span class="input-group-addon pointer" title="Buscar Persona" data-toggle="popover" data-trigger="hover" id="btn_buscar_visitante"><span class="glyphicon glyphicon-search"></span></span>
                            </div>
                        </div>
                        <thead class="ttitulo ">
                            <tr class="filaprincipal"><td class="" id='nombrevisitante'>Nombre Completo</td><td class="">Tipo Identificacion</td><td class="">identificacion</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

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

                                            <tr><td colspan="2">  <span id="foto" class="btn btn-danger active form-control">
                                                        Tomar Foto!
                                                    </span></td></tr>
                                        </table>    

                                    </div>

                                    <select name="tipo_identificacion" id="cbxtipoIdentificacion"  required class="form-control  cbxtipoIdentificacion">

                                    </select>   
                                    <input min="1"  type="number" name="identificacion" id="txtIdentificacion" class="form-control inputt" placeholder="No. Identificación" required>
                                    <input type="text" name="apellido" id="txtApellido" class="form-control inputt2" placeholder="Primer Apellido"  required>
                                    <input type="text" name="segundoapellido" id="txtsegundoapellido" class="form-control inputt2" placeholder="Segundo Apellido" required>


                                    <input type="text" name="nombre" id="txtNombre" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombre" class="form-control inputt2" placeholder="Segundo Nombre" >


                                    <input min="1" type="number" name="celular" id="txtCelular" class="form-control inputt" placeholder="Celular" >
                                    <input type="email" name="correo" id="txtCorreo" class="form-control inputt" placeholder="Correo Eléctronico">
                          <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                    -->  
                                    
                                      <div class="error"></div>
                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" id="btnGuardarVisitante" value="Guardar" class="btn btn-danger active">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div>

            <div class="modal fade" id="ModificarVisitante" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-modificar-visitante" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>

                                <h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Modificar Visitante</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                  
                                <div class="row divmodifica">
                                  
                                    <span  style="color: #990000" id="btnRecargar" class="glyphicon glyphicon-refresh"></span>
                                    <div class="TomarFoto">
                                        <table class="table" style="">
                                            <thead class="ttitulo "> <tr class="filaprincipal"><td colspan="2"> Foto Visitante</td></tr></thead>

                                            <tr><td class="imagenactual"></td><td class="videomodi"><video id="videomodi"  autoplay="autoplay"></video></td><td class="canvasmodi"><canvas id="canvasmodi" width="300" height="208" ></canvas></td></tr>

                                            <tr><td colspan="2">  <span id="fotomodi2" class="btn btn-danger active form-control">
                                                        Nueva Foto!
                                                    </span></td></tr>
                                        </table>    
                                    </div>
                                    <select name="tipo_identificacion" id="cbxtipoIdentificacionModi"  required class="cbxtipoIdentificacion form-control">

                                    </select>   
                                    <input min="1"  type="number" name="identificacion" id="txtIdentificacionModi" class="form-control inputt" placeholder="No. Identificación" required>
                                  
                                           <input type="text" name="apellido" id="txtApellidoModi" class="form-control inputt2" placeholder="Primer Apellido"  required>

                                    <input type="text" name="segundoapellido" id="txtsegundoapellidomodi" class="form-control inputt2" placeholder="Segundo Apellido" required>

                                    <input type="text" name="nombre" id="txtNombreModi" class="form-control inputt2" placeholder="Primer Nombre" required>
                                    <input type="text" name="segundonombre" id="txtSegundoNombremodi" class="form-control inputt2" placeholder="Segundo Nombre" >

                             
                                    <input min="1" type="number" name="celular" id="txtCelularModi" class="form-control inputt" placeholder="Celular" >
                                    <input type="email" name="correo" id="txtCorreoModi" class="form-control inputt" placeholder="Correo Eléctronico">
                          <!--       <input class="form-control inputt" type="file" name="imagen" required  id="FileImagen">
                                    -->  
                                </div>
                                <div class="error"></div>
                            </div>
                            <div class="modal-footer" id="footermodal">

                                <input type="submit" id="btnmodificarVisitante" value="Modificar" class="btn btn-danger active divmodifica">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                            </div>


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
                            <div id="ModalMe" style="text-align: center">

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
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
                                <p class="mc">¿ Esta Seguro de Desea Eliminar el Visitante ?</p>

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <div class="botonesEliminar"> <span id="btnEliminarVisitante" class="btn btn-danger active">Eliminar</span>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>

                            <button type="button" class="btn btn-default" data-dismiss="modal" id="salirEliminar">Salir</button>

                        </div>


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
        <script src="../estilos/Visitantes.js"></script>
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
            $(function() {
                var x1 = 0;
                var cxt = canvas.getContext("2d");
                var cxt2 = canvasmodi.getContext("2d");
                canvas = document.getElementById("canvas");
                canvasmodi = document.getElementById("canvasmodi");
                video = document.getElementById("video");
                videomodi = document.getElementById("videomodi");
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
                        videomodi.src = window.URL.createObjectURL(stream);
                        videomodi.play();
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

                $("#fotomodi2").click(function() {

                    cxt2.drawImage(videomodi, 0, 0, 300, 208);

                });
            });
        </script>
        <script>
            //CON ESTE LLAMADO CARGO LOS PERMISOS QUE TENGAN LOS TIPOS DE USUARIOS
            BuscarPermisosActividadPerfil("Visitantes");
            // EJECUTO LA FUNCION LISTAR VISITANTES CUANDO SE CARGA LA PAGINA
            listarVisitantes("WDWHDGHGDW");
        </script>

    </body>
</html>
