<?php

//header("Cache-Control: no-cache, must-revalidate");
/*
 * POR MEDIO DE LAS VARIABLES QUE SE ENVIAN POR GET SE LLAMA A LA FUNCION QUE SE DESEA
 */
//Llamo al metodo ModificarPermisos 

/*
 * CON ESTE LLAMADO SE VALIDA SE SE DEA NOTIFICAR LAS VISITAS TERMINADAS
 */
if (!empty($_GET['notifica'])) {
    echo json_encode(SeNotifica());
}
if (!empty($_GET['marcarsalida'])) {
    $participante = $_POST['participante'];


    echo json_encode(MarcarHoraSalida($participante));
}

if (!empty($_GET['subirarchivo'])) {

    $nombre_archivo = $_FILES["file"]['name'];
    $ruta = $_POST["ruta"];
    move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . "/" . $nombre_archivo);
    return 1;
}

/*
 * CON ESTE LLAMADO AGREGO UN VISITANTE A UN DEPARTAMENTO
 */
if (!empty($_GET['guardarparticipantedepartamento'])) {
    $participante = $_POST['participante'];
    $departamento = $_POST['departamento'];
    $placa = $_POST['placa'];
    $acompa = $_POST['acompa'];
    if (empty($acompa)) {
        $acompa = 0;
    }
    echo json_encode(GuardarParticipanteDepartamento($departamento, $participante, $placa, $acompa));
}
if (!empty($_GET['cargarValorParametro'])) {
    $id = $_POST['id'];
    echo json_encode(getValorParametro($id));
}
if (!empty($_GET['modificarValorParametro'])) {
    $id = $_POST['id'];
    $valor = $_POST['valor'];
    $valorx = $_POST['valorx'];
    $id_aux = $_POST['id_aux'];
    $idparametro = $_POST["idparametro"];
    if (isset($_POST['valorx'])) {
        $valorx = $_POST['valorx'];
    } else {
        $valorx = null;
    }
    if (isset($_POST['id_aux'])) {
        $id_aux = $_POST['id_aux'];
    } else {
        $id_aux = null;
    }
    echo json_encode(modificarValorParametro($id, $valor, $valorx, $id_aux, $idparametro));
}
if (!empty($_GET['ModificarPermiso'])) {
    $id = $_POST['id'];
    $valor = $_POST['valor'];
    $operacion = $_POST['operacion'];
    echo json_encode(ModificarPermisoPerfil($id, $valor, $operacion));
}
if (!empty($_GET['Modificaricono'])) {
    $id = $_POST['id'];
    $icono = $_POST['icono'];

    echo json_encode(ModificarIcono($id, $icono));
}
if (!empty($_GET['BuscarNombreParametro'])) {
    $nombre = $_POST['nombre'];


    echo json_encode(BuscarValorParametro(3, $nombre));
}



