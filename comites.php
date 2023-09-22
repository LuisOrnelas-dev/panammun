<?php
require_once('./mysqli_connect.php');
$comites=array();
$lugarescomites=array();
					$stmt = $con->query("SELECT * FROM comites WHERE lugares>0");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$comites[]=$row;
    				}
					echo json_encode($comites);
				}

?>