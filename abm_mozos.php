<?php

include 'conexion.php';
//en la variable query tengo almacenada la consulta a sql
$query= "SELECT * FROM mozos";
/* Si una consulta es exitosa, mysqli_query() retornará un objeto mysqli_result.($resultado) */
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">


<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	
	<thead>
	 	
	<form>
	 <a href="AltaMozo.php">
    <button type="button" class="btn btn-primary">ALTA MOZO</button>
	 </a>	
	<a href="MenuAdmin.html" class="btn-light" >Volver</a>
		
    	  <th>Nro</th><br>
          <th>Nombre y Apellido</th>
          
	
    </thead>
	
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //Mientras la funcion pueda acceder a un registro del array, se ejecuta el while.La funcion ve línea a línea lo que hay en la variable fila(array), pero debo darle el resultado de la consulta .
          ?>
			
			<?php if($filas['cond_activo']!=0){?><!--muestra solo los registros activos-->
          <tr>
              <td><?php echo $filas['nro_mozo'] ?></td>
              <td><?php echo $filas['nya_mozo'] ?></td>
            
              <td>
				  <!--envía nro_menu por el enlace-->
                  <a href="AltaMozo.php?nro_mozo=<?php echo $filas['nro_mozo']?>"></a>
                  <a href="BajaMozo.php?nro_mozo=<?php echo $filas['nro_mozo']?>" class="btn btn-primary">Eliminar</a>
				  <a href="ModifMozo1.php?nro_mozo=<?php echo $filas['nro_mozo']?>" class="btn btn-primary">Modificar</a>
              </td>
			  
          </tr>
		 <?php } ?>
          <?php }?>
		</form>
 	 </tbody>
</table>