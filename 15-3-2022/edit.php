<?php 
include_once './checkLogin.php';
require_once './components/header.php';
require_once './components/navBar.php';
require_once './validation.php';
require_once './dbConnection.php';

// check valid URL
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
if($_SERVER['REQUEST_METHOD'] == 'GET' && !array_key_exists('disImg', $queries)){
    header("Location: blog.php");
};

// get article data
$disImg = $queries['disImg'];
$sql = "SELECT Title, Content, disImg From articles WHERE disImg='$disImg'";
$op = mysqli_query($con,$sql);
if (!$op){
    $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
}
elseif (mysqli_num_rows(mysqli_query($con,$sql)) != 1){
    $_SESSION['mssg'] = "sorry this article is not found";
}
$data = mysqli_fetch_assoc($op);

// edit logic
if($_SERVER['REQUEST_METHOD'] == 'POST'){    
    // validate data
    if(!empty( $_POST['Title'] )){
        $Title = $_POST['Title'];
        Validation::validate_string('Title', $Title);
        $Title = Validation::filterData($Title);
    }
    else {
        $Title = $data['Title'];
    }
    
    if(!empty ( $_POST['Content'] )){
        $Content = $_POST['Content'];
        Validation::minLength('Content', $Content, 50);
        $Content = Validation::filterData($Content);
    }
    else {
        $Contet = $data['Content'];
    }
    

    $Image = $_FILES['Image'];
    if( $Image['size'] != 0 ){
        $fileArray = explode('/', $Image['type']);
        $fileExtension = end( $fileArray );
        $allowedExtensions = ['jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG'];
        if( !in_array($fileExtension, $allowedExtensions) ){
            Validation::$errors['Image'] = 'allowed extensions are only jpeg ,jpg and png';
        };
        $FinalName = time() . rand() . '.' . $fileExtension;
        $disImg = 'uploads/' . $FinalName;
        if (!move_uploaded_file($Image['tmp_name'], $disImg)) {
            $_SESSION['mssg'] = 'please try again ';
        }
        else {
            unlink($data['disImg']);
        }
    }
    else {
        $disImg = $data['disImg'];
    }
    
    // print errors if any
    if ( count(Validation::$errors) != 0 ){
        $_SESSION['mssg'] = reset(Validation::$errors); 
    }
    else{
        // save in sql 
        $old_path = $data['disImg'];
        $sql = 
        "UPDATE articles
        SET Title = '$Title', Content = '$Content', disImg = '$disImg'
        WHERE disImg = '$old_path';";
        $op =  mysqli_query($con,$sql);
        if ($op){
            $_SESSION['mssg'] = 'Your article was edited';
        }
        else {
            $_SESSION['mssg'] = 'Error Try Again '.mysqli_error($con);
        }
        header("Location: blog.php");
    }
    mysqli_close($con);
}
?>
<form action=<?php echo $_SERVER['PHP_SELF']."?disImg=".$disImg ?> method='post' enctype="multipart/form-data" 
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
<?php
    include_once './components/footer.php';
?>