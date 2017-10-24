
<?php

/*
 * POR MEDIO DEL GET SE HACEN EL LLAMDO DE LAS DISITINTAS FUNCIONES
 */

/*
 * SI EL USUARIO EN SESION CAMBIA DE PERFIL SE EJECUTA ESTE LLAMADO Y SE CAMBIA LA VARIABLE SE DE SESION PERFIL
 */
if (!empty($_GET['cambiarperfiles'])) {
    session_start();
    $perfil = $_POST['perfil'];

    $_SESSION['perfil'] = $perfil;

    $id = $_SESSION['perfil'];

    echo json_encode($id);
}
if (!empty($_GET['eliminarPerfil'])) {

    $id = $_POST['id'];

    echo json_encode(eliminarPerfilUsuario($id));
}if (!empty($_GET['validarusu'])) {
    session_start();
    $usuario = $_SESSION["usuario"];
    $contra = $_POST["contra"];
    echo json_encode(esUsuario($usuario, md5($contra)));
}
if (!empty($_GET['modicontra'])) {

    $contra = $_POST['contra'];
    $rcontra = $_POST['rcontra'];

    echo json_encode(ModificarContraseña($contra, $rcontra));
}
if (!empty($_GET['perfiles'])) {
    session_start();

    echo json_encode(BuscarPerfilesuaurio($_SESSION['idusuario']));
}
/*
 * LLAMADO AL BUSCAR USUARIO POR ID
 */
if (!empty($_GET['buscarUsuario'])) {
    $usuario = $_POST['usuario'];
    echo json_encode(verificarUsuario($usuario));
}
/*
 * BUSCAR USUARIO POR TIPO DE PERSONA IDENTIFICAICON Y TIPO DE IDENTIFICACION
 */
if (!empty($_GET['buscar2'])) {
    $tipopersona = $_POST['tipopersona'];
    $Tipoidentificacion = $_POST['idtipoidentificacion'];
    $identificacion = $_POST['identificacion'];

    if (empty($identificacion) || empty($Tipoidentificacion) || empty($Tipoidentificacion)) {
        echo 1;
    } else {
        $x = Buscarpersona($identificacion, $Tipoidentificacion, $tipopersona);
        if (empty($x)) {
            echo 2;
        } else {
            echo json_encode($x);
        }
    }
}
/*
 * CON ESTA FUNCIONBUSCO LAS PERSONA POR EL TIPO DE PERSONA Y SU ID
 * PUEDE SER UN VISITANTES O UN VISITADO
 */

function getPersonaPorId($id, $tipoPersona) {
    include ('config.php');
    $usuario = cargarUsuarioPorId($id);
    $id = $usuario['id_persona'];
    if ($tipoPersona == "tblvisitado") {
        $query = "SELECT Nombre nombre,Segundo_Nombre segundo_nombre,Apellido apellido,Segundo_Apellido segundo_apellido FROM visitados WHERE Id ='$id'";
        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {
            return $row;
        }
    } else if ($tipoPersona == 'tblvisitante') {
        $query = "SELECT nombre,Segundo_Nombre,apellido,Segundo_Apellido FROM visitantes WHERE id ='$id' ";
        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {

            return $row;
        }
    }
}

/*
 * LLAMADO A LA FUNCION DE MOSTRAR USUARIO POR SU DI ID
 */
if (!empty($_GET['cargarUsuario'])) {
    $idUsuario = $_POST['idusuario'];
    $usuario = cargarUsuarioPorId($idUsuario);
    echo json_encode($usuario);
}
/*
 * ESTE LLAMADO SE UTILIZA PARA MODIFICAR LA CONTRASEÑA DEL USUARIO Y ENVIARSELA AL CORREO
 */
if (!empty($_GET['correoPassword'])) {
    $id = $_POST['id'];
    $tipoUsuario = $_POST['tipoUsuario'];
    $correo = $_POST['correo'];
    enviarCorreo2($id, $tipoUsuario, $correo);
}
/*
 * ESTE LLAMDO MODIFICA EL NOMBRE DE USUARIO
 */
