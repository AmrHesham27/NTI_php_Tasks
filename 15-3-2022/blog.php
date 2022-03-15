<?php 
    include_once './checkLogin.php';
    include_once './components/header.php';
    include_once './components/navBar.php'; 
    include_once './dbConnection.php';
    $sql = "select Title , Content , disImg from articles";
    $data = mysqli_query($con,$sql);
    if (!$data){
        echo 'Error Try Again '.mysqli_error($con);
    };
?>
<h1 class="text-center"> Blog </h1>
<div class="Container my-5">
    <?php
        while($raw = mysqli_fetch_assoc($data)){
            echo "
                <div class='card'>
                    <h3 class='title text-center'>{$raw['Title']}</h3>
                    <img width='300' src={$raw['disImg']}>
                    <p class='text'>{$raw['Content']}</p>
                    <a  
                        href=delete.php?disImg={$raw['disImg']}
                        class='btn btn-danger my-3'
                    > 
                        Delete 
                    </a>
                    <a  
                        href=edit.php?disImg={$raw['disImg']}
                        class='btn btn-primary my-3'
                    > 
                        Edit 
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