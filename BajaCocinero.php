<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja de Cocinero</title>
</head>

<body>
<?php
	
include 'conexion.php';

$nro_cocinero = $_GET['nro_cocinero'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE cocineros SET cond_activo=0 WHERE nro_cocinero='".$nro_cocinero."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM cocineros";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>

<a href="abm_cocineros.php" class="btn-light" >Volver</a><br>	
	
	
<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	<thead>
          <th>Nro</th>
          <th>Nombre</th>
          
    </thead>
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //muestro los registros actuales
          ?>
			
			 <?php if($filas['cond_activo']!=0){?>
          <tr>
			  
			 
              <td><?php echo $filas['nro_cocinero'] ?></td>
              <td><?php echo $filas['nya_cocinero'] ?></td>
              
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>