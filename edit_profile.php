<?php
include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

$user_id = $_SESSION['id'];

$sql1 = ' SELECT * FROM `user_info` WHERE `user_info`.`user_id` = "' . $user_id . '" ';
$que1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($que1);

if (isset($_REQUEST['change'])) {
    $user_name = $_REQUEST['user_name'];
    $user_email = $_REQUEST['user_email'];

    $sql2 = ' UPDATE `user_info` SET `user_name` = "' . $user_name . '", `user_email` = "' . $user_email . '" WHERE `user_id`="' . $user_id . '"';

    $que2 = mysqli_query($link, $sql2);

    header('Location:view_user_profile.php?status=edit_success');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
	
	<style type="text/css">
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
        <label for="">Username:</label>
        <input type="text" name="user_name" id="" value="<?php echo $row1['user_name']; ?>">
        <br><br>
        <label for="">Email:</label>
        <input type="text" name="user_email" id="" value="<?php echo $row1['user_email']; ?>">
        <br><br>
        <input type="submit" name="change" value="Save">
        <input type="reset" value="Reset">
    </form>

    <?php
    include('footer.php');
?>
</body>

</html>