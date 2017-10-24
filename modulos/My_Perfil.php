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
    <body  class="opcionesMy_Perfil" style="display: none">   
        <div class="opciones    ">
  <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
                <button type="button" id="Recargar2" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
             <button type="button" id="CambiarContra" class="btn btn-link active btnModifica nomostrar" ><span class="smodificar glyphicon glyphicon-random" title="Modificar Contraseña" data-toggle="popover" data-trigger="hover"></span></button>

               <button id="modificar2" type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Datos" data-toggle="popover" data-trigger="hover"></span></button>
          <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>


                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="My_Perfil.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Administrar Mis Datos</h5>
            </div>
        </div>

   
        <div class="container col-md-12 " id="cusuarios">
           <input type="hidden" id="idSeleccionado">
           <div class=" tablausu" id="InfoVisitado">

                            <table class="table" id="datosvisi" style="width: 500px; margin:  0 auto">
                               
                                <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos Actuales</th></tr>
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


                        </div> 
  
   
            <div class="modal fade" id="ModificarVisitado" role="dialog">
                <div class="modal-dialog">
                    <form  id="form-modificar-visitado2" enctype="multipart/form-data" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Modificar Datos</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                     <div class="row">
                                    <div class="error"></div>
                                    <span  style="color: #990000" id="btnRecargar2" class="glyphicon glyphicon-refresh"></span>
                                    <select name="tipo_identificacion" id="cbxtipoIdentificacionModi"  required class="form-control  cbxtipoIdentificacion">  </select>   
                                      <input type="number" name="identificacion" id="txtIdentificacionModi" class="form-control inputt" placeholder="No. Identificación" required readonly="">
                                      <input type="text" name="nombre" id="txtNombreModi" class="form-control inputt2" placeholder="Primer Nombre" required readonly="">
                                      <input type="text" name="segundonombre" id="txtSegundoNombremodi" class="form-control inputt2" placeholder="Segundo Nombre" readonly="">
                       
                                      <input  type="text" name="apellido" id="txtApellidomodi" class="form-control inputt2" placeholder="Primer Apellido"  required readonly="">
                                      <input type="text" name="segundoapellido" id="txtsegundoapellidomodi" class="form-control inputt2" placeholder="Segundo Apellido" required readonly="">
                                     <select name="departamento" id="cbxdepartamentomodi"  required class="form-control inputt departamentos">
                                        <option>Seleccione Departamento</option>
                                    </select>   
                                    <select name="cargo" id="cbxcargomodi"  required class="form-control inputt tiposcargo">  <option>Seleccione Cargo</option>  </select>   

                                    <input type="number" name="celular" id="txtCelularmodi" class="form-control inputt" placeholder="Celular" required>
                                    <input readonly="" type="email" name="correo" id="txtCorreomodi" class="form-control inputt" placeholder="Correo Eléctronico">
                                      <label style="color: #990000; font-size: 13px;width: 100%;margin: 0 auto ">Imagen del Visitado</label>
                             
                                    <input class="form-control inputt" type="file" name="imagen"  id="FileImagen">
     
                                
                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <button type="submit" id="btnModificarVisitado2"  class="btn btn-danger active">Modificar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>


                        </div>
                    </form>

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
                            <div id="ModalMe2" style="text-align: center">

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>
     
   <div class="modal fade" id="ModalContraseña" role="dialog">
                <div class="modal-dialog">
                   
                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Cambiar Contraseña</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div id="ModalMe" style="text-align: center">
                               
  </div>
                            <div style="width: 50%;margin:  0 auto;">
                                  <input type="password" id="contraactual"placeholder="Contraseña Actual" name="actual" class="form-control">
                                  <div class="contraseñas">
                                <input type="password" id="contra"placeholder="Nueva contraseña" name="nueva" class="form-control">
                                <input type="password" id="rcontra" placeholder="Repetir nueva contraseña" name="rnueva" class="form-control">
                      </div> </div> </div>
                          <div class="error"></div>
                        <div class="modal-footer" id="footermodal">
                            <input  type="button" id="Modificar-Contra" value="Actualizar" class="btn btn-danger active">
                              <input  type="button" id="verificar-Contra" value="Continuar" class="btn btn-danger active">
                             
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
           mostrarInfoCompletaVisitadosesion(); 
             BuscarPermisosActividadPerfil("My_Perfil");
</script>

    
    </body>
</html>
