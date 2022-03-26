<?php 
    include_once './components/header.php';
    include_once './components/navBar.php'; 

    Auth::isLoggedIn();
    $writer = new Writer();
    if( isset($_GET['id']) ) 
        $writer->deleteArticle($_GET['id']);
    $articles = $writer->getMyArticles();

?>
<h1 class="text-center"> My Articles </h1>
<div class="Container my-5">
    <?php
        $SQL = new SQL();
        $sql = "SELECT * FROM articles AS a LEFT JOIN writers AS w
        ON a.writer_id = w.id";
        $result = $SQL->doQuery($sql);

        while($row = mysqli_fetch_assoc($articles)){ 
            echo "
                <div class='card'>
                    <h3 class='text-center'>".$row['articleName']."</h3>
                    <img width='300' src=".$row['imagePath'].">
                    <p class='text'>".$row['content']."</p>
                    <div class='d-flex flex-row my-5'>
                        <a href=".htmlspecialchars($_SERVER['PHP_SELF'])."?id=".$row['id']." class='btn btn-danger mx-3'>Delete</a>
                        <a href=editArticle.php?id=".$row['id']." class='btn btn-primary mx-3'>Edit</a>
                    </div>
                </div>
            ";
        };
        require_once './components/mssg.php';
    ?>
</div>
<?php
    include_once './components/footer.php';
?>