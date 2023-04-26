<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja Mesa</title>
</head>

<body>
<?php
	
include 'conexion.php';

$nro_mesa = $_GET['nro_mesa'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE mesas SET cond_activo=0 WHERE nro_mesa='".$nro_mesa."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM mesas";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>

<a href="abm_mesas.php" class="btn-light" >Volver</a><br>	
	
	
<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	<thead>
          <th>Nro</th>
          <th>Capacidad</th>
		  <th>Sector</th>
          
    </thead>
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //muestro los registros actuales
          ?>
			
			 <?php if($filas['cond_activo']!=0){?>
          <tr>
			  
			 
              <td><?php echo $filas['nro_mesa'] ?></td>
              <td><?php echo $filas['capacidad'] ?></td>
			  <td><?php echo $filas['cod_sector'] ?></td>
              
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>