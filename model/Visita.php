<?php

/*
 * POR MEDIO DEL GET SE HACEN EL LLAMDO DE LAS DISITINTAS FUNCIONES
 */

/*
 * OBTENGO LA HORA LOCAL
 */
date_default_timezone_set("America/Bogota");

/*
 * CON ESTE LLAMDO MUESTRO DEPENDIENDO EL TIPO DE USUARIO QUE ESTE EN SESION
 * SI ES EL TIPO DE USUARIO SECRETARIA SE MUESTRAN LAS VISITAS QUE ELLA GUARDO
 * EN DADO CASO QUE NO SEA SECRETARIA SE MUESTRAN LAS VISITAS DEL VISITADO
 */
if (!empty($_GET['mostrarparticipantesVisita'])) {
    $id = $_POST["id"];
    echo json_encode(MostrarParticipantesVisita($id));
}
if (!empty($_GET['ayuda'])) {
    if (isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["tema"]) && isset($_POST["mensaje"])) {
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $tema = $_POST["tema"];
        $mensaje = $_POST["mensaje"];
        echo json_encode(Ayuda($nombre, $correo, $tema, $mensaje));
    } else {
        echo json_encode(2);
   
    }
}

if (!empty($_GET['buscarPersona'])) {
    $idPersona = $_POST['idPersona'];
    echo json_encode(buscarPersona($idPersona)); 
}

if (!empty($_GET['mostrarvisitasvisitado'])) {
    session_start();
    if ($_SESSION['perfil'] == "SecreUser") {
        echo json_encode(MostrarVisitasPorusuario2($_SESSION['idusuario']));
    } else if ($_SESSION['perfil'] == "Admin") {
        echo json_encode(MostrarVisitas2(1));
    } else {

        echo json_encode(MostrarVisitasPorVisitado2($_SESSION['id_persona']));
    }
}

if (!empty($_GET['AsignarVisita'])) {
    session_start();
    require_once './visitantesMetodos.php';
    $id = $_POST['id'];
    $visita = $_POST['visita'];
    if ($id == -1) {
        $usuario = $_SESSION["idusuario"];
        $id = MostrarVisitanteUsuairo($usuario);
    }
    echo json_encode(GuardarVisitanteVisita($id, $visita));
}
if (!empty($_GET['retirarVisita'])) {
    $id = $_POST['id'];
    $visita = $_POST['visita'];
    echo json_encode(visitanteenvisitaretirar($id, $visita));
}

if (!empty($_GET['infoVisita'])) {
    $id = $_POST['id'];
    echo json_encode(getInfoVisita($id));
}
if (!empty($_GET['modificarReserva'])) {
    $id = $_POST['id'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSalida = $_POST['horaSalida'];
    $tipoIngreso = $_POST['tipoIngreso'];
    $numAcompanantes = $_POST['numAcompanantes'];
    $placa = $_POST['placa'];
    $observaciones = $_POST['observaciones'];
    $visitado = $_POST['visitado'];
    if (isset($id) && isset($horaEntrada) && !empty($horaEntrada) && isset($horaSalida) && !empty($horaSalida) && isset($tipoIngreso) && !empty($tipoIngreso)) {
        echo json_encode(modificarReserva($id, $horaEntrada, $horaSalida, $tipoIngreso, $numAcompanantes, $observaciones, $visitado, $placa));
    } else {
        echo json_encode(2);
    }
}


if (!empty($_GET['infoVisitante'])) {
    $id = $_POST['id'];
    echo json_encode(mostrarInfoVisitante($id));
}
if (!empty($_GET['cargarTiposSanciones'])) {
    echo json_encode(cargarSanciones());
}
if (!empty($_GET['agregarSancion'])) {
    session_start();
    $idSancion = $_POST['idSancion'];
    $idVisitante = $_POST['id'];
    $idUsuario = $_SESSION['idusuario'];
    /* echo json_encode(2); */
    agregarSancion($idVisitante, $idUsuario, $idSancion);
}
if (!empty($_GET['cargarSancionesPorUsuario'])) {
    $id = $_POST['id'];
    echo json_encode(getSanciones2($id));
}


if (!empty($_GET['eliminarSancion'])) {
    $idVisitante = $_POST['idVisitante'];
    $idSancion = $_POST['idSancion'];
    eliminarSancion($idVisitante, $idSancion);
    echo json_encode($idVisitante . " " . $idSancion);
}
/*
 * CON ESTE LLAMADO MODIFICO EL ESTADO DE UNA VISITA
 */
if (!empty($_GET['ModificarVisita'])) {

    $visita = $_POST['id'];
    $estado = $_POST['estado'];


    echo json_encode(CambiarEstadoVisita($visita, $estado));
}
/*
 * CON ESTE LLAMADO GUARDO LOS COMENTARIOS HACIENDO EL LLAMDO A LA FUNCION guardarComentario
 */
if (!empty($_GET['comentario'])) {
    $id = $_POST['id'];
    $comentario = $_POST['comentario'];
    guardarComentario($id, $comentario);
    echo 1;
}

/*
 *  CON ESTE LLAMADO MUESTRO LOS COMENTARIOS POR VISITA HACIENDO EL LLAMDO A LA FUNCION cargarComentarios
 */
if (!empty($_GET['cargarComentarios'])) {
    $id = $_POST['id'];
    echo json_encode(cargarComentarios2($id));
}


/*
 * AQUI HAGO EL LLAMADO DE ENVIAR CORREO SE LE PASA POR ID EL VISITADO
 */
if (!empty($_GET['enviarcorreo'])) {
    $id = $_POST['id'];
    enviarCorreo($id);
    return 1;
}

/*
 * CON ESTE LLAMADO MUESTRO LAS VISITAS QUE SE CRUZAN CON UNA EN ESPECIFICA
 */

if (!empty($_GET['mostrarcruzes'])) {
    require_once './Parametros.php';
    session_start();
    $idvisitado = $_POST['id'];
    if ($idvisitado == -1) {
        $idvisitado = $_SESSION["id_persona"];
    }
    $duracion = TraerLimiteHora();

    $strStart = date("Y-m-d H:i:s");

    $x = '+' . $duracion . "hour";
    $strEnd = strtotime($x, strtotime($strStart));
    $strEnd = date('Y-m-d H:i:s', $strEnd);

    echo json_encode(MostrarCruzes($strStart, $strEnd, $idvisitado));
}


/*
 * CON ESTE LLAMADO MUESTRO LOS visitantes CON MAS VISITAS +
 * ESTE METODO SE UTILIZA PARA EL REPORTE
 */
if (!empty($_GET['mostrarMasVisitantes'])) {
    echo json_encode(LosVisitantesConMasVisitas());
}
if (!empty($_GET['mostrarpordepartamento'])) {
    $id = $_POST['id'];
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
    }

    echo json_encode(VisitantesPorDepartamento($id, $inicio, $final));
}
if (!empty($_GET['mostrarMasvisitantes'])) {
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
    }
    echo json_encode(VisitantesMasVisitas($inicio, $final));
}
if (!empty($_GET['mostrarMasvisitdosdepar'])) {
    $id = $_POST['id'];
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
    }
    echo json_encode(VisitadosDepartamento($id, $inicio, $final));
}
/*
 * CON ESTE LLAMADO MUESTRO LOS VISITADOS CON MAS VISITAS +
 * ESTE METODO SE UTILIZA PARA EL REPORTE
 */