if (!empty($_GET['BuscarPermisosActi_per'])) {
    session_start();
    $actividad = $_POST['actividad'];

    echo json_encode(BuscarPermisosActividadPerfil($actividad, $_SESSION["perfil"]));
}
if (!empty($_GET['menutabla'])) {
    session_start();
    echo json_encode(CagarMenutabla());
}
//Llamo al metodo GuardarParmetro 
if (!empty($_GET['GuardarPermiso'])) {
    $perfil = $_POST['perfil'];
    $actividad = $_POST['actividad'];
    echo json_encode(GuardarPermisoPerfil($perfil, $actividad));
}
//Llamo al metodo Guardaractividadesporusuario
if (!empty($_GET['GuardarParametro'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    echo GuardarParametro($nombre, $descripcion);
}
//Llamo al metodo Guardar Valor Parmetro
if (!empty($_GET['GuardarValorParametro'])) {
    $idParametro = $_POST['idParametro'];
    $valor = $_POST['valor'];

    if (isset($_POST['valorx'])) {
        $valorx = $_POST['valorx'];
    } else {
        $valorx = null;
    }
    if (isset($_POST['id_aux'])) {
        $id_aux = $_POST['id_aux'];
    } else {
        $id_aux = null;
    }
    if (isset($_POST['empresa'])) {
        if (!empty($_POST['empresa'])) {
            $id_aux = $_POST['empresa'];
        }
    }

    echo GuardarValorParametro($idParametro, $valor, $valorx, $id_aux);
}

if (!empty($_GET['eliminar'])) {
    $idParametro = $_POST['id'];
    EliminarValorParameto($idParametro);
    echo 1;
}
if (!empty($_GET['eliminarActividad'])) {
    $idParametro = $_POST['id'];
    EliminarActividad($idParametro);
    echo 1;
}
if (!empty($_GET['mostrartiposusuarios'])) {

    echo json_encode(BuscarTiposPerfiles2());
}
if (!empty($_GET['mostrarPerfiles'])) {

    echo json_encode(BuscarTiposPerfiles());
}if (!empty($_GET['traerrutas'])) {

    echo json_encode(BuscarTiposRutas());
}
if (!empty($_GET['mostraractividades'])) {
    $actividad = $_POST['id'];
    echo json_encode(Buscaractividadesasignar($actividad));
}
if (!empty($_GET['mostraractividadesasignadas'])) {
    $actividad = $_POST['id'];
    echo json_encode(Buscaractividades($actividad));
}
if (!empty($_GET['estadoeventos'])) {

    echo json_encode(BuscarEstadosEventos());
}
if (!empty($_GET['mostrarparti'])) {

    echo json_encode(BuscarTiposPart());
}

if (!empty($_GET['mostrarPersonas'])) {

    echo json_encode(BuscarTiposPersonas());
}
if (!empty($_GET['mostrarParametro2'])) {

    echo json_encode(MostrarParametros());
}
//Llamo al metodo Mostrar Parametros
if (!empty($_GET['mostrarParametro'])) {

    echo json_encode(MostrarParametros2());
}//Llamo al metodo Mostrar valor Parametros y le paso el id
if (!empty($_GET['mostrarvalor'])) {
    $idParametro = $_POST['data'];
    echo json_encode(mostrarValorParametro2($idParametro));
}//Llamo al metodo que me trae cargos por id
if (!empty($_GET['mostrarcargos'])) {

    echo json_encode(BuscarTiposCargos());
}//Llamo al metodo que me trae los diferentes tipos de id
if (!empty($_GET['mostrarDepartamen'])) {

    echo json_encode(BuscarTiposDepartamentos());
}
//Llamo al metodo que me trae los diferentes tipos de id
if (!empty($_GET['mostrarDepartamen2'])) {
    $idParametro = $_POST['empresa'];
    echo json_encode(mostrarDepartamentos($idParametro));
}
//Llamo al metodo que me trae los diferentes tipos de id
if (!empty($_GET['mostrarTiposIdentificacion'])) {

    echo json_encode(BuscarTiposIdentificacion());
}//Llamo al metodo que me trae los diferentes tipos de visitas
if (!empty($_GET['mostrarTiposVisitas'])) {

    echo json_encode(BuscarTipoIngreso());
}if (!empty($_GET['mostrarempresas'])) {

    echo json_encode(BuscarEmpresas());
}//Llamo al metodo que me trae los diferentes tipos de departamentos
if (!empty($_GET['mostrarDepartamentos'])) {

    echo json_encode(BuscarDepartamentos());
}//Llamo al metodo que me trae los diferentes estados de visitas
if (!empty($_GET['mostrarEstadosVisitas'])) {

    echo json_encode(BuscarTiposEstadoVisitas());
}

//               FIN     METODOS PARAMETROS
//
//
//Este metodo me Guarada los parametros que manejara el sistema
function GuardarParametro($nombre, $descripcion) {
    //me conecto a la bade de datos
    include 'config.php';

    //Valido que los campos no esten vacios
    if (empty($nombre) || empty($descripcion) || ctype_space($nombre) || ctype_space($descripcion)) {
        return 1;
    } else {
        //Busco si el nombre ingresado existe
        $existe = BuscarNombre($nombre);
        if ($existe == false) {
            //si todo esta completo y no existe el nombrre guardo
            $query = "INSERT INTO `parametros`(`nombre`, `descripcion`) VALUES ('$nombre','$descripcion')";
            mysqli_query($link, $query);
            return 2;
        } else {
            // si existe no guardo
            return 3;
        }
    }
}

function GuardarPermisoPerfil($perfil, $actividad) {
    //me conecto a la bade de datos
    include 'config.php';

    //Valido que los campos no esten vacios
    if (empty($perfil) || empty($actividad) || ctype_space($perfil) || ctype_space($actividad)) {
        return 1;
    } else {
        $query = "INSERT INTO `actividades_por_perfil`(`id_perfil`,`id_actividad`) VALUES('$perfil','$actividad')";
        mysqli_query($link, $query);
        return 2;
    }
}

// Este Metodo Muetsra los parametros Creados
function MostrarParametros() {
    include ('config.php');
    $Parametros = array();
    $query = "SELECT * FROM `parametros` WHERE estado='1' ORDER BY nombre DESC";
    $resultado = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($Parametros, $row);
    }
    return $Parametros;
}

/*
 * CON ESTE METODO ELIMINO UN PARAMETRO Y LE PASO EL ID DEL QUE SE V A ELIMINAR
 */

function EliminarValorParameto($id) {
    include '../model/config.php';

    $query = "UPDATE `valor_parametros` SET `estado`='0' WHERE `id`='$id'";
    $resultado = mysqli_query($link, $query);
}

function EliminarActividad($id) {
    include '../model/config.php';

    $query = "DELETE FROM `actividades_por_perfil` WHERE `id`='$id'";
    $resultado = mysqli_query($link, $query);
}

function ModificarIcono($id, $icono) {
    include '../model/config.php';

    $query = " UPDATE `valor_parametros` SET  `valory`='$icono' WHERE `id`='$id' AND `idParametro`=11 ";
    $resultado = mysqli_query($link, $query);
    return 1;
}

/*
 * CON ESTA FUNCION MUESTRO LOS PARAMETROS
 */

function MostrarParametros2() {
    include ('config.php');

    $parametros = array();
    $query = "SELECT * FROM `parametros` WHERE estado='1' ORDER BY nombre DESC";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;
            $i++;
            $parametros["data"][] = $row;
        }
        return $parametros;
    }
    mysqli_free_result($resultado);
}