if (!empty($_GET['actualizarUsuario'])) {
    $usuario = $_POST['usuario'];
    $id = $_POST['id'];
    modificarUsuario($id, $usuario);
}
/*
 * ESTE LLAMADO BUSCO LOS PERFILES QUE EL USUARIO TIENE ASIGNADO
 */
if (!empty($_GET['perfilesusuarios'])) {
    $usuario = $_POST['idusuario'];
    echo json_encode(BuscarPerfilesuaurio2($usuario));
}
/*
 * CON ESTE LLAMADO BUSCO LOS PERFIELS QUE EL USUARIO NO TIENE ASIGNADO
 */
if (!empty($_GET['perfilesusuariossinasignar'])) {
    $usuario = $_POST['idusuario'];
    echo json_encode(BuscarPerfilesuauriosinasignar($usuario));
}
/*
 * CON ESTE LLAMADO LE ASIGNO UN PEFIL AL USUARIO
 */
if (!empty($_GET['asignar'])) {
    $usuario = $_POST['idusuario'];
    $perfil = $_POST['idperfil'];
    echo AsignarPerfilUsuario($usuario, $perfil);
}
/*
 * CON ESTE LLAMADO RETORNO EL USUARIO QUE ESTA EN SESION
 */
if (!empty($_GET['session'])) {
    session_start();
    $usuario = BuscarUsuarioporid($_SESSION['idusuario']);
    $persona = Buscarpersonaporid($usuario['id_persona'], $usuario['id_tipo_persona']);
    $persona['idusuario'] = $usuario['id'];
    $persona['usuario'] = $usuario['usuario'];
    $persona['contrasena'] = $usuario['contrasena'];
    $persona['tipo_persona'] = $usuario['id_tipo_persona'];
    $persona['id_persona'] = $usuario['id_persona'];
    echo json_encode($persona);
}
/*
 * CON ESTE LLAMADO BUSCO EL USUARIO POR SU IDENTIFICACION Y EL TIPO DE PERSONA
 */

if (!empty($_GET['buscar'])) {
    $tipopersona = $_POST['tipopersona'];
    $Tipoidentificacion = $_POST['idtipoidentificacion'];
    $identificacion = $_POST['identificacion'];

    if (empty($identificacion)) {
        echo 1;
    } else {
        $x = Buscarpersona($identificacion, $Tipoidentificacion, $tipopersona);
        if (empty($x)) {
            echo 2;
        } else {
            echo json_encode($x);
        }
    }
}
/*
 * CON ESTE LLAMDO GUARDO UN NUEVO VISITANTE EL CUAL SE REALIZA MEDIANTE LA FUNCION DE GuardarUsuario
 */
if (!empty($_GET['guardar'])) {
    $persona = $_POST['idPersona'];
    $TipoPersona = $_POST['tipo_persona'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (!ctype_space($usuario)) {
        $d = BuscarPersonaid($persona, $TipoPersona);
        if ($d == true) {
            echo 4;
        } else {
            $x = BuscarUsuario($usuario);

            if (!empty($x)) {
                echo 3;
            } else {
                $D = guardarUsuario($persona, $TipoPersona, $usuario, $contrasena);
                echo 1;
            }
        }
    } else {
        echo 2;
    }
}
/*
 * CON ESTE LLAMADO MUESTRO TODOS LOS USUARIOS
 */
if (!empty($_GET['mostrar'])) {

    echo json_encode(mostrarUsuarios());
}/*
 * CON ESTE LLAMADO MUESTRO TODOS LOS USUARIOS
 */
if (!empty($_GET['mostrar2'])) {

    echo json_encode(MostrarUsuarios2());
}/*
 * CON ESTE LLAMADO ELIMINO TODOS UN USUARIO
 */
if (!empty($_GET['eliminar'])) {
    $idUsuario = $_POST['id'];
    EliminarUsuario($idUsuario);
    echo 1;
}

function esUsuario($usuario, $contra) {

    include 'config.php';
// verifica que esten los dos campos completos.
    if ($usuario == "" || $contra == "") {
        return 1;
    }

// busqueda de los datos de usuarios para loguear.
    $query = "SELECT * FROM `usuarios` WHERE usuario='$usuario' AND estado='1'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        $password_from_db = $row ['contrasena'];
        unset($query);

// verifica que el pass enviado sea igual al pass de la db.
        if ($password_from_db == $contra) {

            $persona = Buscarpersonaporid($row['id_persona'], $row['id_tipo_persona']);
            $perfiles = BuscarPerfilesuaurio($row['id']);
            if (empty($perfiles)) {
                return 4;
            }
            if ($persona['estado'] == 0) {
                return 3;
            } $persona['idusuario'] = $row['id'];
            $persona['usuario'] = $row['usuario'];
            $persona['contrasena'] = $row['contrasena'];
            $persona['tipo_persona'] = $row['id_tipo_persona'];
            $persona['id_persona'] = $row['id_persona'];
            return $persona;
        } else
            return 2;
    }else {
        return 2;
    }
}