if (!empty($_GET['mostrarMasVisitados'])) {
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
    }

    echo json_encode(LosMasVisitados2($inicio, $final));
}
if (!empty($_GET['mostrardepartamentosr'])) {
    if (isset($_POST['inicio']) && isset($_POST['final'])) {
        $inicio = $_POST['inicio'];
        $final = $_POST['final'];
    }
    echo json_encode(DepartamentosMasVisitados($inicio, $final));
}
/*
 * CON ESTE LLAMADO SE LE CAMBIA EL ESTADO DE LA VISITA A NOTIFICADA
 */
if (!empty($_GET['notificado'])) {
    $id = $_POST['id'];
    echo json_encode(Notificado($id));
}

/*
 * CON ESTE LLAMADO MUESTRO TODAS LAS VISITAS
 */
if (!empty($_GET['mostrar'])) {
    echo json_encode(MostrarVisitas2(2));
}
/*
 * CON ESTE LLAMADO GUARDO LAS VISITAS
 * SE RECIBE POR POST LOS RESPECTIVOS DATOS Y SE LLAMA A LA FUNCION GUARDAR
 */
if (!empty($_GET['guardar'])) {
    session_start();

    require_once './Parametros.php';
    $Visitantes = $_POST['Visitantes'];
    $idpersonaVisitar = $_POST['idVisitado'];
    $tipoIngreso = $_POST['tipoIngreso'];

    $acompanantes = $_POST['acompanantes'];
    $observaciones = $_POST['observaciones'];
    $numeroCarnet = 123;
    $estadovisita = "VisiCur";
    $usuario = $_SESSION['idusuario'];
    $fCreacion = date("Y-m-d H:i:s");
    $placa = $_POST['placa'];
    if (empty($placa)) {
        $placa = "------";
    }
    $duracion = TraerLimiteHora();

    $x = '+' . $duracion . "hour";
    $horaSalida = strtotime($x, strtotime($fCreacion));
    $horaSalida = date('Y-m-d H:i:s', $horaSalida);
    echo guardarVisita($Visitantes, $idpersonaVisitar, $tipoIngreso, $horaSalida, $fCreacion, $observaciones, $numeroCarnet, $acompanantes, $estadovisita, $usuario, $fCreacion, $placa);
}
/*
 * CON ESTE LLAMADO GUARDO LAS VISITAS RESERVADAS
 * SE RECIBE POR POST LOS RESPECTIVOS DATOS Y SE LLAMA A LA FUNCION GUARDAR
 */
