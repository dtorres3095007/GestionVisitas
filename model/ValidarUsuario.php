<?php

/*
 * POR MEDIO DE LAS VARIABLES QUE SE ENVIAN POR GET SE LLAMA A LA FUNCION QUE SE DESEA
 */

/*
 *  CON ESTE LLAMADO VALIDO EL USUARIO QUE ESTA EN SESION
 */
if (!empty($_GET['validarperfil'])) {
    session_start();
    echo json_encode($_SESSION['perfil']);
}/*
 *  CON ESTE LLAMADO CARGO EL MENU DEL USUARIO QUE ESTA EN SESSION
 */
if (!empty($_GET['menu'])) {
    session_start();
    echo json_encode(CagarMenu($_SESSION['perfil']));
}if (!empty($_GET['menu2'])) {
    session_start();
    echo json_encode(CagarMenu2($_SESSION['perfil']));
}
/*
 * CON ESTE LLAMO EL USUARIO SE LOGEA EN EL SISTEMA Y SE INSTANCIA LAS VARIABLES DE SESION
 * SE PASA POR POST EL USUARIO Y LA CONTRASEÑA DEL FORMULARIO DE LOGEO
 */
if (!empty($_GET['logear'])) {
    session_start();
    require_once './esUsuario.php';
    require_once './Parametros.php';
    $usuario = $_POST['usuario'];
    $contra = $_POST['contrasena'];
    $integracion = Tipo_logeo();
    if ($integracion == 0) {
        $arrUsuario = esUsuario($usuario, md5($contra));
    } else {
        $arrUsuario = esUsuario_activo($usuario,$contra); 
    }


    if ($arrUsuario != 1 && $arrUsuario != 2 && $arrUsuario != 3 && $arrUsuario!=6) {
        $_SESSION['usuario'] = $arrUsuario['usuario'];
        $_SESSION['contrasena'] = $arrUsuario['contrasena'];
        $_SESSION['nombre'] = $arrUsuario['nombre'];
        $_SESSION['apellido'] = $arrUsuario['apellido'];
        $_SESSION['correo'] = $arrUsuario['correo'];
        $_SESSION['id'] = $arrUsuario['id'];
        $_SESSION['id_persona'] = $arrUsuario['id'];
        $_SESSION['idusuario'] = $arrUsuario['idusuario'];
        $_SESSION['idpersona'] = $arrUsuario['id_persona'];
        $_SESSION['foto'] = $arrUsuario['foto'];
        $_SESSION['tipo_persona'] = $arrUsuario['tipo_persona'];
        $perfiles = BuscarPerfilesuaurio($arrUsuario['idusuario']);
        if (!empty($perfiles)) {

            $p = $perfiles[0];
            $_SESSION['perfil'] = $p['id_aux'];
            $_SESSION['idperfil'] = $p['id'];
            $arrUsuario['perfil'] = $_SESSION['perfil'];
        }
    }

    echo json_encode($arrUsuario);
}

/*
 * CON ESTE LLAMADO VALIDO QUE EL USUARIO ESTE AUN EN SESION
 * SI NO ESTA EN SESION RETORNA 1 Y SE SALE DEL SISTEMA
 */
if (!empty($_GET['validarinicio'])) {
    session_start();
    $inicio = validar();
    if ($inicio == null || $inicio == false) {
        echo 1;
    } else {
        json_encode($inicio);
    }
}

if (!empty($_GET['validar'])) {
    session_start();
    $vali = validar();
    if ($vali == null || $vali == false) {
        echo 1;
    } else {
        echo json_encode($vali);
    }
}

/*
 * CON ESTA FUNCION SE VALIDA EL USUARIO QUE ESTA EN SESION 
 */

function validar() {

    include 'config.php';
    require_once 'esUsuario.php';

    if (!empty($_SESSION['usuario']) && !empty($_SESSION['contrasena'])) {
        $arrUsuario = esUsuario($_SESSION['usuario'], $_SESSION['contrasena']);
        if ($arrUsuario == "1") {
            return false;
        } else {
            return $arrUsuario;
        }
    } else {
        return null;
    }
}

function CagarMenu($id) {
    include'../model/config.php';

    $menu = array();
    $query = "SELECT v.valor,v.id_aux,v.valory FROM `valor_parametros` v INNER JOIN actividades_por_perfil a ON a.id_actividad=v.id_aux  WHERE `id_perfil`='$id'";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($menu, $row);
    } return $menu;
}

function CagarMenu2($id) {
    include'../model/config.php';

    $menu = array();
    $query = "SELECT v.valor,v.id_aux,v.valory FROM `valor_parametros` v INNER JOIN actividades_por_perfil a ON a.id_actividad=v.id_aux  WHERE `id_perfil`='$id'";

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {
            $fila = ' <tr> <td> <a onclick="saluda()" href="../modulos/' . $row["id_aux"] . '.php?cerrar=yes" target="ventana"><span style="color: #990000;" class="' . $row["valory"] . '" ></span><span>' . $row["valor"] . '</span></a></td></tr>';
            $row["indice"] = $fila;
            $visita["data"][] = $row;
        }
        return $visita;
    }
    mysqli_free_result($resultado);
}

?>
