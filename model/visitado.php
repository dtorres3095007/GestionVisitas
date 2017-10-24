<?php

/*
 * POR MEDIO DE LAS VARIABLES QUE SE ENVIAN POR GET SE LLAMA A LA FUNCION QUE SE DESEA
 */

/*
 * ESTE LLAMADO ME RETORNA TODOS LOS VISITANTES
 */
if (!empty($_GET['mostrar'])) {
    echo json_encode(MostrarVisitados2());
}

if (!empty($_GET['mostrarVisitadosVisitas'])) {

    echo json_encode(MostrarVisitadosVisita());
}

/*
 * CON ESTE LLAMADO SE GUARDAN LSO VISITADOS SE LE ENVIAN LOS DATOS NECESARIOS como
 * NOMBRES, APELLIDOS, TIPO DE IDENTIFICACION, IDENTIFICACION, DEPARTAMENTO,CARGO,CORREO,CELULAR Y LA IMAGEN
 * LA IMAGEN SE GURDA CON EL NUMERO DE LA CEDULA
 *  Y SE LLAMA A LA FUNCION GuardarVisitado
 */
if (!empty($_GET['guardar'])) {
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $imagen = $_FILES['imagen']['name'];
    $imageFileType = pathinfo($imagen, PATHINFO_EXTENSION);
    $uploaddir = '../ImagenesVisitados/';
    $segundonombre = $_POST['segundonombre'];
    $segundoapellido = $_POST['segundoapellido'];
    $name = $identificacion . "." . $imageFileType;

    $name = "Myfoto.png";
    $sw = false;

    if (!empty($imageFileType)) {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo 5;
        } else {
            $name = $identificacion . "." . $imageFileType;
            $sw = true;
        }
    }

    $guardado = GuardarVisitado($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $name, $cargo, $departamento, $segundoapellido, $segundonombre);
    if ($guardado == 4) {
        if ($sw == true) {
            $uploadfile1 = $uploaddir . basename($name);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile1);
        }
    }
    echo $guardado;
}
/*
 * CON ESTE LLAMADO SE MODIFICA UN VISITANTE SE LE PASAN LOS DATOS MODIFICADOS 
 * SI SE CAMBIA EL NUMERO DE IDENTIFICACION SE RENOMBRA LA IMAGEN DEL VISITADO
 * LA IMAGEN ES EL UNICO DATO QUE PUEDE ESTAR VACIO YA QUE SI ESTA EN BLANCO QUEDA LA MISMA IMAGEN
 */
if (!empty($_GET['modificar'])) {
    $id = $_POST['id'];
      if ($id == -1) {
        session_start();
        $id = $_SESSION["idpersona"];
    }
    $identificacion = $_POST['identificacion'];
    $tipo_identificacion = $_POST['tipo_identificacion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];
    $departamento = $_POST['departamento'];
    $imagen = $_FILES['imagen']['name'];
    $imageFileType = pathinfo($imagen, PATHINFO_EXTENSION);
    $uploaddir = '../ImagenesVisitados/';
    $segundonombre = $_POST['segundonombre'];
    $segundoapellido = $_POST['segundoapellido'];
    $name = "";
    $sw = false;

    if (!empty($imageFileType)) {
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo 5;
        } else {
            $name = $identificacion . "." . $imageFileType;
            $sw = true;
        }
    }


    $guardado = ModificarVisitado($id, $identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $name, $cargo, $departamento, $segundoapellido, $segundonombre);
    if ($guardado == 4) {
        if ($sw == true) {
            $uploadfile1 = $uploaddir . basename($name);
            move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadfile1);
        }
    }
    header("Cache-Control: no-cache, must-revalidate");
    echo $guardado;
}
/*
 * CON ESTE LLAMADO BUSCO A UN VISITADO POR SU ID
 */
if (!empty($_GET['buscarid'])) {
    $id = $_POST['id'];
    if ($id == -1) {
        session_start();
        $id = $_SESSION["idpersona"];
    }
    echo json_encode(buscarVisitadoId($id));
}
if (!empty($_GET['buscarid2'])) {

    echo json_encode(buscarVisitadoIdseion());
}
/*
 * CON ESTE LLAMADO ELIMINO UN VISITADO SE LE PASA POR PARAMETRO EL ID DEL VISITADO A ELIMINAR
 */
