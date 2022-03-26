<?php 
    include_once './components/header.php';
    include_once './components/navBar.php'; 
?>
<h1 class="text-center"> Blog </h1>
<div class="Container my-5">
    <?php
        $SQL = new SQL();
        $sql = "SELECT * FROM articles AS a LEFT JOIN writers AS w
        ON a.writer_id = w.id";
        $result = $SQL->doQuery($sql);

        while($row = mysqli_fetch_assoc($result)){ 
            echo "
                <div class='card'>
                    <h3 class='text-center'>".$row['articleName']."</h3>
                    <img width='300' src=".$row['imagePath'].">
                    <p class='text'>".$row['content']."</p>
                    <p class='text'>Writer : ".$row['userName']."</p>
                </div>
            ";
        };
    ?>
    <?php
        include_once './components/mssg.php';
    ?>
</div>
<?php
    include_once './components/footer.php';
?>