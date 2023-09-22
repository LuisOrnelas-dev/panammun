<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once('./mysqli_connect.php');
/*$categoria="guapo";
$pais="Mexico";
$comite="Security Council";
$user = "lfcornelas@gmail.com";*/
$categoria=$_POST['categoria'];
$pais=$_POST['pais'];
$comite=$_POST['comite'];
$user=$_POST['user'];
$id_nominacion="";
$response['variables'] = "pais " .$pais." comite ".$comite." categoria ".$categoria." user ".$user;
    $stmt = $con->query("SELECT id FROM nominaciones WHERE categoria= '".$categoria. "'");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$id_nominacion=$row['id'];
						//echo $id_nominacion;
    				}
    			}
    		$data1="votototal".$id_nominacion. "";
    		$data2="voto".$id_nominacion. "";
    		$sql1= "UPDATE users SET $data1 =$data1+1 WHERE pais='".$pais."' AND comite='".$comite."'";
    		// echo $sql1. "<br>";			
    			$stmt1 = $con->query($sql1);

		$sql2= "UPDATE users SET  $data2 = 1 WHERE email='".$user."'";
    		// echo $sql2. "<br>";			
    			$stmt2 = $con->query($sql2);
    			if ($stmt1 === TRUE && $stmt2 === TRUE){
    				$response['message'] = "Actualizacion correcta";
					echo json_encode($response);
				}
					
    			else{
					$response['message'] = "Hubo un error". $con->error;;
					echo json_encode($response);
				}
				$con->close();
?>