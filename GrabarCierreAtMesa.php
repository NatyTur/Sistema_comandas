<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<?php
include('conexion.php');
    $id = $_GET['id_atencion'];
	$est = $_GET['estado'];
	$sql = "UPDATE atencion_por_mesa 
	SET cod_estado_atencion= '".$est."' WHERE atencion_por_mesa.id_atencion='".$id."' ";
	mysqli_query($conexion,$sql);
	header('location:ListarAtMesas.php');
?>
</body>
</html>