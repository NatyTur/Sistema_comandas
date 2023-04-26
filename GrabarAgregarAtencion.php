<!doctype html>
<?php
include('conexion.php');


/*      Indico fecha y hora para ser cargados automáticamente en cada nueva atención   */

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d');
$hora = date('H:i:s ');

$id		= $_GET['id_atencion'];
$mesa	= $_GET['numero_mesa'];
$mozo	= $_GET['numero_mozo'];

	

if($id!=null && $mesa!=null && $mozo!=null ){

	
	$sql = "INSERT INTO atencion_por_mesa (id_atencion, nro_mesa,fecha_atencion,hora_atencion,nro_mozo,nro_cocinero,cdo_estado_atencion) VALUES ('$id','$mesa','$fecha','$hora','$mozo','0','1')";
	mysqli_query($conn,$sql);
	header('location:AbmAtMesas.php');
	}	
?>