//este metodo me busca un parametro por el nombre si existe me retorna el parametro
function BuscarNombre($nombre) {
    include ('config.php');
    $query = "SELECT * FROM `parametros` WHERE nombre='$nombre' ";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return false;
    }
}

//                 FIN   METODOS PARAMETROS
//
//
//                 INICIO   METODOS VALOR PARAMETROS
//
//
function GuardarValorParametro($idParametro, $valor, $valorx, $id_aux) {
    //me conecto a la bade de datos
    include 'config.php';
    require_once './esUsuario.php';

    if (!empty($id_aux) || $id_aux != null) {
        if (ctype_space($id_aux)) {
            return 1;
        } else {
            if ($idParametro != 3) {
                $buscar = BuscarIdaxuParametro($id_aux);
                if ($buscar != false) {
                    return 4;
                }
            }
        }
    }
    //Valido que los campos no esten vacios
    if (empty($valor) || empty($idParametro) || ctype_space($idParametro) || ctype_space($valor) || empty($valorx) || ctype_space($valorx)) {

        return 1;
    } else {
        //Busco si el nombre ingresado existe
        $existe = BuscarValorParametro($idParametro, $valor);
        if ($existe == false) {
            if ($idParametro == 12 && $id_aux == "LimVisita") {
                $solonumero = solo_numeros($valor);
                if ($solonumero == false) {
                    return 5;
                }
            }

            if ($idParametro == 12 && ($id_aux == 'Notifica' || $id_aux == 'Int_Elda')) {
                $se = 0;
                if (strcasecmp($valor, "si") == 0) {
                    $se = 1;
                } else if (strcasecmp($valor, "no") == 0) {
                    $se = 1;
                }
                if ($se == 0) {
                    return 6;
                }
            }
            //si todo esta completo y no existe el nombrre guardo
            $query = "INSERT INTO `valor_parametros`( `idParametro`, `valor`, `valorx`,id_aux) VALUES ('$idParametro','$valor','$valorx','$id_aux')";
            mysqli_query($link, $query);
            return 2;
        } else {
            // si existe no guardo
            return 3;
        }
    }
}

