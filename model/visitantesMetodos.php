<?php


/*---------------------------------------------------------------------------------------------------*/
if (!empty($_GET['existeVisitante'])) {
    $id = $_POST['id'];
    /*echo $identificacion;*/
    echo json_encode(BuscarIdentificacionVisitante($id,"43"));
    /*echo json_encode(getIdVisitante($identificacion));*/
}
/*if (!empty($_GET['prueba'])) {
    $id = $_POST['id'];
    echo json_encode(prueba($id));
}
function prueba($id){
    include 'configI.php';
    $query = "SELECT a.id_usuario,b.descripcion,a.num_documento,a.nombres,a.primer_apellido,a.segundo_apellido,a.fecha_nacimiento,a.direccion,a.telefonos,a.celular,a.correo_personal,a.logon_name,a.codigo_barras 
FROM inf_identidades a, tipo_documento b WHERE a.num_documento='$id'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return null;
    }
}*/
/*----------------------------------------------------------------------------------------------------*/

/*
 * CON ESTE LLAMADO SE BUSCA A UN VISITANTE YA SEA POR SU NOMBRE COMPLETO O SU NUMERO DE IDENTIFICACION
 */
if (!empty($_GET['buscar'])) {
    $modo = $_POST['busqueda'];
    if ($modo == 0) {

        $tipo_identificacion = $_POST['tipo'];
        $identificacion = $_POST['identificacion'];

        if (!empty($identificacion) && !empty($tipo_identificacion) && !ctype_space($identificacion) && !ctype_space($tipo_identificacion)) {
            $x = BuscarIdentificacionVisitante($identificacion, $tipo_identificacion);
            if ($x == false) {
                echo 2;
            } else {
                echo json_encode($x);
            }
        } else {
            echo 1;
        }
    } else {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $x = buscarVisitanteNombreCompleto($nombre, $apellido);
        if (!empty($x)) {
            echo json_encode($x);
        } else {
            echo 2;
        }
    }
}
/*
 * CON ESTE LLAMADO ELIMINO A UN VISITANTE
 */
if (!empty($_GET['eliminar'])) {
    $idVisitante = $_POST['id'];
    EliminarVisitante($idVisitante);
    echo 1;
}
if (!empty($_GET['foto'])) {
    $idVisitante = $_POST['id'];
    ModificarFoto($idVisitante);
    echo 1;
}
/*
 * CON ESTE LLAMADO RETIRO A UN PARTICIPANTE DE UN DEPARTAMENTO
 */
if (!empty($_GET['retirarVisitante'])) {
    $participante = $_POST['participante'];
    echo json_encode(RetirarParticopanteDepartamento($participante));
}
/*
 * CON ESTE LLAMADO MUESTRO LAS VISITAS POR VISITANTE
 */
if (!empty($_GET['mostrarVisitasVisitante'])) {
    $idVisitante = $_POST['visitante'];
    echo json_encode(buscarVisitasPorVisitante2($idVisitante));
}
/*
 * CON ESTE LLAMADO BUSCO UN VISITANTE POR SU ID
 */
if (!empty($_GET['buscarporid'])) {
    $idVisitante = $_POST['id'];
    echo json_encode(buscarVisitanteid($idVisitante));
}
/*
 * CON ESTE LLAMADO MUESTRO TODOS LOS VISITANTES
 */
if (!empty($_GET['mostrar'])) {
    $datos = $_POST['datos'];
    echo json_encode(MostrarVisitantes2($datos));
}
/*
 * CON ESTE LLAMADO MUESTRO LOS VISITANTES EN LA TABLA PARTICIPANTES DEL MODULO DE EVENETOS
 */
if (!empty($_GET['mostrarparticipantes'])) {
    $dato = $_POST["dato"];
    echo json_encode(MostrarParticipantesDepartamento2($dato));
}
if (!empty($_GET['mostrarparticipantesDepartamento'])) {

    echo json_encode(MostrarParticipantesDepartamento());
}
if (!empty($_GET['mostrarparticipantesDepartamento1'])) {
    $dato = $_POST["dato"];
    echo json_encode(MostrarParticipantesDepartamento2($dato));
}/*
 * CON ESTE LLAMADO MUESTRO LOS VISITANTES EN LA TABLA PARTICIPANTES DEL MODULO DE EVENETOS
 */
