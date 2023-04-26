<!doctype html>
<?php

$servername = "127.0.0.1"; //o localhost
$database = "resto";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);//parametros que necesita la funcion mysql_connect para realizar la conexion


// Check connection
if (!$conn) {
    die("Falló la conexión: " . mysqli_connect_error());//Devuelve una cadena con la descripción del último error de conexión
}

?>