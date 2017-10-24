<?php
header("Cache-Control: no-cache, must-revalidate");
clearstatcache();
/*
 * LLAMO A LOS ARCHIVOS QUE NECESITO
 */
require_once 'model/ValidarUsuario.php';
/*
 * INICIO SESSION
 */
session_start();
/*
 * SE SE PASA POR GET SALIR SE DESTRUYE LA SESION
 */
if (!empty($_GET['salir'])) {

    session_destroy();
    session_unset();
}
$validacion = validar();
if ($validacion != null && $validacion != false) {
    header("location:Admin/Principal.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- LLAMO AL CSS DE BOOTSTRAP  !-->
        <link rel="stylesheet" href="estilos/css/bootstrap.min.css">
        <!-- LLAMO A MI HOJA DE ESTILO  !-->

        <!-- LLAMO A MI HOJA DE ESTILO  !-->

            <title>Control de Acceso</title>
        <link href="Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Splash and Coming Soon Page Effects with CSS3" />
        <meta name="keywords" content="coming soon, splash page, css3, animation, effect, web design" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
     
        <link rel="stylesheet" type="text/css" href="estilos/style2.css" />
    </head>

    <body class="">
        <div class="">
            <input id="cerro" type="hidden" value="<?php
if (!empty($_GET['cerro'])) {
    echo $_GET['cerro'];
} else {
    echo '';
}
?>">


            <div class="container">
                    <div class="header">
            
                <span class="right" data-toggle="modal" data-target="#ModalLogeo">
                    <span class=" btn-link btn-lg glyphicon glyphicon-user" style="color: white;background: none"><b>Ingresar</b></span>
                </span>
                <div class="clr"></div>
            </div>
                <div class="sp-container">
                    <div class="sp-content">
                        <div class="sp-globe"></div>
                        <h2 class="frame-1">Bienvenido</h2>
                        <h2 class="frame-2">Somos calidad</h2>
                        <h2 class="frame-3">Somos excelencia</h2>
                        <h2 class="frame-4">Somos...</h2>
                        <h2 class="frame-5"></h2>
   
                    </div>
                </div>
            </div>
      

            <div class="modal fade" id="ModalMensaje1" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal">
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon  glyphicon-random"></span>   Panel de Administracion</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div id="ModalMe" style="text-align: center">
                                <p>    Usted ha Cerrado la sesión o aun no la ha Iniciado</p>
                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>

                    <div class="modal fade" id="ModalLogeo" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" >
                        <div class="modal-header" id="headermodal" >
                            <button type="button" class="close" data-dismiss="modal"> X</button>
                            <h4 class="modal-title"><span class="glyphicon glyphicon-user"></span>   Iniciar Sesion</h4>
                        </div>
                        <div class="modal-body" id="bodymodal">
                            <div class="error" style="text-align: center"></div>
                              <div class="card card-container" style="">
                <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                                  <img id="profile-img" class="profile-img-card" src="Imagenes/Admin.png">
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin"  method="post" id="logeo">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="usuario">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="contraseña">
                        <div id="remember" class="checkbox">

                        </div>
                        <span  class="btn btn-lg  btn-block btn-signin" id="btnentrar"> Ingresar</span> </form><!-- /form -->
                    <a href="#" class="forgot-password">
                        Olvidaste tu Contraseña?

                    </a>
                </div>

                        </div>
                  


                    </div>


                </div>
            </div>
            
        </div>
        <script src="estilos/jquery-2.2.1.js"></script>

        <script src="estilos/js/bootstrap.min.js"></script>
        <script src="estilos/Inicio.js"></script>
         <script src="estilos/Mensaje.js"></script>
    </body>
</html>