if (!empty($_GET['mostrarparticipantesEvento'])) {
    $evento = $_POST['id'];
    echo json_encode(MostrarParticipantesEvento($evento));
}
if (!empty($_GET['mostrarparDepa'])) {
    $departamento = $_POST['id'];
    $persona = $_POST['persona'];
    echo json_encode(MostrarParticipantesDepartamentoVisita($departamento,$persona));
}

/*
 * CON ESTE LLAMADO GUARDO A UN VISITANTE DESDE EL MODULO DE RESERVA DE VISITAS
 */
if (!empty($_GET['guardar2'])) {
    session_start();
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $segundonombre = $_POST['segundonombre'];
    $segundoapellido = $_POST['segundoapellido'];

    $fecha = date("Y-m-d H:i:s");
    $usuairo = $_SESSION['idusuario'];
    // $imagen = $_FILES['imagen']['name'];            segundoapellido-
    // $uploaddir = '../ImagenesVisitantes/';
    $guardado = GuardarVisitante2($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $segundoapellido, $segundonombre, $usuairo, $fecha);



    echo $guardado;
}

/*
 * CON ESTE LLAMADO GUARDO UN VISITANTE 
 */
if (!empty($_GET['guardar'])) {
    session_start();
    require_once './Parametros.php';
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $segundonombre = $_POST['segundonombre'];
    $segundoapellido = $_POST['segundoapellido'];
    $fecha = date("Y-m-d H:i:s");
    $usuairo = $_SESSION['idusuario'];
    // $imagen = $_FILES['imagen']['name'];            segundoapellido-
    // $uploaddir = '../ImagenesVisitantes/';
    $guardado = GuardarVisitante($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $identificacion, $segundoapellido, $segundonombre, $usuairo, $fecha);

    if ($guardado == 4) {

        if (isset($_POST['xxx'])) {
            echo $guardado;
            return;
        }
        // $uploadfile1 = $uploaddir . basename($_FILES['imagen']['name']);
        //      move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile1);
        $jpg = base64_decode($_POST["data"]);
        $file = fopen("../ImagenesVisitantes/$identificacion.jpg", "w");

        // Debe tener permiso de escritura.
        fwrite($file, $jpg);
        fclose($file);
    }
    echo $guardado;
}
/*
 * CON ESTE LLAMADO SE MODIFICA UN VISITANTE
 */
if (!empty($_GET['modificar'])) {
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];

    $id = $_POST['id'];
    $misma = $_POST['misma'];
    $NombreViejo = $_POST['nameviejo'];
    $segundonombre = $_POST['segundonombre'];
    $segundoapellido = $_POST['segundoapellido'];
    // $imagen = $_FILES['imagen']['name'];
    // $uploaddir = '../ImagenesVisitantes/';
    $guardado = ModificarVisitante($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $identificacion, $id, $segundoapellido, $segundonombre);

    if ($guardado == 4) {
        // $uploadfile1 = $uploaddir . basename($_FILES['imagen']['name']);
        //      move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile1);
        if ($misma == 1 && $NombreViejo != $identificacion . ".jpg") {
            $NuevoNombre = $identificacion . ".jpg";
            rename("../ImagenesVisitantes/$NombreViejo", "../ImagenesVisitantes/$NuevoNombre");
        } else if ($misma == 0) {
            unlink("../ImagenesVisitantes/" . $NombreViejo);

            $jpg = base64_decode($_POST["data"]);
            $file = fopen("../ImagenesVisitantes/$identificacion.jpg", "w");
            fwrite($file, $jpg);
            fclose($file);
        }
    }

    // Debe tener permiso de escritura.



    echo $guardado;
}
/*
 * 
 * CON ESTE LLAMADO GUARDO UN VISITANTE SE PASAN LOS DATOS NECESARIOS Y SE LLAMA A LA FUNCION
 * GUARDAR VISITANTE
 * EL SISTEMA VALIDA QUE SOLO SE INGRESEN DATOS NUMERICOS DONDE CORRESPONDE Y QUE UN VISITANTE NO ESTE REGISTRADO
 * LOS CAMPOS CORREO, SEGUNDO NOMBRE,CELULAR NO SON OBLIGATORIOS
 */

