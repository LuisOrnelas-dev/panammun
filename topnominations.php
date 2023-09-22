<?php 

require_once('./mysqli_connect.php');
$votostotales1=[];
$votostotales2=[];
$votostotales3=[];
$votostotales4=[];
$votostotales5=[];

$comite=$_POST['comite'];
$query = "SELECT pais,comite,votototal1 FROM users WHERE comite='".$comite. "' ORDER BY votototal1 DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
$i=0;
    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
        {
            array_push($votostotales1, $items);
        }
    }

$query = "SELECT pais,comite,votototal2 FROM users WHERE comite='".$comite. "' ORDER BY votototal2 DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
$i=0;
    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
        {
            array_push($votostotales2, $items);
        }
    }

$query = "SELECT pais,comite,votototal3 FROM users WHERE comite='".$comite. "' ORDER BY votototal3 DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
$i=0;
    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
        {
            array_push($votostotales3, $items);
        }
    }

$query = "SELECT pais,comite,votototal4 FROM users WHERE comite='".$comite. "' ORDER BY votototal4 DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
$i=0;
    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
        {
            array_push($votostotales4, $items);
        }
    }

$query = "SELECT pais,comite,votototal5 FROM users WHERE comite='".$comite. "' ORDER BY votototal5 DESC LIMIT 3";
$query_run = mysqli_query($con, $query);
$i=0;
    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $items)
        {
            array_push($votostotales5, $items);
        }
    }
    echo json_encode(array("votototal1" => $votostotales1, "votototal2" => $votostotales2, "votototal3" => $votostotales3, "votototal4" => $votostotales4, "votototal5" => $votostotales5));
?>

