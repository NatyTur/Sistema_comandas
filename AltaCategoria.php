<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DETALLES DE CATEGORÍAS</title>
</head>

	<?php
include 'conexion.php';?>
	
<body>
	<?php $sql = "SELECT MAX(nro_categoria_menu) FROM categorias_menu LIMIT 1" ;//selecciono el nro más alto
    $nro = mysqli_query($conn, $sql);
    $nro_max = mysqli_fetch_assoc($nro)['MAX(nro_categoria_menu)']+1;  ?>
 
	<a href="abm_categoria.php" class="btn-light" >Volver</a><br>
		
	<fieldset>
        <legend>Categorias-Menu</legend>
		
	<!--con atributos como "action", se indica la ubicación del agente de procesamiento. "method" es el que determina el método utilizado para empaquetar los datos del formulario antes de enviarlos al agente de procesamiento. GET:envía los datos por la url y los podemos ver-->
		<!--input: representa los campos de entrada de datos
		    name: es el nombre del campo el cual se enviará desde el formulario al servidor.
		  	value: será el valor por defecto que tendrá el campo de texto y que le aparecerá al usuario al cargar el formulario.-->
      <form action="AltaCategoria.php" method="GET">
			
            <label>Nro</label>
          	<input type="number" name="nro_categoria" value= "<?php echo  $nro_max?>"readonly ><br>
			
            <label>Nombre del categoria</label>
            <input type="text" name="descrip_categoria" placeholder="Descripción"><br>
		  
            <input type="submit" value="Guardar">
			
        </form>
	
	</fieldset>
	
</body>
</html>
<?php

/* isset: corrobora que las variables no sean null*/

if(isset($_GET['nro_categoria']) && isset($_GET['descrip_categoria'])){
	
	
//Variables materias
$nro_cat = $_GET['nro_categoria'];
$descrip_cat = $_GET['descrip_categoria'];


        if($nro_cat!=null && $descrip_cat!=null){
        
			$sqlInsertar = "INSERT INTO categorias_menu (nro_categoria_menu,descrip_categoria_menu,cond_activo) VALUES ('$nro_cat','$descrip_cat', '1')";
            mysqli_query($conn,$sqlInsertar);
			header('location:abm_categoria.php');
            
        }
}
        
?>