<?php

include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}


if (isset($_REQUEST['submit'])) {
    $class_name = $_REQUEST['class_name'];
    $class_description = $_REQUEST['class_description'];

    $class_code = RAND(100000, 999999);

    $sql2 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_code` = "' . $class_code . '" ';
    $que2 = mysqli_query($link, $sql2);
    $row2 = mysqli_num_rows($que2);

    if ($row2 > 0) {
        $class_code = RAND(100000, 999999);
    }

    if ($class_name == '') {
        $name_error_empty = 'Class name is required.';
    }
    if ($class_description == '') {
        $description_error = 'Class description is required.';
    }


    $sql1 = 'SELECT * FROM `class_info` WHERE `class_name`="' . $class_name . '" ';
    $que1 = mysqli_query($link, $sql1);

    if (mysqli_num_rows($que1) > 0) {
        $name_error_unique = 'This name already used.';
    }


    if ($name_error_empty == '' && $name_error_unique == '' && $description_error == '') {
        $sql3 = ' INSERT INTO `class_info` (`class_name`, `class_code`, `class_created_by`, `class_description`) VALUES ("' . $class_name . '", "' . $class_code . '", "' . $_SESSION['id'] . '", "' . $class_description . '") ';
        $que3 = mysqli_query($link, $sql3);

        header('Location: class_create_confirmation.php?status=class_successfully_created');
    }
}

?>







<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Create Class</title>

    <style>
        * {
            margin: 0px;
            padding: 0px
        }

        .form {
            height: 300px;
            width: 500px;
            margin: 0px auto;
            margin-top: 50px;
			padding:10px;
        }

        .f_field {
            border-radius: 20px;
        }

        marquee{
            color:#a76c00;
        }

        .f_field h3 {
            font-weight: bold;
        }

        .label {
            font-weight: bold;
            font-size: 25px;
            margin-left: 5px;
        }

        .class_name {
            font-weight: bold;
            height: 32px;
            width: 237px;
            border: 2px solid gray;
            border-radius: 10px;
            margin-left: 5px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-left: 5px;
        }

        .class_description {
            font-weight: bold;
            border: 2px solid gray;
            border-radius: 10px;
            margin-left: 5px;
        }

        input[type='submit'] {
            color: #506fb3;
            font-size: 20px;
            border: 2px solid #77bbbb;
            border-radius: 10px;
            padding: 3px;
            margin-left: 5px;
            margin-bottom: 11px;
            cursor:pointer;
            font-family:cursive;
        }

        input[type='submit']:hover {
            background-color: #77bbbb;
            color:white;
            cursor: pointer;
            font-family:cursive;
        }

        input[type='reset'] {
            color: #b35050;
            font-size: 20px;
            border: 2px solid #77bbbb;
            cursor:pointer;
            border-radius: 10px;
            padding: 3px;
            margin-left: 3px;
            margin-bottom: 11px;
            font-family:cursive;
        }

        input[type='reset']:hover {
            background-color: #77bbbb;
            color:white;
            cursor: pointer;
            font-family:cursive;
        }

        .footer{
            margin-top:166px;
        }
    </style>

</head>

<body>
	<?php include('user_home.php'); ?>
	<hr />
	
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset class="f_field">
                <legend>
                    <marquee>
                        <h3>Please enter information about your class</h3>
                    </marquee>
                </legend>
                <br>

                <label class="label">Class Name:(Must be unique)</label><br>
                <input type="text" class="class_name" name="class_name" placeholder=" Write your class name">
                <?php

                if (isset($name_error_empty)) {
                    echo '<div class="error">' . $name_error_empty . '</div>';
                }
                if (isset($name_error_unique)) {
                    echo '<div class="error">' . $name_error_unique . '</div>';
                }

                ?>

                <br><br>

                <label class="label">Class Description:</label><br>
                <textarea name="class_description" class="class_description" placeholder=" Ex: abcde fghij" cols="66" rows="6"></textarea>
                
                <?php if (isset($description_error)) {
                    echo '<div class="error">' . $description_error . '</div>';
                } ?>

                <br><br>


                <input type="submit" name="submit" value="Create Class">
                <input type="reset" value="Reset">

            </fieldset>
        </form>
    </div>
    </div>

    <br>

    <?php
    include('footer.php');
?>
</body>

</html>