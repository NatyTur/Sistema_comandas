<?php
include 'conexion.php';

$nro_mozo = $_GET['nro_mozo'];

$sql = "SELECT * FROM mozos WHERE nro_mozo='".$nro_mozo."'";
$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_mozos.php" class="btn-light" >Volver</a><br>


 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifMozo1.php" method="GET">
			
			
            <label>Nro</label>
            <input type="number" name="nro_mozo" value= "<?php echo $fila['nro_mozo']?>" placeholder="Nro"><br>
            <label>Nombre</label>
            <input type="text" name="nya_mozo" value= "<?php echo $fila['nya_mozo']?>" placeholder="Nombre"><br>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    $nro_mozo = $_GET['nro_mozo'];
    $nombre = $_GET['nya_mozo'];
    

    if( $nro_mozo!=null && $nombre!=null){
        $sql2 = "UPDATE mozos SET nro_mozo='".$nro_mozo."',nya_mozo='".$nombre."' WHERE nro_mozo='".$nro_mozo."'";
        mysqli_query($conn,$sql2);
        header('location:abm_mozos.php');

	}

?>