/*
 * CON ESTA FUNCION BUSCO EL VALOR DE UN PARAMETRO
 * SE LE PASO EL PARAMETRO Y EL VALOR QUE TIENE
 */

function BuscarValorParametro($idParametro, $valor) {
    include ('config.php');
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='$idParametro' AND valor='$valor' ";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return false;
    }
}

/*
 * CON ESTA FUNCION BUSCO UN PARAMETRO POR SU ID AUX
 */

function BuscarIdaxuParametro($idaux) {
    include ('config.php');
    $query = "SELECT * FROM `valor_parametros` WHERE id_aux='$idaux' ";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return false;
    }
}

//Este metodo me trae los diferentes cargos guardados
function BuscarTiposCargos() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='6' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

//Este metodo me trae los diferentes departamentos guardados
function BuscarTiposDepartamentos() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='3' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {

        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function BuscarTiposRutas() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='13' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {

        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function mostrarDepartamentos($id) {
    include ('config.php');

    $valorparametros = array();
    $query = "SELECT Id,valor,valorx FROM `valor_parametros` WHERE idParametro='3' AND estado='1' AND id_aux='$id' ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;

            $i++;
            $row["numvi"] = "0";
            $valorparametros["data"][] = $row;
        }
        return $valorparametros;
    }
    mysqli_free_result($resultado);
}

//Este metodo me trae los diferentes tipos de identificacion guardados
function BuscarTiposIdentificacion() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='1' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

/*
 * EN ESTA FUNCION BUSCO LOS TIPOS DE INGRESO EL CUAL EL PARAMETRO ES 2
 */

function BuscarTipoIngreso() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='2' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function BuscarEmpresas() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='14' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

/*
 * CON ESTA FUNCION BSCO LOS TIPO DE PERFILES EL CUAL EL PARAMETRO ES 8
 */

function BuscarTiposPerfiles() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='8' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function Buscaractividadesasignar($aperfil) {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT v.valor,v.id,a.id idap,v.id_aux FROM `valor_parametros` v LEFT JOIN actividades_por_perfil a ON a.id_actividad=v.`id_aux` AND a.id_perfil = '$aperfil' WHERE
 v.`idParametro`=11";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        if ($row["idap"] == null) {
            array_push($valorParametro, $row);
        }
    }
    return $valorParametro;
}

/*
 * CON ESTA FUNCION BSCO LOS TIPO DE PERFILES EL CUAL EL PARAMETRO ES 8
 */

function BuscarTiposPerfiles2() {

    include ('config.php');

    $valorparametros = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='8' AND estado='1' ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;
            $i++;
            $valorparametros["data"][] = $row;
        }
        return $valorparametros;
    }
    mysqli_free_result($resultado);
}