if (!empty($_GET['eliminar'])) {
    $idVisitado = $_POST['id'];
    EliminarVisitado($idVisitado);
    echo 1;
}
/*
 * CON ESTE LLAMO SE BUSCA A UN VISITADO YA SEA POR EL NUMERO DE IDENTIFICACION O EL NOMBRE COMPLETO
 */
if (!empty($_GET['buscar'])) {

    $modo = $_POST['modo'];

    if ($modo == 0) {
        $tipo_identificacion = $_POST['tipo'];
        $identificacion = $_POST['identificacion'];

        if (!empty($identificacion) && !empty($tipo_identificacion) && !ctype_space($identificacion) && !ctype_space($tipo_identificacion)) {
            $x = BuscarIdentificacionVisitado($identificacion, $tipo_identificacion);
            if (empty($x)) {
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
        $x = buscarVisitadoNombreCompleto($nombre, $apellido);
        if (!empty($x)) {
            echo json_encode($x);
        } else {
            echo 2;
        }
    }
}
/*
 * ESTA FUNCION ME BUSCA A UN VISITADO POR SU NUMERO DE IDENTIFICACION Y EL TIPO DE IDENTIFICACION
 * ME RETORNA TODOS LOS DATOS DEL VISITADO SI LO ENCUENTRA SI NO RETORNA VACIO
 */

function BuscarIdentificacionVisitado($identificacion, $tipoidentificacion) {
    include ('config.php');
    require_once './Parametros.php';
    $query = "SELECT v.Id,v.Id_TipoIdentificacion,v.Nombre,v.Apellido,p.valor departamento,p.valorx ubicacion,v.cargo,v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido,v.foto FROM visitados v, valor_parametros p WHERE v.Identificacion='$identificacion' AND v.estado='1'AND v.Id_TipoIdentificacion='$tipoidentificacion' AND v.Id_Departamento=p.id AND v.estado='1'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        $cargo = BuscarValorParametro2($row['cargo']);
        $Stipoidentificacion = BuscarValorParametro2($row['Id_TipoIdentificacion']);
        $row['Id_TipoIdentificacion'] = $Stipoidentificacion['valor'];
        $row['cargo'] = $cargo['valor'];
        return $row;
    }
    return $row;
}

/*
 * CON ESTA FUNCION BUSCO A UN VISITADO YA SEA POR SU NOMBRE O APELLIDO
 * RETORNA UNA LISTA DE LOS VISITADOS QUE TIENEN LOS MISMOS NOMBRE O APELLIDOS
 */

function buscarVisitadoNombreCompleto($nombre, $apellido) {
    include ('config.php');
    $visitados = array();
    if ((empty($nombre) || ctype_space($nombre)) && (!empty($apellido) && !ctype_space($apellido))) {
        $query = "SELECT v.Id,v.Nombre,v.Apellido,p.valor departamento,p.valorx ubicacion,v.cargo,v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido FROM visitados v, valor_parametros p WHERE  CONCAT(v.Apellido, ' ', v.Segundo_apellido)  LIKE '$apellido' AND p.id=v.Id_Departamento AND V.estado='1'";

        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitados, $row);
        }
        return $visitados;
    } ELSE if ((!empty($nombre) && !ctype_space($nombre)) && (empty($apellido) || ctype_space($apellido))) {
        $query = "SELECT v.Id,v.Nombre,v.Apellido,p.valor departamento,p.valorx ubicacion,v.cargo,v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido FROM visitados v, valor_parametros p WHERE CONCAT(v.Nombre, ' ', v.Segundo_Nombre) LIKE '$nombre' AND p.id=v.Id_Departamento AND V.estado='1'";

        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitados, $row);
        }
        return $visitados;
    } else if ((!empty($nombre) && !ctype_space($nombre)) && (!empty($apellido) && !ctype_space($apellido))) {
        $query = "SELECT v.Id,v.Nombre,v.Apellido,p.valor departamento,p.valorx ubicacion,v.cargo,v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido FROM visitados v, valor_parametros p WHERE CONCAT(v.Nombre, ' ', v.Segundo_Nombre) LIKE '$nombre' AND CONCAT(v.Apellido, ' ', v.Segundo_apellido) LIKE '$apellido' AND p.id=v.Id_Departamento AND V.estado='1'";
        $resultado = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($resultado)) {
            array_push($visitados, $row);
        }
        return $visitados;
    } else {
        return 1;
    }
}

