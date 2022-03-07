<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <?php
            function print_one_tr($start_color){
                echo '<tr>';
                $second_color = ($start_color == 'white') ? 'black' : 'white';
                for($td=0; $td<8 ; $td++){
                    $color = ($td % 2 == 0) ? $second_color : $start_color;
                    echo "<td style=background-color:" . $color . ";width:30px;height:30px ></td>";
                };
                echo '</tr>';
            }
            for ($row=0; $row<8; $row++){
                ($row % 2 == 0) ? $start_color = 'black' : $start_color = 'white';
                print_one_tr($start_color);
            }
        ?>
    </table>
</body>
</html> 