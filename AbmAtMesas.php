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
	<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="list-group" bgcolor="" align="center"> 
  <h3 class="mb-1">ATENCIONES Y COMANDAS</h3>
  <p class="mb-4"></p>
  <h6 class="mb-1">Listado de comandas en proceso</h6>
	<a href="index.html" class="btn-light" >Volver</a>
	
	
</div>
	
	

<table class= "table" width="100%" bordercolor=#81B077 border="2" align="center">
	
	<thead class="thead-dark" align="center">
		
		<th scope="col" width="10%" align="center" ><strong>Mesa</strong></th>
		<th scope="col" align="center"><strong>Atenciones</strong>
				<form action="AgregarAtencion.php" method="GET">
					<input type="submit" value="+Atención"><!--Agrego nueva atención-->
			  	</form>
		</th>
	
	</thead>
	
	<tbody>
		<?php
		
		$query= "SELECT * FROM estados_atencion WHERE cod_estado_atencion!='5' AND cod_estado_atencion!='2' AND cod_estado_atencion!='3'"; //estado 2-3 corresponde al cocinero y el 5 a la caja,me trae solo las que son para mozo
		$resultado_estados= mysqli_query($conn, $query);
		
		$query= "SELECT * FROM mozos"; // Trae la tabla completa de mozos para las opciones de la lista desplegable.
		$resultado_mozos= mysqli_query($conn, $query);
		
		$query= "SELECT nro_mesa FROM mesas";
		$resultado_mesas= mysqli_query($conn, $query); ?>
		
	
		
		
		<?php
		
		while($mesas = mysqli_fetch_assoc($resultado_mesas)){ ?>
		
			<?php
			$query= "SELECT * FROM atencion_por_mesa INNER JOIN mozos ON(mozos.nro_mozo=atencion_por_mesa.nro_mozo) INNER JOIN estados_atencion ON(atencion_por_mesa.cdo_estado_atencion=estados_atencion.cod_estado_atencion) WHERE (cdo_estado_atencion<'5' OR cdo_estado_atencion='7') AND nro_mesa='".$mesas['nro_mesa']."' ORDER BY id_atencion DESC";
			$resultado_atencion= mysqli_query($conn, $query);
		
			if(mysqli_fetch_assoc($resultado_atencion)!=null){ //Este if verifica que la mesa tenga por lo menos una atención ?>
			<?php mysqli_data_seek($resultado_atencion, 0); //Volvemos el puntero del fetch a cero para que al usar el while debajo arranque en la primera atencion de la mesa 
			
			$nocerrar=0;
			$totalmesa=0;
					
									 /*Recorre atenciones que no estén "para cobrar" y calcula total de la atención*/
															  
			while($control = mysqli_fetch_assoc($resultado_atencion)){
				
				if($control['cdo_estado_atencion']!=4)
				{$nocerrar=1;}
				$totalmesa = $totalmesa + $control['total_atencion'];
				
			}
															  
															  
				mysqli_data_seek($resultado_atencion, 0);
			?>
			<tr align="center" valign="bottom">
			
				<!--En esta columna 1 muestro:
						1-Nro de mesa
				
						2-Si todas las atenciones están cerradas puedo cerrar la mesa aquí también-->
				
			<td align="center" valign="middle"><p class="alert-dark"><strong><?php echo $mesas['nro_mesa'] ?></strong></p>
				
				
			<?php if($nocerrar==0) {?>
				<!--Muestro el calculo del total x mesa-->
				<p class="alert-dark"><strong><?php echo 'Total $' . $totalmesa?></strong></p>
				
				
				<form action="CerrarMesa.php" method="GET">
					<input type="hidden" name="mesa" value=<?php echo $mesas['nro_mesa']?>>
					<input type="submit" value="Cerrar Mesa">
			  	</form>
				
			<?php }	?>
			</td>
			  
			<td><!--TABLA DENTRO DE TABLA--------------------------------------------------------------------------> 	  		
			<table width="100%" style="align-self: auto" align="center" bordercolor=#B58450 border="2">
				<thead align="center">
		
				<th scope="col" width="10%" align="center">Atención</th>
				<th scope="col" width="15%" align="center">Mozo</th>	
				<th scope="col" align="center">Cantidad pedida - Menu</th>		
				<th scope="col" width="15%" align="center">Estado</th>
		
				</thead>
			<tbody>	  
		
			
			<?php
			  while($filas = mysqli_fetch_assoc($resultado_atencion)){ 
			  ?>
			  <tr align="center" valign="middle">
              
				  <!--En esta columna 2:
							1-Muestro ID
							2-Si la atención está abierta la muestro y permito cargar una comanda nueva asociada a ella
						-->
              <td align="center"><?php echo $filas['id_atencion'] ?>
			  
			  	<?php if($filas['cdo_estado_atencion']==1){ ?>
			  
				  	<!--Elijo si agrego nueva comanda en esta atención-->
			  		<form action="AgregarComanda.php" method="GET">
						<input type="hidden" name="atencion" value=<?php echo $filas['id_atencion']?>>
						<input type="submit" value="+Comanda">
					</form>
			  
				 <?php } ?>
			  </td>
			  
				  <!-- En esta columna 3:
							1-Muestro nombre mozo
							2-Solo si la atención está abierta puedo modificar mozo-->
			  
			  <td align="center">
				  <?php echo $filas['nya_mozo']?>
				  		
				  		<?php if($filas['cdo_estado_atencion']==1){ ?>
			  			<!--Modifico mozo en la atención-->
						<form action="modifmozo.php" method="GET">
						<fieldset>
								<!-- En numero_mozo guarda lo seleccionado en el select que luego envía con el submit-->
								<select id="numero_mozo" name="numero_mozo">
								<option value="" selected="selected">-Seleccione-</option>
									
								<?php while($mozos = mysqli_fetch_assoc($resultado_mozos)){?>
									
									<option value=<?php echo $mozos['nro_mozo']?>><?php echo $mozos['nya_mozo']?></option>
										
								<?php }?>
								</select>
								
	
								<input type="hidden" name="atencion" value=<?php echo $filas['id_atencion']?>>
								<input type="submit" value="OK">
							
								<?php mysqli_data_seek($resultado_mozos, 0) //Volvemos el puntero del fetch a cero para el próximo bucle del while de las filas.?>
						</fieldset>
						</form>
			  			<?php } ?>
			  </td>
			  
			  <?php
							
			 			$query= "SELECT * FROM comandas INNER JOIN menues on comandas.nro_menu=menues.nro_menu WHERE id_atencion='".$filas['id_atencion']."' && comandas.debaja = '0'";
						$resultado_desc_menu= mysqli_query($conn, $query);
					?>
					
			  		<!--En esta columna 4 (otra tabla):
								1-Muestro cantidad pedida de c/menú
								2-Muestro el menú de las comandas abiertas
								3-Modifico o elimino comanda-->
					<td>
						<table width="100%" style="align-self: auto" bordercolor=#B58450 border="2">
							  <tbody>
								  
								<?php while($comandas = mysqli_fetch_assoc($resultado_desc_menu)){?>
								  
								<tr>
								  <td align="right" width=5%><?php echo $comandas['cantidad_pedida']?></td>
									
								  <td align="left"><?php echo $comandas['descrip_menu']?></td>
								
									<?php if($filas['cdo_estado_atencion']==1){ ?>
								  	<td align="right" width=20%> 
										
									  <form action="ModiComanda.php" method="GET">
										<input type="hidden" name="id_atencion" value=<?php echo $filas['id_atencion']?>>
										<input type="hidden" name="nro_menu" value=<?php echo $comandas['nro_menu']?>>
										<input type="submit" value="Modificar Comanda">
									  </form>
									  
								  	  <form action="BajaComanda.php" method="GET">
										<input type="hidden" name="id_atencion" value=<?php echo $filas['id_atencion']?>>
										<input type="hidden" name="nro_menu" value=<?php echo $comandas['nro_menu']?>>
										<input type="submit" value="Eliminar Comanda">
									  </form>
									 </td>
								  	<?php } ?>
									
								</tr>
								<?php } 
								  mysqli_data_seek($resultado_desc_menu, 0);
								  
								  ?>
							  </tbody>
							</table>

					</td>
			  
			  <!--Muestro el estado actual de la comanda y luego modifico estado comanda-->
			  <td><?php echo $filas['descrip_estado_atencion'] ?>
			  			
				  <?php if(mysqli_fetch_assoc($resultado_desc_menu)) { //se fija si hay comandas en la atención para permitir o no cambiar el estado de la atención?>
				  		<?php if($filas['cdo_estado_atencion']==1 || $filas['cdo_estado_atencion']==3){ // solo si está en estado abierto o en lista para servir  me permite cambiar de estado la atención?>
				  
							<form name="formulario2" action="modifestado2.php" method="GET">
							<fieldset>
									<!-- En numero_estado guarda la seleccion del select que luego envía con el submit junto con el id_atencion que se envia en el hidden-->
									<select id="numero_estado2" name="numero_estado2">
									<option value="" selected="selected">-Seleccione-</option>
										
										<!--SI LA ATENCIÓN ESTÁ ABIERTA:limito las opciones a: para preparar y para cobrar-->
									<?php if($filas['cdo_estado_atencion']==1){?>
																				
										<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=7";
										$resultado2= mysqli_query($conn, $query);?>
										<option value=7><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>
										
										
										<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=6";
										$resultado2= mysqli_query($conn, $query);?>
										<option value=6><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>


									<?php }?>
									<!--SI LA ATENCIÓN ESTÁ LISTA PARA SERVIR:limito las opciones a para cobrar y cancelada-->
									
										<?php if($filas['cdo_estado_atencion']==3){?>
											
										<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=4";
										$resultado2= mysqli_query($conn, $query);?>
										<option value=4><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>
										
										<?php $query= "SELECT descrip_estado_atencion FROM estados_atencion WHERE 			cod_estado_atencion=6";
										$resultado2= mysqli_query($conn, $query);?>
										<option value=6><?php echo mysqli_fetch_assoc($resultado2)['descrip_estado_atencion']?></option>

									<?php }?>
										
									</select>
									<input type="hidden" name="atencion" value=<?php echo $filas['id_atencion']?>>
									<input type="submit" name="boton1" value="OK">

									<?php mysqli_data_seek($resultado_estados, 0) //Volvemos el puntero del fetch a cero para el próximo bucle del while de las filas.?>
							</fieldset>
							</form>
				  		<?php }?>
				  	<?php }?>
				  
				  <!--SI LA ATENCIÓN ESTÁ CERRADA:muestro el total atención en la misma columna-->
				  	<?php if($filas['cod_estado_atencion']==4){?>
				  		<p class="alert-dark"><strong><?php echo "Total atención \$" . $filas['total_atencion'] ?></strong></p> 
			  		<?php  }?>
			  </td>
			</tr>
          <?php  }?>
          	
			</tbody>
			</table>
			</td>
		</tr>
		<?php  }?>
		<?php  }?>
</tbody>
</table>
			
</body>