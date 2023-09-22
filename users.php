<?php
require_once('./mysqli_connect.php');
// $email=$_POST['email'];
$email='lfcornelas@gmail.com';
// echo json_encode($email);

					$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
							$stmt->bind_param("s",$email);
							$stmt->execute();
							$stmt->bind_result( $id, $name, $email,$password,$colegio,$comite,$pais,$pago);
							$stmt->fetch();

							$user = array(
								'id'=>$id,
								'name'=>$name,
								'email'=>$email,
								'password'=>$password,
								'escuela'=>$colegio,
								'comite'=>$comite,
								'pais'=>$pais,
								'imagen'=>$pago

							);

							$stmt->close();
							$response['data'] = $user;

					echo json_encode($response['data']);

?>