
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
       <title>Control de Acceso</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>
    <body class="inicio" style="display: none" id="ventanareporte">
        <div class="opciones opcionesReportesVisitas">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="operaciones"> 
                <button type="button" id="RecargarReporte" class="btn btn-link active" ><span class="smodificar glyphicon glyphicon-refresh" title="Recargar" data-toggle="popover" data-trigger="hover"></span></button>
                <a id="link-grafica" href="../modulos/Graficos.php" target="graficas-ventana"><button  class="btn btn-link active" id="MostrarGraficas"><span class="smodificar glyphicon glyphicon-signal " title="Graficar" data-toggle="popover" data-trigger="hover"></span></button></a>

                <button  class="btn btn-link active bntLectura" ><span class="smodifica glyphicon glyphicon-eye-open " title="Solo Lectura" data-toggle="popover" data-trigger="hover"></span></button>
           

                <?php
                if (!empty($_GET['cerrar'])) {
                    if ($_GET['cerrar'] == 'yes') {
                        echo '<button id="ampliar" type="button" class="btn btn-link active btnAmplia"><a href="ReportesVisitas.php" target="_blank"><span class="sampliar glyphicon glyphicon-fullscreen" title="Pantalla Completa" data-toggle="popover" data-trigger="hover"></span></a></button>
    ';
                    }
                }
                ?> </div><div class="moduloname"><h5>Reportes Visitas</h5>
            </div>
        </div>
        <div class="container col-md-12 " id="cusuarios" style="padding-top: 30px; ">

            <div class="reporte">
               
                <div class="seleccion">
                     <div class="error"></div>
                    <select class="form-control" required="" id="tiporeporte">
                        <option value="-1">Seleccione Reporte</option>
                        <option value="1">Los Mas Visitados</option>
                        <option value="3">Los Mas Visitados Por departamento</option>
                        <option value="2">Departamentos Mas Visitados</option>
                        <option value="6">Visitantes Por Departamento</option>
                        <option value="4">Visitantes Con Mas Visitas</option>
                       <!-- <option value="5">Meses Mas Visitados</option>
                        -->

                    </select>
   <select class="form-control departamentos oculto"> </select>
                </div>
                <div class="filtro">
                    <label> <input  type="checkbox" class="filtrarfecha">Filtrar Por fecha</label>

                    <div class="oculto fechasFiltro"  style="">
                        <label>Desde: <input type="date" class="form-control fechare" id="finicio"></label>
                        <label>Hasta:  <input type="date" class="form-control fechare" id="ffinal"></label>
                    </div>
                </div>
                <div class="botonesreporte">
                    <button class="btn btn-danger" id="GenerarReporte">Generar</button>
                </div>
            </div>









            <div class="tablausu col-md-12 " >
                <div class="table-responsive col-sm-12 col-md-12  tablauser oculto tablareportesEmpleados" style="text-align: left;">
                    <table class="table table-bordered table-hover table-condensed table-responsive " id="tablareportesEmpleados"  cellspacing="0" width="100%" style="">
                       <thead class="ttitulo "><tr class="filaprincipal"><td class="" id="nombrevisitante">Nombre Completo</td><td class="medio">identificacion</td><td class="medio">Departamento</td><td class="medio">Cargo</td><td class="medio">Celular</td><td class="medio">Visitas</td></tr> </thead> <tbody></tbody>
                    </table>



                </div>
    <div class="table-responsive col-sm-12 col-md-12  tablauser tablareportesVisitantes oculto" style="text-align: left;">
                    <table class="table table-bordered table-hover table-condensed table-responsive " id="tablareportesVisitantes"  cellspacing="0" width="100%" style="">
                       <thead class="ttitulo "><tr class="filaprincipal"><td class="n1" id="nombrevisitante">Nombre Completo</td><td class="medio n2">identificacion</td><td class="medio n3">Visitas</td></tr> </thead> <tbody></tbody>
                    </table>



                </div>
            </div>



        </div>
        <div class="modal fade" id="myModalGrafica" role="dialog">
            <div class="modal-dialog" style="width:60%;overflow-y: hidden">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" id="headermodal">
                        <button type="button" class="close" data-dismiss="modal"> X</button>
                        <h4 class="modal-title" ><span class="glyphicon glyphicon-th-list"></span><b id="TituloGrafico"></b></h4>
                    </div>
                    <div class="modal-body bodygraficas" id="bodymodal" style="overflow-y: hidden">

                        <iframe id="graficas-ventana" name="graficas-ventana"  frameborder="0" style="width: 100%;height: 100%;overflow-x: hidden"></iframe>

                    </div>



                </div>


            </div>
        </div>

        <div class="modal fade" id="ModalMensajevisita" role="dialog">
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
        
        <script src="../estilos/jquery-2.2.1.js"></script>

        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Mensaje.js"></script>
        <script src="../estilos/Registros.js"></script>

        <script src="../estilos/Inicio.js"></script>
        <script src="../estilos/visita.js"></script>
        <script src="../estilos/Parametros.js"></script>
        <script src="../estilos/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
        <script src="../estilos/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>

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

        <script src="../Graficas/code/highcharts.js"></script>
        <script src="../Graficas/code/modules/funnel.js"></script>
        <script src="../Graficas/code/modules/exporting.js"></script>
        <script src="../Graficas/code/highcharts-3d.js"></script>
     


        <script>
            //CON ESTE LLAMADO CARGO LOS PERMISOS QUE TENGAN LOS TIPOS DE USUARIOS
            BuscarPermisosActividadPerfil("ReportesVisitas");

            //EN EL MODULO DE REPORTES POR DEFECTO CARGO LOS MAS VISITADOS
      CargartiposDepartamentos();
        </script>
    </body>
</html>

