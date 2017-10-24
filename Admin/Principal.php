<?php
session_start();
require_once '../model/config.php';
require_once '../model/esUsuario.php';
require_once '../model/ValidarUsuario.php';
header("Cache-Control: no-cache, must-revalidate");
clearstatcache();
$validacion = validar();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="../estilos/css/bootstrap.min.css">
        <link rel="stylesheet" href="../estilos/MiEstilo3.css">



        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
          <title>Control de Acceso</title>

    </head>





    <!-- <span class="glyphicon glyphicon-map-marker "><a>Inicio</a></span>Trigger the modal with a button -->
    <?php
    if ($validacion != null && $validacion != false) {
        ?>

    <body style="overflow: hidden; height: 100%;">
        <header class="">
            <a id="permiso" href="../modulos/inicio.php" target="ventana"></a>
            <div class="OpcionesPrincipal" ><span class="glyphicon glyphicon-th-list menuresposi"><a>Menu</a></span><div class="OcultarResposi"><span data-toggle="modal" data-target="#Infopersona" id="micuenta" class="glyphicon glyphicon-user micuenta"><a>Cuenta</a></span><span class="glyphicon glyphicon-question-sign" ><a href="../modulos/ayuda.php"  target="_blank">Ayuda</a></span><span class="glyphicon glyphicon-remove-sign" data-toggle="modal" data-target="#ModalMensaje"><a>Salir</a></span></div></div>
            <div class="MenusAlterno">
                <div class="menu col-md-12 este">
                  <p class="Open">El Modulo Fue Cargado Con Exito <span class="ver">Ver</span></p>
                  
                    <div class="usuario2" style="text-align: center"> 
                         <div class="OpcionesPrincipal" ><span data-toggle="modal" data-target="#Infopersona" id="micuenta" class="glyphicon glyphicon-user micuenta"><a>Cuenta</a></span><span class="glyphicon glyphicon-question-sign" ><a href="../modulos/ayuda.php"  target="_blank">Ayuda</a></span><span class="glyphicon glyphicon-remove-sign" data-toggle="modal" data-target="#ModalMensaje"><a>Salir</a></span></div>
            
                    <div class="menutitle" ><b class="glyphicon glyphicon-th-list"><a style="color: white">Menu</a></b></div>
                        <?php
                        if ($_SESSION['tipo_persona'] == "tblvisitante") {
                            ?>
                            <img id="profile-img" class="profile-img-card2" src="../ImagenesVisitantes/<?php echo $_SESSION['foto'] ?>" />

                        <?php } else if ($_SESSION['tipo_persona'] == "tblvisitado") { ?>
                            <img id="profile-img" class="profile-img-card2" src="../ImagenesVisitados/<?php echo $_SESSION['foto'] ?>" />

                        <?php }
                        ?>

                        <h4><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></h4> 
                    </div>
                    
                       <table class="tablamenu tablamenuresp" style="margin:  0 auto; width: 100%;border:1" id="">


                        </table>


                    </div>
            </div>        
            </header>
            <section  class="principalSection">
                <var  class="bmenu">
                    <div class="usuario2"> 
                        <div class="menutitle" ><b class="glyphicon glyphicon-th-list"><a>Menu</a></b></div>
                       <?php
                        if ($_SESSION['tipo_persona'] == "tblvisitante") {
                            ?>
                            <img id="profile-img" class="profile-img-card2" src="../ImagenesVisitantes/<?php echo $_SESSION['foto'] ?>" />

                        <?php } else if ($_SESSION['tipo_persona'] == "tblvisitado") { ?>
                            <img id="profile-img" class="profile-img-card2" src="../ImagenesVisitados/<?php echo $_SESSION['foto'] ?>" />

                        <?php }
                        ?>

                        <h4><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></h4> 
                    </div>
                    <div class="menu col-md-12">
                        <table class="tablamenu" style="margin:  0 auto; width: 100%;border:1" id="">


                        </table>


                    </div>
                </var>
                <section  class=" ventanaPrincipal" id="MyFrame">
                    
                    <iframe  height="100%" src="../modulos/inicio.php"  name="ventana"  frameborder="0px" width="100%;"></iframe>
                </section>
            </section>
            <footer  class="footerPrincipal">
                <h5>Copyright © 2017 Universidad de la Costa CUC |<a href="../Archivos/politicadedatos.pdf" target="blank" class="link">
                                                 Política de Protección de Datos.
                    </a>| V1.0</h5>
            </footer>
        <div style=""class="modal fade" id="Infopersona" role="dialog">
                <div class="modal-dialog ModalMicuenta">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title" id="miinfo"><span class="glyphicon glyphicon-user"></span> Mi Cuenta</h4>
                        </div>
                        <div class="modal-body " id="bodymodal" style="width: 100%;margin: 0 auto">
                            <div class="row2 ">

                                <table class="table" id="datosvisi" style=" margin:  0 auto">
                                    <tr><th class="filaprincipal" colspan="1" style="color: #990000; text-align: center">Foto del Usuario</th></tr>
                                    <tr><td rowspan="1"  class="" style="width: 150px;text-align: center">
                                            <?php
                                            if ($_SESSION['tipo_persona'] == "tblvisitante") {
                                                ?>
                                                <img id="profile-img" class="profile-img-card" src="../ImagenesVisitantes/<?php echo $_SESSION['foto'] ?>" />

                                            <?php } else if ($_SESSION['tipo_persona'] == "tblvisitado") { ?>
                                                <img id="profile-img" class="profile-img-card" src="../ImagenesVisitados/<?php echo $_SESSION['foto'] ?>" />

                                            <?php }
                                            ?>


                                        </td></tr>

                                    <tr><td class="nombre"></tr>
                                    <tr><td class="tipoidentificacion"></tr>
                                    <tr><td class="identificacion"></tr>

                                    <tr><td class="usuariosesion"></tr>

                                    <tr><td class="tipousuario"><span class="primero">Tipo de Usuario:<br></span><select class="form-control" id="perfilesUsuario"></select></td></tr>





                                </table>    


                            </div> </div>


                    </div>


                </div>
            </div>


            <div class="modal fade" id="ModalMensaje" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title" style="color: white"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>

                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div id="ModalMe" style="text-align: center"><p>¿ Esta Seguro que desea salir del Sistema ? 
                                </p> </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <A  id="cerrars" HREF="../index.php?salir=true" TARGET="_parent" class="btn btn-danger">Salir</A>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>


                    </div>


                </div>
            </div>
<script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
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
        
        setInterval(function () {
        sinPerfiles();
    }, 5000);
      CargarMenu2();

        
        </script>
        </body>



        <?php
    } else {
        header("location:../index.php");
    }
    ?> 
</html>