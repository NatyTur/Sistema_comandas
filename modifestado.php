<?php include 'conexion.php'; ?>


							<?php
							/*Rescata los campos de la url para modificarlos*/
							$nro_estado = $_GET['numero_estado'];
							$id_atencion = $_GET['atencion'];
							/*MODIFICO CAMPOS*/

							if($nro_estado!=null){
								$query = "UPDATE atencion_por_mesa SET cdo_estado_atencion='".$nro_estado."'WHERE id_atencion='".$id_atencion."'" ;
								mysqli_query($conn,$query);
								header('location:CocinaComanda.php');
								
								$nro_estado=null;
							}?>