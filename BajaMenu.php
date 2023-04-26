<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja de menú</title>
</head>

<body>
<?php
	
include 'conexion.php';

$nro_menu = $_GET['nro_menu'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE menues SET cond_activo=0 WHERE nro_menu='".$nro_menu."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM menues";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>

<a href="abm_menu.php" class="btn-light" >Volver</a><br>	
	
	
<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	<thead>
          <th>Codigo Materia</th>
          <th>Descripción</th>
          <th>Nro de Categoría</th>
		  <th>Precio unitario</th>
    </thead>
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //muestro los registros actuales
          ?>
			
			 <?php if($filas['cond_activo']!=0){?>
          <tr>
			  
			 
              <td><?php echo $filas['nro_menu'] ?></td>
              <td><?php echo $filas['descrip_menu'] ?></td>
              <td><?php echo $filas['nro_cat_menu'] ?></td>
			  <td><?php echo $filas['precio_unitario'] ?></td>
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>