function esUsuario_activo($usuario,$clave) {

    include 'config.php';
    require '../Admin/ldap.php';
    header("Content-Type: text/html; charset=utf-8");

// verifica que esten los dos campos completos.
    if ($usuario == "" || $clave=="") {
        return 1;
    }
//valido que sea un usuario del ELDA
    
    $existe_elda = mailboxpowerloginrd($usuario,$clave);
    if($existe_elda == "0" || $existe_elda == ''){
        return 2;
    }else{   
// SI ES UN USUARIO DEL ELDA VALIDO QUE ESTE CREADO Y ACTIVO EN EL SOFTWARE GESTION DE VISITAS
//  busqueda de los datos de usuarios para loguear.
   
    $query = "SELECT * FROM `usuarios` WHERE usuario='$usuario'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        if ($row["estado"] == 1) {
            $persona = Buscarpersonaporid($row['id_persona'], $row['id_tipo_persona']);
            $perfiles = BuscarPerfilesuaurio($row['id']);
            if (empty($perfiles)) {
                return 4;
            }
            if ($persona['estado'] == 0) {
                return 3;
            } $persona['idusuario'] = $row['id'];
            $persona['usuario'] = $row['usuario'];
            $persona['contrasena'] = $row['contrasena'];
            $persona['tipo_persona'] = $row['id_tipo_persona'];
            $persona['id_persona'] = $row['id_persona'];
            return $persona;
        } else {
            return 5;
        }
    } else {
        return 6;
    }
    
    }
}

/*
 *  ESTE METODO ES QUIEN REGISTRA LOS USUARIOS SE PASA POR PARAMETRO EL TIPO DE PERSON, EL ID DE LA PERSONA
 * EL NOMBRE DE USUARIO Y LA CONTRASEÑA
 */

function guardarUsuario($persona, $tipopersona, $usuario, $contrasena) {
    include 'config.php';
    $query = "INSERT INTO `usuarios`( `usuario`,  `id_persona`, `id_tipo_persona`,contrasena) VALUES('" . $usuario . "','" . $persona . "','" . $tipopersona . "','" . md5($contrasena) . "')";
    mysqli_query($link, $query);
    return 1;
}

/*
 * CON ESTA FUNCION LE ASIGNO AL USUARIO UN NUEVO PERFIL
 */

function AsignarPerfilUsuario($usuario, $peril) {
    include 'config.php';
    $query = "INSERT INTO `perfiles_usuarios`(`id_perfil`, `id_usuario`) VALUES ('" . $peril . "','" . $usuario . "')";
    mysqli_query($link, $query);
    return 1;
}

/*
 * CON ESTA FUNCION BUSCO EL USAURIO POR EL NOMBRE DE USUARIO
 */

function BuscarUsuario($usuario) {
    require_once('config.php');
    $query = "SELECT * FROM `usuarios` WHERE usuario='$usuario' AND estado='1'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return $row;
    }
}

/*
 * CON ESTA FUNCION BUSCO EL USUARIO POR SU ID
 */

function BuscarUsuarioporid($id) {
    require_once('config.php');
    $query = "SELECT * FROM `usuarios` WHERE id='$id' AND estado='1'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return $row;
    }
}

