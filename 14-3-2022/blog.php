<?php 
    include_once './components/header.php';
    include_once './components/navBar.php'; 
    include_once './dbConnection.php';
    $sql = "select Title , Content , disImg from articles";
    $data = mysqli_query($con,$sql); 
?>
<h1 class="text-center"> Blog </h1>
<div class="Container my-5">
    <?php
        // delete article if there are URL params
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        if(count($queries) != 0){
            $disImg = $queries['disImg'];
            $sql = "DELETE FROM articles WHERE disImg='$disImg'";
            if ( !$con->query($sql) ) {
                echo "Error : mysqli_error($con)";
            }
            else {
                unlink($disImg);
                header("Location: blog.php");
            }
        }
        // show articles
        while($raw = mysqli_fetch_assoc($data)){
            echo "
                <div class='card'>
                    <h3 class='title text-center'>{$raw['Title']}</h3>
                    <img width='300' src={$raw['disImg']}>
                    <p class='text'>{$raw['Content']}</p>
                    <a  
                        href=".$_SERVER['PHP_SELF']."?disImg=".$raw['disImg']." 
                        class='btn btn-danger my-3'
                    > 
                        Delete 
                    </a>
                </div>
            ";
        };
        mysqli_close($con);
    ?>
</div>
<?php
    include_once './components/footer.php';
?>