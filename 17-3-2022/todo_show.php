<?php
include_once './checkLogin.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './validation.php';
require_once './dbConnection.php';
// save in sql 
$userId = $_SESSION['user'];
$sql = "SELECT id, Title, Content, taskDate FROM tasks WHERE user_id = $userId";
$op =  mysqli_query($con,$sql);
if (!$op){
    $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
}else {
    while($raw = mysqli_fetch_assoc($op)){
        echo "
        <div class='card'>
            <p>".$raw['Title']."</p>
            <p>".$raw['Content']."</p>
            <p>".$raw['taskDate']."</p>
            <a  
                href=deleteTask.php?taskId={$raw['id']}
                class='btn btn-danger my-3'
            > 
                Delete 
            </a>
            <a  
                href=editTask.php?taskId={$raw['id']}
                class='btn btn-primary my-3'
            >
                Edit
            </a>
        </div>
        ";
    }
}
mysqli_close($con);
?>
<div class='my-5'>
    <?php
    require_once './components/message.php';
    ?>
</div>
