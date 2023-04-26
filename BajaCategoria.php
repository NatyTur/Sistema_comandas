<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Baja de categoria</title>
</head>

<body>
<?php
	
include 'conexion.php';

$nro_categoria_menu = $_GET['nro_categoria_menu'];

/*$sql = "DELETE FROM menues WHERE nro_menu='".$nro_menu."'";*/
$sql = "UPDATE categorias_menu SET cond_activo=0 WHERE nro_categoria_menu='".$nro_categoria_menu ."'";//baja lógica

mysqli_query ($conn, $sql);//realiza el query
	
$query= "SELECT * FROM categorias_menu";
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>
<a href="abm_categoria.php" class="btn-light" >Volver</a><br>
	
<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	<thead>
          <th>Categoría</th>
          <th>Descripción</th>
          
    </thead>
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //muestro los registros actuales
          ?>
			
			 <?php if($filas['cond_activo']!=0){?>
          <tr>
			  
			 
              <td><?php echo $filas['nro_categoria_menu'] ?></td>
              <td><?php echo $filas['descrip_categoria_menu'] ?></td>
              
			
          </tr>
		
		 <?php } ?>
          <?php }?>
		

	
</body>
</html>