<?php 
    include_once './components/header.php';
    include_once './components/navBar.php';

    include_once './classes/Auth.php';
    include_once './classes/Validation.php';

    Auth::isLoggedIn();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $writer = new Writer();
        $writer->addArticle($_POST['Title'], $_POST['Content'], 'Image');
    };
?>

<form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method='post' enctype="multipart/form-data" 
      class="mx-auto my-5" style="width: 300px;">
    <div class="btn-3 mt-3">
        <label>Title</label>
        <input name="Title" class="form-control">
        <?php
            Validation::echoError('Title');
        ?>
    </div>
    <div class="btn-3 mt-3">
        <label>Content</label>
        <input name="Content" class="form-control" minLength='50'>
        <?php
            Validation::echoError('Content');
        ?>
    </div>
    <div class="btn-3 mt-3">
        <label>Image</label>
        <input type='file' name="Image" class="form-control">
        <?php
            Validation::echoError('Image');
        ?>
    </div>
    
    <div class="btn-3 mt-5">
        <button type='submit' name="submit" class="btn btn-primary"> Post </button>
    </div>
    <?php
        include_once './components/mssg.php';
    ?>
</form>
<?php
    include_once './components/footer.php';
?>