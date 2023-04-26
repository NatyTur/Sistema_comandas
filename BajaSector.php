<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja Sector</title>
</head>

<body>
<?php
	
include 'conexion.php';

$cod_sector = $_GET['cod_sector'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE sectores SET debaja=1 WHERE cod_sector='".$cod_sector."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM sectores";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>

<a href="abm_sectores.php" class="btn-light" >Volver</a><br>	
	
	
<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	<thead>
          <th>Nro</th>
         
		  <th>Sector</th>
          
    </thead>
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //muestro los registros actuales
          ?>
			
			 <?php if($filas['debaja']!=1){?>
          <tr>
			  
			 
              <td><?php echo $filas['cod_sector'] ?></td>
              <td><?php echo $filas['descrip_sector'] ?></td>
			  
              
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>