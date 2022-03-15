<?php
include_once './checkLogin.php';
include_once './dbConnection.php';

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$disImg = $queries['disImg'];
$sql = "DELETE FROM articles WHERE disImg='$disImg'";
if ( !$con->query($sql) ) {
    echo "Error : mysqli_error($con)";
}
else {
    unlink($disImg);
    header("Location: blog.php");
}
?>