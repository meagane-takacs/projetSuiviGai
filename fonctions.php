<?php

function connectDB(){
    $base = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($base,'suivi_gai');

    return $base;

}

function connectDBuser2(){
    $base = mysqli_connect('localhost', 'mtakacs', 'Eebslpdmv1904');
    mysqli_select_db($base,'suivi_gai');

    return $base;

}


?>
