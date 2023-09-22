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
					//DELETE USER
					$stmt = $con->prepare("DELETE FROM users WHERE email = ? ");
					$stmt->bind_param("s", $email);

                    if ($stmt->execute()){
                        $response['error'] = false;
                        $response['message'] = 'Usuario eliminado exitosamente';
                        $stmt->close();
                    }
                    else {
                        $response['error'] = true;
                        $response['message'] = 'Error al eliminar usuario';
                        $stmt->close();
                    }
					echo json_encode($response);


?>