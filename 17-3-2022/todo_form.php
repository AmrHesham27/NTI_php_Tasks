<?php 
include_once './checkLogin.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './validation.php';
require_once './dbConnection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // validate data
    $Title = $_POST['Title'];
    Validation::required_input('Title', $Title);
    Validation::validate_string('Title', $Title);
    $Title = Validation::filterData($Title);

    $Content = $_POST['Content'];
    Validation::required_input('Content', $Content);
    Validation::minLength('Content', $Content, 50);
    $Content = Validation::filterData($Content);

    $Date = $_POST['Date'];
    Validation::validateDate($Date);

    if ( count(Validation::$errors) != 0 ){
        $_SESSION['mssg'] = reset(Validation::$errors); 
    }
    else {
        // save in sql 
        $userId = $_SESSION['user'];
        $sql = "insert into tasks (user_id ,Title, Content, taskDate) values ('$userId','$Title','$Content','$Date')";
        $op =  mysqli_query($con,$sql);
        if ($op){
            $_SESSION['mssg'] = 'Your Task was inserted';
        }else {
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
        }
        mysqli_close($con);
    }
}
?>
<form action=<?php echo $_SERVER['PHP_SELF']?> method='post' class="mx-auto my-5" style="width: 300px;">
    <div class="btn-3 mt-3">
        <label>Title</label>
        <input name="Title" class="form-control">
    </div>
    <div class="btn-3 mt-3">
        <label>Content</label>
        <input name="Content" class="form-control" minLength='50'>
    </div>
    <div class="btn-3 mt-3">
        <label>Date</label>
        <input type="date" name="Date" class="form-control">
    </div>
    
    <div class="btn-3 my-5">
        <button type='submit' name="submit" class="btn btn-primary my-5"> Add Task </button>
    </div>
    <?php
        require_once './components/message.php';
    ?>
</form>
<?php
    include_once './components/footer.php';
?>