/*
 * CON ESTA FUNCION VALIDO QUE EL USUARIO YA TENGA UN USUARIO ASIGNADO
 */

function BuscarPersonaid($persona, $tipo) {
    include'config.php';

    $usuarios = array();
    $query = "SELECT * FROM `usuarios` WHERE `estado`=1 AND `id_tipo_persona`='$tipo' AND `id_persona`='$persona' ";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return true;
    } return false;
}

/*
 * CON ESTA FUNCION MUESTRO TODOS LOS PERFILES QYE TIENE ASIGNADO UN USUARIO
 */

function BuscarPerfilesuaurio($usuairo) {
    include'config.php';

    $perfiles = array();
    $query = "SELECT v.valorx,v.valor,v.id,v.id_aux FROM `perfiles_usuarios` p INNER JOIN valor_parametros v ON v.id_aux=p.`id_perfil` WHERE p.`id_usuario`='$usuairo' ";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($perfiles, $row);
    } return $perfiles;
}

/*
 * CON ESTA FUNCION MUESTRO TODOS LOS PERFILES QYE TIENE ASIGNADO UN USUARIO
 */

function BuscarPerfilesuaurio2($usuairo) {
    include'config.php';
    $perfiles = array();
    $query = "SELECT v.valorx,v.valor,v.id,v.id_aux,P.id FROM `perfiles_usuarios` p INNER JOIN valor_parametros v ON v.id_aux=p.`id_perfil` WHERE p.`id_usuario`='$usuairo' ";

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $indice = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $indice;
            $indice++;
            $perfiles["data"][] = $row;
        }
        return $perfiles;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION VALIDO QUE SOLO SE PUEDAN INGRESAR LETRAS DONDE CORRESPONDE
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

function solo_numeros($cadena) {
    $permitidos = "0123456789";
    for ($i = 0; $i < strlen($cadena); $i++) {
        if (strpos($permitidos, substr($cadena, $i, 1)) === false) {
//no es válido; 
            return false;
        }
    }
//si estoy aqui es que todos los caracteres son validos 
    return true;
}

/*
 * CON ESTE METODO BUSCO AL USUARIO POR SI IDENTIFICACION Y EL TIPO DE PERSONA
 */

function Buscarpersona($identificacion, $tipoidentificacion, $tipopersona) {
    include ('config.php');


    if ($tipopersona == "tblvisitado") {
        $query = "SELECT v.`Id` id, v.`Identificacion` identificacion, v.`Nombre` nombre ,v.Segundo_Nombre,v.Segundo_Apellido ,v.`Apellido` apellido, `Correo` correo,v.`Telefono` telefono,v. `foto`, p.valor tipoidentificacion FROM `visitados` v,valor_parametros p WHERE p.id = v.`Id_TipoIdentificacion` AND v.`estado`=1 AND v.Identificacion='$identificacion' AND v.Id_TipoIdentificacion='$tipoidentificacion'";
        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {

            return $row;
        }
        return $row;
    } else if ($tipopersona == 'tblvisitante') {
        $query = "SELECT v.`id` id, v.`identificacion` identificacion, v.`nombre` nombre,v.Segundo_Nombre,v.Segundo_Apellido ,v.`apellido` apellido, `correo` correo,v.`celular` telefono,v. `foto`, p.valor tipoidentificacion FROM visitantes v,valor_parametros p WHERE p.id = v.`id_tipoIdentificacion` AND v.`estado`=1 AND v.Identificacion='$identificacion' AND v.Id_TipoIdentificacion='$tipoidentificacion'";

        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {

            return $row;
        }
        return $row;
    }
}

function Buscarperfil($id_aux) {
    include ('config.php');

    $query = "SELECT * FROM `valor_parametros` WHERE `id_aux`='$id_aux'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
    return $row;
}

/*
 * CON ESTE METODO BUSCO EL USUARIO POR SU ID DE LA PERSONA Y EL TIPO DE PERSONA
 */