if (!empty($_GET['reservar'])) {
    session_start();
    $Visitantes = $_POST['Visitantes'];
    $idpersonaVisitar = $_POST['idVisitado'];
    $tipoIngreso = $_POST['tipoIngreso'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSalida = $_POST['horaSalida'];
    $acompanantes = $_POST['acompanantes'];
    $observaciones = $_POST['observaciones'];
    $numeroCarnet = 123;
    $placa = $_POST['placa'];
    if (empty($placa)) {
        $placa = "------";
    }
    $usuario = $_SESSION['idusuario'];
    $fCreacion = date("Y-m-d H:i:s");
    echo reservarVisita($Visitantes, $idpersonaVisitar, $tipoIngreso, $horaSalida, $horaEntrada, $observaciones, $numeroCarnet, $acompanantes, $usuario, $fCreacion, $placa);
}
/*
 * CON ESTE LLAMDO BUSCO UNA VISITA POR SU ID
 */
if (!empty($_GET['buscarid'])) {
    $idvisita = $_POST['idvisita'];
    echo json_encode(BuscarVisitaid($idvisita));
}
/*
 * CON ESTE LLAMADO MUESTRO LA ULTIMA VISITA GUARDADA
 */
if (!empty($_GET['buscar'])) {

    echo json_encode(BuscarVisita());
}

//Buscar si existe el VISITANTE y consultar su información 
if (!empty($_GET['consultar'])) {
    $identificacion = $_POST['identificacion'];
    if (isset($identificacion) && !empty($identificacion)) {
        require_once('config.php');
        $query = "SELECT * FROM visitantes WHERE identificacion = '$identificacion'";
        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {
            echo json_encode($row);
        } else {
            echo 1;
        }
    } else {
        echo 2;
    }
}
/*
 * CON ESTE LLAMDO RETORNO LAS VISITAS QUE YA ESTAN PASADAS DEL TIEMPO DE DURACION
 */
if (!empty($_GET['notificar'])) {
    require_once('config.php');
    $fechahora = date("Y-m-d H:i:s");
    $query = "SELECT  va.Id,ve.nombre venombre,ve.apellido veapellido,ve.foto,vo.nombre vonombre,vo.apellido voapellido,va.HoraSalida,vp.valor
FROM visitas va,visitantes ve,visitados vo, valor_parametros vp
WHERE Id_EstadoVisita = 'VisiCur' AND HoraSalida < '$fechahora' AND Id_Visitante = ve.id AND Id_Visitado = vo.Id AND vo.Id_Departamento=vp.id AND notificado=0 ";
    $resultado = mysqli_query($link, $query);
    $visitasTerminada = array();

    while ($row = mysqli_fetch_array($resultado)) {

        array_push($visitasTerminada, $row);
    }
    echo json_encode($visitasTerminada);
    //echo 2;
}
/*
 * ESTE METODO LO UTILIZO PARA COMPARAR LAS FECHAS AL MOMENTO DE GUARDAR LA VISITA
 * ADEMAS SE VALIDA QUE LA FECHA DE ENTRADA SEA MAYOR QUE LA FECHA ACTUAL
 */

function compararFecha($strStart, $strEnd) {
    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    $interval = date_diff($datetime1, $datetime2);
    $horayfecha = date("Y-m-d H:i:s");
    $datetimeactual = date_create($horayfecha);

    if ($datetime1 < $datetimeactual) {

        return "false2";
    }
    if ($datetime2 <= $datetime1) {
        return "false";
    } else {
        $dteStart = new DateTime($strStart);
        $dteEnd = new DateTime($strEnd);

        $dteDiff = $dteStart->diff($dteEnd);

        return $dteDiff->format("%a:%H:%I:%S ");
    }
}

/*
 * CON ESTA FUNCION BUSCO LOS CRUZES DE LAS VISITAS DE UN VISITADO
 * 
 */

function BuscarCruzes($strStart, $strEnd, $idvisitado) {

    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    $Visitas = MostrarVisitasPorVisitado($idvisitado);
    for ($index = 0; $index < count($Visitas); $index++) {
        $visita = $Visitas[$index];
        $datetimevisita1 = date_create($visita['HoraEntrada']);
        $datetimevisita2 = date_create($visita['HoraSalida']);
        if ($datetime1 >= $datetimevisita1 && $datetime1 <= $datetimevisita2) {
            return 1;
        } else if ($datetime2 >= $datetimevisita1 && $datetime2 <= $datetimevisita2) {
            return 2;
        }
    }
    return 3;
}

/*
 * CON ESTA FUNCION MUESTRO LA VISITA QUE SE CRUZA CON LA QUE DESEO GUARDAR
 */

function MostrarCruzes($strStart, $strEnd, $idvisitado) {

    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    $Visitas = MostrarVisitasPorVisitado($idvisitado);
    for ($index = 0; $index < count($Visitas); $index++) {
        $visita = $Visitas[$index];

        $datetimevisita1 = date_create($visita['HoraEntrada']);
        $datetimevisita2 = date_create($visita['HoraSalida']);
        if ($datetime1 >= $datetimevisita1 && $datetime1 <= $datetimevisita2) {
            return $visita['Id'];
            ;
        } else if ($datetime2 >= $datetimevisita1 && $datetime2 <= $datetimevisita2) {
            return $visita['Id'];
            ;
        }
    }
    return -1;
}

/*
 * CON ESTA FUNCION GUARDO LA VISITA SE PASA POR PARAMETRO
 * EL VISITANTES, EL VISITADO, EL TIPO DE INGRESO, LA HORA DE ENTRADA Y SALIDA, EL NUMERO DEL CARNET, EL NUMERO DE ACOMPAÑANTES, EL ESTADO DE LA VISITA, EL USUSARIO QUE REGISTRA,
 * Y LA FECHA DE CREACION
 */

function guardarVisita($idVistatente, $idpersonaVisitar, $tipoIngreso, $horaSalida, $horaEntrada, $observaciones, $numeroCarnet, $acompanantes, $estadoVisita, $usuario, $fcreacion, $placa) {
    include 'config.php';


    $fechacorrecta = compararFecha($horaEntrada, $horaSalida);

    if ($fechacorrecta != "false" && $fechacorrecta != "false2") {
        $cruzes = MostrarCruzes($horaEntrada, $horaSalida, $idpersonaVisitar);

        if ($cruzes == -1) {
            if ($idpersonaVisitar != "" && $tipoIngreso != "" && !ctype_space($horaSalida) && !ctype_space($horaEntrada)) {

                $query = "INSERT INTO `visitas` (`Id_Visitado`, `Id_TipoIngreso`,  `HoraEntrada`, `HoraSalida`, `DuracionVisita`, `Id_EstadoVisita`, `Observaciones`, `NumeroCarnet`,NumAcompanantes,Usuario_Registra,Fecha_Registro,Visita_Placa)VALUES('$idpersonaVisitar', '$tipoIngreso', '$horaEntrada', '$horaSalida','$fechacorrecta','$estadoVisita','$observaciones','$numeroCarnet','$acompanantes','$usuario','$fcreacion','$placa')";
                mysqli_query($link, $query);
                $idmivisita = BuscarVisita();
                $idmivisitan = $idmivisita[0];
                GuardarVisitantesVisita($idVistatente, $idmivisitan["Id"]);



                return -3;
            } else {
                return -2;
            }
        } else {
            return $cruzes;
        }
    } else if ($fechacorrecta == "false") {
        return -1;
    } else if ($fechacorrecta == "false2") {
        return -6;
    }
}

/*
 * CON ESTA FUNCION RESERVA LA VISITA SE PASA POR PARAMETRO
 * EL VISITANTES, EL VISITADO, EL TIPO DE INGRESO, LA HORA DE ENTRADA Y SALIDA, EL NUMERO DEL CARNET, EL NUMERO DE ACOMPAÑANTES, EL ESTADO DE LA VISITA, EL USUSARIO QUE REGISTRA,
 * Y LA FECHA DE CREACION
 */

function reservarVisita($idVistatente, $idpersonaVisitar, $tipoIngreso, $horaSalida, $horaEntrada, $observaciones, $numeroCarnet, $acompanantes, $usuario, $fcreacion, $placa) {
    include 'config.php';

    $fechacorrecta = compararFecha($horaEntrada, $horaSalida);

    if ($fechacorrecta != "false" && $fechacorrecta != "false2") {
        $cruzes = MostrarCruzes($horaEntrada, $horaSalida, $idpersonaVisitar);
        if ($cruzes == -1) {
            if ($idpersonaVisitar != "" && $tipoIngreso != "" && !ctype_space($horaSalida) && !ctype_space($horaEntrada)) {
                $query = "INSERT INTO `visitas` ( `Id_Visitado`, `Id_TipoIngreso`,  `HoraEntrada`, `HoraSalida`, `DuracionVisita`, `Id_EstadoVisita`, `Observaciones`, `NumeroCarnet`,NumAcompanantes,Usuario_Registra,Fecha_Registro,Visita_Placa)VALUES('$idpersonaVisitar', '$tipoIngreso', '$horaEntrada', '$horaSalida','$fechacorrecta','VisiRe','$observaciones','$numeroCarnet','$acompanantes','$usuario','$fcreacion','$placa')";
                mysqli_query($link, $query);
                $idmivisita = BuscarVisita();
                $idmivisitan = $idmivisita[0];
                GuardarVisitantesVisita($idVistatente, $idmivisitan["Id"]);
                return -3;
            } else {
                return -2;
            }
        } else {
            return $cruzes;
        }
    } else if ($fechacorrecta == "false") {
        return -1;
    } else if ($fechacorrecta == "false2") {
        return -6;
    }
}

/*
 * ESTA FUNCION ES LA QUE ME RETORNA LA ULTIMA VISITA GUARDADA
 */

function BuscarVisita() {
    include ('config.php');
    require_once './Parametros.php';
    $visita = array();

    $query = "SELECT vp2.valor departamento,vp2.valorx ubicacion,v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado,v.Visita_Placa placa FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON  vp1.id=v.`Id_TipoIngreso` INNER JOIN valor_parametros vp2 ON p.Id_Departamento=vp2.id  WHERE 1 ORDER BY Id DESC LIMIT 1";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {

        array_push($visita, $row);
    }
    return $visita;
}

/*
 * CON ESTE METODO SE BUSCA LA VISITA POR SI ID
 */

function BuscarVisitaid($idVisita) {
    include ('config.php');
    require_once './Parametros.php';

    $query = "SELECT vp2.valor departamento,vp2.valorx ubicacion,v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado,v.Visita_Placa placa,v.Usuario_Registra,p.Correo FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON  vp1.id=v.`Id_TipoIngreso` INNER JOIN valor_parametros vp2 ON p.Id_Departamento=vp2.id  WHERE v.`Id`='$idVisita'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {

        return $row;
    }
    return $row;
}

