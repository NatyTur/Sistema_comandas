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
	$menu = $_GET['menu'];
	
	if($id!=null && $menu!=null){	
		
		$sql = "UPDATE comandas SET debaja= '1' WHERE id_atencion='".$id."' && nro_menu='".$menu."'";
		mysqli_query($conn,$sql);
		header('location:AbmAtMesas.php');
	}

?>
</body>
</html>