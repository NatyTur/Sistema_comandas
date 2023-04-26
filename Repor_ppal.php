<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes del sistema</title>
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
	
	<?php
   include 'conexion.php';
    $sql_coci = "SELECT * FROM cocineros ORDER BY nro_cocinero ASC";
    $coci= mysqli_query($conn, $sql_coci);
	
	$sql_menu = "SELECT * FROM menues ORDER BY nro_menu ASC";
    $menu= mysqli_query($conn, $sql_menu);
    ?>
	
	
</head>

	
<body>
	
<a href="MenuAdmin.html" class="btn" >Volver</a>	
<table class= "table" width="100%" border="0" align="center">
	
			<tr>	
		
  					<td>
					<div class="list-group"> 

							  <h5 class="mb-1">Reporte de ventas por menu</h5>
							  <h3 class="mb-1">Ingrese un período de tiempo para realizar el reporte:</h3>
								
								<form action="Repor_menu.php" method="GET">
								<fieldset>
									
									Desde <input type="date" name="desde">
									Hasta <input type="date" name="hasta" value="today">
									<input type="submit" value="REPORTAR">
								</fieldset>
							    </form>
					</div>
					</td>
	

	
			</tr>
	
			<tr>
		
  					<td> 
					<div class="list-group"> 
							   
						
							   <h5 class="mb-1">Reporte de Cocinero por menú</h5>
							  <h3 class="mb-1">Ingrese un período de tiempo para realizar el reporte:</h3>
						
							  <form action="RepCocixMenu.php" method="GET">
									<fieldset>
									
									Desde <input type="date" name="desde">
									Hasta <input type="date" name="hasta">
									
							
		  											<select name= "coci_ingre">
            										<option value="0">Seleccionar cocinero</option>
           											 
													<?php
               										 while($row = mysqli_fetch_assoc($coci)) { ?>
													<option value="<?php echo $row['nro_cocinero']?>"><?php echo $row['nya_cocinero'] ?></option>
													<?php } ?>
														
       											    </select> 
	  												<input type="submit" value="REPORTAR">	
													
								  	</fieldset>
							</form>
					</div>
					</td>
	
   			</tr>
	
			<tr>
		
  					<td>
					<div class="list-group"> 
							   
						
							   <h5 class="mb-1">Reporte de menú realizado por cocinero</h5>
							  <h3 class="mb-1">Ingrese un período de tiempo para realizar el reporte:</h3>
						
							  <form action="RepMenuxCoci.php" method="GET">
									<fieldset>
									
									Desde <input type="date" name="desde">
									Hasta <input type="date" name="hasta" value="today">
									
							
		  											<select name= "menu_ingre">
            										<option value="0">Seleccionar menú</option>
           											 
													<?php
               										 while($row = mysqli_fetch_assoc($menu)) { ?>
													<option value="<?php echo $row['nro_menu']?>"><?php echo $row['descrip_menu'] ?></option>
													<?php } ?>
														
       											    </select> 
	  												<input type="submit" value="REPORTAR">	
													
								  	</fieldset>
							  </form>
						
					</div>
					</td>
	
   			</tr>
	
</table>

</body>

</html>
