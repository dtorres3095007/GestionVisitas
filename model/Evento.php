<?php

/*
 * POR MEDIO DE LAS VARIABLES QUE SE ENVIAN POR GET SE LLAMA A LA FUNCION QUE SE DESEA
 */

/*
 * CON ESTE LLAMADO GUARDO EL EVENTO SE LE ENVIA POR POST LOS RESPECTIVOS DATOS
 * Y SE HACE EL LLAMADO A LA FUNCION GuardarEvento
 */
if (!empty($_GET['BuscarDia'])) {
    echo json_encode(Buscar_Guardado());
}
if (!empty($_GET['guardarevento2'])) {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSalida = $_POST['horaSalida'];
    $id_eve_siru = $_POST['id'];
    $tipo = $_POST['tipo'];
    $cupo = $_POST["capacidad"];
    $exite = Buscar_id_siru($id_eve_siru);
    if ($exite == 0) {
        echo json_encode(GuardarEvento2($nombre, $ubicacion, $horaEntrada, $horaSalida, $id_eve_siru, $tipo, $cupo));
    } else {
        echo json_encode(0);
    }
}
if (!empty($_GET['guardarevento'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSalida = $_POST['horaSalida'];
    $estadoevento = 'EveReg';

    if (isset($_POST['inscripcion'])) {
        $preincripion = $_POST['inscripcion'];
    } else {
        $preincripion = "0";
    }
    $cupos = $_POST['cupos'];
    echo json_encode(GuardarEvento($nombre, $descripcion, $ubicacion, $horaEntrada, $horaSalida, $estadoevento, $cupos, $preincripion));
}
if (!empty($_GET['modificarevento'])) {
    $nombre = $_POST['nombre'];
    $estadoevento = $_POST['estadoevento'];
    $idevento = $_POST['id'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSalida = $_POST['horaSalida'];


    if (isset($_POST['inscripcion'])) {
        $preincripion = 1;
    } else {
        $preincripion = 0;
    }
    $cupos = $_POST['cupos'];


    echo json_encode(ModificarEvento($nombre, $descripcion, $ubicacion, $horaEntrada, $horaSalida, $estadoevento, $cupos, $preincripion, $idevento));
}

if (!empty($_GET['cancelar'])) {
    $idevento = $_POST['id'];
    CancelarEvento($idevento);
    echo 1;
}
/*
 * CON ESTE LLAMADO RETORNO LOS EVENTOS QUE YA ESTAN CREADOS
 */
if (!empty($_GET['guardarparticipante'])) {
    $participante = $_POST['participante'];
    $evento = $_POST['evento'];
    $placa = $_POST['placa'];
    $tipo = $_POST['tipo'];
    $acompa = $_POST['acompa'];
    echo json_encode(GuardarParticipante($evento, $participante, "-1", $placa, $acompa, $tipo));
}
/*
 * CON ESTE LLAMADO MARCO LA HORA DE ENTRADA DE UN PARTICIPANTE
 */
if (!empty($_GET['marcarentrada'])) {
    $participante = $_POST['participante'];
    $evento = $_POST['evento'];

    echo json_encode(MarcarHoraEntrada($evento, $participante));
}/*
 * CON ESTE LLAMADO RETIRO A UN PARTICIPANTE DE UN EVENTO
 */
if (!empty($_GET['retirar'])) {
    $participante = $_POST['participante'];
    echo json_encode(RetirarParticopanteEvento($participante));
}
/*
 * con este llamado muestro los eventos
 */
if (!empty($_GET['mostrar'])) {

    echo json_encode(MostrarEventos());
}
/*
 * con este llamado muestro los eventos por usuario
 */
if (!empty($_GET['mostrarusuario'])) {
    session_start();
    $Buscar = $_POST["buscar"];
    $consulta = $_POST["consulta"];
    echo json_encode(MostrarEventosUsuario($Buscar, $consulta));
}
/*
 * ESTA ES LA FUNCION GUARADR EVENTO
 * SE LE PASA POR PARAMETRO EL 
 * NOMBRE
 * DESCRIPCION
 * UBICACION 
 * HORA DE ENTRADA
 * HORA DE SALIDA 
 * ESTADO DEL EVENTO
 * SE HACEN LAS RESPECTIVAS VALIDACIONES SI TODO ESTA CORRECTO SE GUARDA EL EVENTO
 */

function GuardarEvento($nombre, $descripcion, $ubicacion, $horaEntrada, $horaSalida, $estadoevento, $cupos, $pre) {
    //me conecto a la bade de datos
    include 'config.php';
    require_once './Visita.php';
    require_once './esUsuario.php';
    session_start();

    $usuario = $_SESSION['idusuario'];
    $creacion = date("Y-m-d H:i:s");
    if ($nombre != "" && $estadoevento != "" && $descripcion != "" && $cupos != "" && $ubicacion != "" && $horaSalida != "" && $horaEntrada != "" && !ctype_space($nombre) && !ctype_space($horaSalida) && !ctype_space($horaEntrada) && !ctype_space($ubicacion) && !ctype_space($descripcion) && !ctype_space($estadoevento) && !ctype_space($cupos)) {
        $fechacorrecta = compararFecha($horaEntrada, $horaSalida);


        if ($fechacorrecta != "false" && $fechacorrecta != "false2") {

            $cruze = BuscarCruzeseventos($horaEntrada, $horaSalida, $ubicacion);
            if ($cruze == 3) {
                $existe = BuscarEventoPorNoombre($nombre);
                if (empty($existe)) {
                    $valida = solo_numeros($cupos);
                    if ($valida == false) {
                        return 7;
                    } else {
                        $query = "INSERT INTO `eventos`( `Nombre`, `Descripcion`, `Hora_Inicio`, `Hora_Fin`, `Duracion`, `Estado_evento`, `Ubicacion`,  `Cupos`, `Preinscripcion`, `Id_Usuario_Crea`, `Fecha_Creacion`) VALUES ('$nombre','$descripcion', '$horaEntrada', '$horaSalida','$fechacorrecta', '$estadoevento', '$ubicacion','$cupos','$pre','$usuario','$creacion')";
                        mysqli_query($link, $query);
                        return 3;
                    }
                } else {
                    return 5;
                }
            } else {
                return 4;
            }
        } else if ($fechacorrecta == "false") {
            return 1;
        } else if ($fechacorrecta == "false2") {
            return 6;
        }
    } else {
        return 2;
    }
}

function GuardarEvento2($nombre, $ubicacion, $horaEntrada, $horaSalida, $id, $tipo, $cupos) {
    //me conecto a la bade de datos
    include 'config.php';
    require_once './Visita.php';
    require_once './esUsuario.php';
    session_start();
    $descripcion = "Ninguna";
    $estadoevento = "EveReg";

    $usuario = "0";
    if ($tipo == "1") {
        $usuario = $_SESSION['idusuario'];
    }
    $pre = "0";
    $creacion = date("Y-m-d H:i:s");


    $fechacorrecta = compararFechaEventoModificar($horaEntrada, $horaSalida);
    $query = "INSERT INTO `eventos`( `Nombre`, `Descripcion`, `Hora_Inicio`, `Hora_Fin`, `Duracion`, `Estado_evento`, `Ubicacion`,  `Cupos`, `Preinscripcion`,`Fecha_Creacion`,id_siru,Id_Usuario_Crea) VALUES ('$nombre','$descripcion', '$horaEntrada', '$horaSalida','$fechacorrecta', '$estadoevento', '$ubicacion','$cupos','$pre','$creacion','$id','$usuario')";
    mysqli_query($link, $query);
    CambiarEstadoEnDia();
    return 5;
}

function ModificarEvento($nombre, $descripcion, $ubicacion, $horaEntrada, $horaSalida, $estadoevento, $cupos, $pre, $idEvento) {
    //me conecto a la bade de datos
    include 'config.php';
    require_once './Visita.php';
    require_once './esUsuario.php';

    session_start();
    $visitaa = BuscarEventoPorid($idEvento);
    if ($visitaa["Id_Usuario_Crea"] == $_SESSION["idusuario"] || $_SESSION["perfil"] == "Admin") {



        if ($nombre != "" && $estadoevento != "" && $descripcion != "" && $cupos != "" && $ubicacion != "" && $horaSalida != "" && $horaEntrada != "" && !ctype_space($nombre) && !ctype_space($horaSalida) && !ctype_space($horaEntrada) && !ctype_space($ubicacion) && !ctype_space($descripcion) && !ctype_space($estadoevento) && !ctype_space($cupos)) {
            $fechacorrecta = compararFechaEventoModificar($horaEntrada, $horaSalida);

            $sw = 0;
            if ($fechacorrecta != "false") {

                /*    $existe = BuscarEventoPorNoombre($nombre);
                  if ($existe["Id"] == $idEvento || empty($existe)) {
                  $sw = 1;
                  } else {
                  return 5;
                  }


                  $Visitas = MostrarEventoPorUbicaicon($ubicacion);
                  $cruze = BuscarCruzeseventos2($horaEntrada, $horaSalida, $Visitas, $idEvento);

                 */
                $sw = 1;
                $cruze = 3;

                if ($cruze == 3) {

                    if (empty($existe) || $sw == 1) {
                        $valida = solo_numeros($cupos);
                        if ($valida == false) {
                            return 7;
                        } else {
                            $query = "UPDATE `eventos` SET `Nombre`='$nombre',`Descripcion`='$descripcion',`Hora_Inicio`='$horaEntrada',`Hora_Fin`='$horaSalida',`Duracion`='$fechacorrecta',`Estado_evento`='$estadoevento',`Ubicacion`='$ubicacion',`Cupos`='$cupos',`Preinscripcion`='$pre' WHERE `Id`=$idEvento";
                            mysqli_query($link, $query);
                            return 3;
                        }
                    } else {
                        return 5;
                    }
                } else {
                    return 4;
                }
            } else if ($fechacorrecta == "false") {
                return 1;
            }
        } else {
            return 2;
        }
    } else {
        return 10;
    }
}

/*
 * ESTA FUNCION SE UTILIZA SI EXISTE ALGUN CRUZE DE EVENTOS AL MOMENTO DE CREARLOS
 */

function compararFechaEventoModificar($strStart, $strEnd) {
    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    $interval = date_diff($datetime1, $datetime2);
    $horayfecha = date("Y-m-d H:i:s");
    $datetimeactual = date_create($horayfecha);


    if ($datetime2 <= $datetime1) {
        return "false";
    } else {
        $dteStart = new DateTime($strStart);
        $dteEnd = new DateTime($strEnd);

        $dteDiff = $dteStart->diff($dteEnd);

        return $dteDiff->format("%a:%H:%I:%S ");
    }
}

function BuscarCruzeseventos($strStart, $strEnd, $idlugar) {

    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    $Visitas = MostrarEventoPorUbicaicon($idlugar);

    for ($index = 0; $index < count($Visitas); $index++) {
        $visita = $Visitas[$index];
        $datetimevisita1 = date_create($visita['Hora_Inicio']);
        $datetimevisita2 = date_create($visita['Hora_Fin']);
        if ($datetime1 >= $datetimevisita1 && $datetime1 <= $datetimevisita2) {
            return 1;
        } else if ($datetime2 >= $datetimevisita1 && $datetime2 <= $datetimevisita2) {
            return 2;
        }
    }
    return 3;
}

function BuscarCruzeseventos2($strStart, $strEnd, $eventos, $evento) {
    $suma = 0;
    $datetime1 = date_create($strStart);
    $datetime2 = date_create($strEnd);
    for ($index = 0; $index < count($eventos); $index++) {

        $eventoM = $eventos[$index];
        $datetimevisita1 = date_create($eventoM['Hora_Inicio']);
        $datetimevisita2 = date_create($eventoM['Hora_Fin']);
        if ($datetime1 >= $datetimevisita1 && $datetime1 <= $datetimevisita2) {
            $suma++;
            $id = $eventoM["Id"];
        } else if ($datetime2 >= $datetimevisita1 && $datetime2 <= $datetimevisita2) {
            $suma++;
            $id = $eventoM["Id"];
        }
    }
    if ($suma == 0) {
        return 3;
    } else {
        if ($suma == 1) {
            if ($id == $evento) {
                return 3;
            }
        }

        return 2;
    }
}

/*
 * CON ESTA FUNCION MUESTRO LOS EVENTOS POR SU UBICACION
 */

function MostrarEventoPorUbicaicon($idlugar) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT Id,`Hora_Fin`,`Hora_Inicio` FROM `eventos` WHERE `Ubicacion`='$idlugar'  AND `Estado_evento` <> 'EveCan' AND `Estado_evento` <> 'EveTer'";
    $resultado = mysqli_query($link, $query);

    while ($row = mysqli_fetch_array($resultado)) {
        array_push($eventos, $row);
    }
    return $eventos;
}

/*
 * CON ESTA FUNCION BUSCO UN EVENTO POR SU NOMBRE
 */

function BuscarEventoPorNoombre($nombre) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT * FROM `eventos` WHERE `nombre`='$nombre'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
    return $row;
}

/*
 * CON ESTA FUNCION BUSCO UN EVENTO POR SU id
 */

function BuscarEventoPorid($id) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT * FROM `eventos` WHERE `Id`='$id'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
    return $row;
}

