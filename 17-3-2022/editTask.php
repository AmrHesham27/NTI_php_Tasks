<?php
include_once './checkLogin.php';
include_once './dbConnection.php';

$userId = $_SESSION['user'];
$taskId = $_GET['taskId'];

// edit logic


// show user data
$sql = "SELECT id FROM tasks WHERE id='$taskId'";
$op =  mysqli_query($con,$sql);


?>
<form action=<?php echo $_SERVER['PHP_SELF']."?taskId=".$taskId ?> method='post' enctype="multipart/form-data" 
      class="mx-auto my-5" style="width: 300px;">
    <div class="btn-3 mt-3">
        <label>Title</label>
        <input name="Title" value=<?php echo $data['Title'] ?> class="form-control">
    </div>
    <div class="btn-3 mt-3">
        <label>Content</label>
        <input name="Content" value=<?php echo $data['Content'] ?> class="form-control" minLength='50'>
    </div>
    <div class="btn-3 mt-3">
        <label>Image</label>
        <img src=<?php echo $data['disImg'] ?>>
        <input type='file' name="Image" class="form-control">
    </div>
    
    <div class="btn-3 my-5">
        <button type='submit' name="submit" class="btn btn-primary my-5"> Edit </button>
    </div>
    <?php
        require_once './components/message.php';
    ?>
</form>