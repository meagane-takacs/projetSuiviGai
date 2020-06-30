<?php

function connectDB(){
    $base = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($base,'suivi_gai');

    return $base;

}


?>