/*
 * CON ESTA FUNCION SE MUESTRAN TODAS LAS VISITAS
 */

function MostrarVisitas() {
    include ('config.php');
    require_once './Parametros.php';
    $visita = array();

    $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,v.`Id_EstadoVisita`,v.`Id_TipoIngreso`,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,CONCAT(m.nombre, ' ', m.Segundo_Nombre,' ',m.apellido, ' ', m.Segundo_Apellido) nombrevisitante,p.foto fotovisitado,m.foto fotovisitante,m.id idvisitante,p.Id idVisitado,m.correo,m.celular,m.identificacion,m.id_tipoIdentificacion FROM `visitas` v, visitados p,visitantes m WHERE m.id=v.`Id_Visitante` AND p.Id=`Id_Visitado` ORDER BY `v`.`HoraEntrada`
";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        $tingreso = BuscarValorParametro2($row['Id_TipoIngreso']);
        $testado = BuscarValorParametro3($row['Id_EstadoVisita']);
        $row['id_estado_visita'] = $row['Id_EstadoVisita'];
        $row['Id_TipoIngreso'] = $tingreso['valor'];
        $row['Id_EstadoVisita'] = $testado['valor'];

        array_push($visita, $row);
    }
    return $visita;
}

/*
 * CON ESTA FUNCION SE MUESTRAN TODAS LAS VISITAS
 */

function MostrarVisitas2($datos) {
    include ('config.php');

    $visita = array();
    $actualhora = date("Y-m-d H:i:s");
    $actual = date_create($actualhora);
    if ($datos == 1) {
        $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON vp1.id=v.`Id_TipoIngreso`   WHERE 1 ORDER by `HoraEntrada` DESC ";
    } else {
        $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON vp1.id=v.`Id_TipoIngreso`   WHERE  DATE_FORMAT(NOW(),'%m-%d-%Y')=DATE_FORMAT(`HoraEntrada`,'%m-%d-%Y') ORDER by DATE_FORMAT(`HoraEntrada`,'%m-%d-%Y') DESC ";
    }
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $visitahora = date_create($row["HoraSalida"]);
            $visitahorareserva = date_create($row["HoraEntrada"]);
            if ($row["idestado"] == "VisiCancel") {
                $spam = "<p style='background-color:red;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                $row["Id_EstadoVisita"] = $spam;
            } else if ($row["idestado"] == "VisiEsp") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#cc00cc;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiRe") {

                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiTer") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {

                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiCur") {


                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            }

            $row["indice"] = $i;
            $i++;
            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION SE BUSCAN LAS VISITAS POR VISITADO
 */

function MostrarVisitasPorVisitado($id) {
    include ('config.php');
    require_once './Parametros.php';
    $visita = array();

    $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado FROM `visitas` v INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON vp1.id=v.`Id_TipoIngreso`   WHERE `Id_Visitado`='$id'  AND v.`Id_EstadoVisita`<> 'VisiTer' AND `Id_EstadoVisita`<> 'VisiCancel'";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {

        array_push($visita, $row);
    }
    return $visita;
}

/*
 * CON ESTA FUNCION SE BUSCAN LAS VISITAS POR VISITADO
 */

function MostrarVisitasPorVisitado2($id) {

    include ('config.php');

    $visita = array();
    $actualhora = date("Y-m-d H:i:s");
    $actual = date_create($actualhora);
    $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON vp1.id=v.`Id_TipoIngreso`   WHERE `Id_Visitado`='$id'   ORDER by `HoraEntrada` DESC";

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $visitahora = date_create($row["HoraSalida"]);
            $visitahorareserva = date_create($row["HoraEntrada"]);
            if ($row["idestado"] == "VisiCancel") {
                $spam = "<p style='background-color:red;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                $row["Id_EstadoVisita"] = $spam;
            } else if ($row["idestado"] == "VisiEsp") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#cc00cc;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiRe") {

                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiTer") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {

                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiCur") {


                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            }

            $row["indice"] = $i;
            $i++;
            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION SE BUSCAN LAS VISITAS POR USUARIO
 */

