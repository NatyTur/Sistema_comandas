<?php
include 'conexion.php';

$nro_menu = $_GET['nro_menu'];

$sql = "SELECT * FROM menues WHERE nro_menu='".$nro_menu."'";
$resultado = mysqli_query($conn,$sql);

while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_menu.php" class="btn-light" >Volver</a><br>


 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifMenu.php" method="GET">
			<!--almacena el codigo de la materia a modificar y para que no sea un valor fijo sino que el usuario pueda elegir rescatamos del array asociativo fila el nro_menu ingresado en la consulta.Hacemos lo mismo con los demás campos
			"value" será el valor por defecto que tendrá el campo de texto y que le aparecerá al usuario al cargar el formulario
			Los placeholders se usan sobre todo para informar al usuario de qué debe escribir en un campo de un formulario-->
			
            <label>Nro Menu</label>
            <input type="number" name="nro_menu" value= "<?php echo $fila['nro_menu']?>" placeholder="menú"><br>
            <label>Nombre</label>
            <input type="text" name="descrip_menu" value= "<?php echo $fila['descrip_menu']?>" placeholder="descripcion"><br>
            <label>Categoría</label>
            <input type="number" name="nro_cat_menu" value= "<?php echo $fila['nro_cat_menu']?>" placeholder="categoría"><br>
			<label>Precio</label>
			<input type="number" name="precio_unitario" value= "<?php echo $fila['precio_unitario']?>" placeholder="precio"><br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    $nro_menu = $_GET['nro_menu'];
    $descrip_menu = $_GET['descrip_menu'];
    $cat_menu = $_GET['nro_cat_menu'];
    $p_uni = $_GET['precio_unitario'];

    if($nro_menu!=null && $descrip_menu!=null && $cat_menu!=null && $p_uni!=null){
        $sql2 = "UPDATE menues SET descrip_menu='".$descrip_menu."',nro_cat_menu='".$cat_menu."',precio_unitario='".$p_uni."' WHERE nro_menu='".$nro_menu."'";
        mysqli_query($conn,$sql2);
        header('location:abm_menu.php');

	}

?>