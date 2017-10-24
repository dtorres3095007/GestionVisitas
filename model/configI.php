<?php  

	/* Inicia la sesión, función utilizada para mantener 
la sesión y variables de sesión para que no se pierdan 
sus valores al navegar a través de las páginas del sitio */
//session_start();
$server = "10.2.0.61"; 
$database = "Identidades"; //nombre de la base de datos
$username = "ide_ca"; // nombre de usuario con el que se conecta a la base de datos
$password = "CA_MySql818"; // contraseña

//Conexión
	$link = mysqli_connect($server, $username, $password, $database);

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    printf("Conexión fallida: %s\n", mysqli_connect_error());
	    exit();
	}

	/* comprobar si el servidor sigue funcionando */
	/*if (mysqli_ping($link)) {
	    printf ("¡La conexión está bien!\n");
	} else {
	    printf ("Error: %s\n", mysqli_error($link));
	}*/

	
	
	/* cerrar la conexión */
	/*mysqli_close($link);*/

date_default_timezone_set("America/Bogota");

?>