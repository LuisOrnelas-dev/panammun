<?php
require_once('./mysqli_connect.php');
$paises=array();
$comite=$_POST['comite'];
$id_comite="";
$id="";
				$stmt = $con->query("SELECT id FROM comites WHERE comite= '".$comite. "'");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$id_comite=$row['id'];
						//echo json_encode($id_comite);
    				}
    			}
    				if ($id_comite!=""){
					$stmt = $con->query("SELECT * FROM paises WHERE id_comite = '".$id_comite. "'");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$paises[]=$row;
    				}
    				// if (empty($paises))
    				// 	echo "nopaises";
    				// else
					echo json_encode($paises);
				}
			}
			else
				echo json_encode("Sin resultados");
?> 