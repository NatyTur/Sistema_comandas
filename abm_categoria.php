<?php

include 'conexion.php';

$query= "SELECT * FROM categorias_menu";

$resultado= mysqli_query($conn, $query); 

?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">


<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	
	<thead>
	 	
	<form>
	 <a href="AltaCategoria.php">
    <button type="button" class="btn btn-primary">ALTA CATEGORÍA</button>
	 </a>	
	<a href="MenuAdmin.html" class="btn-light" >Volver</a>
		
    	  <th>Numero</th>
          <th>Descripción</th>
          
	
    </thead>
	
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ 
          ?>
			
			<?php if($filas['cond_activo']!=0){?><!--muestra solo los registros activos-->
          <tr>
              <td><?php echo $filas['nro_categoria_menu'] ?></td>
			  <td><?php echo $filas['descrip_categoria_menu'] ?></td>
              <td>
				  <!--envía nro por el enlace-->
                  <a href="AltaCategoria.php?nro_categoria_menu=<?php echo $filas['nro_categoria_menu']?>"></a>
                  <a href="BajaCategoria.php?nro_categoria_menu=<?php echo $filas['nro_categoria_menu']?>" class="btn btn-primary">Eliminar</a>
				  <a href="ModifCategoria.php?nro_categoria_menu=<?php echo $filas['nro_categoria_menu']?>" class="btn btn-primary">Modificar</a>
              </td>
			  
          </tr>
		 <?php } ?>
          <?php }?>
		</form>
 	 </tbody>
</table>