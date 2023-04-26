<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE LAS MESAS</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(nro_mesa) FROM mesas LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(nro_mesa)']+1;  ?>
 
	<a href="abm_mesas.php" class="btn-light" >Volver</a><br>
	
	<fieldset>
        <legend>MESAS</legend>
		
	<!--con atributos como "action", se indica la ubicación del agente de procesamiento. "method" es el que determina el método utilizado para empaquetar los datos del formulario antes de enviarlos al agente de procesamiento. GET:envía los datos por la url y los podemos ver-->
		<!--input: representa los campos de entrada de datos
		    name: es el nombre del campo el cual se enviará desde el formulario al servidor.
		  	value: será el valor por defecto que tendrá el campo de texto y que le aparecerá al usuario al cargar el formulario.-->
      <form action="AltaMesa.php" method="GET">
			
            <label>Nro de menú</label>
          	<input type="number" name="nro_mesa" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Nombre del menú</label>
            <input type="text" name="capacidad" placeholder="Capacidad"><br>
		  
		    <label>Nombre del menú</label>
            <input type="text" name="cod_sector" placeholder="Nro sector"><br>
			
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php



$nro_mesa = $_GET['nro_mesa'];
$capacidad = $_GET['capacidad'];
$sector = $_GET['cod_sector'];
	


        if($nro_mesa!=null && $capacidad!=null && $sector!=null){
        
			$sqlInsertar = "INSERT INTO mesas (nro_mesa,capacidad,cod_sector, cond_activo) VALUES ('$nro_mesa','$capacidad','$sector','1')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_mesas.php');
            
        }

        
?>