/*
 * ESTA ES LA FUNCION QUE ME RETORNA TODOS LOS EVENTOS YA CREADOS
 */

function MostrarEventos() {
    include ('config.php');
    session_start();
    $eventos = array();
    $actualhora = date("Y-m-d H:i:s");
    $actual = date_create($actualhora);

    $query = "SELECT p.valor estado_evento,e.`Ubicacion` ubicacion,e.`nombre`,e.`Hora_Inicio`,e.`Hora_Fin`,e.`Duracion`,e.`id`,e.Cupos,e.Preinscripcion,e.Descripcion,e.Estado_evento idestado,e.Id_Usuario_Crea FROM `eventos` e INNER JOIN valor_parametros p ON e.`Estado_evento`=p.id_aux WHERE DATE_FORMAT(NOW(),'%m-%d-%Y')=DATE_FORMAT(`Hora_Inicio`,'%m-%d-%Y')
 ";
    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $indice = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $indice;

            $indice++;
            $visitahora = date_create($row["Hora_Fin"]);
            $visitahorareserva = date_create($row["Hora_Inicio"]);

            if ($row["Id_Usuario_Crea"] == $_SESSION["idusuario"] || $_SESSION["perfil"] == "UserRep") {
                $agrega = "<span data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link'></span>";
            } else {
                $agrega = "<span title='No Tiene Permisos para esta Operacion' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
            }

            if ($row["idestado"] == "EveCan") {
                $spam = "<p style='background-color:red;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                $row["estado_evento"] = $spam;
            } else if ($row["idestado"] == "EveReg") {
                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveCur");
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>En Curso</b></p>";
                    $row["estado_evento"] = $spam;
                } else if ($actual >= $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveTer");
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>Terminado</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else {
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                }
            } else if ($row["idestado"] == "EveTer") {
                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveCur");
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>En Curso</b></p>";
                    $row["estado_evento"] = $spam;
                } else if ($actual >= $visitahora) {
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else {
                    ModificarEstadoEvento($row["id"], "EveReg");
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>Registrado</b></p>";
                    $row["estado_evento"] = $spam;
                }
            } else if ($row["idestado"] == "EveCur") {
                if ($actual >= $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveTer");
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>Terminado</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else if ($actual < $visitahorareserva) {
                    ModificarEstadoEvento($row["id"], "EveReg");
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>Registrado</b></p>";
                    $row["estado_evento"] = $spam;
                } else {
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                }
            }

            if ($row["Preinscripcion"] == 0) {
                $row["Preinscripcion"] = "NO";
            } else {
                $row["Preinscripcion"] = "SI";
            }
            $row["agrega"] = $agrega;
            $total = ContarEnEvento($row["id"]);
            $row["total"] = $total;
            $eventos["data"][] = $row;
        }
        return $eventos;
    }
    mysqli_free_result($resultado);
}

