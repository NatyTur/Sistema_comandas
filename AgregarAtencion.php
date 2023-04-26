<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Agregar Comanda</title>
</head>

<body>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<?php
include 'conexion.php';

	
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha = date('Y-m-d');
$hora = date('H:i:s '); 
	
echo "La fecha del día es '".$fecha."'";

$sql		= "SELECT id_atencion FROM `atencion_por_mesa` WHERE id_atencion = (SELECT MAX(id_atencion) FROM atencion_por_mesa)LIMIT 1" ;//selecciono el id más alto
$id_response = mysqli_query($conn, $sql);
$id = mysqli_fetch_assoc($id_response)['id_atencion']+1;	

$query= "SELECT nro_mesa FROM mesas";
$resultado_mesas= mysqli_query($conn, $query);
	
$query= "SELECT * FROM mozos"; // Trae la tabla completa de mozos para las opciones de la lista desplegable.
$resultado_mozos= mysqli_query($conn, $query);
	
?>

<body>
<div class="list-group" bgcolor="" align="center"> 
  <h3 class="mb-1">ATENCIÓN</h3>
  <p class="mb-4"></p>
  <h6 class="mb-1">Agregar atención</h6>
  <a href="AbmAtMesas.php" class="btn-light">Volver</a>
</div>
	

<form action="GrabarAgregarAtencion.php" method= "GET"><!--Graba nueva comanda a esa atención-->
	
	
<table class= "table" width="100%" align="center">
	
	<thead class="thead-dark">	 
		<th scope="col" align="center"><strong>Atención</strong></th>
	</thead>

 
	<tr>
      <th scope="row">Id Atencion&nbsp;</th>
      <td><input type="number" name="id_atencion" value= "<?php echo $id?>"readonly ><br></td>
    </tr>
	
    <tr>
      <th scope="row">Mesa&nbsp;</th>
      <td>
		<select id="numero_mesa" name="numero_mesa" required>
		
		<?php while($mesas = mysqli_fetch_assoc($resultado_mesas)){?>
			<!-- En cada opción se carga en el campo value el numero de mesa que se selecciona
			<option value="windows">Windows</option>El propósito de este atributo es identificar a las opciones de un grupo, su valor debe ser diferente para cada opción.
			-->
			<option value=<?php echo $mesas['nro_mesa']?>><?php echo $mesas['nro_mesa']?></option>

		<?php }?>
		</select>
		</td>
	</tr>
    <tr>
      <th scope="row">Mozo&nbsp;</th>
		<td>
      	<select id="numero_mozo" name="numero_mozo" required>
		
		<?php while($mozos = mysqli_fetch_assoc($resultado_mozos)){?>
			
			<option value=<?php echo $mozos['nro_mozo']?>><?php echo $mozos['nya_mozo']?></option>

		<?php }?>
		</select>
		</td>
		<td><input type="submit" class="btn-light" value="Agregar"></td>
	</tr>
 
	
 			
</table>
</form>
</body>
</html>

