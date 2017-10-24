<?php

require_once('../model/config.php');
$link = mysqli_connect("localhost","root","","GestionVisitas");

if (mysqli_connect_errno()) {
     
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
   
}else{
    echo 'bien';
}
	



?>