function MostrarVisitasPorusuario($id) {
    include ('config.php');
    require_once './Parametros.php';
    $visita = array();

    $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,v.`Id_EstadoVisita`,v.`Id_TipoIngreso`,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,CONCAT(m.nombre, ' ', m.Segundo_Nombre,' ',m.apellido, ' ', m.Segundo_Apellido) nombrevisitante,p.foto fotovisitado,m.foto fotovisitante,m.id idvisitante,p.Id idVisitado,m.correo,m.celular,m.identificacion,m.id_tipoIdentificacion FROM `visitas` v, visitados p,visitantes m WHERE m.id=v.`Id_Visitante` AND p.Id=`Id_Visitado`AND `Usuario_Registra`='$id' ORDER BY `v`.`HoraEntrada`";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        $tingreso = BuscarValorParametro2($row['Id_TipoIngreso']);
        $testado = BuscarValorParametro3($row['Id_EstadoVisita']);
        $row['id_estado_visita'] = $row['Id_EstadoVisita'];
        $row['Id_TipoIngreso'] = $tingreso['valor'];
        $row['Id_EstadoVisita'] = $testado['valor'];

        array_push($visita, $row);
    }
    return $visita;
}

/*
 * CON ESTA FUNCION SE BUSCAN LAS VISITAS POR USUARIO
 */

function MostrarVisitasPorusuario2($id) {

    include ('config.php');
    require_once './Parametros.php';
    $visita = array();
    $actualhora = date("Y-m-d H:i:s");
    $actual = date_create($actualhora);
    $query = "SELECT v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON vp1.id=v.`Id_TipoIngreso`   WHERE `Usuario_Registra`='$id'  ORDER by `HoraEntrada` DESC ";

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $visitahora = date_create($row["HoraSalida"]);
            $visitahorareserva = date_create($row["HoraEntrada"]);
            if ($row["idestado"] == "VisiCancel") {
                $spam = "<p style='background-color:red;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                $row["Id_EstadoVisita"] = $spam;
            } else if ($row["idestado"] == "VisiEsp") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#cc00cc;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiRe") {

                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiTer") {


                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    TerminarVisita($row["Id"], "VisiCur");
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . 'En Curso' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {

                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            } else if ($row["idestado"] == "VisiCur") {


                if ($actual >= $visitahora) {
                    TerminarVisita($row["Id"], "VisiTer");
                    $spam = "<p style=' background-color:#33cc00;color:white;text-align: center;'>" . 'Terminada' . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                } else {
                    $spam = "<p style=' background-color:#cc9900;color:white;text-align: center;'>" . $row["Id_EstadoVisita"] . "</p>";
                    $row["Id_EstadoVisita"] = $spam;
                }
            }


            $row["indice"] = $i;
            $i++;
            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

/*
 * ESTA FUNCION SE UTILIZA EN EL REPORTES PARA TRAER LOS LISTADOS DE LOS MAS VISITADOS
 */

function LosMasVisitados() {
    include ('config.php');
    $visitados = array();

    $query = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.Identificacion,t.cargo,t.Id_Departamento,t.Correo,t.Telefono,count( v.`Id_Visitado`) as NumVisitas
from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id WHERE t.estado=1
group by V.Id_Visitado
ORDER by  NumVisitas DESC";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {

        array_push($visitados, $row);
    }
    return $visitados;
}

/*
 * CON ESTA FUNCION MUETSRO LOS VISITANTES CON MAS INGRESOS A LA UNIVERSIDAD
 */

