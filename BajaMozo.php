<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja de menú</title>
</head>

<body>
<?php
	
include 'conexion.php';

$nro_mozo = $_GET['nro_mozo'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE mozos SET cond_activo=0 WHERE nro_mozo='".$nro_mozo."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM mozos";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>

<a href="abm_mozos.php" class="btn-light" >Volver</a><br>	
	
	
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
			  
			 
              <td><?php echo $filas['nro_mozo'] ?></td>
              <td><?php echo $filas['nya_mozo'] ?></td>
              
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>