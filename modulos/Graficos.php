
<?php
include '../model/config.php';


if (!empty($_GET['inicio']) && !empty($_GET['final'])) {
    $inico = $_GET['inicio'];
    $final = $_GET['final'];
   
    $sql1 = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as nombre,count( v.`Id_Visitado`) as valor
from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id  WHERE t.estado=1 AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitado
ORDER by  valor DESC";

    $sql2 = "select p.valor nombre,count(v.Id_Departamento) as valor
from visitantes_departamento v INNER JOIN valor_parametros p on p.id=v.Id_Departamento WHERE DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Departamento 
ORDER by  valor DESC";

    $sql4 = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as nombre,t.identificacion,count(v.Id_Visitantes) as valor
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitantes
ORDER by  valor DESC";
} else {
    $sql1 = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as nombre,count( v.`Id_Visitado`) as valor
from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id  WHERE t.estado=1
group by V.Id_Visitado
ORDER by  valor DESC";

    $sql2 = "select p.valor nombre,count(v.Id_Departamento) as valor
from visitantes_departamento v INNER JOIN valor_parametros p on p.id=v.Id_Departamento WHERE 1
group by V.Id_Departamento 
ORDER by  valor DESC";

    $sql4 = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as nombre,t.identificacion,count(v.Id_Visitantes) as valor
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE 1
group by V.Id_Visitantes
ORDER by  valor DESC";
}



if (!empty($_GET["sql"])) {
    if ($_GET["sql"] == 1) {
        $query = $sql1;
    } else if ($_GET["sql"] == 2) {
        $query = $sql2;
    } else if ($_GET["sql"] == 3) {
        if (!empty($_GET["id"])) {
            $sql3 = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as nombre,count(v.Id_Visitado) as valor from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id WHERE t.Id_Departamento='" . $_GET["id"] . "' group by v.Id_Visitado ORDER by valor DESC";
            $query = $sql3;
            if (!empty($_GET['inicio']) && !empty($_GET['final'])) {
                $sql3 = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as nombre,count(v.Id_Visitado) as valor from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id WHERE t.Id_Departamento='" . $_GET["id"] . "' AND DATE_FORMAT(v.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(v.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y') group by v.Id_Visitado ORDER by valor DESC";
                $query = $sql3;
            }
        }
    } else if ($_GET["sql"] == 4) {
        $query = $sql4;
    } else if ($_GET["sql"] == 6) {
        if (!empty($_GET["id"])) {
            $sql6 = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as nombre,count(v.Id_Visitantes) as valor
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE v.Id_Departamento='" . $_GET["id"] . "'
group by V.Id_Visitantes
ORDER by  valor DESC";
            $query = $sql6;
        }
          if (!empty($_GET['inicio']) && !empty($_GET['final'])) {
                  $sql6 = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as nombre,count(v.Id_Visitantes) as valor
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE v.Id_Departamento='" . $_GET["id"] . "'  AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitantes
ORDER by  valor DESC";
            $query = $sql6;
            }
        
        
       
    }
 
}

/* if (isset($_POST['inicio']) && isset($_POST['final'])) {
  $inicio = $_POST['inicio'];
  $final = $_POST['final'];
  }

  if (empty($final) || empty($inicio)) {

  }else{

  }
 */
?>
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
        <title>Software de Visitantes</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />
    </head>


    <body>

        <div class="grafico" id="containerpie"></div>
        <div class="grafico" id="containerpiramide" ></div>
        <div class="grafico" id="containerbarra" ></div>
        <div class="grafico" id="containerdona" ></div>
     
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
        <script type="text/javascript">
            function GraficoPie() {
                Highcharts.chart('containerpie', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Grafico de Torta'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                            name: 'Num. Visitas',
                            colorByPoint: true,
                            data: [
<?php
$resultado = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($resultado)) {
    ?>
                                    ["<?php echo $row["nombre"]; ?>",<?php echo $row["valor"]; ?>],
    <?php
}
?>

                            ]
                        }]
                });
            }

            function GraficoPiramide() {
                Highcharts.chart('containerpiramide', {
                    chart: {
                        type: 'pyramid',
                        marginRight: 100
                    },
                    title: {
                        text: 'Grafico en piramide',
                        x: -50
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b> ({point.y:,.0f})',
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                                softConnector: true
                            }
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                            name: 'Num. Visitas',
                            data: [
<?php
$resultado = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($resultado)) {
    ?>
                                    ["<?php echo $row["nombre"]; ?>",<?php echo $row["valor"]; ?>],
    <?php
}
?>
                            ]
                        }]
                });

            }

            function GraficoBarra() {

                Highcharts.chart('containerbarra', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Grafico de Barra'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Visitas'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Num. Visita: <b>{point.y:.1f}</b>'
                    },
                    series: [{
                            name: 'Population',
                            data: [
<?php
$resultado = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($resultado)) {
    ?>
                                    ["<?php echo $row["nombre"]; ?>",<?php echo $row["valor"]; ?>],
    <?php
}
?>
                            ],
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y:.1f}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                });
            }

            function GraficoDona() {
                Highcharts.chart('containerdona', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45
                        }
                    },
                    title: {
                        text: 'Grafico Dona'
                    },
                    subtitle: {
                        text: ''
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 100,
                            depth: 45
                        }
                    },
                    series: [{
                            name: 'Num. Visitas',
                            data: [
<?php
$resultado = mysqli_query($link, $query);

while ($row = mysqli_fetch_array($resultado)) {
    ?>
                                    ["<?php echo $row["nombre"]; ?>",<?php echo $row["valor"]; ?>],
    <?php
}
?>
                            ]
                        }]
                });

            }
        </script>  
        
        <script>
        
        GraficoPiramide();
                GraficoBarra();
                GraficoPie();
                GraficoDona()</script>
    </body>

</html>