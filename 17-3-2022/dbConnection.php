<?php  
$server = "localhost";
$dbName = "task-14-3-2022";
$dbUser = "root";
$dbPassword= "";

$con = mysqli_connect($server,$dbUser,$dbPassword,$dbName);

if(!$con){
    die('Error '.mysqli_connect_error() );
}

?>