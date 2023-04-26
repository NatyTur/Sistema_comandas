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


$date = date('Y-m-d');
echo "La fecha del día es '".$date."'";
	

$id	= $_GET['atencion'];

$sql_at	= "SELECT * FROM atencion_por_mesa INNER JOIN mozos ON(mozos.nro_mozo=atencion_por_mesa.nro_mozo) WHERE atencion_por_mesa.id_atencion= '".$id."'";
$mostrar_at	= mysqli_query($conn, $sql_at);

$sql_menues 	= "SELECT nro_menu, descrip_menu FROM menues ORDER BY nro_menu ASC";
$menues			= mysqli_query($conn, $sql_menues);

?>

<body>
<div class="list-group" bgcolor="" align="center"> 
  <h3 class="mb-1">COMANDA</h3>
  <p class="mb-4"></p>
  <h6 class="mb-1">Agregar comanda</h6>
  <a href="AbmAtMesas.php" class="btn-light">Volver</a>
</div>
	

<form action="GrabarAgregarComanda.php" method= "GET"><!--Graba nueva comanda a esa atención-->
	
	
<table class= "table" width="100%" align="center">
	
	<thead class="thead-dark">	 
		<th scope="col" align="center"><strong>Comanda</strong></th>
	</thead>

<?php
if($fila=mysqli_fetch_assoc($mostrar_at)){ ?>
 
	<tr>
      <th scope="row">Id Atencion&nbsp;</th>
      <td><input type="number" name="id_atencion" value= "<?php echo $fila['id_atencion']?>"readonly ><br></td>
    </tr>
	
    <tr>
      <th scope="row">Mesa&nbsp;</th>
      <td><input type="number" name="mesa" value= "<?php echo $fila['nro_mesa']?>"readonly><br></td>
	</tr>
	
	
    <tr>
      <th scope="row">Mozo&nbsp;</th>
      <td><input type="text" name="mozo" value= "<?php echo $fila['nya_mozo']?>"readonly><br></td>
	</tr>
 
	
    <tr><!--Para una nueva comanda en esa atención solo voy a poder acceder a un nuevo menú y a cantidad del mismo-->
      <th scope="row">Menu&nbsp;</th>
	  <td>
		<input type=hidden name="menu_original" value="<?php echo $fila['nro_menu']?>"></input>			
		
		<select name="menu" required>
			<?php while($row = mysqli_fetch_assoc($menues)) {  ?>
			
              	<option value= "<?php echo $row['nro_menu']; echo " "; echo $row['descrip_menu']; ?>"><?php echo $row['nro_menu']; echo " - "; echo $row['descrip_menu']; ?></option>
			
			<?php } ?>
        </select>
	
	  </td>		
	</tr>
	
	
	<tr>
      <th scope="row">Cantidad&nbsp;</th>
      <td><input type="number" name="cantidad" value=1 min=1 required><br></td><!--muestra mínimo 1 como cantidad-->
	  <td><input type="submit" class="btn-light" value="Agregar"></td>	
    </tr>
<?php } ?>

			
</table>
</form>
</body>
</html>
