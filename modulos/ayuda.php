<!DOCTYPE html>

<?php
session_start();

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Control de Acceso</title> <link href="../Imagenes/logo_cuc.png" type="image/png" rel="shortcut icon" />V
        <meta name="description" content="Free Bootstrap Theme by BootstrapMade.com">
        <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans|Roboto:300,400|Questrial|Satisfy">
        <link rel="stylesheet" type="text/css" href="../estilos/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../estilos/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../estilos/css/animate.css">

        <link rel="stylesheet" type="text/css" href="../estilos/style.css">


    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" onload="myFunction()">
        <div class="principal">
            <A class="sinsesion" id="sinsesion" HREF="../index.php?cerro=siqwrd54h74swef14afkn" TARGET="_parent">salir</A>
            <div class="header">
                <div class="bg-color">
                    <header id="main-header">
                        <nav class="navbar navbar-default navbar-fixed-top">
                            <div class="container">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#lauraMenu">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="#">Control de Acceso CUC</a>
                                </div>
                                <div class="collapse navbar-collapse" id="lauraMenu">
                                    <ul class="nav navbar-nav navbar-right navbar-border">
                                        <li class="active"><a href="#main-header">Inicio</a></li>
                                        <li><a href="#about">Informacion</a></li>
                                        <li><a href="#modulos">Modulos</a></li>
                                        <li><a href="#manuales">Manuales</a></li>
                                        <li><a href="#contact">Contacto</a></li>
                                    </ul>
                                </div>
                            </div>


                        </nav>
                    </header>
                    <div class="wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 wow fadeIn delay-05s">
                                    <div class="banner-text">
                                        <h2>Bienvenido,<span><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] ?></span>,</h2>
                                        <p>En que te podemos ayudar..?</p>
    
                                    </div>
                                    <div class="overlay-detail text-center">
                                        <a href="#about"><i class="fa fa-angle-down"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="about" class="section-padding wow fadeIn delay-05s">
                <div class="container">
                    <div class="row info">
                        <div class="col-md-6 text-right">
                            <h2 class="title-text">
                                <span class="deco">Informacion</span>
                            </h2>
                        </div>
                        <div class="col-md-6 text-left">
                            <div class="about-text">

                                <p>
                                    Este software le brinda a la
                                    universidad de la costa CUC un
                                    control del personal externo que
                                    ingresa a la universidad, Ademas le
                                    permite tener la información en
                                    tiempo real.
                                    Por otro lado El software mantiene
                                    los estándares de diseños
                                    institucionales cumpliendo con las
                                    normas de diseño MVS que tiene la
                                    universidad de la costa CUC.
                                    Ademas garantiza los derechos de la
                                    privacidad, la intimidad, el buen
                                    nombre y la autonomía universitaria,
                                    en el tratamiento de los datos
                                    personales, y en consecuencia todas
                                    sus actuaciones se regirán por los
                                    principios de legalidad, finalidad,
                                    libertad, veracidad o calidad,
                                    transparencia, acceso y circulación
                                    restringida, seguridad y
                                    confidencialidad.|        <a href="../Archivos/Brochure.pdf" target="blank" class="link">
                                                 Brochure.
                    </a> |
        <a href="../Archivos/politicadedatos.pdf" target="blank" class="link">
                                                 Política de Protección de Datos.
                    </a>
                                </p>
                        
                            </div>
                            
                        </div>


                        <div class="col-md-6 text-right">
                            <h2 class="title-text">
                                <span class="deco">Caracteristicas</span>
                            </h2>
                        </div>
                        <div class="col-md-6 text-left">
                            <div class="about-text">
                                <p> El Software Control de acceso te permite:<br><br>
                                    
                                    <span class="glyphicon glyphicon-hand-right iten"></span> Agilizar la atención y el acceso a proveedores y personas externas a la compañía.<BR><br>
                                   <span class="glyphicon glyphicon-hand-right iten"></span> Registrar al instante los datos del visitante, permitiendo consultar local o de forma
                                    remota la información (accesibilidad a la información).<BR><br>

                                  <span class="glyphicon glyphicon-hand-right iten"></span>  Consultar de forma exacta y oportuna información de visitantes en caso de
                                    cualquier incidente.<BR><br>
                                   <span class="glyphicon glyphicon-hand-right iten"></span> Consolidar la información a través de reporte gráficos y estadísticos.<BR><br>
                                   <span class="glyphicon glyphicon-hand-right iten"></span> Pre-programar las visitas de personal masivo agilizando el ingreso.<BR><br>
                                   <span class="glyphicon glyphicon-hand-right iten"></span> Integrar el sistema con otras plataformas propias de la compañía (Active Directory,
                                    Planta Física entre otros).
