<?php

include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$post_id = $_GET['id'];

$sql1 = ' SELECT * FROM `post_details` WHERE `post_details`.`post_id` = "' . $post_id . '" ';
$que1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($que1);

if (isset($_REQUEST['save'])) {
    $post_title = $_REQUEST['post_title'];
    $post_description = $_REQUEST['post_description'];

    if ($post_title == '') {
        $post_title_error = "Post title cann't be empty.";
    }

    if ($post_title == '') {
        $post_title_description = "Post description cann't be empty.";
    }

    if ($post_title != '' && $post_description != '') {
        $sql2 = ' UPDATE `post_details` SET `post_title` = "' . $post_title . '", `post_description` = "' . $post_description . '" WHERE `post_id` = "' . $post_id . '"  ';
        $que2 = mysqli_query($link, $sql2);

        if (isset($_FILES['file']['tmp_name'])) {
            $path_info = pathinfo($_FILES['file']['name']);
            $ext = $path_info['extension'];
            $ext = '.' . $ext;

            if ($path_info['extension'] != '') {
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/post/post' . $post_id . $ext);

                $sql4 = ' UPDATE `post_details` SET `ext` = "' . $ext . '" WHERE `post_id` = "' . $post_id . '" ';
                mysqli_query($link, $sql4);
            }

            //echo $last_insert_id;
        }


        header('Location:class_details.php?status=post_edited');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post</title>
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
                        <h3>You are editing your post</h3>
                    </marquee>
                </legend>
                <br>

                <label class="label">Edit Post Title:</label><br>
                <input type="text" name="post_title" value="<?php echo $row1['post_title']; ?>">
                <?php
                if (isset($post_title_error)) {
                    echo '<div class="error">' . $post_title_error . '</div>';
                }
                ?>

                <br><br>

                <label class="label">Edit Post Description:</label><br>
                <textarea name="post_description" class="textarea" cols="60" rows="7"><?php echo $row1['post_description']; ?></textarea>
                <?php
                if (isset($post_description_error)) {
                    echo '<div class="error">' . $post_description_error . '</div>';
                }
                ?>

                <br><br>


                <label class="label"><?php if ($row1['ext'] != '') {
                                            echo 'Delete Previous & Attach';
                                        } else {
                                            echo 'Attach';
                                        } ?> new file (Optional):</label><br>
                <input type="file" name="file" value="" />

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