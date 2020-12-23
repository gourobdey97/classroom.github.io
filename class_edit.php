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

if (isset($_REQUEST['save'])) {
    $class_name = $_REQUEST['class_name'];
    $class_description = $_REQUEST['class_description'];

    if ($class_name == '') {
        $class_name_error = "Class name cann't be empty.";
    }

    if ($class_description == '') {
        $class_description_error = "Post description cann't be empty.";
    }

    if ($class_name != '' && $class_description != '') {
        $sql2 = ' UPDATE `class_info` SET `class_name` = "' . $class_name . '", `class_description` = "' . $class_description . '" WHERE `class_id` = "' . $class_id . '"  ';
        $que2 = mysqli_query($link, $sql2);


        header('Location:class_information.php?status=class_updated');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
    <style>
        .form {
            margin: 0 auto;
            /* float: left; */
            width: 42%;
            /* background: #a74b4b; */
            margin-top: 0px;
            /* box-shadow: 0 4px 6px 2px #9c9c9c; */
            /* border-radius: 55px; */
            min-height: 515px;
            margin-top: 3%;
        }

        .f_field {
            margin: 0px auto;
            padding-bottom: 0px;
            min-height: 320px;
            border-radius: 25px;
        }

        .f_field h3 {
            color: #6f4801;
            font-size: 20px;
            font-family: cursive;
        }

        .f_field input[type="text"] {
            width: 277px;
            margin-left: 54px;
            margin-top: 5px;
            border-radius: 10px;
            box-sizing: border-box;
            border: 2px solid #504b42;
            padding: 5px 10px;
            font: normal 14px Arial, Helvetica, sans-serif;
            /* color: #1F5A9D; */
        }


        .f_field input[type="submit"] {
            margin-left: 28%;
            margin-top: 0px;
            margin-bottom: 6px;
            border-radius: 10px;
            box-sizing: border-box;
            border: 2px solid #504b42;
            padding: 4px 10px;
            background: #fbedd3;
            font: normal 14px Arial, Helvetica, sans-serif;
            font-size: 20px;
            /* color: #1F5A9D; */
            cursor: pointer;
        }

        .f_field input[type="reset"] {
            margin-left: 10%;
            margin-top: 0px;
            margin-bottom: 6px;
            border-radius: 10px;
            box-sizing: border-box;
            border: 2px solid #504b42;
            padding: 4px 10px;
            background: #fbedd3;
            font: normal 14px Arial, Helvetica, sans-serif;
            font-size: 20px;
            /* color: #1F5A9D; */
            cursor: pointer;
        }

        .textarea {
            margin-left: 54px;
            margin-top: 5px;
            border-radius: 10px;
            box-sizing: border-box;
            border: 2px solid #504b42;
            padding: 5px 10px;
            font: normal 14px Arial, Helvetica, sans-serif;
        }

        .f_field input[type="submit"]:hover,
        .f_field input[type="reset"]:hover {
            background: orange;
            color: black;
        }

        .f_field input[type="file"] {
            margin-left: 54px;
            color: #b3390b;
        }

        .label {
            padding-left: 54px;
            color: #6f4801;
            font-size: 22px;
            font-weight: bold;
        }

        .error {
            color: red;
            padding-left: 54px;
        }
    </style>
</head>

<body>
    <?php include("user_home.php") ?>

    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset class="f_field">
                <legend>
                    <marquee>
                        <h3>You are editing your class</h3>
                    </marquee>
                </legend>
                <br>

                <label class="label">Edit Class Name:</label><br>
                <input type="text" name="class_name" value="<?php echo $row1['class_name']; ?>">
                <?php
                if (isset($class_name_error)) {
                    echo '<div class="error">' . $class_name_error . '</div>';
                }
                ?>

                <br><br>

                <label class="label">Edit Class Description:</label><br>
                <textarea name="class_description" class="textarea" cols="60" rows="7"><?php echo $row1['class_description']; ?></textarea>
                <?php
                if (isset($class_description_error)) {
                    echo '<div class="error">' . $class_description_error . '</div>';
                }
                ?>

                <br><br>

                <input type="submit" name="save" value="Update">
                <input type="reset" value="Reset">
            </fieldset>
        </form>

    </div>

    <?php
    include('footer.php');
    ?>
</body>

</html>