function MostrarEventosUsuario($buscar, $consulta) {
    include ('config.php');

    $eventos = array();
    $actualhora = date("Y-m-d H:i:s");
    $actual = date_create($actualhora);
    if ($consulta == 1) {
        $query = "SELECT p.valor estado_evento,e.`Ubicacion` ubicacion,e.`nombre`,e.`Hora_Inicio`,e.`Hora_Fin`,e.`Duracion`,e.`id`,e.Cupos,e.Preinscripcion,e.Descripcion,e.Estado_evento idestado,e.Id_Usuario_Crea FROM `eventos` e INNER JOIN valor_parametros p ON e.`Estado_evento`=p.id_aux WHERE DATE_FORMAT('$buscar','%m-%d-%Y')=DATE_FORMAT(`Hora_Inicio`,'%m-%d-%Y')
 ";
    } else if ($consulta == 2) {
        $buscar = $_SESSION["idusuario"];
        $query = "SELECT p.valor estado_evento,e.`Ubicacion` ubicacion,e.`nombre`,e.`Hora_Inicio`,e.`Hora_Fin`,e.`Duracion`,e.`id`,e.Cupos,e.Preinscripcion,e.Descripcion,e.Estado_evento idestado,e.Id_Usuario_Crea FROM `eventos` e INNER JOIN valor_parametros p ON e.`Estado_evento`=p.id_aux WHERE Id_Usuario_Crea='$buscar'
 ";
    }

    $resultado = mysqli_query($link, $query);
    if (!$resultado) {
        die("error");
    } else {
        $indice = 1;
        while ($row = mysqli_fetch_array($resultado)) {
            $row["indice"] = $indice;
            $indice++;
            $visitahora = date_create($row["Hora_Fin"]);
            $visitahorareserva = date_create($row["Hora_Inicio"]);

            if ($row["Id_Usuario_Crea"] == $_SESSION["idusuario"] || $_SESSION["perfil"] == "Admin") {
                $agrega = "<span data-toggle='modal' data-target='#participantes'style='  color: #990000;' class='glyphicon glyphicon-user btn btn-link'></span>";
            } else {
                $agrega = "<span title='No Tiene Permisos para esta Operacion' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
            }

            if ($row["idestado"] == "EveCan") {
                $spam = "<p style='background-color:red;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                $row["estado_evento"] = $spam;
            } else if ($row["idestado"] == "EveReg") {
                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveCur");
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>En Curso</b></p>";
                    $row["estado_evento"] = $spam;
                } else if ($actual >= $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveTer");
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>Terminado</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else {
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                }
            } else if ($row["idestado"] == "EveTer") {
                if ($actual >= $visitahorareserva && $actual < $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveCur");
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>En Curso</b></p>";
                    $row["estado_evento"] = $spam;
                } else if ($actual >= $visitahora) {
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else {
                    ModificarEstadoEvento($row["id"], "EveReg");
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>Registrado</b></p>";
                    $row["estado_evento"] = $spam;
                }
            } else if ($row["idestado"] == "EveCur") {
                if ($actual >= $visitahora) {
                    ModificarEstadoEvento($row["id"], "EveTer");
                    $spam = "<p style='background-color:#00cc00;color:white;text-align: center;'><b>Terminado</b></p>";
                    $row["estado_evento"] = $spam;
                    $agrega = "<span title='El evento ya ha terminado' data-toggle='popover' data-trigger='hover' style='  color:black;' class='glyphicon glyphicon-user btn btn-link'></span>";
                } else if ($actual < $visitahorareserva) {
                    ModificarEstadoEvento($row["id"], "EveReg");
                    $spam = "<p style='background-color:#0000ff;color:white;text-align: center;'><b>Registrado</b></p>";
                    $row["estado_evento"] = $spam;
                } else {
                    $spam = "<p style='background-color:#6666ff;color:white;text-align: center;'><b>" . $row["estado_evento"] . "</b></p>";
                    $row["estado_evento"] = $spam;
                }
            }

            if ($row["Preinscripcion"] == 0) {
                $row["Preinscripcion"] = "NO";
            } else {
                $row["Preinscripcion"] = "SI";
            }
            $row["agrega"] = $agrega;
              $total = ContarEnEvento($row["id"]);
            $row["total"] = $total;
            $eventos["data"][] = $row;
        }
        return $eventos;
    }
    mysqli_free_result($resultado);
}

/*
 *  ESTE METODO ES QUIEN REGISTRA LOS VISITANTES A UN EVENTO SE PASA EL ID DEL VISITANTES Y EL ID DEL EVENTO
 * 
 */

function GuardarParticipante($evento, $participante, $extra, $placa, $acompa, $tipo) {
    include 'config.php';
    if ($extra == -1) {
        session_start();
        $usuario = $_SESSION['idusuario'];
    } else {
        $usuario = $extra;
    }

    $existe = BuscarParticipante($participante, $evento);
    $eventobuscado = BuscarEventoPorid($evento);


    $idusuarios = $_SESSION['perfil'];
    $cupos = NumeroParticipantesEnEvento($evento);
    if (!empty($existe)) {
        return 2;
    }if ($eventobuscado["Estado_evento"] == "EveCan") {
        return 7;
    } else if ($eventobuscado["Preinscripcion"] == 1) {
        if ($eventobuscado["Cupos"] > $cupos) {
            if ($eventobuscado["Id_Usuario_Crea"] == $usuario || $idusuarios == "Admin") {

                $query = " INSERT INTO `participantes`(`id_evento`, `id_participante`,`tipo_participante`, `placa_vehiculo`, `acompanantes`) VALUES ('$evento','$participante','$tipo','$placa','$acompa')";
                mysqli_query($link, $query);
                return 1;
            } else {
                return 3;
            }
        } else {
            return 4;
        }
    } else {
        $horainicio = $eventobuscado["Hora_Inicio"];
        $horafinal = $eventobuscado["Hora_Fin"];
        $horaentrada = date("Y-m-d H:i:s");

        $validahora = compararFecha2($horainicio, $horafinal, $horaentrada);
        if ($validahora == 2) {
            return 6;
        } else
        if ($eventobuscado["Cupos"] > $cupos) {
            if ($eventobuscado["Id_Usuario_Crea"] == $usuario || $idusuarios == "UserRep" || $idusuarios == "Admin") {

                $datetime1 = date_create($horainicio);
                $datetime3 = date_create($horaentrada);
                $fechaInicio = date_format($datetime1, 'Y-m-d');
                $fechaEntrada = date_format($datetime3, 'Y-m-d');
                if ($eventobuscado["Id_Usuario_Crea"] == $usuario && $idusuarios != "UserRep" && $idusuarios != "Admin") {
                    $query = "INSERT INTO `participantes`(`id_evento`, `id_participante`,`tipo_participante`, `placa_vehiculo`, `acompanantes`) VALUES ('$evento','$participante','$tipo','$placa','$acompa')";
                    mysqli_query($link, $query);
                    return 1;
                } else {
                    if ($idusuarios == "UserRep" || $idusuarios == "Admin") {
                        if ($fechaInicio == $fechaEntrada) {
                            $query = "INSERT INTO `participantes`( `id_evento`, `id_participante`, `EnEvento`, `Hora_Ingreso`,`tipo_participante`, `placa_vehiculo`, `acompanantes`) VALUES ('$evento','$participante','1','$horaentrada','$tipo','$placa','$acompa')";
                            mysqli_query($link, $query);
                            return 1;
                        } else {
                            $query = "INSERT INTO `participantes`(`id_evento`, `id_participante`,`tipo_participante`, `placa_vehiculo`, `acompanantes`) VALUES ('$evento','$participante','$tipo','$placa','$acompa')";
                            mysqli_query($link, $query);
                            return 1;
                        }
                    }
                }
            } else {
                return 3;
                ;
            }
        } else {
            return 4;
        }
    }
}

/*
 * CON ESTE METODO BUSCO UN PARTICIPANTE POR SU ID
 */

function BuscarParticipante($id, $EVENTO) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT * FROM `participantes` WHERE `id_participante`='$id' AND `id_evento`='$EVENTO'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row;
    }
    return $row;
}

