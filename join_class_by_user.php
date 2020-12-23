<?php
include('database.php');
if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

if (isset($_REQUEST['join'])) {
    $class_code = $_REQUEST['class_code'];

    if ($class_code == '') {
        $code_error = 'Enter class code for joining.';
    }

    $sql1 = ' SELECT * FROM `class_info` WHERE `class_code`="' . $class_code . '" AND `class_created_by`="' . $_SESSION['id'] . '" ';
    $que1 = mysqli_query($link, $sql1);
    $row1 = mysqli_num_rows($que1);

    $sql2 = 'SELECT * FROM `class_info` WHERE `class_code`="' . $class_code . '"';
    $que2 = mysqli_query($link, $sql2);
    $count2 = mysqli_num_rows($que2);
    $row2 = mysqli_fetch_array($que2);

    if ($row1 > 0) {
        echo '<script type="text/javascript">alert("You are already admin of this class.");</script>';
    } else if ($count2 == 0) {
        echo '<script type="text/javascript">alert("Invalid class code.");</script>';
    } else if ($class_code != '' && $row1 == 0) {
        $sql3 = ' INSERT INTO `join_info` (`class_id`, `user_id`) VALUES ("' . $row2['class_id'] . '", "' . $_SESSION['id'] . '") ';
        $que3 = mysqli_query($link, $sql3);

        header('Location: joined_class_by_user.php?status=joined_successfully');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Class</title>
	
	<style type="text/css">
		.contant{
			width:450px;
			height:120px;
			margin:0 auto;
			margin-top:50px;
			box-shadow: -2px 2px 5px 5px #c7c1c1;
			background-color: #e1efde;
			text-align:center;
			color:#2f4f4f;
		}
	</style>
</head>

<body>
	<?php include('user_home.php'); ?>
	<hr />
	<div class="contant">
		<form style="padding-top:5px" action="" method="post">
			<label for="">You have to put a class ID for joining in this class</label>
			<br>
			<br>
			<input type="text" name="class_code" placeholder=" Ex: 654321">
			<?php if (isset($code_error)) {
				echo '<div class="error">' . $code_error . '</div>';
			} ?>
			<br><br>
			<input style="margin-right:8px" type="submit" name="join" value="Join Class">
			<input type="reset" value="Reset">
		</form>
	</div>

	<?php
    include('footer.php');
?>
</body>

</html>