function Buscaractividades($id) {

    include ('config.php');

    $valorparametros = array();
    $query = "SELECT A.agrega,a.elimina,a.modifica,a.amplia,a.cambia_tabla ,v.valor,a.id FROM `valor_parametros` v INNER JOIN actividades_por_perfil a ON a.id_actividad=v.id_aux  WHERE `id_perfil`='$id'";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        $p = "";
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;
            $i++;
            if ($row['agrega'] == 0) {
                $row["agrega"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['agrega'] . ',' . '0' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ban-circle btn btn-link'></span>";
            } else {
                $row["agrega"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['agrega'] . ',' . '0' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ok btn btn-link'></span>";
            }
            if ($row['elimina'] == 0) {
                $row["elimina"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['elimina'] . ',' . '1' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ban-circle btn btn-link'></span>";
            } else {
                $row["elimina"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['elimina'] . ',' . '1' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ok btn btn-link'></span>";
            }
            if ($row['modifica'] == 0) {
                $row["modifica"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['modifica'] . ',' . '2' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ban-circle btn btn-link'></span>";
            } else {
                $row["modifica"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['modifica'] . ',' . '2' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ok btn btn-link'></span>";
            }
            if ($row['amplia'] == 0) {
                $row["amplia"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['amplia'] . ',' . '3' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ban-circle btn btn-link'></span>";
            } else {
                $row["amplia"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['amplia'] . ',' . '3' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ok btn btn-link'></span>";
            }
            if ($row['cambia_tabla'] == 0) {
                $row["cambia_tabla"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['cambia_tabla'] . ',' . '4' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ban-circle btn btn-link'></span>";
            } else {
                $row["cambia_tabla"] = "<span onclick='javascript:sombrear2(" . $row["id"] . ',' . $row['cambia_tabla'] . ',' . '4' . ");' data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-ok btn btn-link'></span>";
            }
            $valorparametros["data"][] = $row;
        }
        return $valorparametros;
    }
    mysqli_free_result($resultado);
}

function ModificarPermisoPerfil($id, $valor, $operacion) {
    //me conecto a la bade de datos
    include 'config.php';

    if ($operacion == 0) {
        if ($valor == 0) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $query = "UPDATE `actividades_por_perfil` SET `agrega`='$valor' WHERE id='$id'";
    } else if ($operacion == 1) {
        if ($valor == 0) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $query = "UPDATE `actividades_por_perfil` SET `elimina`='$valor' WHERE id='$id'";
    } else if ($operacion == 2) {
        if ($valor == 0) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $query = "UPDATE `actividades_por_perfil` SET `modifica`='$valor' WHERE id='$id'";
    } else if ($operacion == 3) {
        if ($valor == 0) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $query = "UPDATE `actividades_por_perfil` SET `amplia`='$valor' WHERE id='$id'";
    } else if ($operacion == 4) {
        if ($valor == 0) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $query = "UPDATE `actividades_por_perfil` SET `cambia_tabla`='$valor' WHERE id='$id'";
    }

    mysqli_query($link, $query);
    return 2;
}

/*
 * FUNCION BUSCAR ESTADOS DE LOS EVENTOS SE REALIZA POR EL VALOR DE 10
 */

function BuscarEstadosEventos() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='10' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function BuscarTiposPart() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='15' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

/*
 * FUNCION DE BUSCAR TIPOS DE VISITAS SE LE PASA EL VALOR DE 4
 */

function BuscarTiposEstadoVisitas() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='4' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

//Este metodo me trae un parametro en especifico

function BuscarValorParametro2($vparametro) {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE id='$vparametro' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
}

function BuscarValorParametro3($vparametro) {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE id_aux='$vparametro' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
}

//Este metodo me trae los diferentes tipos de estados que manejen las visitas
function BuscarDepartamentos() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='3' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function BuscarTiposPersonas() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='7' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function mostrarValorParametro($idparametro) {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='$idparametro' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function mostrarValorParametro2($idparametro) {
    include ('config.php');

    $valorparametros = array();
    $query = "SELECT id,valor,valorx,id_aux FROM `valor_parametros` WHERE idParametro='$idparametro' AND estado='1' ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;

            $i++;
            $valorparametros["data"][] = $row;
        }
        return $valorparametros;
    }
    mysqli_free_result($resultado);
}

function BuscarCorreos() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='9' AND estado='1' ";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($valorParametro, $row);
    }
    return $valorParametro;
}

function TraerLimiteHora() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='12' AND estado='1' AND `id_aux`='LimVisita'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row['valor'];
    }
    return 1;
}

function SeNotifica() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='12' AND estado='1' AND `id_aux`='Notifica'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        $valor = $row['valor'];
        if (strcasecmp($valor, "si") == 0) {
            return 1;
        } else if (strcasecmp($valor, "no") == 0) {
            return 0;
        }
    }
    return 0;
}

function Tipo_logeo() {
    include ('config.php');
    $valorParametro = array();
    $query = "SELECT * FROM `valor_parametros` WHERE idParametro='12' AND estado='1' AND `id_aux`='Int_Elda'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        $valor = $row['valor'];
        if (strcasecmp($valor, "si") == 0) {
            return 1;
        } else if (strcasecmp($valor, "no") == 0) {
            return 0;
        }
    }
    return 0;
}

function CagarMenutabla() {
    include ('config.php');
    $valorparametros = array();
    $query = "SELECT `id`,`valor`,`valorx`,`valory` FROM `valor_parametros` WHERE `idParametro`=11";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $i = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $i;
            $row["valory"] = "<span style='color: #990000;' class='" . $row["valory"] . "'></span>";

            $i++;
            $valorparametros["data"][] = $row;
        }
        return $valorparametros;
    }
    mysqli_free_result($resultado);
}

