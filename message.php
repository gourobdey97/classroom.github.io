<?php
include('database.php');
if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$class_id = $_GET['id'];
$user_id = $_SESSION['id'];

$sql2 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_id` = ' . $class_id . ' ';
$que2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_array($que2);

$sql3 = ' SELECT * FROM `user_info` WHERE `user_id` = ' . $row2['class_created_by'] . ' ';
$que3 = mysqli_query($link, $sql3);
$row3 = mysqli_fetch_array($que3);

$sql4 = ' SELECT * FROM `message_info` WHERE `class_id`="' . $class_id . '" ';
$que4 = mysqli_query($link, $sql4);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row2['class_name']; ?></title>
    <style>
        * {
            margin: 0px;
            padding: 0px
        }

        .class_name a {
            text-decoration: none;
            font-weight: bold;
            font-size: 45px;
            padding: 15px;
            color: darkslategrey;
        }

        .created_by,
        .created_date {
            font-size: 20px;
            float: left;
            margin-left: 17px;
        }

        .content{
            min-height: 500px;
            width:60%;
            background-color: wheat;
        }
    </style>
</head>

<body>
    <?php include('user_home.php'); ?>
    <hr />
    <header>
        <p class="class_name"><a href="class_information.php?id=<?php echo $row2['class_id']; ?>"><?php echo $row2['class_name']; ?></a></p>
        <p class="created_by"> Created by <?php echo $row3['user_name']; ?> ||</p>
        <p class="created_date"> Created date: <?php echo $row2['class_date']; ?></p>
    </header>

    <br><br>
    <hr>

    <div class="content">

    </div>

    <br>
    <?php
    include('footer.php');
    ?>
</body>

</html>