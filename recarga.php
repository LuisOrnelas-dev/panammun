<?php
require_once('./mysqli_connect.php');
$keys=array('email');
$email=$_POST['email'];
for ($i = 0; $i < count($keys); $i++){
	if(!isset($_POST[$keys[$i]]))

	 {
		  $response['error'] = true;
			$response['message'] = 'Required Filed Missed';
			echo json_encode($response);
		  return;
	 }

}

$stmt = $con->prepare("SELECT id,name,email,password,colegio,comite,pais,pago,estatus FROM users WHERE email = ?");
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$stmt->store_result();
					if($stmt->num_rows > 0){

						$stmt->bind_result( $id, $name, $email,$password,$colegio,$comite,$pais,$pago,$estatus);
							$stmt->fetch();

							$user = array(
								'id'=>$id,
								'name'=>$name,
								'email'=>$email,
								'password'=>$password,
								'escuela'=>$colegio,
								'comite'=>$comite,
								'pais'=>$pais,
								'imagen'=>$pago,
								'estatus'=>$estatus
							);

							$stmt->close();
							$response['error'] = false;
							$response['message'] = 'Recarga de página exitosa';
							$response['data'] = $user;
					}else
					{
						$response['error'] = true;
						$response['message'] = 'Recarga de página con error';
						$stmt->close();

					}
					echo json_encode($response);

?>