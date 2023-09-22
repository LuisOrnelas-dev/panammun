<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('./mysqli_connect.php');
require ('./uploadtobucket.php');
$return["error"] = false;
$return["msg"] = "";
$return["uploadstatus"] = "";
$return["success"] = false;
//array to return
$nameuser=$_POST['nameuser'];
echo $nameuser;

if(isset($_FILES["file"])){
    //directory to upload file
    $target_dir = "files"; //create folder files/ to save file
    $filename = $_FILES["file"]["name"]; 
    $savefile = "$target_dir/$filename";
    //complete path to save file
    $stmt = $con->prepare("UPDATE users SET doc1=? WHERE name=?");
    $stmt->bind_param("ss", $filename,$nameuser);
    // echo $filename;
    // if the user is successfully added to the database
    if($stmt->execute()){

    if(move_uploaded_file($_FILES["file"]["tmp_name"],$filename)) {
        $return["uploadstatus"] = upload_to_bucket($filename);
        $return["error"] = false;
        //upload successful
    }else{
        $return["error"] = true;
        $return["msg"] =  "Error during saving file.";
    }
        }
}else{
    $return["error"] = true;
    $return["msg"] =  "No file is sublitted.";
}

// header('Content-Type: application/json'); //esta linea genera problemas 
// tell browser that its a json data
echo json_encode($return);
//converting array to JSON string
?>