<!doctype html>
<?php
include('conexion.php');
	
    $id		= $_GET['id_atencion'];
	$menu	= $_GET['menu'];
	$cant	= $_GET['cantidad'];

	

if($id!=null && $menu!=null && $cant!=null ){

	//$sql = "INSERT INTO comandas VALUES(id_atencion='".$id."',nro_menu='".$menu."',cantidad_pedida='".$cant."',debaja='0')";
	$sql = "INSERT INTO comandas (id_atencion, nro_menu, cantidad_pedida, debaja) VALUES ('".$id."', '".$menu."', '".$cant."','0')";
	mysqli_query($conn,$sql);
	header('location:AbmAtMesas.php');
	}	
?>