/*
 * CON ESTE METODO RETIRO A UN PARTICIPANTE DE UN EVENTO
 */

function RetirarParticopanteEvento($partcipante) {
    include ('config.php');
    $query = " DELETE FROM `participantes` WHERE `id`='$partcipante'";
    mysqli_query($link, $query);
    return 1;
}

/*
 * CON ESTE METODO CUENTO EL NUMERO DE PARTICIPANTES QUE HAY EN UN EVENTO
 */

function NumeroParticipantesEnEvento($EVENTO) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT COUNT(id) total FROM `participantes` WHERE `id_evento`='$EVENTO'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row["total"];
    }
    return $row["total"];
}

/*
 * Con esta funcion modifico la hora de entrada de los participanets que ya ingresaron al evento
 */

function MarcarHoraEntrada($evento, $participante) {
    include 'config.php';
    $horaentrada = date("Y-m-d H:i:s");
    $eventobuscado = BuscarEventoPorid($evento);
    if (empty($eventobuscado)) {
        return 1;
    } else {
        $horainicio = $eventobuscado["Hora_Inicio"];
        $horafinal = $eventobuscado["Hora_Fin"];
        $validahora = compararFecha2($horainicio, $horafinal, $horaentrada);
        if ($validahora == 1) {
            return 2;
        } else if ($validahora == 2) {
            return 3;
        } else {
            $participantebuscado = BuscarParticipante($participante, $evento);
            if (empty($participantebuscado)) {
                return 4;
            } else {
                $entra = $participantebuscado["EnEvento"];
                if ($entra == 1) {
                    return 5;
                } else {
                    $query = "UPDATE `participantes` SET `EnEvento`='1',`Hora_Ingreso`='$horaentrada' WHERE `id_participante`='$participante' AND `id_evento`='$evento'";
                    mysqli_query($link, $query);
                    return 6;
                }
            }
        }
    }
}

