<?php
    /* 
        write php function to print the next character of a specific caharacter.
        Examples :
        input: 'a' => output: 'b'
        input: 'z' => output: 'a' 
    */    
    function get_next_character($char){
        if( (gettype($char) != 'string') || (strlen($char) != 1) ){
            echo 'please enter one character';
            return;
        };
        $char = strtoupper($char);
        $all_characters = range('A', 'Z');
        $next_char_index = array_search($char, $all_characters) + 1;
        if($next_char_index == 26){
            $next_char = 'A';
            return $next_char;
        };
        $next_char = $all_characters[$next_char_index];
        return $next_char;
    };
    // Test
    echo get_next_character('aa');
    echo '<br/>';
    echo get_next_character(3);
    echo '<br/>';
    echo get_next_character('b');
    echo '<br/>';
    echo get_next_character('g');
    echo '<br/>';
    echo get_next_character('Z');
?>