<?php
include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$pass1 = $pass2 = '';

if (isset($_REQUEST['change'])) {
    $pass1 = $_REQUEST['pass1'];
    $pass2 = $_REQUEST['pass2'];

    if ($pass1 == '') {
        $pass1_error = 'This field cannot be empty';
    }

    if ($pass2 == '') {
        $pass2_error = 'This field cannot be empty';
    }

    if ($pass1 != $pass2) {
        $match_error = 'Password not matched';
    }

    if($pass1!='' && $pass2!='' && $pass1==$pass2){
        $sql1 = ' UPDATE `user_info` SET `user_password` = "'.$pass1.'" WHERE `user_id` = "'.$_SESSION['id'].'" ';
        $que1 = mysqli_query($link, $sql1);

        header('Location:view_user_profile.php?status=pass_change');
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .error{
        color:red;
    }
	
	.profile{
			width: 400px;
			height: 100px;
			margin: 0 auto;
			margin-top: 50px;
			box-shadow: -2px 2px 5px 5px #c7c1c1;
			background-color: #e1efde;
			text-align: center;
			color: #2f4f4f;
			padding-top: 17px;
			padding-bottom: 10px;
		}
    </style>
</head>

<body>

	<?php include('user_home.php'); ?>
	<hr />
	
    <form class="profile" action="" method="post" enctype="multipart/form-data">
    <?php if(isset($match_error)){
        echo '<div class="error">'.$match_error.'</div>';
    } ?>
        <label for="">Enter your new password</label>
        <input type="password" name="pass1" id="" value="<?php echo $pass1;?>">
        <?php
        if (isset($pass1_error)) {
            echo '<div class="error">' . $pass1_error . '</div>';
        }
        ?>
        <br><br>
        <label for="">Retype your new password</label>
        <input type="password" name="pass2" id="" value="<?php echo $pass2;?>">
        <?php
        if (isset($pass2_error)) {
            echo '<div class="error">' . $pass2_error . '</div>';
        }
        ?>
        <br><br>
        <input type="submit" name="change" value="Change">
        <input type="reset" value="Reset">
    </form>

    <?php
    include('footer.php');
?>
</body>

</html>