<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eliminar Comanda</title>
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
	

$id	= $_GET['id_atencion'];
$menuorig= $_GET['nro_menu'];
	
$sql_at	= "SELECT * FROM atencion_por_mesa INNER JOIN comandas ON (comandas.id_atencion= atencion_por_mesa.id_atencion)  INNER JOIN mozos ON(mozos.nro_mozo=atencion_por_mesa.nro_mozo) INNER JOIN menues on comandas.nro_menu=menues.nro_menu WHERE atencion_por_mesa.id_atencion= '".$id."' && comandas.nro_menu='".$menuorig."' ";
$mostrar_at	= mysqli_query($conn, $sql_at);

$sql_menues = "SELECT nro_menu, descrip_menu FROM menues ORDER BY nro_menu ASC";
$menues	= mysqli_query($conn, $sql_menues);

?>

<body>
<div class="list-group" bgcolor="" align="center"> 
  <h3 class="mb-1">COMANDA</h3>
  <p class="mb-4"></p>
  <h6 class="mb-1">Eliminar comanda</h6>
  <a href="AbmAtMesas.php" class="btn-light">Volver</a>
</div>
	

<form action="GrabarBajaComanda.php" method= "GET"><!--Graba la baja-->
	
	
<table class= "table" width="100%" border="0" align="center">
	
	<thead class="thead-dark">	 
		<th scope="col" align="center"><strong>Comanda</strong></th>
	</thead>

<?php
if($fila=mysqli_fetch_assoc($mostrar_at)){ ?>
 
	<tr>
      <th scope="row">Id Atencion&nbsp;</th>
      <td><input type="number" name="id_atencion" value= "<?php echo $fila['id_atencion']?>"readonly ><br></td>
	  <td></td>	
    </tr>
	
    <tr>
      <th scope="row">Mesa&nbsp;</th>
      <td><input type="number" name="mesa" value= "<?php echo $fila['nro_mesa']?>"readonly><br></td>
	  <td></td>	
	</tr>
	
    <tr>
      <th scope="row">Mozo&nbsp;</th>
      <td><input type="text" name="mozo" value= "<?php echo $fila['nya_mozo']?>"readonly><br></td>
	  <td></td>
	</tr>
 
    <tr>
      <th scope="row">Menu&nbsp;</th>
	  <td><input type="text" name="menu" value= "<?php echo $fila['nro_menu']?>-<?php echo $fila['descrip_menu']?>" readonly><br></td>
	  <td></td>
	</tr>
	<tr>
      <th scope="row">Cantidad&nbsp;</th>
      <td><input type="text" name="cantidad" value= "<?php echo $fila['cantidad_pedida']?>"><br></td>
	  <td>¿Está seguro que quiere eliminar la comanda? <input type="submit" class="btn-light" value="Eliminar"></td>	
    </tr>
<?php } ?>


	
			
</table>
</form>
</body>
</html>
