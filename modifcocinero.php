<?php

include 'conexion.php';

?>


							<?php
							/*Rescata los campos de la url para modificarlos*/
							$nro_cocinero = $_GET['numero_cocinero'];
							$id_atencion = $_GET['atencion'];
							/*MODIFICO CAMPOS*/

							if($nro_cocinero!=null){
								$sql2 = "UPDATE atencion_por_mesa SET nro_cocinero='".$nro_cocinero."'WHERE id_atencion='".$id_atencion."'" ;
								mysqli_query($conn,$sql2);
								header('location:CocinaComanda.php');
								$nro_cocinero=null;
							}?>
