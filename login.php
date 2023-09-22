<?php
require_once('./mysqli_connect.php');
$keys=array('email','password');
$email=$_POST['email'];
//$password=$_POST['password'];
$password = htmlspecialchars($_POST['password']);
$pasword2;
$response;
for ($i = 0; $i < count($keys); $i++){
	if(!isset($_POST[$keys[$i]]))

	 {
		  $response['error'] = true;
			$response['message'] = 'Required Filed Missed';
			echo json_encode($response);
		  return;
	 }
	 // else {
	 // 	$response['error'] = true;
		// $response['message'] = $email;
		// $response['prueba']=count($keys);
		// $response['pass'] = $password;
	 	
	 // }

}

// $stmt = $con->prepare("SELECT id,name,email,password,colegio,comite,pais,pago,estatus FROM users WHERE email = ? AND password = ?");
$stmt = $con->prepare("SELECT id,name,email,password,colegio,comite,pais,pago,estatus FROM users WHERE email = ?");
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$stmt->store_result();
					$response['message'] = "1";
					if($stmt->num_rows > 0){
						$response['message'] = "2";
						$stmt->bind_result( $id, $name, $email,$password2,$colegio,$comite,$pais,$pago,$estatus);
							$stmt->fetch();
							// $response['pass2'] = $password2 ;
							// $response['pass1'] = $password;
							// if($password==$password2){
							if(password_verify($password,$password2)){
								$response['message'] = "4";
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
							 $response['message'] = "5";
							$stmt->close();
							$response['error'] = false;
							$response['message'] = 'Usuario logueado existosamente';
							$response['data'] = $user;
						}
						else{
							$response['error'] = true;
							$response['message'] = 'Contrasena Incorrecta';
							$stmt->close();
						}
					}else
					{
						$response['error'] = true;
						$response['message'] = 'Usuario Invalidos';
						$stmt->close();

					}
					echo json_encode($response);
?>