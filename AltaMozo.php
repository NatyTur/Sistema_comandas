<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE LOS MOZOS</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(nro_mozo) FROM mozos LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(nro_mozo)']+1;  ?>
 
	<a href="abm_mozos.php" class="btn-light" >Volver</a><br>
	
	<fieldset>
        <legend>MOZO</legend>
		
	
      <form action="AltaMozo.php" method="GET">
			
            <label>Nro</label>
          	<input type="number" name="nro_mozo" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Nombre</label>
            <input type="text" name="nya_mozo" placeholder="Nombre y Apellido"><br>
			
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php



if(isset($_GET['nro_mozo']) && isset($_GET['nya_mozo'])){
	
	
//Variables materias
$nro_mozo = $_GET['nro_mozo'];
$mozo = $_GET['nya_mozo'];


        if($nro_mozo!=null && $mozo!=null){
        
			$sqlInsertar = "INSERT INTO mozos (nro_mozo, nya_mozo, cond_activo) VALUES ('$nro_mozo','$mozo', '1')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_mozos.php');
            
        }
}
        
?>