

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
    <body class="inicio opcionesParametros" style="display: none">
        <div class="opciones ">
   <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones">
                <button type="button" id="Recargar2" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
           
               <button id="agregar" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#myModal"><span class="sagregar glyphicon glyphicon-floppy-disk" title="Agregar Parametro" data-toggle="popover" data-trigger="hover"></span></button>
                <button id="agregar" type="button" class="btn btn-link active btnAgregar" data-toggle="modal" data-target="#ValorParmetro"><span class="sasignar glyphicon glyphicon-floppy-save" title="Asignar Valor Parametro" data-toggle="popover" data-trigger="hover"></span></button>
  
                <button type="button" id="CambiarTabla" class="btn btn-link active btnCambiaTabla" ><span class="smodificar glyphicon glyphicon-random " title="Cambiar Tabla" data-toggle="popover" data-trigger="hover"></span></button>
               <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
               
 <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="Parametros.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?>

               
            </div><div class="moduloname"><h5>Genericas del Sistema</h5>
            </div>
        </div> 

        <div class="container col-md-12 parametros " id="cusuarios" style="">
  <input type="hidden" id="idSeleccionado">
         <div class="container tablausu col-md-12 perfilesusuariotabla" >
                <div class="table-responsive col-sm-12 col-md-12 tablauser" style=" margin:  0 auto;">
                        <table class="table table-bordered table-hover table-condensed table-responsive"  id="tablaparametros"   style="text-align: left;width: 100%;">
                        <thead class="ttitulo ">
                         <tr class="filaprincipal" ><td colspan="3">Tabla Parametros </td></tr>
                         
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="">Nombre</td><td class="">Descripcion</td></tr>
                        </thead>

                    </table>
                
                </div>    </div>
             <div class="container tablausu col-md-12 permisosperfilestabla" >
                <div class="table-responsive col-sm-12 col-md-12 tablauser" style=" margin:  0 auto;">
                     <table class="table table-bordered table-hover table-condensed table-responsive"  id="tablavalorparametros"   style="text-align: left; width: 100%;">
                     <thead class="ttitulo ">
                            <tr class="opcioenstabla opcioenstablaparametros" style="display: none"><td class="smodificar btnElimina glyphicon glyphicon-remove btnEliminarvalorparametro"   title="Eliminar Valor" data-toggle="popover" data-trigger="hover"></td><td  class="smodificar glyphicon glyphicon-wrench btnModifica " title="Modificar Valor" data-toggle="popover" data-trigger="hover" id="btnModificar"></td></tr>
                            <tr class="filaprincipal" ><td colspan="5">Tabla Valor Parametro </td></tr>
                         
                            <tr class="filaprincipal"><td class="indice">No.</td><td class="codigotabla">Codigo</td><td class="valortabla">Nombre</td><td class="largo">Descripcion</td></tr>
                     </thead>
                 </table>
                </div>    </div>


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
                             
                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <div class="botonesEliminar"> <span id="btnEliminarParametro" style="display: none" class="btn btn-danger active">Eliminar</span>
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button></div>

                            <button type="button" class="btn btn-default" data-dismiss="modal" id="salirEliminar">Salir</button>

                        </div>


                    </div>


                </div>
            </div>

    <div class="modal fade" id="ModalModificarParametro" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header" id="headermodal">
                    <button type="button" class="close" data-dismiss="modal"> X</button>
                    <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Modificar Valor Parametro</h4>
                </div>
                <div class="modal-body" id="bodymodal">
                    <div class="error"></div>
                    <div class="panel-body">
                        <div class="row divmodifica">
                            <input type="text" id="txtValor" class="form-control" placeholder="Valor" name="valor" required>
                            <input type="text" id="txtPassword" class="form-control" placeholder="Password" name="password" required>
                            <textarea rows="3" cols="100" class="form-control" id="txtDescripcion" placeholder="Descripcion..." name="descripcion" required></textarea>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer" id="footermodal">
                    <button type="submit" class="btn btn-danger divmodifica" id="btnModificarParametro" >Modificar</button>
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

                    <p id="mensajed"></p>
                </div>
                <div class="modal-footer" id="footermodal">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>








            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <form action="#" id="GuardarParametro" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Creacion de Genericas</h4>
                            </div>
                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <div id="error" class="form-group has-error text-center oculto"></div>
                               
                                    <input type="text" name="nombre" class="form-control inputt2" placeholder="Nombre" required>

                                    <textarea class="form-control inputt2"  cols="1" rows="3" name="descripcion" placeholder="Descripcion" required="" ></textarea>

                                </div> </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" value="Guardar" class="btn btn-danger active">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </form>

                </div>
            </div> 
            <div class="modal fade" id="ValorParmetro" role="dialog">
                <div class="modal-dialog">
                    <form action="#" id="GuardarValorParametro" method="post">
                        <!-- Modal content-->
                        <div class="modal-content" >
                            <div class="modal-header" id="headermodal">
                                <button type="button" class="close" data-dismiss="modal"> X</button>
                                <h4 class="modal-title"><span class="glyphicon glyphicon-floppy-disk"></span> Asignacion Valor Genericas</h4>
                            </div>

                            <div class="modal-body" id="bodymodal">
                                <div class="row">

                                    <div id="error1" class="form-group has-error text-center oculto" style="color : #990000;
 font-size: 15px;"></div>
                                    <select class="form-control idParametros" name="idParametro" id="idParametros" >
                                        <option value="">Seleccione Parametro</option>

                                    </select>
                                    <select class="form-control oculto Empresas" name="empresa" id="Empresa"><option value="">Seleccione Empresa</option></select>
                                    <div class="div_id_aux"> <input class="form-control inputt" type="text" id="id_aux" name="id_aux" placeholder="Codigo" required=""></div>
                                    <input type="text" name="valor" class="form-control inputt" placeholder="Valor" id="valorparametro" required>
                                    <textarea class="form-control inputt" name="valorx" placeholder="Descripcion del Parametro" required=""></textarea>

                                </div> </div>
                            <div class="modal-footer" id="footermodal">
                                <input type="submit" value="Guardar" class="btn btn-danger active">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
        </div>





    <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
       
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
          listarParametros();
     CargarEmpresas();
        
            BuscarPermisosActividadPerfil("Parametros");
        </script>
    </body>
</html>
