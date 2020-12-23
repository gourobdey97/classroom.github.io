<?php

include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$post_id = $_GET['id'];

$sql1 = ' DELETE FROM `post_details` WHERE `post_details`.`post_id` = "'.$post_id.'" ';
$que1 = mysqli_query($link, $sql1);

header('Location:class_details.php?status=post_delete');


?>
