<?php
include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$user_id = $_SESSION['id'];

$sql1 = ' SELECT * FROM `class_info`, `join_info` WHERE `join_info`.`user_id` = "'.$user_id.'" && `join_info`.`class_id` = `class_info`.`class_id` ';
$que1 = mysqli_query($link, $sql1);
$total_classes = mysqli_num_rows($que1);

if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'joined_successfully') {
        echo '<script type="text/javascript">alert("Successfully Joined!");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joined classes</title>
    <style>
        .classes {
            height: 135px;
            width: 194px;
            background-color: #a3ef87;
            float: left;
            margin-left: 35px;
            margin-bottom: 41px;
            padding: 0px;
            padding-top: 13px;
            border-radius: 14px;
            text-align: center;
            font-family: cursive;
        }

        .classes p {
            padding-left: 0px;
            margin-bottom: 8px;
        }

        .all_class {
            min-height: 441px;
            width: 1090px;
            margin: 0px auto;
            /*background-color: gray;*/
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <?php include('user_home.php'); ?>
    <hr>

    <h1 style="text-align: center;color:darkslategrey; margin-top:10px">My Joined classes</h1>
    <br>
    <br>
    <div class="all_class">
        <?php
        if (mysqli_num_rows($que1) == 0) {
        ?>
            <p class="no_class">You have not joined any class yet. <a href="join_class_by_user.php">Click here</a> to join.</p>
            <?php
        } else {
            $i = 1;
            while ($row1 = mysqli_fetch_array($que1)) {
                
            ?>
                <a href="class_details.php?id=<?php echo $row1['class_id']; ?>">
                    <div class="classes">
                        <p>Class Id:<?php echo $row1['class_id']; ?></p>
                        <p>Class Name:<?php echo $row1['class_name']; ?></p>
                        <p>Class Code: <?php echo $row1['class_code']; ?></p>
                    </div>
                </a>

        <?php

                $i++;
            }
        }
        ?>
    </div>

    <?php
    include('footer.php');
    ?>
</body>

</html>