<?php
include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}


if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'edit_success') {
        echo '<script type="text/javascript">alert("Successfully update your profile.");</script>';
    }

    if ($status == 'pass_change') {
        echo '<script type="text/javascript">alert("Successfully Changed your password.");</script>';
    }
}

$sql1 = 'SELECT * FROM `user_info` WHERE `user_info`.`user_id` = "'.$_SESSION['id'].'" ';
$que1 = mysqli_query($link, $sql1);
$row1 = mysqli_fetch_array($que1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
	
	<style type="text/css">
		.profile{
			width:400px;
			height:100px;
			margin:0 auto;
			margin-top:50px;
			box-shadow: -2px 2px 5px 5px #c7c1c1;
			background-color: #e1efde;
			text-align:center;
			color:#2f4f4f;
			padding-top:30px;
		}
		
		.profile p{
			text-align: left;
			padding-left: 100px;
			padding-bottom: 10px;
		}
		
		.profile a{
			text-decoration: none;
			border: 1px solid #c1b6b6;
			border-radius: 10px;
			padding: 3px;
			margin-left: 5px;
			color: #171d1d;
			font-size: 16px;
		}
		
		.profile a:hover{
			background-color:#749696;
			color:black
		}
	</style>
</head>

<body>
	<?php include('user_home.php'); ?>
	<hr />
	
    <div class="profile">

        <p>Username: <?php echo $row1['user_name']; ?></p>
        <p>Email: <?php echo $row1['user_email']; ?></p>
        <a href="edit_profile.php">Edit profile</a>
        <a href="change_password.php">Change Password</a>

	</div>
	

	<?php
    include('footer.php');
?>
</body>

</html>