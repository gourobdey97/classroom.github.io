<?php

include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$user_id = $_SESSION['id'];

if (isset($_GET['id'])) {
    $_SESSION['class_id'] = $_GET['id'];
}

$class_id = $_SESSION['class_id'];

if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'posting_success') {
        echo '<script type="text/javascript">alert("Successfully Posted!");</script>';
    }
    if ($status == 'post_edited') {
        echo '<script type="text/javascript">alert("Successfully Updated your post!");</script>';
    }
    if ($status == 'post_delete') {
        echo '<script type="text/javascript">alert("Successfully Deleted your post!");</script>';
    }
}

$sql1 = ' SELECT * FROM `post_details` WHERE `post_details`.`class_id` = ' . $class_id . ' ORDER BY `post_id` DESC ';
$que1 = mysqli_query($link, $sql1);
$total_posts = mysqli_num_rows($que1);
//$row1 = mysqli_fetch_array($que1);

$sql2 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_id` = ' . $class_id . ' ';
$que2 = mysqli_query($link, $sql2);
$row2 = mysqli_fetch_array($que2);

$sql3 = ' SELECT * FROM `user_info` WHERE `user_id` = ' . $row2['class_created_by'] . ' ';
$que3 = mysqli_query($link, $sql3);
$row3 = mysqli_fetch_array($que3);


if (isset($_REQUEST['delete_attachment'])) {
    $post_id_for_delete_attchment = $_REQUEST['post_id'];
    $null_string = '';
    $sql8 = 'UPDATE `post_details` SET `ext` = "' . $null_string . '" WHERE `post_details`.`post_id` = "' . $post_id_for_delete_attchment . '";';
    $que8 = mysqli_query($link, $sql8);
    header('Location:class_details.php?id=' . $class_id . '   ');
}

if (isset($_REQUEST['post'])) {
    $comment = $_REQUEST['comment'];
    $post_id_comment = $_REQUEST['post_id'];

    if ($comment == '') {
        $comment_empty_error = '<p class="error">Can not post empty comment!<p>';
    }

    if ($comment != '') {
        // echo $comment;
        $sql5 = ' INSERT INTO `post_comment`(`post_id`, `comment`, `user_id`) VALUES ("' . $post_id_comment . '", "' . $comment . '", "' . $user_id . '") ';
        $que5 = mysqli_query($link, $sql5);

        header('Location:class_details.php?id=' . $class_id . '   ');
    }
}
//}

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
            padding: 0px;
        }

        .no_post_div {
            min-height: 416px;
            width: 85%;
            margin: 0px auto;
        }

        .no_post {
            color: #9a2a18;
            font-size: 35px;
            font-family: cursive;
            margin: 0px auto;
            margin-left: 32.7%;
        }

        .all_posts {
            min-height: 446px;
            width: 100%;
        }

        .create_post_first {
            /* color: blue; */
            text-decoration: none;
            font-size: 25px;
            font-family: cursive;
            border: 2px solid #1b6d0c;
            color: #1b6d0c;
            border-radius: 18px;
            margin-left: 44%;
            padding: 2px;

        }

        .create_post_first:hover {
            background-color: #1b6d0c;
            color: wheat;
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
            border: 2px solid darkslategrey;
            color: darkslategrey;
            font-family: auto;
        }

        .create_post a:hover {
            background-color: #77bbbb;
            color: white;
            cursor: pointer;
        }

        .main_content {
            box-shadow: -2px 2px 5px 5px #c7c1c1;
            background-color: #e1efde;
            min-height: 0px;
            width: 659px;
            margin: 0px auto;
            border-radius: 5px;
            margin-bottom: 20px;
            padding-bottom: 16px;
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

        .title a{
            text-decoration: none;
            color: darkcyan;
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
            margin-bottom: 5px;
        }

        .attachment_label {
            font-family: cursive;
            color: darkslategray;
            margin-left: 1%;
            float: left;
        }

        .attachment {
            font-family: cursive;
            color: darkslategray;
            text-decoration: none;
            /* border: 1px solid #e1efde; */
            border: 1px solid darkslategray;
            border-radius: 5px;
            /* margin-top: 0px; */
            margin-left: 2%;
            background-color: #e1efde;
        }

        .attachment:hover {
            background-color: darkslategray;
            color: wheat;
            cursor: pointer;
        }

        .delete_attachment {
            font-family: cursive;
            color: darkslategray;
            text-decoration: none;
            border: 1px solid darkslategray;
            border-radius: 5px;
            font-size: 16px;
            /* margin-top: 0px; */
            margin-left: 4%;
            background-color: #e1efde;
        }

        .delete_attachment:hover {
            background-color: darkslategray;
            color: red;
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

        .write_comment input[type='submit']:hover {
            color: wheat;
            background-color: darkslategrey;
        }

        .see_all {
            color: #6d6bce;
            text-decoration: none;
            font-family: cursive;
            margin-left: 108px;
        }

        .error {
            color: red;
            font-family: cursive;
            margin-left:21%;
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
    <div class="create_post">
        <a href="message.php?id=<?php echo $class_id?>">Message</a>
        <a href="create_post.php?id=<?php echo $class_id; ?>">Create Post</>
    </div>

    <br><br>
    <hr><br>


    <?php

    if (mysqli_num_rows($que1) == 0) {
    ?>
        <div class="no_post_div">
            <p class="no_post">There is no post in this class.</p>
            <br>
            <a class="create_post_first" href="create_post.php?id=<?php echo $class_id; ?>">Create Post</a>
        </div>
    <?php
    } else {
    ?>
        <div class="all_posts">
            <?php

            $i = 1;
            while ($row1 = mysqli_fetch_array($que1)) {
                $post_id = $row1['post_id'];
                $sql4 = 'SELECT * FROM `user_info` WHERE `user_info`.`user_id` = ' . $row1['posted_by'] . '';
                $que4 = mysqli_query($link, $sql4);
                $row4 = mysqli_fetch_array($que4);
                $sql6 = ' SELECT * FROM `post_comment` WHERE `post_id` = "' . $post_id . '" ORDER BY `comment_id` DESC ';
                $que6 = mysqli_query($link, $sql6);
                $total_comments = mysqli_num_rows($que6);
            ?>
                <div class="main_content">
                    <div class="title">
                        <p><a href="post_details.php?id=<?php echo $post_id?>"><?php echo $row1['post_title']; ?></a></p>


                    </div>
                    <div class="posted_by">
                        <p id="name"><?php echo $row4['user_name'];
                                        echo ' '; ?> ||</p>
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
                        <a href="uploads/post/post<?php echo $row1['post_id'] . $row1['ext']; ?>" class="attachment" style="<?php if ($_SESSION['id'] == $row4['user_id'] && $row1['ext'] != '') {echo 'float:left';} else {echo 'float:none';} ?>">View Attachment</a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['id'] == $row4['user_id'] && $row1['ext'] != '') {
                    ?>

                        <form action="" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                            <input class="delete_attachment" type="submit" value="Delete Attachment" name="delete_attachment">
                        </form>

                    <?php
                    }
                    ?>

                    <div class="write_comment">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Write a comment:</label>
                            <input type="text" name="comment" placeholder="Write your comments">
                            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                            <input type="submit" name="post" value="Post">

                            <?php if ($total_comments > 2) { ?>
                                <a class="see_all" href="post_details.php?id=<?php echo $post_id; ?>">See all comments</a>
                            <?php } ?>
                            <?php
                            if(isset($comment_empty_error) && $row1['post_id']==$post_id_comment){
                                echo $comment_empty_error;
                            }?>
                        </form>
                    </div>
                    <div class="comments">
                        <?php
                        $i = 1;
                        while ($row6 = mysqli_fetch_array($que6)) {

                            $sql7 = ' SELECT `user_name` FROM `user_info`, `post_comment` WHERE `user_info`.`user_id` = "' . $row6['user_id'] . '" ';
                            $que7 = mysqli_query($link, $sql7);
                            $row7 = mysqli_fetch_array($que7);

                        ?>
                            <div class="name_section">
                                <div class="name">
                                    <label for=""><?php echo $row7['user_name']; ?>: </label>
                                </div>
                                <div class="comment">
                                    <p><?php echo $row6['comment']; ?></p>
                                </div>

                            </div>
                        <?php
                            $i++;
                            if ($i == 3) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>

                <br>
            <?php
            }

            ?>

        </div>
    <?php


    }
    ?>



    <?php
    include('footer.php');
    ?>
</body>

</html>