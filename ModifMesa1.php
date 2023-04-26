<?php
include 'conexion.php';

$nro_mesa = $_GET['nro_mesa'];

$sql = "SELECT * FROM mesas WHERE nro_mesa='".$nro_mesa."'";
$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_mesas.php" class="btn-light" >Volver</a><br>


 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifMesa1.php" method="GET">
			
            <label>Nro</label>
            <input type="number" name="nro_mesa" value= "<?php echo $fila['nro_mesa']?>" placeholder="Nro"><br>
            <label>Capacidad</label>
            <input type="text" name="capacidad" value= "<?php echo $fila['capacidad']?>" placeholder="Capacidad"><br>
			<label>Sector</label>
            <input type="text" name="cod_sector" value= "<?php echo $fila['cod_sector']?>" placeholder="Sector"><br>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    $nro_mesa = $_GET['nro_mesa'];
    $capacidad = $_GET['capacidad'];
	$sector = $_GET['cod_sector'];
    

    if( $nro_mesa!=null && $capacidad!=null && $sector!=null){
        $sql2 = "UPDATE mesas SET nro_mesa='".$nro_mesa ."',capacidad='".$capacidad."',cod_sector='".$sector."' WHERE nro_mesa='".$nro_mesa."'";
        mysqli_query($conn,$sql2);
        header('location:abm_mesas.php');

	}

?>