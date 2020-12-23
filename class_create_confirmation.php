<?php
include('database.php');

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'class_successfully_created') {
        echo '<script type="text/javascript">alert("Successfully Created your class.");</script>';
    }
}

    $sql1 = ' SELECT `class_id` FROM `class_info`';
    $que1 = mysqli_query($link, $sql1);
    $row1 = mysqli_num_rows($que1);

    $sql2 = ' SELECT * FROM `class_info` WHERE `class_info`.`class_id` = ' . $row1 . '';
    $que2 = mysqli_query($link, $sql2);
    $row2 = mysqli_fetch_array($que2);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Confirmation</title>
	
	<style type="text/css">
		.create_info{
			width: 550px;
			min-height: 312px;
			background-color: #f7f4f4;
			margin: 0 auto;
			margin-top: 38px;
			box-shadow: 0px 2px 3px 1px #afabab;
			padding-top: 20px;
		}
		
		p{padding-left: 30%;}
		
		h5,h3{text-align:center}
		
		
	</style>
</head>

<body>
	<?php include('user_home.php'); ?>
	<hr />
	
	<div class="create_info">
    <p>Class ID No: <b><?php echo $row2['class_id']; ?></b> </p> <br>
    <p>Class name:  <b><?php echo $row2['class_name']; ?></b></p><br>
    <p>Class code:  <b><?php echo $row2['class_code']; ?></b></p><br>
    <p>Class Description: <b><?php echo $row2['class_description']; ?></b></p><br>
    <p>Created date: <b><?php echo $row2['class_date']; ?></b></p><br><br>
    <h5>You have to share your class code to other users for join in your class.</h5><br>
    <h3>Thank You!</h3><br>
    <a style="margin-left: 40%;color:gray;text-decoration:none;border:1px solid gray;padding:3px;" href="joined_class_by_user.php">Goto HOME</a>
    </div>
    
    <?php
    include('footer.php');
?>
</body>

</html>