function LosVisitantesConMasVisitas() {
    include ('config.php');

    $visita = array();

    $query = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as NombreCompleto,p.valor TipoIdentificacion,t.Identificacion,t.numPlacaCarro,t.correo,t.celular,count( v.`Id_Visitante`) as NumVisitas
from visitas v INNER JOIN visitantes t on v.`Id_Visitante`=t.id INNER JOIN valor_parametros P ON P.id=T.id_tipoIdentificacion WHERE t.estado=1
group by V.`Id_Visitante`
ORDER by  NumVisitas DESC";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

/*
 * ESTA FUNCION SE UTILIZA EN EL REPORTES PARA TRAER LOS LISTADOS DE LOS MAS VISITADOS
 */

function LosMasVisitados2($inico, $final) {
    include ('config.php');

    $visita = array();
    if (empty($final) || empty($inico)) {
        $query = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.Identificacion,p1.valor cargo ,p.valor Id_Departamento,t.Correo,t.Telefono,count( v.`Id_Visitado`) as NumVisitas
from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id INNER JOIN valor_parametros P ON P.id=t.Id_Departamento INNER JOIN valor_parametros P1 ON P1.id=t.cargo WHERE t.estado=1
group by V.Id_Visitado
ORDER by  NumVisitas DESC";
    } else {
        $query = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.Identificacion,p1.valor cargo ,p.valor Id_Departamento,t.Correo,t.Telefono,count( v.`Id_Visitado`) as NumVisitas
from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id INNER JOIN valor_parametros P ON P.id=t.Id_Departamento INNER JOIN valor_parametros P1 ON P1.id=t.cargo WHERE t.estado=1 AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitado
ORDER by  NumVisitas DESC";
    }

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

function VisitantesPorDepartamento($departamento, $inico, $final) {
    include ('config.php');

    $visita = array();
    if (empty($final) || empty($inico)) {
        $query = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.identificacion,count(v.Id_Visitantes) as NumVisitas
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE v.Id_Departamento='$departamento'
group by V.Id_Visitantes
ORDER by  NumVisitas DESC

";
    } else {
        $query = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.identificacion,count(v.Id_Visitantes) as NumVisitas
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE v.Id_Departamento='$departamento'  AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitantes
ORDER by  NumVisitas DESC

";
    }

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

function VisitantesMasVisitas($inico, $final) {
    include ('config.php');

    $visita = array();
    if (empty($final) || empty($inico)) {
        $query = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.identificacion,count(v.Id_Visitantes) as NumVisitas
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE 1
group by V.Id_Visitantes
ORDER by  NumVisitas DESC
    ";
    } else {
        $query = "select CONCAT(t.nombre,' ',t.Segundo_Nombre,' ',t.apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.identificacion,count(v.Id_Visitantes) as NumVisitas
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Visitantes
ORDER by  NumVisitas DESC
    ";
    }
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

function VisitadosDepartamento($id, $inico, $final) {
    include ('config.php');

    $visita = array();
    if (empty($final) || empty($inico)) {
        $query = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.Identificacion,count(v.Id_Visitado) as NumVisitas from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id WHERE t.Id_Departamento='$id' group by v.Id_Visitado ORDER by NumVisitas DESC
";
    } else {
        $query = "select CONCAT(t.Nombre,' ',t.Segundo_Nombre,' ',t.Apellido,' ',t.Segundo_Apellido) as NombreCompleto,t.Identificacion,count(v.Id_Visitado) as NumVisitas from visitas v INNER JOIN visitados t on v.Id_Visitado=t.Id WHERE t.Id_Departamento='$id' AND DATE_FORMAT(v.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(v.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
         group by v.Id_Visitado ORDER by NumVisitas DESC
";
    }

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

function DepartamentosMasVisitados($inico, $final) {
    include ('config.php');

    $visita = array();
    if (empty($final) || empty($inico)) {
        $query = "select p.valor nombre,p.valorx ubicacion,count(v.Id_Departamento) as NumVisitas
from visitantes_departamento v INNER JOIN valor_parametros p on p.id=v.Id_Departamento WHERE 1
group by V.Id_Departamento 
ORDER by  NumVisitas DESC";
    } else {
        $query = "select p.valor nombre,p.valorx ubicacion,count(v.Id_Departamento) as NumVisitas
from visitantes_departamento v INNER JOIN valor_parametros p on p.id=v.Id_Departamento WHERE  DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')>=DATE_FORMAT('$inico','%m-%d-%Y') AND DATE_FORMAT(V.HoraEntrada,'%m-%d-%Y')<=DATE_FORMAT('$final','%m-%d-%Y')
group by V.Id_Departamento 
ORDER by  NumVisitas DESC";
    }
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION SE LE CAMBIA EL ESTADO DE UNA VISITA A NOTIFICADO CON VALOR 1
 */

function Notificado($id) {
    include ('config.php');
    $query = "UPDATE `visitas` SET `notificado`=1 WHERE `Id`='$id'";
    mysqli_query($link, $query);
    return 1;
}

/*
 * ESTA FUNCION LE NOTIFICA AL VISITADO QUE TIENE UNA VISITA
 * EL CORREO QUE SE UTILIZA PARA EL ENVIO ES EL QUE ESTA DEFINIDO EN EL PARAMETRO DE CORREOS
 */

//$query = "SELECT vp2.valor departamento,vp2.valorx ubicacion,v.Id, v.observaciones,v.NumeroCarnet, v.NumAcompanantes,v.HoraEntrada,v.HoraSalida,v.`DuracionVisita`,vp.valor as Id_EstadoVisita,vp1.valor as Id_TipoIngreso,p.Id_Departamento, CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado,p.foto fotovisitado,p.Id idVisitado,v.Id_EstadoVisita idestado,v.Visita_Placa placa,v.Usuario_Registra,p.Correo FROM `visitas` v  INNER JOIN visitados p on p.Id=v.`Id_Visitado` INNER JOIN valor_parametros vp ON vp.id_aux=v.`Id_EstadoVisita`  INNER JOIN valor_parametros vp1 ON  vp1.id=v.`Id_TipoIngreso` INNER JOIN valor_parametros vp2 ON p.Id_Departamento=vp2.id  WHERE v.`Id`='$idVisita'";



function Ayuda($nombre,$correo,$tema,$mensaje) {

    require_once './esUsuario.php';
    require '../PHPMailer/PHPMailerAutoload.php';
    require_once './Parametros.php';
    $email = BuscarCorreos();
    $correoPrincipal = $email[0];
    /**
     * This example shows making an SMTP connection with authentication.
     */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
//  $mail->charSet = "UTF-8";
//$mail­->Encoding = "quoted­printable";
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 1;
//Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
//Set the hostname of the mail server
    $mail->Host = "smtp.office365.com";
// Seteo de la seguridad
    $mail->SMTPSecure = 'tls';
//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
    $mail->Username = $correoPrincipal["valor"];
//Password to use for SMTP authentication
    $mail->Password = $correoPrincipal["id_aux"];
//Set who the message is to be sent from
    $mail->setFrom($correoPrincipal["valor"], 'Gestion de Visitas');
//Set an alternative reply-to address
//$mail->addReplyTo('ocantill4@cuc.edu.co', 'Oscar Cantillo Menco');
//Set who the message is to be sent to
    $mail->addAddress($correo, "Ayuda");
//Set the subject line
    $mail->Subject = $tema;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('inicio.php'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $mail->Body = $mensaje;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
//if($nombre != '' && $email != '' && $telefono != '' && $mensaje != ''){
//  mail($dest,$asunto,$cuerpo,$headers); //ENVIAR!
//}

    if (!$mail->send()) {
       return 1;
    } else {
  return 2;
    }
}

function enviarCorreo($idvisita) {
    require_once './esUsuario.php';
    require '../PHPMailer/PHPMailerAutoload.php';
    require_once './Parametros.php';

    $email = BuscarCorreos();

    $correoPrincipal = $email[0];

    $visita = BuscarVisitaid($idvisita);
    $usuario = cargarUsuarioPorId($visita['Usuario_Registra']);
    $nombreUsuario = $usuario["nombre"] . " " . $usuario["apellido"];

    $correo = $visita['Correo'];
    $nombre = $visita['nombrevisitado'];
    $visitantes = TraerVisitantes($idvisita);
    $listado = "";
    for ($index = 0; $index < count($visitantes); $index++) {

        $v = $visitantes[$index];

        $listado = $listado . " " . $v["nombrevisitado"] . "\n";
    }
    /**
     * This example shows making an SMTP connection with authentication.
     */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
    //  $mail->charSet = "UTF-8";
//$mail­->Encoding = "quoted­printable";
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 1;
//Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
//Set the hostname of the mail server
    $mail->Host = "smtp.office365.com";
// Seteo de la seguridad
    $mail->SMTPSecure = 'tls';
//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 25;
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication
    $mail->Username = $correoPrincipal["valor"];
//Password to use for SMTP authentication
    $mail->Password = $correoPrincipal["id_aux"];
//Set who the message is to be sent from
    $mail->setFrom($correoPrincipal["valor"], 'Gestion de Visitas');
//Set an alternative reply-to address
//$mail->addReplyTo('ocantill4@cuc.edu.co', 'Oscar Cantillo Menco');
//Set who the message is to be sent to
    $mail->addAddress($correo, $nombre);
//Set the subject line
    $mail->Subject = 'Notificacion Registro Visita';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('inicio.php'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $mail->Body = 'Buen dia. ' . "\r\n" . "\r\n" .
            'Se le informa que el dia: ' . $visita['HoraEntrada'] . "\r\nTiene una Visita por parte de: " . $listado . "\r\n" . " Visita Registrada por: " . $nombreUsuario;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
//if($nombre != '' && $email != '' && $telefono != '' && $mensaje != ''){
    //  mail($dest,$asunto,$cuerpo,$headers); //ENVIAR!
//}

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}

/*
 * CON ESTA FUNCION CAMBIO EL ESTADO DE LA VISITA 
 * SE LE PASA POR PARAMETRO EL ID DE LA VISITA Y EL NUEVO ESTADO
 * CUANDO SE MODIFICA LA VISITA SE LE DEBE NOTIFICAR AL VISITADO EL CAMBIO
 */

function CambiarEstadoVisita($Idvisita, $idestado) {

    include 'config.php';
    session_start();
    $visita = BuscarVisitaid($Idvisita);
    if ($visita["Usuario_Registra"] == $_SESSION["idusuario"] || $_SESSION["perfil"] == "Admin") {
        $query = "UPDATE `visitas` SET `Id_EstadoVisita`='$idestado' WHERE  `Id`='$Idvisita'";
        mysqli_query($link, $query);
        return 1;
    } else {
        return 2;
    }
}

/*
 * CON ESTA FUNCION GUARDO LOS COMENTARIOS 
 * SE LE PASA POR PARAMETRO EL ID DE LA VISITA Y EL COMENTARIO A GUARDAR
 */

function guardarComentario($idVisita, $comentario) {
    session_start();
    $idUsuario = $_SESSION['idusuario'];
    $hoy = date("Y-m-d H:i:s");
    include 'config.php';
    $query = "INSERT INTO `comentarios` (comentario, id_visita, id_usuario, fecha)VALUES('$comentario', '$idVisita', '$idUsuario', '$hoy')";
    mysqli_query($link, $query);
}

/*
 * CON ESTA FUNCION MUESTRO LOS COMENTARIOS POR VISITA
 */

function cargarComentarios($id) {
    include ('config.php');
    $comentarios = array();
    $query = "SELECT comentario,fecha,usuario FROM comentarios,usuarios u WHERE id_usuario = u.id AND id_visita = $id";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($comentarios, $row);
    }
    return $comentarios;
}

function cargarComentarios2($id) {
    include ('config.php');

    $comentarios = array();

    $query = "SELECT comentario,fecha,usuario FROM comentarios,usuarios u WHERE id_usuario = u.id AND id_visita = $id";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {

            $row["indice"] = $i;
            $i++;
            $comentarios["data"][] = $row;
        }
        return $comentarios;
    }
    mysqli_free_result($resultado);
}

function mostrarInfoVisitante($id) {
    include ('config.php');
    $info = array();
    $query = "SELECT v.id,identificacion,nombre,Segundo_Nombre,apellido,Segundo_Apellido,celular,correo,foto, valor FROM visitas vv, visitantes v, valor_parametros vp WHERE Id_Visitante = v.id AND v.id_tipoIdentificacion=vp.id AND vv.id= $id";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($info, $row);
    }
    return $info;
}

function cargarSanciones() {
    include ('config.php');
    $sanciones = array();
    $query = "SELECT vp.id,vp.valor FROM parametros p, valor_parametros vp WHERE vp.idParametro=p.id AND vp.idParametro=5";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($sanciones, $row);
    }
    return $sanciones;
}

function agregarSancion($idVisitante, $idUsuario, $idSancion) {
    $fecha = date("Y-m-d H:i:s");
    include ('config.php');
    if (traerInfoSancion($idVisitante, $idSancion) == null) {
        $query = "INSERT INTO sanciones_usuarios(Id_sancion,Id_visitante,Id_usuario,fecha) VALUES('$idSancion','$idVisitante','$idUsuario','$fecha')";
        $resultado = mysqli_query($link, $query);
        echo json_encode(1);
    } else {
        echo json_encode(0);
    }
}

function traerInfoSancion($idVisitante, $idSancion) {
    include ('config.php');
    $query = "SELECT * FROM sanciones_usuarios WHERE Id_Visitante = '$idVisitante' AND Id_Sancion='$idSancion' AND estado = 1";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return null;
    }
}

function getSanciones($idVisitante) {
    include ('config.php');
    $sanciones = array();
    $query = "SELECT usuario, valor, fecha FROM sanciones_usuarios su, usuarios u, valor_parametros vp WHERE u.id = su.Id_Usuario AND vp.id=su.Id_Sancion AND su.estado = 1 and su.Id_Visitante = '$idVisitante'";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($sanciones, $row);
    }
    return $sanciones;
}

function getSanciones2($idVisitante) {
    include ('config.php');

    $sanciones = array();

    $query = "SELECT usuario, valor, fecha, su.Id FROM sanciones_usuarios su, usuarios u, valor_parametros vp WHERE u.id = su.Id_Usuario AND vp.id=su.Id_Sancion AND su.estado = 1 and su.Id_Visitante = '$idVisitante'";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {

            $row["indice"] = $i;
            $i++;
            $sanciones["data"][] = $row;
        }
        return $sanciones;
    }
    mysqli_free_result($resultado);
}

function eliminarSancion($idVisitante, $idSancion) {
    include ('config.php');
    $query = "UPDATE sanciones_usuarios SET estado=0 WHERE  Id_Visitante='$idVisitante' AND Id = '$idSancion'";
    $resultado = mysqli_query($link, $query);
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function getInfoVisita($id) {
    include ('config.php');
    $query = "SELECT Id_TipoIngreso, NumAcompanantes,HoraEntrada,HoraSalida,Observaciones,Id_Visitado,Visita_Placa FROM visitas WHERE Id=$id";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return null;
    }
}

//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
function modificarReserva($id, $horaEntrada, $horaSalida, $tipoIngreso, $numAcompanantes, $observaciones, $idvisitado, $placa) {

    include 'config.php';
    require_once './Evento.php';
    session_start();
    $visitaa = BuscarVisitaid($id);
    if ($visitaa["Usuario_Registra"] == $_SESSION["idusuario"] || $_SESSION["perfil"] == "Admin") {


        $fechacorrecta = compararFechaEventoModificar($horaEntrada, $horaSalida);

        if ($fechacorrecta != "false") {

            $Visitas = MostrarVisitasPorVisitado($idvisitado);

            $cruzes = BuscarCruzeseVisitas2($horaEntrada, $horaSalida, $Visitas, $id);

            if ($cruzes == 2) {

                return 4;
            } else {
                include ('config.php');
                $query = "  UPDATE visitas 
                SET DuracionVisita='$fechacorrecta',HoraEntrada='$horaEntrada', HoraSalida='$horaSalida', Id_TipoIngreso='$tipoIngreso', NumAcompanantes='$numAcompanantes',Visita_Placa='$placa', Observaciones='$observaciones',Id_EstadoVisita='VisiRe' 
                WHERE  Id='$id'";
                mysqli_query($link, $query);
                return 3;
            }
        } else if ($fechacorrecta == "false") {
            return 1;
        }
    } else {
        return 5;
    }
}

//2017-01-11 22:35
//2017-01-12 20:30
function BuscarCruzeseVisitas2($strStart, $strEnd, $Visitas, $IdVisita) {
    $suma = 0;
    $HoraInicio = date_create($strStart);
    $HoraFin = date_create($strEnd);
    for ($index = 0; $index < count($Visitas); $index++) {

        $visita = $Visitas[$index];
        $HoraInicioVisita = date_create($visita['HoraEntrada']);
        $HoraFinVisita = date_create($visita['HoraSalida']);
        if ($HoraInicio >= $HoraInicioVisita && $HoraInicio <= $HoraFinVisita) {
            $suma++;
            $id = $visita["Id"];
        } else if ($HoraFin >= $HoraInicioVisita && $HoraFin <= $HoraFinVisita) {
            $suma++;
            $id = $visita["Id"];
        }
    }
    if ($suma == 0) {

        return 3;
    } else {
        if ($suma == 1) {
            if ($id == $IdVisita) {
                return 3;
            }
        }

        return 2;
    }
}

function GuardarVisitantesVisita($visitantes, $visita) {

    include 'config.php';

    $visitantes = explode(",", $visitantes);

    for ($index = 0; $index < count($visitantes); $index++) {

        $query = "INSERT INTO `visitantes_visitas`( `Id_Visitantes`, `Id_Visita`) VALUES ('$visitantes[$index]','$visita');";
        mysqli_query($link, $query);
    }
}

function GuardarVisitanteVisita($visitantes, $visita) {

    include 'config.php';

    $esta = visitanteenvisita($visitantes, $visita);
    if ($esta == 1) {
        return 2;
    } else {
        $query = "INSERT INTO `visitantes_visitas`( `Id_Visitantes`, `Id_Visita`) VALUES ('$visitantes','$visita');";
        mysqli_query($link, $query);
        return 1;
    }
}

/*
 * ME MUESTRA LOS VISITANTES EN EL MODULO DE EVENTOS
 */

function MostrarParticipantesVisita($id) {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT  CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id FROM  visitantes_visitas v INNER JOIN visitantes o ON o.id=v.Id_Visitantes  WHERE `Id_Visita`='$id'";
    $resultado = mysqli_query($link, $query);

    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $row["indice"] = $i;
            $i++;
            $visitantes["data"][] = $row;
        }
        return $visitantes;
    }
    mysqli_free_result($resultado);
}