function BuscarPermisosActividadPerfil($actividad, $perfil) {
    include ('config.php');

    $query = "SELECT * FROM `actividades_por_perfil` WHERE `id_perfil`='$perfil' AND `id_actividad`='$actividad'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
}

function getValorParametro($id) {
    include ('config.php');
    $query = "SELECT idParametro, id_aux, valor, valorx FROM valor_parametros WHERE id=$id";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    } else {
        return null;
    }
}

function modificarValorParametro($id, $valor, $valorx, $id_aux, $idParametro) {
    include ('config.php');
    require_once './esUsuario.php';
    if (!empty($id_aux) || $id_aux != null) {
        if (ctype_space($id_aux)) {
            return 1;
        }
    }
    //Valido que los campos no esten vacios
    if (empty($valor) || empty($idParametro) || ctype_space($idParametro) || ctype_space($valor) || empty($valorx) || ctype_space($valorx)) {
        return 1;
    } else {

        //Busco si el nombre ingresado existe
        if ($idParametro == 12) {
            $existe = false;
        } else {
            $existe = BuscarValorParametro($idParametro, $valor);
        }
        if ($existe == false || $existe["id"] == $id) {
            if ($idParametro == 12 && $id_aux == "LimVisita") {
                $solonumero = solo_numeros($valor);
                if ($solonumero == false) {
                    return 5;
                }
            }

            if ($idParametro == 12 && ($id_aux == 'Notifica' || $id_aux == 'Int_Elda')) {
                $se = 0;
                if (strcasecmp($valor, "si") == 0) {
                    $se = 1;
                } else if (strcasecmp($valor, "no") == 0) {
                    $se = 1;
                }
                if ($se == 0) {
                    return 6;
                }
            }
            //si todo esta completo y no existe el nombrre guardo
            $query = "UPDATE valor_parametros SET valor = '$valor', valorx = '$valorx', id_aux='$id_aux' WHERE  id = $id";
            $resultado = mysqli_query($link, $query);
            return 2;
        } else {
            // si existe no guardo
            return 3;
        }
    }
}

function GuardarParticipanteDepartamento($departamento, $participante, $placa, $acompa) {

    include 'config.php';
    require_once './visitantesMetodos.php';
    $horaentrada = date("Y-m-d H:i:s");
    $visitante = buscarVisitanteid($participante);
    $tienesanciones = TieneSancionesPersona($participante);
    $datos = $visitante[0];
    //$tienefoto = VisitanteSinFoto($datos["foto"]);
    $tienefoto = 1;
    if ($tienesanciones > 0) {
        return -20;
    }
    if ($tienefoto == 1) {
        $query = "INSERT INTO `visitantes_departamento`(`Id_Visitantes`, `Id_Departamento`, `HoraEntrada`,placa_visitante,Acompanantes) VALUES ('$participante','$departamento','$horaentrada','$placa','$acompa')";
        mysqli_query($link, $query);
        //$suma = contarVisitasDepartamentoVisitante($participante);
        //return $suma;
        return 1;
    } else {
        return -1;
    }
}

function MarcarHoraSalida($participante) {
    include 'config.php';
    $Horasalida = date("Y-m-d H:i:s");
    $query = "UPDATE `visitantes_departamento` SET `HoraSalida`='$Horasalida' WHERE `Id`='$participante'";
    mysqli_query($link, $query);
    return 6;
}

function contarVisitasDepartamentoVisitante($id) {
    include ('config.php');
    $query = "select count(v.Id_Visitantes) as NumVisitas
from visitantes_departamento v INNER JOIN visitantes t on v.Id_Visitantes=t.Id WHERE v.`Id_Visitantes`=$id
group by V.Id_Visitantes
ORDER by  NumVisitas DESC";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["NumVisitas"];
    } else {
        return 0;
    }
}

function ContarEnDepartamento($id) {
    include ('config.php');


    $query = "SELECT COUNT(`Id`) total FROM visitantes_departamento WHERE`Id_Departamento` ='$id' AND DATE_FORMAT(NOW(),'%m-%d-%Y') = DATE_FORMAT(`HoraEntrada`,'%m-%d-%Y')";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["total"];
    }
    return 0;
}

?>
