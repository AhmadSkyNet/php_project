<?php
function escape($string) {
global $connection;
return mysqli_real_escape_string($connection, $string);}

function confirmQuery($result) {  
    global $connection;
    if(!$result) {        
          die("QUERY FAILED ." . mysqli_error($connection));}
        }