function visitanteenvisita($id, $visita) {
    include'../model/config.php';
    $query = "SELECT * FROM `visitantes_visitas` WHERE `Id_Visitantes`='$id' AND `Id_Visita`='$visita'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return 1;
    }
    return 2;
}

function TraerVisitantes($visita) {
    include'../model/config.php';
    $Visitante = array();
    $query = "SELECT CONCAT(p.nombre, ' ', p.Segundo_Nombre,' ',p.apellido, ' ', p.Segundo_Apellido) nombrevisitado FROM `visitantes_visitas` v INNER JOIN visitantes p on p.id=v.`Id_Visitantes` WHERE `Id_Visita`='$visita'";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($Visitante, $row);
    }
    return $Visitante;
}

function visitanteenvisitaretirar($id, $visita) {
    include'../model/config.php';
    $query = "DELETE FROM `visitantes_visitas`  WHERE `Id_Visitantes`='$id' AND `Id_Visita`='$visita'";
    $resultado = mysqli_query($link, $query);

    return 1;
}

function TerminarVisita($Idvisita, $idestado) {
    include 'config.php';
    $query = "UPDATE `visitas` SET `Id_EstadoVisita`='$idestado' WHERE  `Id`='$Idvisita'";
    mysqli_query($link, $query);
    return 1;
}