function GuardarVisitante2($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $segundoapellido, $segundonombre, $usuario, $fecha) {
    //Conexión
    include 'config.php';
    require_once './Evento.php';
    if (!ctype_space($nombre) && !ctype_space($apellido) && !ctype_space($segundoapellido) && !ctype_space($identificacion)) {
        $validarnombre = solo_letras($nombre);
        $validarapellido = solo_letras($apellido);
        $validarapellido2 = solo_letras($segundoapellido);
        $validarnombre2 = solo_letras($segundonombre);
        if ($validarapellido == true && $validarnombre == true && $validarnombre2 == true && $validarapellido2 == true) {
            $existe = BuscarIdentificacionVisitante($identificacion, $tipo_identificacion);
            if ($existe == FALSE) {

                $result = mysqli_query($link, "INSERT INTO visitantes (identificacion,id_tipoIdentificacion,nombre,apellido,celular,correo,Segundo_Nombre,Segundo_Apellido,Usuario_Registra,Fecha_Creacion) VALUES('$identificacion','$tipo_identificacion','$nombre','$apellido','$celular','$correo','$segundonombre','$segundoapellido','$usuario','$fecha')");
                if (!empty($_POST['evento']) && $_POST['evento'] != 0 && isset($_POST['evento'])) {
                    $idvi = MostrarVisitanteUsuairo($usuario);
                    $tipo = $_POST['tipo'];
                    $acompa = $_POST['acompanantes'];
                    $placa = $_POST['placa'];
                    if (empty($placa)) {
                        $placa = "------";
                    }
                    $guardo = GuardarParticipante($_POST['evento'], $idvi, $usuario, $placa, $acompa, $tipo);
                    if ($guardo != 1) {
                        return "-" . $guardo;
                    }
                }
                return 4;
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    } else {
        return 1;
    }
}

/*
 * 
 * CON ESTE LLAMADO GUARDO UN VISITANTE SE PASAN LOS DATOS NECESARIOS Y SE LLAMA A LA FUNCION
 * GUARDAR VISITANTE
 * EL SISTEMA VALIDA QUE SOLO SE INGRESEN DATOS NUMERICOS DONDE CORRESPONDE Y QUE UN VISITANTE NO ESTE REGISTRADO
 * TODOS LOS CAMPOS SON OBLIGATORIOS
 */

function GuardarVisitante($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $imagen, $segundoapellido, $segundonombre, $usuario, $fecha) {
    //Conexión
    include 'config.php';
    require_once './Evento.php';
    if (!ctype_space($nombre) && !ctype_space($apellido) && !ctype_space($celular) && !ctype_space($correo) && !ctype_space($imagen) && !ctype_space($segundoapellido) && !ctype_space($identificacion)) {
        $validarnombre = solo_letras($nombre);
        $validarapellido = solo_letras($apellido);
        $validarapellido2 = solo_letras($segundoapellido);
        $validarnombre2 = solo_letras($segundonombre);
        if ($validarapellido == true && $validarnombre == true && $validarnombre2 == true && $validarapellido2 == true) {
            $existe = BuscarIdentificacionVisitante($identificacion, $tipo_identificacion);
            if ($existe == FALSE) {
                $imagen = $imagen . '.jpg';
                $result = mysqli_query($link, "INSERT INTO visitantes (identificacion,id_tipoIdentificacion,nombre,apellido,celular,correo,foto,Segundo_Nombre,Segundo_Apellido,Usuario_Registra,Fecha_Creacion) VALUES('$identificacion','$tipo_identificacion','$nombre','$apellido','$celular','$correo','$imagen','$segundonombre','$segundoapellido','$usuario','$fecha')");

                if (!empty($_POST['departa']) && $_POST['departa'] != 0 && isset($_POST['departa'])) {
                    $idvi = MostrarVisitanteUsuairo($usuario);
                    GuardarParticipanteDepartamento($_POST['departa'], $idvi, $_POST['placa'], $_POST['acompa']);
                }
                if (!empty($_POST['evento']) && $_POST['evento'] != 0 && isset($_POST['evento'])) {
                    $idvi = MostrarVisitanteUsuairo($usuario);
                    $tipo = $_POST['tipo'];
                    $acompa = $_POST['acompanantes'];
                    $placa = $_POST['placa'];
                    if (empty($placa)) {
                        $placa = "------";
                    }
                    $guardo = GuardarParticipante($_POST['evento'], $idvi, $usuario, $placa, $acompa, $tipo);

                    if ($guardo != 1) {
                        return "-" . $guardo;
                    }
                }
                
                return 4;
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    } else {
        return 1;
    }
}

/*
 * CON ESTA FUNCION BUSCO UN VISITANTE POR SU IDENTIFICACION Y EL TIPO DE IDENTIFICACION
 * RETORNA TODOS LOS DATOS DEL VISITANTE SI LO ENCUENTRA
 */
function getIdVisitante($identificacion){
    include ('config.php');
    require_once './Parametros.php';
    $query = "SELECT id FROM `visitantes` WHERE identificacion='$identificacion' AND estado='1'";

    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {

        return $row['id'];
    } else {
        return false;
    }
}

function BuscarIdentificacionVisitante($identificacion, $tipoidentificacion) {
    include ('config.php');
    require_once './Parametros.php';
    $query = "SELECT * FROM `visitantes` WHERE identificacion='$identificacion' AND estado='1' AND id_tipoIdentificacion='$tipoidentificacion'";

    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        $tipo = BuscarValorParametro2($row['id_tipoIdentificacion']);
        $row['id_tipoIdentificacion'] = $tipo['valor'];

        return $row;
    } else {
        return FALSE;
    }
}

/*
 * CON ESTA FUNCION VALIDO QUE SOLO SE INGRESEN LETRAS DONDE CORRESPONDE 
 */

function solo_letras($cadena) {
    $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ";
    for ($i = 0; $i < strlen($cadena); $i++) {
        if (strpos($permitidos, substr($cadena, $i, 1)) === false) {
//no es válido; 
            return false;
        }
    }
//si estoy aqui es que todos los caracteres son validos 
    return true;
}

// me trae todos los visitantes registrados
function mostrarVisitantes() {
    include'../model/config.php';

    $usuarios = array();
    $query = "SELECT o.nombre,o.Segundo_Nombre,o.Segundo_Apellido,o.apellido,o.correo,o.celular,o.identificacion,p.valor Tipo,o.id FROM  visitantes o, `valor_parametros` p  WHERE o.id_TipoIdentificacion=p.id AND o.estado='1' ";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($usuarios, $row);
    }
    return $usuarios;
}

// me trae todos los visitantes registrados
function MostrarVisitantes2($datos) {
    include'../model/config.php';

    $visitantes = array();

    $query = "SELECT CONCAT(o.nombre,' ',o.Segundo_Nombre,' ',o.apellido,' ',o.Segundo_Apellido) persona,o.correo,o.celular,o.identificacion,p.valor Tipo,o.id FROM  visitantes o INNER JOIN  valor_parametros p  ON o.id_TipoIdentificacion=p.id WHERE CONCAT(o.nombre,' ',o.apellido,' ',o.Segundo_Apellido) LIKE '%$datos%' OR o.identificacion LIKE '%$datos%'";
    $resultado = mysqli_query($link, $query);
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {
            $visitantes["data"][] = $row;
        }
        return $visitantes;
    }
    mysqli_free_result($resultado);
}

/*
 * ME MUESTRA LOS VISITANTES EN EL MODULO DE EVENTOS
 */

function MostrarParticipantes($evento) {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT  CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id,p.id_evento FROM   visitantes o LEFT join participantes p ON p.id_participante=o.id AND p.id_evento='$evento' WHERE 1";
    $resultado = mysqli_query($link, $query);

    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {
            if ($row["id_evento"] == null) {
                $row["indice"] = $i;
                $i++;
                $visitantes["data"][] = $row;
            }
        }
        return $visitantes;
    }
    mysqli_free_result($resultado);
}

