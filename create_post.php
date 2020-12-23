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


if (isset($_REQUEST['submit'])) {
    $post_title = $_REQUEST['post_title'];
    $post_description = $_REQUEST['post_description'];

    if ($post_title == '') {
        $post_title_error = 'Posttitle is required.';
    }
    if ($post_description == '') {
        $post_description_error = 'Post description is required.';
    }


    if ($post_title != '' && $post_description != '') {

        $sql1 = 'INSERT INTO `post_details`(`post_title`, `post_description`, `posted_by`, `class_id`) VALUES("' . $post_title . '", "' . $post_description . '", "' . $user_id . '", "' . $class_id . '")';

        $que1 = mysqli_query($link, $sql1);

        $last_insert_id = mysqli_insert_id($link);

        if (isset($_FILES['file']['tmp_name'])) {
            $path_info = pathinfo($_FILES['file']['name']);
            $ext = $path_info['extension'];
            $ext = '.' . $ext;

            if ($path_info['extension'] != '') {
                move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/post/post' . $last_insert_id . $ext);

                $sql4 = ' UPDATE `post_details` SET `ext` = "' . $ext . '" WHERE `post_id` = "' . $last_insert_id . '" ';
                mysqli_query($link, $sql4);
            }

            //echo $last_insert_id;
        }

        header('Location:class_details.php?status=posting_success');
    } else {
        echo '<script type="text/javascript">alert("There some errors! Please retry.");</script>';
    }
}



/*
function resize_image($file, $w, $h, $crop=FALSE) {
    $img = imagecreatefromjpeg($file);
    $imgresize = imagescale($img, $w, $h);
    $img = imagecreatefromjpg($file);
    $imgresize = imagescale($img, $w, $h);
    $img = imagecreatefrompng($file);

    // Now resize the image width = 200 and height = 200
    $imgresize = imagescale($img, $w, $h);
}

*/

?>







<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Create Post</title>

    <style>
        * {
            margin: 0px;
            padding: 0px
        }

        .class_name a{
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

        .form {
            margin: 0 auto;
            /* float: left; */
            width: 42%;
            /* background: #a74b4b; */
            margin-top: 0px;
            /* box-shadow: 0 4px 6px 2px #9c9c9c; */
            /* border-radius: 55px; */
            min-height: 446px;
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
    <?php include('user_home.php'); ?>
    <hr />
    <header>
    <p class="class_name"><a href="class_information.php?id=<?php echo $row2['class_id'];?>"><?php echo $row2['class_name']; ?></a></p>
        <p class="created_by"> Created by <?php echo $row3['user_name']; ?> ||</p>
        <p class="created_date"> Created date: <?php echo $row2['class_date']; ?></p>
    </header>

    <br><br>
    <hr>


    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset class="f_field">
                <legend>
                    <marquee>
                        <h3>You are creating a post</h3>
                    </marquee>
                </legend>
                <br>

                <label class="label">Post Title:</label><br>
                <input type="text" name="post_title" placeholder="Write post title here">
                <?php if (isset($post_title_error)) echo '<div class="error">' . $post_title_error . '</div>'; ?>

                <br><br>

                <label class="label">Description:</label><br>
                <textarea name="post_description" placeholder="Write post description here" class="textarea" cols="60" rows="7"></textarea>
                <?php if (isset($post_description_error)) echo '<div class="error">' . $post_description_error . '</div>'; ?>

                <br><br>


                <label class="label">Attach any file (Optional):</label><br>
                <input type="file" name="file" value="" />

                <br><br>

                <input type="submit" name="submit" value="Publish">
                <input type="reset">
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