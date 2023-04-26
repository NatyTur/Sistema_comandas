<?php include 'conexion.php'; ?>


							<?php
							/*Rescata los campos de la url para modificarlos*/
							$nro_estado = $_GET['numero_estado2'];
							$id_atencion = $_GET['atencion'];
							/*MODIFICO CAMPOS*/

							if($nro_estado!=null){
								$query = "UPDATE atencion_por_mesa SET cdo_estado_atencion='".$nro_estado."'WHERE id_atencion='".$id_atencion."'" ;
								mysqli_query($conn,$query);
								header('location:AbmAtMesas.php');
								
								if($nro_estado==4){//para cobrar 
									
									$query = "SELECT * FROM comandas WHERE (id_atencion='".$id_atencion."' AND debaja=0)";
									$resultado_comanda = mysqli_query($conn, $query);
									$total = 0;
									
									while($comanda = mysqli_fetch_assoc($resultado_comanda)){
									
									$query = "SELECT precio_unitario FROM menues WHERE nro_menu='".$comanda['nro_menu']."'";
									$resultado_precio = mysqli_query($conn, $query);
									$precio = mysqli_fetch_assoc($resultado_precio)['precio_unitario'];//pongo el único valor que necesito entre corchetes, sino falla el fetch
									
									$total = $total + ($comanda['cantidad_pedida'] * $precio);
									
									}
									
									
									$query = "UPDATE atencion_por_mesa SET total_atencion='".$total."'WHERE id_atencion='".$id_atencion."'" ;
									mysqli_query($conn,$query);
									header('location:AbmAtMesas.php');
									
								}
								$nro_estado=null;
							}?>