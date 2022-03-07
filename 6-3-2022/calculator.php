<?php
    function calculate_price($quantity){
        if ( gettype($quantity) != 'integer' || $quantity < 0 ){
            echo "please enter valid number";
            return;
        };
        if ( $quantity <= 50 ){
            $price = 3.5 * $quantity;
            return $price;
        }
        if ( $quantity <= 150 ){
            $price = 3.5 * 50;
            $price += 4 * ($quantity - 50);
            return $price;
        }
        if ( $quantity > 150 ){
            $price = (3.5 * 50) + (4 * 100);
            $price += 6.5 * ($quantity - 150);
            return $price;
        }
    };
    // Test
    echo calculate_price(-100);
    echo '<br>';
    echo calculate_price("100");
    echo '<br>';
    echo calculate_price(40);
    echo '<br>';
    echo calculate_price(120);
?>