/*
 * ME MUESTRA LOS VISITANTES EN EL MODULO DE EVENTOS
 */

function MostrarParticipantesDepartamento2($dato) {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT  CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id FROM   visitantes o  WHERE o.identificacion LIKE '%$dato%' OR CONCAT(o.nombre, ' ', o.Segundo_nombre)  LIKE '%$dato%' OR  CONCAT(o.apellido, ' ', o.Segundo_apellido) Like '%$dato%' ";
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

function MostrarParticipantesDepartamento() {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT  CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id FROM   visitantes o  WHERE 1";
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

/*
 * ME MUESTRA LOS PARTICIPANTES POR UN EVENRO EN ESPECIFICO
 */

function MostrarParticipantesEvento($evento) {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id,`Hora_Ingreso`,P.id participanteid,vp.valor tipo_participante,p.`placa_vehiculo`,p.`acompanantes`  FROM `participantes` p INNER JOIN visitantes o INNER JOIN valor_parametros vp  WHERE p.`id_participante`=o.id AND p.`id_evento`='$evento' AND vp.id=p.`tipo_participante`";
    $resultado = mysqli_query($link, $query);

    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {
            if ($row["placa_vehiculo"] == "------") {
                $row["indice"] = $i;
            } else {
                $row["indice"] = '<span  style="font-weight:bold; color:#990000" title="Placa: ' . $row["placa_vehiculo"] . ' Acompañantes: ' . $row["acompanantes"] . '" data-toggle="popover" data-trigger="hover">' . $i . '</span>';
            }
            $i++;
            $visitantes["data"][] = $row;
        }
        return $visitantes;
    }
    mysqli_free_result($resultado);
}

function MostrarParticipantesDepartamentoVisita($departamento,$persona) {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    if ($persona!=-1) {
        $query = "SELECT CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id,d.`HoraEntrada`,d.`HoraSalida`,d.Id,d.placa_visitante,d.Acompanantes FROM `visitantes_departamento` d INNER JOIN visitantes o on o.id=d.`Id_Visitantes` WHERE o.identificacion='$persona' AND DATE_FORMAT(`HoraEntrada`,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')";
    }else{
        $query = "SELECT CONCAT(o.apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.nombre, ' ', o.Segundo_nombre)nombres,o.identificacion,o.id,d.`HoraEntrada`,d.`HoraSalida`,d.Id,d.placa_visitante,d.Acompanantes FROM `visitantes_departamento` d INNER JOIN visitantes o on o.id=d.`Id_Visitantes` WHERE d.`Id_Departamento`='$departamento' AND DATE_FORMAT(`HoraEntrada`,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')";
    }
   
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

/*
 * ME MUESTRA LAS VISITAS QUE TIENE UN VISITANTE EN ESPECIFICO
 */

function buscarVisitasPorVisitante($idVisitante) {
    include '../model/config.php';
    require_once './Parametros.php';
    $visitas = array();
    $query = "SELECT v.`HoraEntrada`,v.`HoraSalida`,v.`DuracionVisita`,v.`Id_EstadoVisita`,p.valor,v.`NumAcompanantes`,o.nombre,o.apellido,o.identificacion FROM `visitas` v, valor_parametros p,visitados o WHERE v.`Id_Visitado`=o.id AND v.`Id_Visitante`='$idVisitante' AND P.id=`Id_TipoIngreso`";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        $estado = BuscarValorParametro3($row['Id_EstadoVisita']);
        $row['Id_EstadoVisita'] = $estado['valor'];
        array_push($visitas, $row);
    }
    return $visitas;
}

/*
 * ME MUESTRA LAS VISITAS QUE TIENE UN VISITANTE EN ESPECIFICO
 */

function buscarVisitasPorVisitante2($idVisitante) {

    include '../model/config.php';
    require_once './Parametros.php';
    $visitas = array();

    $query = "SELECT v.`HoraEntrada`,v.`HoraSalida`,v.`DuracionVisita`,p1.valor TipoVisita,p.valor EstadoVisita,v.`NumAcompanantes`,CONCAT(o.nombre, ' ', o.Segundo_Nombre,' ',o.apellido, ' ', o.Segundo_Apellido) nombrevisitado,o.Identificacion FROM visitantes_visitas vv INNER JOIN visitas v ON V.Id=VV.Id_Visita INNER JOIN visitados o ON V.Id_Visitado=o.Id INNER JOIN valor_parametros p ON p.id_aux=v.Id_EstadoVisita INNER JOIN valor_parametros p1 ON p1.id=v.Id_TipoIngreso WHERE vv.`Id_Visitantes`='$idVisitante'";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {

            $row['indice'] = $i;
            $i++;
            $visitas["data"][] = $row;
        }
        return $visitas;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION BUSCO A UN VISITANTE POR SU NOMBRE COMPLETO
 */

function buscarVisitanteNombreCompleto($nombre, $apellido) {
    include '../model/config.php';
    require_once './Parametros.php';
    $visitantes = array();
    if ((empty($nombre) || ctype_space($nombre)) && (!empty($apellido) && !ctype_space($apellido))) {
        $query = "SELECT * FROM `visitantes` WHERE CONCAT(apellido, ' ', Segundo_apellido) LIKE '$apellido' AND estado='1'";
        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitantes, $row);
        }
        return $visitantes;
    } ELSE if ((!empty($nombre) && !ctype_space($nombre)) && (empty($apellido) || ctype_space($apellido))) {
        $query = "SELECT * FROM `visitantes` WHERE CONCAT(nombre, ' ', Segundo_Nombre) LIKE '$nombre' AND estado='1'";
        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitantes, $row);
        }
        return $visitantes;
    } else if ((!empty($nombre) && !ctype_space($nombre)) && (!empty($apellido) && !ctype_space($apellido))) {
        $query = "SELECT * FROM `visitantes` WHERE CONCAT(nombre, ' ', Segundo_Nombre) like '$nombre' AND CONCAT(apellido, ' ', Segundo_apellido) LIKE '$apellido' AND estado='1'";
        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitantes, $row);
        }
        return $visitantes;
    } else {
        return 1;
    }
}

