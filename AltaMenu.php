<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE MENÚ</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(nro_menu) FROM menues LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(nro_menu)']+1;  ?>
 
	<a href="abm_menu.php" class="btn-light" >Volver</a><br>
	
	<fieldset>
        <legend>MENU</legend>
		
	<!--con atributos como "action", se indica la ubicación del agente de procesamiento. "method" es el que determina el método utilizado para empaquetar los datos del formulario antes de enviarlos al agente de procesamiento. GET:envía los datos por la url y los podemos ver-->
		<!--input: representa los campos de entrada de datos
		    name: es el nombre del campo el cual se enviará desde el formulario al servidor.
		  	value: será el valor por defecto que tendrá el campo de texto y que le aparecerá al usuario al cargar el formulario.-->
      <form action="AltaMenu.php" method="GET">
			
            <label>Nro de menú</label>
          	<input type="number" name="nro_menu" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Nombre del menú</label>
            <input type="text" name="descrip_menu" placeholder="Descripción"><br>
			
            <label>Nro de categoría del menú</label>
            <input type="number" name="nro_cat_menu" placeholder="Categoría"><br>
		  	
		  	<label>Precio unitario</label>
            <input type="number" name="precio_unitario" placeholder="Precio"><br>
		  <!--hay que cambiarlo a float ¿como?-->
		  
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php

/* isset: corrobora que las variables no sean null*/

if(isset($_GET['nro_menu']) && isset($_GET['descrip_menu']) && isset($_GET['nro_cat_menu'])&& isset($_GET['precio_unitario'])){
	

$nro_menu = $_GET['nro_menu'];
$descrip_menu = $_GET['descrip_menu'];
$cat_menu = $_GET['nro_cat_menu'];
$p_uni = $_GET['precio_unitario'];

        if($nro_menu!=null && $descrip_menu!=null && $cat_menu!=null && $p_uni!=null){
        
			$sqlInsertar = "INSERT INTO menues (nro_menu,descrip_menu,nro_cat_menu,precio_unitario,cond_activo) VALUES ('$nro_menu','$descrip_menu','$cat_menu','$p_uni','1')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_menu.php');
            
        }
}
        
?>