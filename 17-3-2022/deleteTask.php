<?php
include_once './checkLogin.php';
include_once './dbConnection.php';
$userId = $_SESSION['user'];

// get task id from url
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$taskId = $queries['taskId'];

// make sure of two condition so that no user can delete other user tasks
$sql = "DELETE FROM tasks WHERE id='$taskId' AND user_id='$userId'";
if ( !$con->query($sql) ) {
    $_SESSION['mssg'] = "Error : mysqli_error($con)";
}
header("Location: todo_show.php");
?>