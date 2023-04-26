<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE SECTORES</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(cod_sector) FROM sectores LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(cod_sector)']+1;  ?>
 
	<a href="abm_sectores.php" class="btn-light" >Volver</a><br>
	
	<fieldset>
        <legend>SECTORES</legend>
		

      <form action="AltaSectores.php" method="GET">
			
            <label>Nro de sector</label>
          	<input type="number" name="cod_sector" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Descripción del sector</label>
            <input type="text" name="descrip_sector" placeholder="Descripción"><br>
		 
			
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php

/* isset: corrobora que las variables no sean null*/

if(isset($_GET['cod_sector']) && isset($_GET['descrip_sector'])){
	
	

$nro_sector = $_GET['cod_sector'];
$sector = $_GET['descrip_sector'];

	
        if($nro_sector!=null && $sector!=null){
        
			$sqlInsertar = "INSERT INTO sectores (cod_sector,descrip_sector,debaja) VALUES ('$nro_sector','$sector','0')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_sectores.php');
            
        }
}
        
?>