function compararFecha2($horainicio, $horafinal, $horaentrada) {

    $datetime1 = date_create($horainicio);
    $datetime3 = date_create($horaentrada);
    $fechaInicio = date_format($datetime1, 'Y-m-d');
    $fechaEntrada = date_format($datetime3, 'Y-m-d');
    $datetime2 = date_create($horafinal);


    if ($fechaEntrada < $fechaInicio) {

        return 1;
    } else if ($datetime3 > $datetime2) {
        return 2;
    } else {
        return 3;
    }
}

function CancelarEvento($id) {
    include '../model/config.php';

    $query = "UPDATE `eventos` SET `Estado_evento`='EveCan' WHERE `Id`='$id'";
    $resultado = mysqli_query($link, $query);
}

function Buscar_Guardado() {
    include ('config.php');
    $eventos = array();

    $query = 'SELECT valor FROM `valor_parametros` WHERE `id_aux`="Guar_EV_Dia" AND idParametro="12"';
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return $row["valor"];
    }
    return 0;
}

function CambiarEstadoEnDia() {
    include '../model/config.php';
    $creacion = date("Y-m-d", strtotime("+1 day"));


    $query = "UPDATE `valor_parametros` SET valor='$creacion' WHERE `id_aux`='Guar_EV_Dia' AND idParametro=12";
    $resultado = mysqli_query($link, $query);
    return 1;
}

function Buscar_id_siru($id) {
    include ('config.php');
    $eventos = array();

    $query = "SELECT * FROM `eventos` WHERE `id_siru`='$id'";
    $resultado = mysqli_query($link, $query);

    if ($row = mysqli_fetch_array($resultado)) {
        return 1;
    }
    return 0;
}

function ModificarEstadoEvento($Idevento, $idestado) {
    include 'config.php';

    $query = "UPDATE `eventos` SET `Estado_evento` = '$idestado' WHERE `Id` = '$Idevento';";
    mysqli_query($link, $query);
    return 1;
}

function ContarEnEvento($id) {
    include ('config.php');


    $query = "SELECT COUNT(`id`) total FROM `participantes` WHERE `id_evento`='$id'";
    $resultado = mysqli_query($link, $query);
    if ($row = mysqli_fetch_array($resultado)) {
        return $row["total"];
    }
    return 0;
}

?>