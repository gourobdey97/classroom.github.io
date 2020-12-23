<?php
include('database.php');
if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}
$post_id = $_GET['id'];
$user_id = $_SESSION['id'];

$sql1 = ' SELECT * FROM `post_details` WHERE `post_id` = "' . $post_id . '" ';
$que1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($que1);

$class_id = $row1['class_id'];

$sql2 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_id` = "' . $class_id . '" ';
$que2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_array($que2);

$sql3 = ' SELECT * FROM `user_info` WHERE `user_id` = "' . $row2['class_created_by'] . '" ';
$que3 = mysqli_query($link, $sql3);
$row3 = mysqli_fetch_array($que3);

$sql4 = ' SELECT * FROM `user_info` WHERE `user_id` = "' . $row1['posted_by'] . '" ';
$que4 = mysqli_query($link, $sql4);
$row4 = mysqli_fetch_array($que4);

$sql5 = ' SELECT * FROM `post_comment` WHERE `post_id`  = "' . $post_id . '" ORDER BY `comment_id` DESC ';
$que5 = mysqli_query($link, $sql5);
$totla_comments = mysqli_num_rows($que5);

if (isset($_REQUEST['post'])) {
    $comment = $_REQUEST['comment'];
    // echo $comment;
    if ($comment == '') {
        $comment_error = 'Cannot be a empty comment';
    }

    if ($comment != '') {
        // echo $comment;
        $sql6 = ' INSERT INTO `post_comment`(`post_id`, `comment`, `user_id`) VALUES ("' . $post_id . '", "' . $comment . '", "' . $user_id . '") ';
        $que6 = mysqli_query($link, $sql6);

        header('Location:post_details.php?id=' . $post_id . '   ');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        .class_name {
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

        .create_post a {
            border-radius: 20px;
            font-style: none;
            text-decoration: none;
            font-size: 28px;
            background-color: #ffffff;
            padding: 5px;
            /* margin-left: -1px; */
            float: right;
            margin-top: -42px;
            margin-right: 30px;
            border: 2px solid #77bbbb;
            color: lightslategray;
        }

        .create_post a:hover {
            background-color: #77bbbb;
            color: white;
            cursor: pointer;
        }


        .main_content {
            box-shadow: -2px 2px 5px 5px #c7c1c1;
            /* background-color: #e1efde; */
            /* background-color: #9eda8f; */
            min-height: 0px;
            width: 659px;
            margin: 0px auto;
            padding-bottom: 10px;
            border: 2px solid orange;
            border-radius: 4%;
        }

        .title {
            /*    background-color: red;*/
            height: 50px;
            width: 649px;
            font-size: 34px;
            font-weight: bold;
            font-family: cursive;
            padding: 5px;

        }

        .posted_by {
            /*   background-color: orange;*/
            font-size: 24px;
            font-family: cursive;
            height: 36px;
            width: 339px;
            float: left;
        }

        #name {
            float: left;
            margin-left: 5px;
        }

        .edit_delete {
            /*    background-color: #f792ca;*/
            /* background-color: orange; */
            font-size: 19px;
            font-family: cursive;
            height: 36px;
            width: 320px;
            float: left;
            text-align: center;
            text-decoration: none;
            float: left;
        }

        .post_edit {
            margin-left: 174px;
            margin-right: 15px;
            text-decoration: none;

        }

        .post_delete {
            text-decoration: none;

        }

        .description {
            /*    background-color: greenyellow;*/
            /* margin-top: 10px; */
            min-height: 0px;
            width: 597px;
            border: 2px solid gray;
            border-radius: 14px;
            padding: 10px;
            margin: 0px auto;
            font-family: cursive;
            font-size: inherit;
            margin-bottom: 1%;
        }


        .attachment_label {
            font-family: cursive;
            color: darkslategray;
            margin-left: 1%;
        }

        .attachment {
            font-family: cursive;
            color: darkslategray;
            text-decoration: none;
            border: 1px solid darkslategray;
            border-radius: 5px;
            /* margin-top: 0px; */
        }

        .attachment:hover {
            background-color: darkslategray;
            color: wheat;
            cursor: pointer;
        }

        .comments {
            margin: 0px;
            padding-left: 9.5%;
        }

        .name {
            float: left;
            margin-right: 20px;
            margin-top: 2px;
            margin-left: 5px;
            font-size: 16px;
            font-family: cursive;
            font-weight: bold;
            color: darkslategray;
        }

        .comment {
            border: 1px solid #231919;
            border-radius: 10px;
            padding: 5px;
            min-width: 0px;
            margin-top: 2px;
            margin-left: 81px;
            /* min-width: 158px; */
            width: fit-content;
            margin-top: 12px;

        }

        .name_section {
            min-height: 31px;
            margin-top: 5px;
            width: 544px;
        }

        .write_comment {
            height: 36px;
            width: 650px;
            margin: 0px auto;
            margin-top: 10px;
        }

        .write_comment label {
            font-family: cursive;
            color: darkslategray;
        }

        .write_comment input[type='text'] {
            border-radius: 7px;
            font-size: 15px;
            border: 1px solid #968080;
            padding: 2px;
        }

        .write_comment input[type='submit'] {
            margin-left: 17px;
            border-radius: 7px;
            padding: 2px;
            cursor: pointer;
            color: darkslategrey;
            font-family: cursive;
            font-size: 15px;
            font-weight: bold;
            border: 1px solid #bbb4b4;

        }
        .write_comment input[type='submit']:hover{
            color:wheat;
            background-color: darkslategrey;
        }

        .error{
            color:red;
            font-family:cursive;
            margin-left: 21%;
        }
    </style>
</head>

<body>
    <?php include('user_home.php'); ?>
    <hr />

    <header>
        <p class="class_name"><?php echo $row2['class_name']; ?></p>
        <p class="created_by"> Created by <?php echo $row3['user_name']; ?> ||</p>
        <p class="created_date"> Created date: <?php echo $row2['class_date']; ?></p>
    </header>
    <div class="create_post">
        <a href="create_post.php?id=<?php echo $class_id; ?>">Create Post</a>
    </div>
    <br><br>
    <hr><br>
    <div class="main_content">
        <div class="title">
            <p><?php echo $row1['post_title']; ?></p>
        </div>
        <div class="posted_by">
            <p id="name"><?php echo $row4['user_name'];
                            echo ' '; ?>||</p>
            <p><?php echo $row1['post_date']; ?></p>
        </div>
        <div class="edit_delete">
            <?php
            if ($_SESSION['id'] == $row4['user_id']) {
            ?>
                <a style="color:orange" href="post_edit.php?id=<?php echo $post_id; ?>" class="post_edit">Edit</a>

                <a style="color:red" href="post_delete.php?id=<?php echo $post_id; ?>" class="post_delete">Delete</a>
            <?php
            }
            ?>
        </div>
        <br><br><br>
        <div class="description">
            <p><?php echo $row1['post_description']; ?></p>
        </div>
        <?php
        if ($row1['ext'] != NULL) {
        ?>
            <label class="attachment_label">Attachment:</label>
            <a href="uploads/post/post<?php echo $row1['post_id'] . $row1['ext']; ?>" class="attachment">Click Here</a>
        <?php
        }
        ?>
        <div class="write_comment">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="">Write a comment:</label>
                <input type="text" name="comment" placeholder="Write your comments">
                <input type="submit" name="post" value="Post">
                <?php
                if (isset($comment_error)) {
                    echo '<div class="error">' . $comment_error . '</div>';
                }
                ?>
            </form>
        </div>
        <div class="comments">
            <?php
            while ($row5 = mysqli_fetch_array($que5)) {

                $sql6 = ' SELECT `user_name` FROM `user_info`, `post_comment` WHERE `user_info`.`user_id` = "' . $row5['user_id'] . '" ';
                $que6 = mysqli_query($link, $sql6);
                $row6 = mysqli_fetch_array($que6);

            ?>
                <div class="name_section">
                    <div class="name">
                        <label for=""><?php echo $row6['user_name']; ?>: </label>
                    </div>

                    <div class="comment">
                        <p><?php echo $row5['comment']; ?></p>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <br>
    <?php
    include('footer.php');
    ?>
</body>

</html>