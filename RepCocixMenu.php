<!doctype html>
<html>
<?php
include 'conexion.php';
?>
<head>
		<?php
		$fecha_desde = $_GET['desde'];
		$fecha_hasta = $_GET['hasta'];
		$coci_ingre = $_GET['coci_ingre'];
		?>
	
		<p>Consulta realizada desde <?php echo $fecha_desde?> hasta <?php echo $fecha_hasta?></p>
	
		<?php
		$fecha_desde = str_replace("-","",$fecha_desde); //le saco el guión a las fechas que vienen del form con str-replace sino la base de datos no las acepta
		$fecha_hasta = str_replace("-","",$fecha_hasta);
		?>	
	
</head>

<?php if($coci_ingre!=null and $fecha_desde!=null and $fecha_hasta!=null ){ 
	
	
	
//Capturo nya sólo para mostrar
$sql = "SELECT nya_cocinero FROM cocineros WHERE nro_cocinero='".$coci_ingre."'"; 
$sql_nya = mysqli_query($conn,$sql);
$f_nya=mysqli_fetch_assoc($sql_nya);

?>

	
	<body>
		
	<a href="Repor_ppal.php" class="btn" >Volver</a>
		
	<hr class="my-4">
	
	<table class= "table" width="100%" border="5" align="center">
	
	<thead class="thead-dark">
    <tr>
      <th scope="col" align="center" width=700><strong>Menu</strong></th>
      <th scope="col" align="center"><strong>Cantidad [un]</strong></th>
      
	</tr>
		
	</thead>
		
	<tbody>
	
	<?php
	$query = "SELECT descrip_menu, nya_cocinero, SUM(comandas.cantidad_pedida) as cantidad FROM `comandas`INNER JOIN menues on comandas.nro_menu=menues.nro_menu INNER JOIN atencion_por_mesa on (comandas.id_atencion = atencion_por_mesa.id_atencion) INNER JOIN cocineros on (cocineros.nro_cocinero = atencion_por_mesa.nro_cocinero) WHERE atencion_por_mesa.nro_cocinero='".$coci_ingre."' AND fecha_atencion BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' AND cdo_estado_atencion=5 and comandas.cantidad_pedida!=0 GROUP BY comandas.nro_menu";
	
	$rdo= mysqli_query($conn, $query);
	$cantidad=0;
	
	if(mysqli_fetch_assoc($rdo)){
		
		mysqli_data_seek($rdo,0);
		
	    while($f = mysqli_fetch_assoc($rdo)){ ?>
		
			
	
		   <tr>
			  <td><?php echo $f['descrip_menu']?></td>
			  <td><?php echo $f['cantidad']?></td>
			   <?php $cantidad_total = $cantidad_total + $f['cantidad']; ?>
		  </tr>
		  
	
		<?php } ?>
    	</table>
		
			<p class="lead" align="left" > Cocinero:  <?php echo $f_nya['nya_cocinero']?> realizó      <?php echo $cantidad_total?> menus en total </p>
		
		<?php }else {
			
			 echo "El cocinero seleccionado no ha realizado ningun menú en las fechas elegidas";
		 }
		
		
		
	} ?><!--NO BORRAR - LLAVE IF PRINCIPAL -->
	 
  	</tbody>
		

		
		
		
</body>
</html>
	
  
