<?php
include 'conexion.php';

$nro_cat = $_GET['nro_categoria_menu'];

$sql = "SELECT * FROM categorias_menu WHERE nro_categoria_menu='".$nro_cat."'";
$resultado = mysqli_query($conn,$sql);


	
while($fila=mysqli_fetch_assoc($resultado)){
?>

<a href="abm_categoria.php" class="btn-light" >Volver</a><br>	
 <!--BUSQUEDA DE LO QUE VOY A MODIFICAR-->
<fieldset>
        <legend>EDITAR</legend>
        <form action="ModifCategoria.php" method="GET">
			<!--almacena el codigo de la materia a modificar y para que no sea un valor fijo sino que el usuario pueda elegir rescatamos del array asociativo fila el nro_menu ingresado en la consulta.Hacemos lo mismo con los demás campos
			"value" será el valor por defecto que tendrá el campo de texto y que le aparecerá al usuario al cargar el formulario
			Los placeholders se usan sobre todo para informar al usuario de qué debe escribir en un campo de un formulario-->
			
			
            <label>Nro</label>
            <input type="number" name="nro_cat" value= "<?php echo $fila['nro_categoria_menu']?>"readonly><br>
            <label>Nombre</label>
            <input type="text" name="descrip_cat" value= "<?php echo $fila['descrip_categoria_menu']?>" placeholder="descripcion"><br>
            <br>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
</fieldset>



<!--MODIFICO CAMPOS-->
<?php
/*Rescata los campos de la url para modificarlos*/
    $nro_cat = $_GET['nro_cat'];
    $descrip_cat = $_GET['descrip_cat'];
   

    if($nro_cat!=null && $descrip_cat!=null){
        $sql2 = "UPDATE categorias_menu SET nro_categoria_menu='".$nro_cat."',descrip_categoria_menu='".$descrip_cat."' WHERE nro_categoria_menu='".$nro_cat."'";
        mysqli_query($conn,$sql2);
        header('location:abm_categoria.php');

	}

?>