function Buscarpersonaporid($id, $tipopersona) {
    include ('config.php');


    if ($tipopersona == "tblvisitado") {
        $query = "SELECT v.`Id` id, v.`Identificacion` identificacion, v.`Nombre` nombre ,v.`Apellido` apellido,v.Segundo_Nombre,v.Segundo_Apellido , `Correo` correo,v.`Telefono` telefono,v. `foto`, p.valor tipoidentificacion,v.estado FROM `visitados` v,valor_parametros p WHERE p.id = v.`Id_TipoIdentificacion` AND v.`estado`=1 AND v.Id='$id'";
        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {

            return $row;
        }
        return $row;
    } else if ($tipopersona == 'tblvisitante') {
        $query = "SELECT v.`id` id, v.`identificacion` identificacion, v.`nombre` nombre,v.Segundo_Nombre,v.Segundo_Apellido ,v.`apellido` apellido, `correo` correo,v.`celular` telefono,v. `foto`, p.valor tipoidentificacion,v.estado FROM visitantes v,valor_parametros p WHERE p.id = v.`id_tipoIdentificacion` AND v.`estado`=1 AND v.id='$id' ";

        $resultado = mysqli_query($link, $query);
        if ($row = mysqli_fetch_array($resultado)) {

            return $row;
        }
        return $row;
    }
}

/*
 * CON ESTA FUNCION ELIMINO UN USUARIO
 */

function eliminarUsuario($id) {
    include ('config.php');
    $query = "UPDATE usuarios SET estado = 0 WHERE id='$id'";
    $resultado = mysqli_query($link, $query);
}

/*
 * CON ESTA FUNCION ELIMINO UN PERFIL DE UN USUARIO
 */

function eliminarPerfilUsuario($id) {
    include ('config.php');
    $query = "DELETE FROM `perfiles_usuarios` WHERE `id`='$id'";
    $resultado = mysqli_query($link, $query);
    return 1;
}

/*
 * ESTA FUNCION ES LA ENCARGADA DE BUSCAR LOS PERFILES QUE UN USAURIO NO TIENE ASIGNADO
 */

function BuscarPerfilesuauriosinasignar($usuairo) {
    include'config.php';

    $perfiles = array();
    $query = "SELECT v.valor,U.id usuario,v.id_aux FROM valor_parametros v LEFT join  perfiles_usuarios U ON U.id_perfil=V.id_aux AND u.id_usuario='$usuairo' WHERE V.idParametro=8 ";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        if ($row['usuario'] == null) {
            array_push($perfiles, $row);
        }
    } return $perfiles;
}

/*
 *  ESTA FUNCION MUESTRA TODOS LOS USUARIOS
 */

function MostrarUsuarios2() {
    include'config.php';

    $usuarios = array();
    $query = "SELECT * FROM usuarios WHERE estado='1' ORDER BY `id_tipo_persona` ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {
            $usuarios["data"][] = $row;
        }
        return $usuarios;
    }
    mysqli_free_result($resultado);
}

function mostrarUsuarios() {
    include'config.php';

    $usuarios = array();
    $query = "SELECT * FROM usuarios WHERE estado='1' ORDER BY `id_tipo_persona` ";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        $persona = $row["id_persona"];
        if ($row["id_tipo_persona"] == 'tblvisitante') {
            $query = "SELECT v.`id` id, v.`identificacion` identificacion, CONCAT(v.nombre, ' ', v.Segundo_Nombre) nombre ,CONCAT(v.apellido, ' ',v.Segundo_Apellido) apellido, `correo` correo,v.`celular` telefono,v. `foto`, p.valor tipoidentificacion FROM visitantes v,valor_parametros p WHERE p.id = v.`id_tipoIdentificacion` AND v.`estado`=1 AND v.`id`='$persona'";
            $resultado2 = mysqli_query($link, $query);
            if ($row2 = mysqli_fetch_array($resultado2)) {
                $usuario = $row['usuario'];
                $row2["usuario"] = $usuario;
                $row2["idusuario"] = $row['id'];
                $usuarios["data"][] = $row2;
            }
        } else if ($row["id_tipo_persona"] == 'tblvisitado') {
            $query = "SELECT v.`Id` id, v.`Identificacion` identificacion,  CONCAT(v.nombre, ' ', v.Segundo_Nombre) nombre ,CONCAT(v.apellido, ' ',v.Segundo_Apellido) apellido, `Correo` correo,v.`Telefono` telefono,v. `foto`, p.valor tipoidentificacion FROM `visitados` v,valor_parametros p WHERE p.id = v.`Id_TipoIdentificacion` AND v.`estado`=1 AND v.`id`='$persona'";
            $resultado2 = mysqli_query($link, $query);
            if ($row2 = mysqli_fetch_array($resultado2)) {
                $usuario = $row['usuario'];
                $row2["usuario"] = $usuario;
                $row2["idusuario"] = $row['id'];
                $usuarios["data"][] = $row2;
            }
        }
    } return $usuarios;
}

