<!doctype html>
<html>

	<!-------------Conexion con la base------------------>
<?php

include 'conexion.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
$date = date('Y-m-d');
echo "HOY es '".$date."'";

?>
	
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cocina_Comanda</title>
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>
	
<!--TITULOS------->	

<div class="list-group" bgcolor="" align="center"> 
  <h3 class="mb-1">COCINA</h3>
  <p class="mb-4"></p>
  <h6 class="mb-1">Listado de atenciones en proceso</h6>
	<a href="index.html" class="btn-light">Volver</a>
</div>
	
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.4.1.js"></script>



<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	
	<thead class="thead-dark" align="center"><!--TABLA DE REGISTROS-->
    <tr><!--FILA-->
      <th scope="col" width="10%" align="center"><strong>Atención</strong></th><!--COLUMNA-->
      <th scope="col" width="15%" align="center"><strong>Cocinero</strong></th>
      <th scope="col" align="left"><strong>Cantidad pedida - Menú</strong></th>
      <th scope="col" width="15%" align="center"><strong>Estado</strong></th>
	  
    </tr>
		
	</thead>
	
	<tbody valign="middle">
		
		<?php $query= "SELECT * FROM cocineros"; // Trae la tabla completa de cocineros para las opciones de la lista desplegable.
		$resultado_cocineros= mysqli_query($conn, $query);?>
		
		<?php $query= "SELECT * FROM estados_atencion WHERE cod_estado_atencion!=1 AND cod_estado_atencion<4"; // Trae la tabla de estados de atencion (lista para servir y en preparación).
		$resultado_estados= mysqli_query($conn, $query); ?>
		
		<?php $query= "SELECT * FROM atencion_por_mesa WHERE (cdo_estado_atencion=2 OR cdo_estado_atencion=7) ORDER BY id_atencion DESC";// Trae la tabla de estados de atencion (en preparación y para preparar).
		$resultado_atencion= mysqli_query($conn, $query);
		
		
		while($filas = mysqli_fetch_assoc($resultado_atencion)){ 
		 ?>
				<?php
				/*guardo todas las comandas con ese ID y que estén activas para mostrar en la columna correspondiente la el menú y la cantidad*/			
				$query= "SELECT cantidad_pedida, descrip_menu FROM comandas INNER JOIN menues on comandas.nro_menu=menues.nro_menu WHERE id_atencion='".$filas['id_atencion']."' && comandas.debaja = '0'";
				$resultado_desc_menu= mysqli_query($conn, $query);
				?>
		
    			<?php if(mysqli_fetch_assoc($resultado_desc_menu)) { 
					mysqli_data_seek($resultado_desc_menu, 0);?>
					
				<tr valign="middle"> <!--FILA-->
		
					<!--COLUMNA 1: muestro ID -->
      				<td align="center" valign="middle"><p class="alert-dark"><strong><?php echo $filas['id_atencion']?></strong></td><!--columnas-->
					
					
					<?php
			 			//asocio nro de cocinero con nombre para mostrarlo en el menú y seleccionarlo
			 			$query= "SELECT nya_cocinero FROM cocineros WHERE nro_cocinero='".$filas['nro_cocinero']."'";
						$cocinero_sel= mysqli_query($conn, $query);
					?>
					
					<!--COLUMNA 2:  menú desplegable para elegir uno y muestro el cocinero elegido  -->
					<td align="center">
						<?php echo mysqli_fetch_assoc($cocinero_sel)['nya_cocinero']?>
						
						<form action="modifcocinero.php" method="GET">
						<fieldset>
								<!-- En numero_cocinero guarda lo seleccionado en el select que luego envía con el submit-->
								<select id="numero_cocinero" name="numero_cocinero">
								<option value="" selected="selected">-Seleccione-</option>
									
								<?php while($cocineros = mysqli_fetch_assoc($resultado_cocineros)){?>
									
									<option value=<?php echo $cocineros['nro_cocinero']?>><?php echo $cocineros['nya_cocinero']?></option>
										
								<?php }?>
								</select>
								
								<!--hidden para que pase como oculto el cuadro de texto con el id_atencón y lo envío en el formulario-->
								<input type="hidden" name="atencion" value=<?php echo $filas['id_atencion']?>>
								<input type="submit" value="OK">
							
								<?php mysqli_data_seek($resultado_cocineros, 0)?>
						</fieldset>
						</form>
					</td>
					
					
					<!--COLUMNA 3:  muestro menú y cantidad de esa comanda  -->
					<td>
						<table width="100%" bordercolor=#B58450 border="2">
							  <tbody valign="middle">
								 <?php while($comandas = mysqli_fetch_assoc($resultado_desc_menu)){?>
								<tr>
								  <td align="center" width=10%><?php echo $comandas['cantidad_pedida']?></td>
								  <td align="left"><?php echo $comandas['descrip_menu']?></td>
								</tr>
								<?php } ?>
							  </tbody>
						</table>

					</td>
					
					
					<?php
			 			$query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE cod_estado_atencion='".$filas['cdo_estado_atencion']."'";
						$resultado2= mysqli_query($conn, $query);
					?>
					
					<!--COLUMNA 4: muestro el estado de atención correspondiente-->
					<td align="center"><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?>
						
						
						<form name="formulario1" action="modifestado.php" method="GET">
						<fieldset>
								<!-- En numero_estado guarda la seleccion del select que luego envía con el submit junto con el id_atencion que se envia en el hidden-->
								<select id="numero_estado" name="numero_estado">
								<option value="" selected="selected">-Seleccione-</option>
									
								<?php if($filas['cdo_estado_atencion']==7){?><!--si es para preparar-->
									
									<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=2";
									$resultado2= mysqli_query($conn, $query);?>
									
									<!--muestro descripcion de los estados que estarán disponibles si la atencion es "para preparar":en preparación y cancelada-->
									<option value="2"><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>
									
									<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=6";
									$resultado2= mysqli_query($conn, $query);?>
									
									<option value="6"><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>
																	
								<?php }
									if($filas['cdo_estado_atencion']==2){?><!--si está en preparación-->
									
									<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=3";
									$resultado2= mysqli_query($conn, $query);?>
									
									<!--solo muestro la opcion lista para servir-->
									<option value="3"><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>
																	
								<?php }?>	
														
								</select>
								<input type="hidden" name="atencion" value=<?php echo $filas['id_atencion']?>>
								<input type="submit" name="boton2" value="OK">
							
								<?php mysqli_data_seek($resultado_estados, 0) ?>
						</fieldset>
						</form>
						
					</td>
					
			    </tr>
		<?php }?>
		<?php }?>
    
  </tbody>
</table>
</body>
</html>


