<!doctype html>
<html>
<?php
include 'conexion.php';
?>
<head>
		<?php
		$fecha_desde = $_GET['desde'];
		$fecha_hasta = $_GET['hasta'];
		?>
	
		<p>Consulta realizada desde <?php echo $fecha_desde?> hasta <?php echo $fecha_hasta?></p>
	
		<?php
		$fecha_desde = str_replace("-","",$fecha_desde); //le saco el guión a las fechas que vienen del form con str-replace sino la base de datos no las acepta
		$fecha_hasta = str_replace("-","",$fecha_hasta);
		?>	
	
</head>

<body>
	<table class= "table" width="100%" border="5" align="center">
	
	<thead class="thead-dark">
    <tr>
      <th scope="col" align="center" width=700><strong>Menu</strong></th>
      <th scope="col" align="center"><strong>Cantidad [un]</strong></th>
      <th scope="col" align="center"><strong>Monto [$]</strong></th>
	</tr>
		
	</thead>
	
	<tbody>

		<a href="Repor_ppal.php" class="btn" >Volver</a>	
		<!--Selecciono los datos que me permitirán realizar el barrido de informacion en la tabla comandas-->
		<?php $query= "SELECT * FROM menues"; 
		$resultado_menues= mysqli_query($conn, $query);?>
		
		
		
		<?php
		while($menu = mysqli_fetch_assoc($resultado_menues)){ 
		 ?>
    			<?php 
					//selecciono todas las atenciones con ese id_atencion en las fechas ingresadas, voy a necesitar la cantidad pedida de los menues elegidos para el reporte
					$query="SELECT SUM(cantidad_pedida) as Cantidad_pedida, descrip_menu FROM `comandas` LEFT JOIN menues on comandas.nro_menu=menues.nro_menu WHERE comandas.nro_menu='".$menu['nro_menu']."' AND comandas.id_atencion = ANY (SELECT id_atencion FROM atencion_por_mesa WHERE fecha_atencion BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' && cdo_estado_atencion = '5')";
			
					$resultado_cantidad= mysqli_query($conn, $query);
					$fila = mysqli_fetch_assoc($resultado_cantidad);
				?>
		
		
				<?php if($fila['Cantidad_pedida']!=null){// permite filtrar (no imprimir) filas vacias en la tabla debido a los menues sin cantidad vendida, sino me muestra una fila vacía en la tabla?> 
		
				<tr>
					<td>
						<?php 
							//echo $query
							echo $fila['descrip_menu']
						?>
					</td>
						
					<td align="center">
						<?php echo $fila['Cantidad_pedida']?>
					</td>
						
					<td align="center">
						<?php 
								
								$monto_por_menu= $menu['precio_unitario']*$fila['Cantidad_pedida'];//cantidad total vendida en pesos de ese menú
					
					
								echo $monto_por_menu;
					
								$cantidad_total = $cantidad_total + $fila['Cantidad_pedida'];//acumulador de cantidad pedida de menues para sacar el porcentje vendido de ese menú 
								$monto_total = $monto_total + $monto_por_menu;//acumulador de cantidad total vendida en pesos de menues para sacar el porcentaje vendido de ese menú 
					
						?>
					</td>
      			</tr>
		
				<?php }?>
		<?php }?>
	
  </tbody>
</table>

	<p>La cantidad total de menues vendidos es: <?php echo $cantidad_total?> por un monto total de $<?php echo $monto_total?></p>
	
	
	<!---------------------Tabla para mostrar porcentajes------------------------------------------------------------------>
	
	
	
	<table class= "table" width="100%" border="5" align="center">
	
	<thead class="thead-dark">
    <tr>
      <th scope="col" align="center" width=700><strong>Menu</strong></th>
	  <th scope="col" align="center"><strong>Cantidad [%]</strong></th>
	  <th scope="col" align="center"><strong>Monto [%]</strong></th>
	</tr>
		
	</thead>
	
	<tbody>
		
		
		<?php
		mysqli_data_seek($resultado_menues,0);
		
		
		
		while($menu = mysqli_fetch_assoc($resultado_menues)){ 
		 ?>
    		
		
					<?php 
					
					$query="SELECT SUM(cantidad_pedida) as Cantidad_pedida, descrip_menu FROM `comandas` LEFT JOIN menues on comandas.nro_menu=menues.nro_menu WHERE comandas.nro_menu='".$menu['nro_menu']."' AND comandas.id_atencion = ANY (SELECT id_atencion FROM atencion_por_mesa WHERE fecha_atencion BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' && cdo_estado_atencion = '5')";
			
					$resultado_cantidad= mysqli_query($conn, $query);
					$fila = mysqli_fetch_assoc($resultado_cantidad);
				?>
				<?php if($fila['Cantidad_pedida']!=null){// permite filtrar (no imprimir) filas vacias en la tabla debido a los menues sin cantidad vendida, sino me muestra una fila vacía en la tabla?> 
		
				<tr>
					<td>
						<?php 
							//echo $query
							echo $fila['descrip_menu']
						?>
					</td>
					<td align="center">
						<?php echo round($fila['Cantidad_pedida']/$cantidad_total*100)?><!--round 2 dec-->
					</td>
					<td align="center">
						<?php 
								
								$monto_por_menu= $menu['precio_unitario']*$fila['Cantidad_pedida'];//cantidad total vendida en pesos de ese menú
								echo round($monto_por_menu/$monto_total*100);
						?>
					</td>
      			</tr>
		
				<?php }?>
		
				
		<?php }?>
		
    
  </tbody>
</table>

</body>
</html>
