<?php

include 'conexion.php';

?>


							<?php
							/*Rescata los campos de la url para modificarlos*/
							$nro_mozo = $_GET['numero_mozo'];
							$id_atencion = $_GET['atencion'];
							/*MODIFICO CAMPOS*/

							if($nro_mozo!=null){
								$sql2 = "UPDATE atencion_por_mesa SET nro_mozo='".$nro_mozo."'WHERE id_atencion='".$id_atencion."'" ;
								mysqli_query($conn,$sql2);
								header('location:AbmAtMesas.php');
								$nro_mozo=null;
							}?>