/*
 * CON ESTA FUNCION SE GENERA UNA CONTRASEÑA NUEVA DE USUARIO
 */

function password_random($length) {
    $charset = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrrSsTtUuRrSsTtUuVvWwXxYyZz0123456789";
    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $rand = rand() % strlen($charset);
        $password .= substr($charset, $rand, 1);
    }
    return $password;
}

/*
 * CON ESTE METODO SE LE ENVIA AL CORREO LA NUEVA CONTRASEÑA DEL USUARIO
 */

function enviarCorreo2($id, $tipoUsuario, $correo) {
    require_once('config.php');
    require '../PHPMailer/PHPMailerAutoload.php';
    require_once './Parametros.php';
    $email = BuscarCorreos();

    $correoPrincipal = $email[0];
    $nuevo_password = password_random(10);
    $ecrip = md5($nuevo_password);
    $query = "UPDATE usuarios SET contrasena = '$ecrip'  WHERE id = '$id'";
    $resultado = mysqli_query($link, $query);
    $usuario = getPersonaPorId($id, $tipoUsuario);
    $nombre = $usuario['nombre'] . " " . $usuario['segundo_nombre'] . " " . $usuario['apellido'] . " " . $usuario['segundo_apellido'];
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');
//Create a new PHPMailer instance
    $mail->charSet = "UTF-8";
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
    $mail->Subject = 'Notificacion Reestablecimiento de Contraseña';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('inicio.php'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $mail->Body = 'Buen dia, Sr(a). ' . $nombre . "\r\n" . "\r\n" .
            'Se le informa que se ha reestablecido su contraseña. ' . "\r\n" . "\r\n" . 'Su Nueva Contraseña es: ' . $nuevo_password;
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
 * CON ESTE METODO MODIFICO EL NOMBRE DE USUARIO
 */

function modificarUsuario($id, $nuevo) {
    require_once('config.php');
    $query = "UPDATE usuarios SET usuario = '$nuevo'  WHERE id = '$id'";
    $resultado = mysqli_query($link, $query);
}

/*
 * CON ESTA FUNCION VALIDO QUE UN USUARIO NO ESTE ASIGNADO DOS VECES
 */

function verificarUsuario($usuario) {
    require_once('config.php');
    $query = "SELECT usuario FROM usuarios WHERE usuario ='$usuario'";
    $resultado = mysqli_query($link, $query);
    $row_cnt = mysqli_num_rows($resultado);
    if ($row_cnt > 0) {
        return 1;
    } else {
        return 2;
    }
}

/*
 * CON ESTA FUNCION MUESTRO UN USUARIOS POR SU ID
 */

function cargarUsuarioPorId($id) {
    include ('config.php');
    $query = "SELECT * FROM usuarios WHERE id ='$id'";

    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        $persona = Buscarpersonaporid($row['id_persona'], $row['id_tipo_persona']);

        $row['correo'] = $persona['correo'];
        $row['nombre'] = $persona['nombre'];
        $row['apellido'] = $persona['apellido'];
        return $row;
    }
    return null;
}

function ModificarContraseña($contra, $rcontra) {
    session_start();
    $id = $_SESSION['idusuario'];
    include ('config.php');
    if ($contra === $rcontra) {

        $ecrip = md5($contra);
        $query = "UPDATE usuarios SET contrasena = '$ecrip'  WHERE id = '$id'";
        $resultado = mysqli_query($link, $query);
        return 1;
    } else {
        return 2;
    }
}

?>