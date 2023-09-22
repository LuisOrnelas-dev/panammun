<?php
require_once('./mysqli_connect.php');
require ('./uploadtobucket.php');

$keys=array('name','email','password','escuela','comite','pais','imagen','nameimg');
//$password=$_POST['password'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$email=$_POST['email'];
$name=$_POST['name'];
$escuela=$_POST['escuela'];
$comite=$_POST['comite'];
$pais=$_POST['pais'];

$image = $_POST['imagen'];
$nameimg = $_POST['nameimg'];
$img = base64_decode($image);

$image = $nameimg;
file_put_contents($image, $img);
$response['uploadstatus'] = upload_to_bucket($image);

for ($i = 0; $i < count($keys); $i++){
	if(!isset($_POST[$keys[$i]]))

	 {
		  $response['error'] = true;
			$response['message'] = 'Required Filed Missed';
			echo json_encode($response);
		  return;
	 }

}


					//as the email and username should be unique for every user
					$stmt = $con->prepare("SELECT id FROM users WHERE email = ? ");
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$stmt->store_result();

					//if the user already exist in the database
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();

					}else{
						// echo ("entre1");
						//if user is new creating an insert query
						$stmt = $con->prepare("INSERT INTO users ( name,email, password,colegio,comite,pais,pago) VALUES (?,?,?,?,?,?,?)");
						$stmt->bind_param("sssssss",  $name, $email, $password,$escuela,$comite,$pais,$image);

						//if the user is successfully added to the database
						if($stmt->execute()){
							// echo ("entre2");
							//fetching the user back
							$stmt = $con->prepare("SELECT id,name,email,password,colegio,comite,pais,pago,estatus FROM users WHERE email = ?");
							$stmt->bind_param("s",$email);
							$stmt->execute();
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

							//adding the user data in response
							$response['error'] = false;
							$response['message'] = 'Usuario registrado exitosamente';
							$response['data'] = $user;

						}

					}
					echo json_encode($response);


?>