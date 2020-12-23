<?php
include('database.php');
if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$class_id = $_SESSION['class_id'];
if (isset($_GET['id'])) {
    $class_id = $_GET['id'];
    $_SESSION['class_id'] = $class_id;
}

$sql1 = ' SELECT * FROM `class_info` WHERE `class_id` = "' . $class_id . '" ';
$que1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($que1);

$sql2 = ' SELECT `user_name` FROM `user_info` WHERE `user_info`.`user_id` = "' . $row1['class_created_by'] . '" ';
$que2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_array($que2);

if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'class_code_changed') {
        echo '<script type="text/javascript">alert("Successfully changed class code!");</script>';
    }
    if ($status == 'class_updated') {
        echo '<script type="text/javascript">alert("Successfully Update your class");</script>';
    }
}

if (isset($_REQUEST['change_code'])) {
    $class_code = RAND(100000, 999999);

    $sql3 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_code` = "' . $class_code . '" ';
    $que3 = mysqli_query($link, $sql3);
    $total_code = mysqli_num_rows($que3);
    $row3 = mysqli_num_rows($que3);

    if ($row2 > 0) {
        $class_code = RAND(100000, 999999);
    }

    $sql4 = ' UPDATE `class_info` SET `class_code`="' . $class_code . '" WHERE `class_id` = "' . $class_id . '" ';
    $que4 = mysqli_query($link, $sql4);

    header('Location:class_information.php?status=class_code_changed');
}


$sql5 = ' SELECT `user_info`.`user_name`, `user_info`.`user_id` FROM `user_info`, `join_info` WHERE `join_info`.`class_id` = "' . $class_id . '" && `join_info`.`user_id` = `user_info`.`user_id`; ';
$que5 = mysqli_query($link, $sql5);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row1['class_name'] ?></title>
    <style>
        * {
            margin: 0px;
            padding: 0px
        }

        .class_info {
            min-height: 500px;
            width: 47%;
            /* background-color: olivedrab; */
            /* border: 2px solid orange; */
            border-radius: 3%;
            margin: 0px auto;
        }

        .class_name {
            font-size: 35px;
            color: #a70000;
            font-weight: bold;
            margin: 0px auto;
            text-align: center;
        }

        input[type='submit'] {
            font-size: 16px;
            border: 1px solid orange;
            border-radius: 8px;
            padding: 1px;
        }

        input[type='submit']:hover {
            cursor: pointer;
            background-color: orange;
            color: wheat;
        }

        .edit {
            font-size: 19px;
            text-decoration: none;
            color: orange;
            font-family: cursive;
            margin-left: 78%;
            border: 1px solid orange;
            border-radius: 9px;
            padding: 2px;
        }

        .edit:hover {
            cursor: pointer;
            background-color: orange;
            color: wheat;
        }

        .delete {
            font-size: 19px;
            text-decoration: none;
            color: orangered;
            font-family: cursive;
            margin-left: 3%;
            border: 1px solid orangered;
            border-radius: 9px;
            padding: 2px;

        }

        .delete:hover {
            cursor: pointer;
            background-color: orangered;
            color: wheat;
        }

        .remove_add {
            text-decoration: none;
            font-size: 17px;
            border: 1px solid burlywood;
            color: brown;
            border-radius: 5px;
            padding: 2px;
        }

        .remove_add:hover {
            cursor: pointer;
            background-color: brown;
            color: wheat;
        }

        .td1 {
            min-height: 0px;
            /* text-align: center; */
            width: 149px;
            background-color: #c0e6e2;
            padding-left: 10px;
            margin-left: 0%;
            border-radius: 8px;
        }

        .td2 {
            min-height: 0px;
            width: 450px;
            background-color: #f3dddd;
            padding: 4%;
            font-size: 20px;
            border-radius: 8px;
            font-family: serif;
        }

        table {
            margin: 0px auto;
        }
    </style>
</head>

<body>
    <?php include('user_home.php'); ?>
    <hr />

    <br><br>

    <div class="class_info">
        <p class="class_name"><?php echo $row1['class_name'] ?></p>

        <br>

        <table>
            <tr>
                <td class="td1">Created By:</td>
                <td class="td2"><?php echo $row2['user_name'] ?></td>
            </tr>

            <tr>
                <td class="td1">Date of Creation: </td>
                <td class="td2"><?php echo $row1['class_date'] ?></td>
            </tr>

            <tr>
                <td class="td1">Class Code:</td>
                <td class="td2"><?php echo $row1['class_code'] ?>
                    <?php if ($row1['class_created_by'] == $_SESSION['id']) { ?>
                        <form action="" method="post">
                            <input type="submit" value="Change" name="change_code">
                        </form>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td class="td1">Class Description: </td>
                <td class="td2"><?php echo $row1['class_description'] ?></td>
            </tr>

            <tr>
                <td class="td1">Members</td>
                <td class="td2">
                    <?php
                    if (mysqli_num_rows($que5) > 0) {
                        while ($row5 = mysqli_fetch_array($que5)) {
                    ?>
                            <ul>
                                <li><?php echo $row5['user_name']; ?></li>
                            </ul>
                    <?php
                        }
                    } else {
                        echo '0 members';
                    }
                    ?>
                    <?php 
                        if ($row1['class_created_by'] == $_SESSION['id']) {
                    ?>
                        <a class="remove_add" href="remove_add_member.php?id=<?php echo $class_id ?>">Remove/Add members</a>
                    <?php
                        }
                    ?>
                </td>
            </tr>

        </table>

        <?php if ($row1['class_created_by'] == $_SESSION['id']) {
        ?>
            <br><br>
            <a class="edit" href="class_edit.php?id=<?php echo $class_id ?>">Edit</a>
            <a class="delete" href="class_delete.php?id=<?php echo $class_id ?>">Delete</a>
        <?php
        } ?>
    </div>
    <br>
    <?php
    include('footer.php');
    ?>
</body>

</html>