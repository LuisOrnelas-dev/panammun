<?php
require_once('./mysqli_connect.php');
$escuelas=array();
					$stmt = $con->query("SELECT * FROM escuelas");
					if ($stmt){
					while ($row = $stmt->fetch_assoc()) {
						$escuelas[]=$row;
    				}
					echo json_encode($escuelas);
				}

?>