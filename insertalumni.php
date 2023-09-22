<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once('./mysqli_connect.php');

$id=intval($_POST['ID']);
$value=intval($_POST['value']);
$comite=$_POST['comite'];
$pais=$_POST['pais'];
$valordeny=2;
// echo "Valor de id ". $id . " Valor de acccion " .$value;
if ($value == 1){
	$stmt = $con->prepare("UPDATE users SET estatus=? WHERE id=?");
	$stmt->bind_param("ii", $value,$id);
	$stmt->execute(); 
	$stmt->close();

	$stmt = $con->prepare("UPDATE comites SET lugares=lugares-1 WHERE comite=?");
	$stmt->bind_param("s", $comite);
	$stmt->execute(); 
	$stmt->close();
	//update ocupado pais-comite
	$stmt = $con->prepare("UPDATE paises INNER JOIN comites ON paises.id_comite=comites.id 
		SET paises.ocupado=1 WHERE comites.comite=? AND paises.pais=?");
	$stmt->bind_param("ss", $comite,$pais);
	$stmt->execute(); 
	$stmt->close();

	$response = 'err1';
}
else{
	if ($value == 0){
		// $stmt = $con->prepare("DELETE FROM users WHERE id=?");
		// $stmt->bind_param("i",intval($id));
		// $stmt->execute(); 
		// $stmt->close();
		$stmt = $con->prepare("UPDATE users SET estatus=? WHERE id=?");
		$stmt->bind_param("ii", $valordeny,$id);
		$stmt->execute(); 
		$stmt->close();
		$response = 'err2';
	}
	else{
		$response == 'err3';
	}
}
echo json_encode($response);
?>