<?php
include 'conexion.php';

$nro_cocinero = $_GET['nro_cocinero'];

$sql = "SELECT * FROM cocineros WHERE nro_cocinero='".$nro_cocinero."'";
$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_cocineros.php" class="btn-light" >Volver</a><br>


 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifCocinero1.php" method="GET">
			
            <label>Nro</label>
            <input type="number" name="nro_cocinero" value= "<?php echo $fila['nro_cocinero']?>" placeholder="Nro"><br>
            <label>Nombre</label>
            <input type="text" name="nya_cocinero" value= "<?php echo $fila['nya_cocinero']?>" placeholder="Nombre"><br>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    $nro_cocinero = $_GET['nro_cocinero'];
    $nombre = $_GET['nya_cocinero'];
    

    if( $nro_cocinero!=null && $nombre!=null){
        $sql2 = "UPDATE cocineros SET nro_cocinero='".$nro_cocinero."',nya_cocinero='".$nombre."' WHERE nro_cocinero='".$nro_cocinero."'";
        mysqli_query($conn,$sql2);
        header('location:abm_cocineros.php');

	}

?>