/*
 * CON ESTA FUNCION BUSCO UN VISITANTE POR SU ID
 */

function buscarVisitanteid($id) {
    include '../model/config.php';
    require_once './Parametros.php';
    $visitantes = array();
    $query = "SELECT o.foto, o.nombre,o.Segundo_Nombre,o.Segundo_Apellido,o.apellido,o.correo,o.celular,o.identificacion,p.valor tipo,p.id tipoid,o.numPlacaCarro placa,o.id FROM  visitantes o, `valor_parametros` p  WHERE o.id_TipoIdentificacion=p.id  AND o.id='$id'";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($visitantes, $row);
    }
    return $visitantes;
}

/*
 * CON ESTA FUNCION SE ELIMINA UN VISITANTE
 */

function EliminarVisitante($id) {
    include '../model/config.php';

    $query = "UPDATE `visitantes` SET `estado`='0' WHERE `id`='$id'";
    $resultado = mysqli_query($link, $query);
}

/*
 * ESTA FUNCION ES LA ENCARGADA DE MODIFICAR LOS DATOS DE UN VISITANTE
 */

function ModificarVisitante($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $imagen, $id, $segundoapellido, $segundonombre) {
    //Conexión
    include 'config.php';

    if (!ctype_space($nombre) && !ctype_space($apellido) && !ctype_space($celular) && !ctype_space($correo) && !ctype_space($imagen) && !ctype_space($identificacion) && !ctype_space($segundoapellido)) {
        $validarnombre = solo_letras($nombre);
        $validarapellido = solo_letras($apellido);
        if ($validarapellido == true && $validarnombre == true) {
            $existe = BuscarIdentificacionVisitante($identificacion, $tipo_identificacion);
            if ($existe == FALSE) {
                $imagen = $imagen . '.jpg';
                $query = "UPDATE `visitantes` SET `identificacion`='$identificacion',`id_tipoIdentificacion`='$tipo_identificacion',`nombre`='$nombre',`apellido`='$apellido',`celular`='$celular',`correo`='$correo',`foto`='$imagen', Segundo_Nombre='$segundonombre',Segundo_Apellido='$segundoapellido' WHERE `id`='$id'";

                $result = mysqli_query($link, $query);
                return 4;
            } else if ($existe['id'] == $id) {
                $imagen = $imagen . '.jpg';
                $query = "UPDATE `visitantes` SET `identificacion`='$identificacion',`id_tipoIdentificacion`='$tipo_identificacion',`nombre`='$nombre',`apellido`='$apellido',`celular`='$celular',`correo`='$correo',`foto`='$imagen', Segundo_Nombre='$segundonombre',Segundo_Apellido='$segundoapellido' WHERE `id`='$id'";

                $result = mysqli_query($link, $query);
                return 4;
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    } else {
        return 1;
    }
}

/*
 * Con este metodo Valido que todo los datos esten completos en los visitantes
 * se pasa como id el visitante a validar y el returna verdadero si esta correcto y falso en dado caso falten datos
 */

function ValidaCampos($id) {
    include 'config.php';
    $visitante = buscarVisitanteid($id);
    $datos = $visitante[0];

    if ($datos["correo"] == null || $datos["correo"] == "" || $datos["celular"] == null || $datos["celular"] == "" || $datos["foto"] == "" || $datos['foto'] == "Myfoto.png") {
        return false;
    }
    return $visitante;
}

/*
 * CON ESTE METODO RETIRO A UN PARTICIPANTE DE UN DEPARTAMENTO
 */

function RetirarParticopanteDepartamento($partcipante) {
    include ('config.php');
    $query = " DELETE FROM `visitantes_departamento` WHERE `Id`='$partcipante'";
    mysqli_query($link, $query);
    return 1;
}

function MostrarVisitanteUsuairo($usuario) {
    include ('config.php');
    $visitantes = array();
    $query = " SELECT `id` FROM `visitantes` WHERE `Usuario_Registra`='$usuario' ORDER BY `id` DESC LIMIT 1";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["id"];
    } else {
        return null;
    }
}

function VisitanteSinFoto($foto) {
    $nombre_fichero = '../ImagenesVisitantes/' . $foto;

    if (file_exists($nombre_fichero)) {
        return 1;
    } else {
        return 0;
    }
}

function ModificarFoto($participante) {
    include 'config.php';
    require_once './visitantesMetodos.php';
   
    $visitante = buscarVisitanteid($participante);
    $datos = $visitante[0];
   
    $jpg = base64_decode($_POST["data"]);
    $file = fopen("../ImagenesVisitantes/".$datos['foto'], "w");
    // Debe tener permiso de escritura.
    fwrite($file, $jpg);
    fclose($file);
}

function existeVisitante($id){
    include 'config.php';
    $query = "SELECT 'id' FROM 'visitantes' WHERE 'identificacion'='$id' ORDER BY 'id'";
   
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["id"];
    } else {
        return null;
    }
}
function TieneSancionesPersona($id){
    include 'config.php';
    $query = "SELECT COUNT(Id_Visitante) sanciones FROM `sanciones_usuarios` WHERE `Id_Visitante` = '$id' AND estado = '1' GROUP BY Id_Visitante";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["sanciones"];
    } else {
        return 0;
    }
}


?>