/*
 * CON ESTA FUNCION BUSCO A UN VISITADO POR SU ID
 * ME RETORNA LA INFOMACION COMPLETA SI LO ENCUENTRA SI NO RETORNA VACIO
 */

function buscarVisitadoId($id) {
    require_once './Parametros.php';
    include ('config.php');
    $query = "SELECT v.Id,v.Id_TipoIdentificacion,v.Id_TipoIdentificacion idtipoidenti,v.foto,v.Nombre,v.Apellido,p.valor departamento,p.id departamentoid,p.valorx ubicacion,v.cargo,v.cargo idcargo,v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido FROM visitados v, valor_parametros p WHERE v.estado='1'AND v.Id='$id' AND v.Id_Departamento=p.id AND v.estado='1'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        $cargo = BuscarValorParametro2($row['cargo']);
        $Stipoidentificacion = BuscarValorParametro2($row['Id_TipoIdentificacion']);
        $row['Id_TipoIdentificacion'] = $Stipoidentificacion['valor'];
        $row['cargo'] = $cargo['valor'];
        return $row;
    }
    return $row;
}

function buscarVisitadoIdseion() {
    session_start();
    $uduario = $_SESSION["idusuario"];

    include ('config.php');
    $query = "SELECT v.Id,p1.valor Id_TipoIdentificacion,v.foto,v.Nombre,v.Apellido,p.valor departamento,p.valorx ubicacion,p2.valor cargo, v.identificacion,v.correo,v.telefono,v.Segundo_Nombre,v.Segundo_Apellido   FROM  usuarios u  INNER JOIN visitados v on u.id_persona=v.`Id` INNER JOIN valor_parametros p on p.id=v.Id_Departamento INNER JOIN valor_parametros p1 ON V.Id_TipoIdentificacion=P1.id INNER JOIN valor_parametros p2 ON p2.id=v.cargo WHERE u.id='$uduario'
";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {

        return $row;
    }
    return $row;
} 
/*
 * CON ESTA FUNCION GUARDO UN VISITADO SE LE PASA LOS DATOS Y LA FUNCION VALIDA
 * QUE NO PASEN DATOS VACIOS O SE INGRESEN DATOS NUMERICOS DONDE NO CORRESPONDEN, ADEMAS VALIDA QUE EL NUMERO DE IDENTIFICACION
 * NO ESTE REGISTRADO EN EL SISTEMA
 */

