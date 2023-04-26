<?php include 'conexion.php'; ?>


							<?php
							/*Rescata los campos de la url para modificarlos*/
							$mesa = $_GET['mesa'];
						
							/*MODIFICO CAMPOS*/

							if($mesa!=null){
								
								$query= "SELECT * FROM atencion_por_mesa WHERE (cdo_estado_atencion<'5' OR cdo_estado_atencion='7') AND nro_mesa='".$mesa."'";
								$resultado_atencion= mysqli_query($conn, $query);
								
								while($atencion = mysqli_fetch_assoc($resultado_atencion)){
									
									$query = "UPDATE atencion_por_mesa SET cdo_estado_atencion='5' WHERE id_atencion='".$atencion['id_atencion']."'" ;
									mysqli_query($conn,$query);
								}
							}	
									header('location:AbmAtMesas.php');?>
									
							
							