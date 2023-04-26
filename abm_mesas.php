<?php

include 'conexion.php';
//en la variable query tengo almacenada la consulta a sql
$query= "SELECT * FROM mesas";
/* Si una consulta es exitosa, mysqli_query() retornará un objeto mysqli_result.($resultado) */
$resultado= mysqli_query($conn, $query); //or die ($query . mysqli_error($conn));

?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">


<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	
	<thead>
	 	
	<form>
	 <a href="AltaMesa.php">
    <button type="button" class="btn btn-primary">ALTA MESA</button>
	 </a>	
	<a href="MenuAdmin.html" class="btn-light" >Volver</a>
		
    	  <th>Nro de mesa</th><br>
          <th>Capacidad</th>
		  <th>Código de sector</th>
          
	
    </thead>
	
	<tbody>
          <?php
          while($filas = mysqli_fetch_assoc($resultado)){ //Mientras la funcion pueda acceder a un registro del array, se ejecuta el while.La funcion ve línea a línea lo que hay en la variable fila(array), pero debo darle el resultado de la consulta .
          ?>
			
			<?php if($filas['cond_activo']!=0){?>
          <tr>
              <td><?php echo $filas['nro_mesa'] ?></td>
              <td><?php echo $filas['capacidad'] ?></td>
			  <td><?php echo $filas['cod_sector'] ?></td>
            
              <td>
				  <!--envía nro_menu por el enlace-->
                  <a href="AltaMesa.php?nro_mesa=<?php echo $filas['nro_mesa']?>"></a>
                  <a href="BajaMesa.php?nro_mesa=<?php echo $filas['nro_mesa']?>" class="btn btn-primary">Eliminar</a>
				  <a href="ModifMesa1.php?nro_mesa=<?php echo $filas['nro_mesa']?>" class="btn btn-primary">Modificar</a>
              </td>
			  
          </tr>
		 <?php } ?>
          <?php }?>
		</form>
 	 </tbody>
</table>