<?php

/*$db_host='localhost';
$db_user='root';
$db_password='';
$db_database='panamun';*/
$db_host='n4m3x5ti89xl6czh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$db_user='cv5bbahxm1kt1vtg';
$db_password='wffug2t5rg39ipn9';
$db_database='qrlzu096cuz0qcw0';

$con=mysqli_connect($db_host,$db_user,$db_password,$db_database);

if (mysqli_connect_errno()){
    printf("connect failed: %s\n", mysqli_connect_errno());
}
//Get Heroku ClearDB connection information
/*$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);*/
?>