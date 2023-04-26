<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
	<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Anular Antencion</title>
<link href="../css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>
	
<?php
include 'conexion.php';
$id			= $_GET['id_atencion'];
$sql_at		= "SELECT * FROM `atencion_por_mesa` WHERE id_atencion = '".$id."'";
$mostrar_at	= mysqli_query($conn, $sql_at);

?>

<body background="imagenes/fondo12.jpg">
<legend align="center" style="background:#AC898A ">Atencion Mesa</legend>		
<table align="center" width="100" border="10" cellspacing="5" cellpadding="5">  
<tbody bgcolor="#AC898A">
<form action="GrabarBajaAtMesa.php" method="GET">
	<a href="ListarAtMesas.php" class="btn" >Volver</a>	

<?php
while($fila=mysqli_fetch_assoc($mostrar_at)){ ?>
	
	<tr>
      <th scope="row">Atencion&nbsp;</th>
      <td><input type="number" name="id_atencion" value="<?php echo $fila['id_atencion']?>"readonly></input>  
	  </td>
 	  <td></td>	
   </tr>
	<tr>
      <th scope="row">Fecha&nbsp;</th>
      <td><input type="date" name="fecha_atencion" value="<?php echo $fila['fecha_atencion']?>"readonly></input></td>
	  <td></td>	
    </tr>
    <tr>
      <th scope="row">Hora&nbsp;</th>
      <td><input type="time" name="hora_atencion" value="<?php echo $fila['hora_atencion']?>"readonly></td>
	  <td></td>	
	</tr>
    <tr>
      <th scope="row">Mozo&nbsp;</th>
      <td><input name= "mozo" value="<?php echo $fila['nro_mozo'] ?>"readonly>
	  </td>
 	  <td></td>	
   </tr>
    <tr>
      <th scope="row">Mesa&nbsp;</th>
      <td><input name= "mesa" value="<?php echo $fila['nro_mesa'] ?>"readonly>
	  </td>
 	  <td></td>	
   </tr>
    <tr>
      <th scope="row">Estado Atención&nbsp;</th>
      <td><input type="number" name="estado" value="<?php echo $fila['cod_estado_atencion']?>"readonly></td>
	  <td><input type="submit" class="btn btn-danger" value="Eliminar"></td>	
<?php } ?>
</tbody>
</table>
</form>
</html>
</body>
</html>