<BR>

                                </p>

                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </section>
            <section id="modulos" class="section-padding wow fadeInUp delay-05s">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title text-center"><span class="deco titulo">Modulos Software Control de Acceso</span></h1>
                        </div>
                        <div class="col-md-12">
                            <div id="myGrid" class="grid-padding">

                                <div class="col-md-4 col-sm-4 padding-right-zero">
                                    <h1 class="title text-center"><span class="deco">   Modulo Inicio</span></h1>
                                    <img src="../img/Index.PNG" class="img-responsive">
                                    <h1 class="title text-center"><span class="deco">   Modulo Principal</span></h1>
                                    <img src="../img/Principal.PNG" class="img-responsive">
                                    <h1 class="title text-center"><span class="deco">   Modulo de Visitantes</span></h1>
                                    <img src="../img/visitantes.PNG" class="img-responsive">




                                </div>
                                <div class="col-md-4 col-sm-4 padding-right-zero">

                                    <h1 class="title text-center"><span class="deco">   Modulo Visitados</span></h1>
                                    <img src="../img/visitados.PNG" class="img-responsive">
                                    <h1 class="title text-center"><span class="deco">     Modulo Visitas</span></h1>
                                    <img src="../img/visitas.PNG" class="img-responsive">
                                    <h1 class="title text-center"><span class="deco">     Modulo Usuarios</span></h1>
                                    <img src="../img/usuarios.PNG" class="img-responsive">




                                </div>

                                <div class="col-md-4 col-sm-4 padding-right-zero">
                                    <h1 class="title text-center"><span class="deco">    Modulo Genericas</span></h1>
                                    <img src="../img/genericas.PNG" class="img-responsive">

                                    <h1 class="title text-center"><span class="deco">    Modulo Reportes</span></h1>
                                    <img src="../img/reportes.PNG" class="img-responsive">

                                    <h1 class="title text-center"><span class="deco">    Modulo Reserva</span></h1>
                                    <img src="../img/visitas.PNG" class="img-responsive">


                                </div>                       



                            </div>

                        </div>
                    </div>
                </div>

            </section>
            <section id="manuales" class="section-padding wow fadeInUp">
                <div class="container">
                    <div class="row">
                        <h2 class="title text-center">Aun no encuentras lo que buscas <span class="deco"><?php echo $_SESSION['nombre'] ?></span>?</h2>
                        <div class="test-sec">
                            <div class="col-sm-4">
                                <blockquote>
                                    <p>Si deseas mas informacion sobre la funcionalidad de cada modulo o alguna funcionalidad especifica te invitamos a que descargues el maual de usuario </p>
                                </blockquote>
                                      <div class="carousel-info">
                                    <?php if($_SESSION['perfil']=="Admin"){ ?>
                                    <div class="pull-left"><a href="../Archivos/Manual_Admin.pdf" target="black">
                                            Mostrar Archivo
                                        </a></div>
                                    <?php  }else if ($_SESSION['perfil']=="VisitadoUser") {?>
                                          <div class="pull-left"><a href="../Archivos/Manual_Visitados.pdf" target="black">
                                            Mostrar Archivo
                                        </a></div>
                                    <?php } else if ($_SESSION['perfil']=="SecreUser") {?>
                                    <div class="pull-left"><a href="../Archivos/Manual_ Secretarias.pdf" target="black">
                                            Mostrar Archivo
                                        </a></div>
                                    <?php }  else if ($_SESSION['perfil']=="UserRep") {?>
                                    <div class="pull-left"><a href="../Archivos/Manual_Recepcionistas.pdf"target="black">
                                            Mostrar Archivo
                                        </a></div>
                                    <?php }  ?>
                                </div>
                            </div>

                        </div>
                           <?php if($_SESSION['perfil']=="Admin"){ ?>
                        <div class="test-sec">
                            <div class="col-sm-4">
                                <blockquote>
                                    <p>Si deseas Informacion sobre la parametrizacion del sistema y que valores deben tomar para que el
                                        sistema funcione de la mejor manera te invitamos a que descargues el siguiente manual
                                    </p>
                                </blockquote>
                                <div class="carousel-info">
                                 
                                    <div class="pull-left"><a href="../Archivos/Parametrizacion/Parametrizacion.pdf" >
                                            Mostrar Archivo
                                        </a></div>
                                  
                              
                                </div>
                            </div>

                        </div>
                              <?php }  ?>
                        
                    </div>
                </div>
            </section>
            <section id="contact" class="section-padding wow fadeIn delay-05s">
                <div class="container">
                    <div class="row rowcontact">
                        <div class="col-md-12">
                            <div class="contact-sec text-center">
                                <h2>No encontraste la  <span class="deco">Solucion</span> ?</h2>
                                <p class="text-center">Te invitamos a que nos informes tu problema</p>
                            </div>
                        </div>

                        <div class="col-md-8 col-md-push-2">
                    
                            <div id="error"></div>
                            <form action="" method="post" role="form" class="contactForm">
                                <div class="form-group">
                                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Tu Correo" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="tema" id="tema" placeholder="Tema" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="mensaje" rows="5"id="mensaje" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                    <div class="validation"></div>
                                </div>

                                <div class="text-center"><button type="button" id="ayuda_form" class="btn btn-danger btn-lg">Enviar Mensaje</button></div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
            <footer class="footer-2 text-center-xs bg--white">
                <div class="container footer">
                    <!--end row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footer">

                                <div class="credits">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-right" >
                            <ul class="social-list">
                                <li>
                                    <a href="#" style="color: #990000">
                                        <i class="glyphicon glyphicon-star-empty"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="color: #990000">
                                        <i class="glyphicon glyphicon-cog"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="color: #990000">
                                        <i class="glyphicon glyphicon-download-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" style="color: #990000">
                                        <i class="glyphicon glyphicon-book"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!--end row-->
                </div>
            </footer>
        </div>

        <script src="../estilos/jquery-2.2.1.js"></script>
        <script src="../estilos/Inicio.js"></script>
        <script src="../estilos/js/jquery.min.js"></script>
        <script src="../estilos/js/jquery.easing.min.js"></script>
        <script src="../estilos/js/bootstrap.min.js"></script>
        <script src="../estilos/Registros.js"></script>
        <script src="../estilos/js/wow.js"></script>
        <script src="../estilos/js/custom.js"></script>


    </body>
</html>