function GuardarVisitado($identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $imagen, $cargo, $departamento, $segundoapellido, $segundonombre) {
    //Conexión
    include 'config.php';

    if (!ctype_space($nombre) && !ctype_space($apellido) && !ctype_space($celular) && !ctype_space($correo) && !ctype_space($identificacion) && !ctype_space($segundoapellido)) {
        $validarnombre = solo_letras($nombre);
        $validarapellido = solo_letras($apellido);
        if ($validarapellido == true && $validarnombre == true) {
            $existe = BuscarIdentificacionVisitado($identificacion, $tipo_identificacion);
            if (empty($existe)) {
                $query = "INSERT INTO `visitados`( `Identificacion`, `Nombre`, `Apellido`, `Id_Departamento`, `Correo`, `Telefono`, `Id_TipoIdentificacion`, `cargo`, `foto`,Segundo_Nombre,Segundo_Apellido) VALUES ('$identificacion','$nombre','$apellido','$departamento','$correo','$celular','$tipo_identificacion','$cargo','$imagen','$segundonombre','$segundoapellido')";
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
 * CON ESTA FUNCION MODIFICO UN VISITADO SE LE PASA LOS DATOS Y LA FUNCION VALIDA
 * QUE NO PASEN DATOS VACIOS O SE INGRESEN DATOS NUMERICOS DONDE NO CORRESPONDEN, ADEMAS VALIDA QUE EL NUMERO DE IDENTIFICACION
 * NO ESTE REGISTRADO EN EL SISTEMA
 */

function ModificarVisitado($id, $identificacion, $tipo_identificacion, $nombre, $apellido, $celular, $correo, $imagen, $cargo, $departamento, $segundoapellido, $segundonombre) {
    //Conexión
    include 'config.php';

    if (!ctype_space($nombre) && !ctype_space($apellido) && !ctype_space($celular) && !ctype_space($imagen) && !ctype_space($identificacion) && !ctype_space($segundoapellido)) {
        $validarnombre = solo_letras($nombre);
        $validarapellido = solo_letras($apellido);
        if ($validarapellido == true && $validarnombre == true) {
            $existe = BuscarIdentificacionVisitado($identificacion, $tipo_identificacion);
            if (empty($existe)) {
                if (!empty($imagen)) {
                    $query = "UPDATE `visitados` SET `Identificacion`='$identificacion',`Nombre`='$nombre',`Segundo_Nombre`='$segundonombre',`Apellido`='$apellido',`Segundo_Apellido`='$segundoapellido',`Id_Departamento`='$departamento',`Correo`='$correo',`Telefono`='$celular',`Id_TipoIdentificacion`='$tipo_identificacion',`cargo`='$cargo',`foto`='$imagen' WHERE Id='$id'";
                    $result = mysqli_query($link, $query);
                } else {
                    $query = "UPDATE `visitados` SET `Identificacion`='$identificacion',`Nombre`='$nombre',`Segundo_Nombre`='$segundonombre',`Apellido`='$apellido',`Segundo_Apellido`='$segundoapellido',`Id_Departamento`='$departamento',`Correo`='$correo',`Telefono`='$celular',`Id_TipoIdentificacion`='$tipo_identificacion',`cargo`='$cargo' WHERE Id='$id'";
                    $result = mysqli_query($link, $query);
                }

                return 4;
            } else if ($existe['Id'] == $id) {
                if (!empty($imagen)) {
                    $query = "UPDATE `visitados` SET `Identificacion`='$identificacion',`Nombre`='$nombre',`Segundo_Nombre`='$segundonombre',`Apellido`='$apellido',`Segundo_Apellido`='$segundoapellido',`Id_Departamento`='$departamento',`Correo`='$correo',`Telefono`='$celular',`Id_TipoIdentificacion`='$tipo_identificacion',`cargo`='$cargo',`foto`='$imagen' WHERE Id='$id'";
                    $result = mysqli_query($link, $query);
                } else {
                    $query = "UPDATE `visitados` SET `Identificacion`='$identificacion',`Nombre`='$nombre',`Segundo_Nombre`='$segundonombre',`Apellido`='$apellido',`Segundo_Apellido`='$segundoapellido',`Id_Departamento`='$departamento',`Correo`='$correo',`Telefono`='$celular',`Id_TipoIdentificacion`='$tipo_identificacion',`cargo`='$cargo' WHERE Id='$id'";
                    $result = mysqli_query($link, $query);
                }return 4;
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
 * CON ESTA FUNCION VALIDO QUE SOLO SE INGRESEN LETRAS EN UN CAMPO DE TEXTO
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

/*
 * ESTA FUNCION ME RETORNA TODOS LOS VISITADOS
 */

function MostrarVisitados2() {
    include'../model/config.php';
    require_once 'Parametros.php';


    $visitado = array();
    $query = "SELECT v.Id,v.Identificacion,v.Nombre,v.Apellido,v.Correo,v.Telefono,p.valor,p2.valor as  cargo ,v.`Id_Departamento`,v.foto,v.Segundo_Nombre,v.Segundo_Apellido,P1.valor AS Id_Departamento FROM `visitados` v INNER JOIN valor_parametros p ON p.id=v.`Id_TipoIdentificacion` INNER JOIN valor_parametros p1 ON `Id_Departamento`=P1.id  INNER JOIN valor_parametros p2 ON p2.id=v.`cargo` WHERE  v.estado=1 ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {

        while ($row = mysqli_fetch_array($resultado)) {

            $visitado["data"][] = $row;
        }
        return $visitado;
    }
    mysqli_free_result($resultado);
}

/*
 * CON ESTA FUNCION ELIMINO A UN VISITADO
 */

function eliminarVisitado($id) {
    include'../model/config.php';
    $query = "UPDATE `visitados` SET `estado`=0 WHERE  id='$id'";
    $resultado = mysqli_query($link, $query);
}

function MostrarVisitadosVisita() {
    include'../model/config.php';

    $visitantes = array();
    $i = 1;
    $query = "SELECT  CONCAT(o.Apellido, ' ', o.Segundo_apellido) apellidos,CONCAT(o.Nombre, ' ', o.Segundo_nombre)nombres,o.Identificacion,o.Id FROM   visitados o  WHERE 1";
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

?>