<?php
    session_start();
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "classroom";
    $link = mysqli_connect($db_host, $db_user, $db_password);
    mysqli_select_db($link, $db_name);
    $error = mysqli_connect_error();
    if($error!=NULL){
        echo $error;
    }
?>