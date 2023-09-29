<?php 

global $host, $user, $pass, $database;

$host="localhost";
$user="root";
$pass="";
$database="procita";

@$link = mysqli_connect($host, $user, $pass) or die ("Conexion fallida");
mysqli_select_db($link,$database) or die ("Error al conectarse con la base de datos" .mysqli_error($link));

?>