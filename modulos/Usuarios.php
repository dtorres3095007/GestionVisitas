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
        <!-- Buttons DataTables -->


           <title>Control de Acceso</title><link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio opcionesUsuarios"  style="display: none">
        <div class="opciones ">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones">
                <button type="button" id="Recargar" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>

                <button id="agregar" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-user" title="Agregar Usuario" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="eliminar" type="button" class="btn btn-link active btnElimina "><span class="seliminar glyphicon glyphicon-remove" title="Eliminar Usuario" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="modificar"  type="button" class="btn btn-link active btnModifica" ><span class="smodificar glyphicon glyphicon-wrench" title="Modificar Usuario" data-toggle="popover" data-trigger="hover"></span></button>
                <button  type="button" id="Asignar"  class="btn btn-link active btnAgregar"  ><span class="Asignarperfil glyphicon glyphicon-share" title="Asignar Perfiles" data-toggle="popover" data-trigger="hover"></span></button>
                <button type="button" id="CambiarTabla" class="btn btn-link active btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random" title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>

                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="usuarios.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?>
            </div><div class="moduloname"><h5>Administracion de Usuarios</h5>
            </div>
        </div>

        <div class="container col-md-12 " id="cusuarios">



            <input type="hidden" id="idSeleccionado">
            <div class="tablausu col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser" style="text-align: left;">
                    <table class="table table-bordered table-hover table-condensed table-responsive" id="tablausuarios"  cellspacing="0" width="100%" style="">
                        <thead class="ttitulo ">
                            <tr class="filaprincipal"><td>Nombre</td><td >Apellido</td><td>Tipo Identificacion</td><td >identificacion</td><td >Usuario</td><td >Correo Personal</td><td >Telefono</td></tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal fade" id="modalModificar" role="dialog">
                <div class="modal-dialog">
                    <form action="#" id="ModificarUsuario" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> <b>X</b></button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Modificar Usuarios</h4>
                            </div>

                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <div class="error"></div>
                                    <div class="divmodifica">
                                        <input type="text" name="usuario" id="txtUsuario1" class="inputt form-control" placeholder="usuario" readonly="" required="">
                                        <input type="text" class="form-control inputt" name="nuevoUsuario" placeholder="Nuevo Usuario" id="txtNuevoUsuario">
                                        <input type="hidden" name="idPersona" id="personabuscadamodi">
                                        <label style="color: #990000"><input id="chbxReestablecerPassword" type="checkbox" name="restablecerPassword" value="Restablecer Password">Restablecer Contraseña</label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" id="btnModificarUsuario" value="Modificar" class="btn btn-danger active divmodifica">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <form action="#" id="GuardarUsuario" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span> Asignacion de Usuarios</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row tablausu" style="width: 80%;">

                                    <div class="error"></div>

                                    <select name="tipo_persona" id="cbxtipopersona" class="form-control" required="">
                                        <option value="">Seleccione Tipo de persona</option>
                                    </select>
                                    <select name="tipo_identificacion" id="cbxtipoIdentificacion" class="form-control cbxtipoIdentificacion" required="">

                                    </select>

                                    <div class="buscarusuario"><div class="caja"> <input type="number" name="identificacion" id="txtIdentificacionpersona" class="inputt form-control" placeholder="No. Identificación" required="">
                                        </div><div class="boto"> <span id ="btnBuscarpersona" class="glyphicon glyphicon-zoom-in btn btn-danger"></span>
                                            <span id="btnmostrarpersona" class="glyphicon glyphicon-eye-open btn btn-default"></span>
                                        </div></div> 
                                    <input type="text" name="usuario" id="txtUsuario" class="inputt form-control" placeholder="usuario" readonly="" required="">

                                    <input type="hidden" name="idPersona" id="personabuscada">
                                </div>
                            </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" id="btnGuardarusuario" value="Guardar" class="btn btn-danger active">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div>
            <div class="modal fade" id="AsignarPerfil" role="dialog">
                <div class="modal-dialog">
                    <form  id="Asignar-Perfil" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-random"></span> Asignacion de Perfiles</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <div class="error "></div>





                                    <div class="tablausu col-md-12 " >
                                        <select name="tipo_persona" id="cbxdperfil" class="form-control" required="" style="margin: 0 auto">
                                            <option value="">Seleccione Perfil</option>
                                        </select>
                                        <div class="col-sm-12 col-md-12  tablauser" style=" width: 100%; text-align: left">


                                            <table class="table table-bordered table-hover  " id="perfilesUsuariot"  cellspacing="0" width="100%" style="width: 100%">
                                                <thead class="ttitulo " style="">
                                                    <tr class="opcioenstabla btnElimina"><td  colspan="4"><span class="smodificar glyphicon glyphicon-remove  " title="Eliminar Perfil" data-toggle="popover" data-trigger="hover" id="EliminarPerfil"></span></td></tr>

                                                    <tr class="filaprincipal" ><td colspan="3">Perfiles Asignados</td></tr> 
                                                    <tr class="filaprincipal"><td id="cli" class="indice">No.</td><td class="">Nombre</td><td class="">Descripcion</td></tr> </thead>         
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div> <div class="confirmar" style="color: #990000">Esta Seguro que desea Retirar el Perfil..? <span id="retirarsi" class="btn btn-link">Si</span>-<span id="retirarno" class="btn btn-link">No</span></div>

                            </div>
                            <div class="modal-footer" id="footermodal">
                                <span id="AsignarPerfilusuario" class="btn btn-danger active">Asignar</span>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </form>

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
                                <p class="mc">¿ Esta Seguro de Desea Eliminar el Usuario ?</p>

                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <div class="botonesEliminar"> <span id="btnEliminarUsuario" class="btn btn-danger active">Eliminar</span>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>

                            <button type="button" class="btn btn-default" data-dismiss="modal" id="salirEliminar">Salir</button>

                        </div>


                    </div>


                </div>
            </div>

            <div class="modal fade" id="Infopersona" role="dialog">
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
                                    <tr><th class="filaprincipal" colspan="3" style="color: #990000; text-align: center">Datos del Usuario</th></tr>
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



        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/Registros.js"></script>

        <script src="../estilos/Parametros.js"></script>
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
        <script>// UNA VES CARGADA LA PAGINA LLAMO A LA FUNCION listarUsuarios
            BuscarPermisosActividadPerfil("Usuarios");
            listarUsuarios();</script>
    </body>
</html>