function buscarPersona($id){
    include 'configI.php';
    $array = array();
    $vinculacion = array();
    $query = "SELECT a.id_usuario,a.num_documento,a.nombres,a.primer_apellido,a.segundo_apellido,a.fecha_nacimiento,a.direccion,a.telefonos,a.celular,a.correo_personal,a.logon_name,a.codigo_barras 
    FROM inf_identidades a WHERE a.num_documento=  '$id'";

    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {

        array_push($array, array(
        "num_documento"=>$row["num_documento"],
        "nombres"=>htmlentities($row["nombres"], ENT_QUOTES | ENT_IGNORE, "UTF-8"),
        "primer_apellido"=>htmlentities($row["primer_apellido"], ENT_QUOTES | ENT_IGNORE, "UTF-8"),
        "segundo_apellido"=>htmlentities($row["segundo_apellido"], ENT_QUOTES | ENT_IGNORE, "UTF-8"),
        "fecha_nacimiento"=>$row["fecha_nacimiento"],
        "telefonos"=>$row["telefonos"],
        "celular"=>$row["celular"],
        "correo_personal"=>$row["correo_personal"],
        "logon_name"=>$row["logon_name"],
        "codigo_barras"=>$row["codigo_barras"],
   
    ));
    }else{
        return "";
    }
    $id_usuario = $row['id_usuario'];
    $query = "SELECT b.nombre_empresa,c.descripcion,d.nom_departamento,e.nombre_cargo,f.id_unidad_aca,f.nombre_unidad_aca,a.estado 
FROM inf_vinculacion a, empresas b, tipo_persona c, dept_empresa d, cargos e, unidades_academicas f
WHERE a.id_usuario='$id_usuario' AND a.id_empresa=b.id_empresa AND a.id_persona=c.id_persona AND a.id_deptemp=d.id_deptemp AND a.id_registro_cargo=e.id_registro_cargo AND a.id_reg_uni_aca=f.id_reg_uni_aca ORDER BY a.fecha_hora_reg DESC";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($vinculacion, $row);
    }
    array_push($array, $vinculacion);
    return $array;
}

?>
