<?php
require_once('./mysqli_connect.php');
$nominaciones=array();
$nameuser=$_POST['user'];
//$nameuser="Luis Francisco Ornelas Rios";
$id_nameuser=[];
$id_nominaciones=[];
$nominacionesfinal=[];
				$stmt = $con->query("SELECT voto1,voto2,voto3,voto4,voto5 FROM users WHERE name= '".$nameuser. "'");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$id_nameuser=$row;
    				}
    			}

    			$stmt = $con->query("SELECT id,categoria FROM nominaciones");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						array_push($id_nominaciones, $row);
    				}

    			}
    			$i=0;
    			foreach ($id_nameuser as $clave => $valor)
    			{
    				 if ($valor == 0){
    				 	array_push($nominacionesfinal,$id_nominaciones[$i]);
    				 }
    				 $i++;
    			}
    			 echo json_encode($nominacionesfinal);
?> 