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
        <link rel="stylesheet" href="../estilos/MiEstilo3.css">
         <title>Control de Acceso</title><link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio" style="margin: 0 auto"> <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=si" TARGET="_parent">salir</A>
                <input id="cerro" type="hidden" value="<?php if(!empty($_GET['permiso'])){
     echo $_GET['permiso'];
            }else{
                echo '';
            }
?>">
                
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
                            <p>El tipo de Persona a la que esta Asociado el Usuario No puede realizar una reserva</p>
                            </div>
                        </div>
                        <div class="modal-footer" id="footermodal">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>


                    </div>


                </div>
            </div>
                   <div class="menutitle" ><b class="glyphicon glyphicon-thumbs-up"><a>Bienvenido</a></b></div>
                      
               
        <img src="../Imagenes/LogocucF.png">
         <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
          <script src="../estilos/Inicio.js"></script>
    </body>
</html>
