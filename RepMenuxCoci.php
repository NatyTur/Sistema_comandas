<!doctype html>
<html>
<?php
include 'conexion.php';
?>
<head>
		<?php
		$fecha_desde = $_GET['desde'];
		$fecha_hasta = $_GET['hasta'];
		$menu_ingre = $_GET['menu_ingre'];
	
	
		?>
	
		<p>Consulta realizada desde <?php echo $fecha_desde?> hasta <?php echo $fecha_hasta?></p>
	
		<?php
		$fecha_desde = str_replace("-","",$fecha_desde); //le saco el guión a las fechas que vienen del form con str-replace sino la base de datos no las acepta
		$fecha_hasta = str_replace("-","",$fecha_hasta);
		?>	
	
</head>

<?php if($menu_ingre!=null and $fecha_desde!=null and $fecha_hasta!=null ){ 
//Capturo nya sólo para mostrar
$sql = "SELECT descrip_menu FROM menues WHERE nro_menu='".$menu_ingre."'"; 
$sql_descrip = mysqli_query($conn,$sql);
$f_descrip=mysqli_fetch_assoc($sql_descrip);

?>

	<body>
	<hr class="my-4">
	<p class="lead" align="left" > Menú:  <?php echo $f_descrip['descrip_menu']?></p>
		
	<table class= "table" width="100%" border="5" align="center">
	
	<thead class="thead-dark">
    <tr>
      <th scope="col" align="center" width=700><strong>Cocinero</strong></th>
      <th scope="col" align="center"><strong>Cantidad realizada del menú</strong></th>
      
	</tr>
		
	</thead>
		
	<tbody>
	<a href="Repor_ppal.php" class="btn" >Volver</a>	
	<?php
	$query = "SELECT nya_cocinero, SUM(comandas.cantidad_pedida) as cantidad FROM `comandas`INNER JOIN menues on comandas.nro_menu=menues.nro_menu INNER JOIN atencion_por_mesa on (comandas.id_atencion = atencion_por_mesa.id_atencion) INNER JOIN cocineros on (cocineros.nro_cocinero = atencion_por_mesa.nro_cocinero) WHERE comandas.nro_menu='".$menu_ingre."' AND fecha_atencion BETWEEN '".$fecha_desde."' AND '".$fecha_hasta."' AND cdo_estado_atencion=5 GROUP BY comandas.id_atencion;";
	
	$rdo= mysqli_query($conn, $query);
	
	while($f = mysqli_fetch_assoc($rdo)){ ?>
		<tr>
			<td><?php echo $f['nya_cocinero']?></td>			 
										 
			<td><?php echo $f['cantidad']?></td>
		</tr>
		<?php } ?>


<?php 
} ?><!--NO BORRAR - LLAVE IF PRINCIPAL -->
	   
  	</tbody>
		
</table>
</body>
</html>
	
  
