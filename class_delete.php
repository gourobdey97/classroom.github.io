<?php

include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$class_id = $_GET['id'];

if (isset($_REQUEST['confirm'])) {
    $sql1 = ' DELETE FROM `class_info` WHERE `class_info`.`class_id` = "' . $class_id . '" ';
    $que1 = mysqli_query($link, $sql1);

    $sql2 = 'DELETE FROM `join_info` WHERE `class_id` = "' . $class_id . '"';
    $que2 = mysqli_query($link, $sql2);

    $sql3 = ' SELECT `post_id` FROM `post_details` WHERE `class_id` = "' . $class_id . '" ';
    $que3 = mysqli_query($link, $sql3);
    if (mysqli_num_rows($que3) > 0) {
        while ($row3 = mysqli_fetch_array($que3)) {
            $sql5 = 'DELETE FROM `post_comment` WHERE `post_id` = "' . $row3['post_id'] . '"';
            $que5 = mysqli_query($link, $sql5);
        }
    }

    $sql6 = 'DELETE FROM `post_details` WHERE `class_id` = "' . $class_id . '"';
    $que6 = mysqli_query($link, $sql6);

    header('Location:joined_class_by_user.php?status=class_delete');
}

if (isset($_REQUEST['cancel'])) {
    header('Location:class_information.php');
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Class</title>
    <style>
        .confirmation_notice {
            min-height: 500px;
            margin: 0 auto;
            width: 37%;
        }

        .notice {
            font-family: cursive;
            font-size: 20px;
        }

        .input1 {
            color: brown;
            font-size: 21px;
            margin-left: 27%;
            margin-top: 3%;
            border: 1px solid brown;
            border-radius: 10%;
            padding: 3px;
            font-family: cursive;
            font-weight: bold;
        }

        .input1:hover{
            cursor: pointer;
            color:wheat;
            background-color: brown;
        }

        .input2 {
            color: brown;
            font-size: 21px;
            margin-left: 9%;
            margin-top: 3%;
            border: 1px solid brown;
            border-radius: 10%;
            padding: 3px;
            font-family: cursive;
            font-weight: bold;
        }
        .input2:hover{
            cursor: pointer;
            color:wheat;
            background-color: brown;
        }
    </style>
</head>

<body>
    <?php include('user_home.php'); ?>
    <hr />

    <br><br>


    <div class="confirmation_notice">
        <p class="notice">You are going to delete this class. If you delete this class once all of data of this class will be deleted. Make sure are you want to delete this class?</p>
        <br>
        <form action="" method="post">
            <input class="input1" type="submit" value="Confirm" name="confirm">
            <input class="input2" type="submit" value="Cancel" name="cancel">
        </form>
    </div>

    <br>
    <?php
    include('footer.php');
    ?>
</body>

</html>