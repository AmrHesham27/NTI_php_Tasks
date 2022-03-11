<?php 
    include_once './components/header.php';
    include_once './components/navBar.php'; 
?>
<h1 class="text-center"> Blog </h1>
<div class="Container my-5">
    <?php
        if( $_SERVER['REQUEST_METHOD'] == 'POST'){
            $db = fopen('db.txt','r') or die("unable to open file ");
            $file_path = $_POST['Delete'];
            while(!feof($db)){
                $line = fgets($db);
                if($line == '') continue;
                if(strpos($line, $file_path)){
                    $contents = file_get_contents('./db.txt');
                    $contents = str_replace($line, '', $contents);
                    file_put_contents('./db.txt', $contents);
                }
            };
            unlink($file_path);
            fclose($db);
        };
        $db = fopen('db.txt','r') or die("unable to open file ");
        while(!feof($db)){ 
            $line = fgets($db);
            if($line == '') continue;

            $Title = explode(' Content=', $line)[0];
            $Title = explode('Title=', $Title)[1];

            $Content = explode(' disPath=', $line)[0];
            $Content = explode(' Content=', $Content)[1];

            $disPath = explode(' disPath=', $line)[1];

            echo "
                <div class='card'>
                    <h3 class='text-center'>{$Title}</h3>
                    <img width='300' src={$disPath}/>
                    <p class='text'>{$Content}</p>
                    <form method='post' action=".$_SERVER['PHP_SELF'].">
                        <input class='hiddenInput' name='Delete' value=".$disPath."/>
                        <button class='btn btn-danger my-3'> Delete </button>
                    </form>
                </div>
            ";
        };
        fclose($db);
    ?>
</div>
<?php
    include_once './components/footer.php';
?>