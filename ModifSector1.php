<?php
include 'conexion.php';

$cod_sector = $_GET['cod_sector'];

$sql = "SELECT * FROM sectores WHERE cod_sector='".$cod_sector."'";
$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_sectores.php" class="btn-light" >Volver</a><br>


 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifSector1.php" method="GET">
			
            <label>Nro</label>
            <input type="number" name="cod_sector" value= "<?php echo $fila['cod_sector']?>" placeholder="Nro"><br>
            <label>Capacidad</label>
            
            <input type="text" name="descrip_sector" value= "<?php echo $fila['descrip_sector']?>" placeholder="Sector"><br>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    
	$nro = $_GET['cod_sector']; 
    $sector = $_GET['descrip_sector'];
	

    if( $nro!=null && $sector!=null){
        $sql2 = "UPDATE sectores SET cod_sector='".$nro."',descrip_sector='".$sector."' WHERE cod_sector='".$nro."'";
        mysqli_query($conn,$sql2);
        header('location:abm_sectores.php');

	}

?>