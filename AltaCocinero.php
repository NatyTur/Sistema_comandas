<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE LOS COCINEROS</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(nro_cocinero) FROM cocineros LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(nro_cocinero)']+1;  ?>
 
	<a href="abm_cocineros.php" class="btn-light" >Volver</a><br>
	
	<fieldset>
        <legend>COCINERO</legend>
		
	
      <form action="AltaCocinero.php" method="GET">
			
            <label>Nro de cocinero</label>
          	<input type="number" name="nro_cocinero" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Nombre</label>
            <input type="text" name="nya_cocinero" placeholder="Nombre y Apellido"><br>
			
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php



if(isset($_GET['nro_cocinero']) && isset($_GET['nya_cocinero'])){
	
	
//Variables materias
$nro_cocinero = $_GET['nro_cocinero'];
$cocinero = $_GET['nya_cocinero'];


        if($nro_cocinero!=null && $cocinero!=null){
        
			$sqlInsertar = "INSERT INTO cocineros (nro_cocinero, nya_cocinero, cond_activo) VALUES ('$nro_cocinero','$cocinero', '1')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_cocineros.php');
            
        }
}
        
?>