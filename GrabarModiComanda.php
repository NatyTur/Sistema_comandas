<!doctype html>
<?php
include('conexion.php');
	
    $id		= $_GET['id_atencion'];
	$menu_original = $_GET['menu_original'];
	$menu	= $_GET['menu'];
	$cant	= $_GET['cantidad'];

	

if($id!=null && $menu!=null && $cant!=null ){

	$sql = "UPDATE comandas SET nro_menu='".$menu."',cantidad_pedida='".$cant."'WHERE id_atencion='".$id."' && nro_menu='".$menu_original."' ";
	mysqli_query($conn,$sql);
	header('location:AbmAtMesas.php');
	}	
?>