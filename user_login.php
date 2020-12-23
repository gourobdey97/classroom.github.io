<?php

include('database.php');

if (isset($_REQUEST['login'])) {

	$em = $_REQUEST['email'];
	$pass = $_REQUEST['pass'];


	if ($em == '') {
		$e_error = "Email is required.";
	}
	if ($pass == '') {
		$p_error = "Password is required.";
	}
	if ($em != '' && $pass != '') {

		$sql = 'SELECT * FROM `user_info` where `user_email` = "' . $em . '" AND `user_password` = "' . $pass . '"';

		$que = mysqli_query($link, $sql);

		if (mysqli_num_rows($que) > 0) {

			$row = mysqli_fetch_array($que);

			$_SESSION['id'] = $row['user_id'];
			$_SESSION['ext'] = $row['user_img_ext'];
			$_SESSION['mail'] = $row['user_email'];
			$_SESSION['password'] = $row['user_password'];


			header('Location: joined_class_by_user.php');
		} else {
			echo '<script type="text/javascript">alert("Invalid email or password!");</script>';
		}
	}
}
?>

<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<style type="text/css">
		* {
			margin: 0px;
			padding: 0px
		}

		body {
			background-color: #f1f2f4
		}

		.form {

			margin: 0 auto;
    width: 28%;
    background: #f5d49859;
    margin-top: 59px;
    box-shadow: 0 3px 8px 5px #9c9c9c;
    border-radius: 3px;
			
		}

		.form h2 {
			text-align: center;
			padding-top: 2px;
		}

		.container a {
			text-decoration: none;
			padding-left: 30px;
		}

		.container input[type=text],
		input[type=password] {
			width: 100%;
			padding: 8px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 2px solid #f1cfcf;
			box-sizing: border-box;
			font-size: 18px;
		}

		.container input[type=submit] {
			border: 2px solid #a2a1a1;
    background-color: #f9f3e852;
    box-sizing: border-box;
    text-align: center;
    padding: 4px 9px;
    margin-top: 20px;
    margin-left: 35%;
    font-size: 21px;
    cursor: pointer;
    /* font-family: cursive; */
    font-weight: bold;
    border-radius: 21px;
		}

		input[type=submit]:hover {
			background-color: #9494f99c;
			color: black;
		}

		.imgcontainer {
			text-align: center;
			padding-top: 20px;
		}

		img {
			width: 17%;
			height: 60px;
			border-radius: 58px;
			border: 6px solid #49c6f2b0;
			padding: 6px;
		}

		.container {
			padding: 38px
		}


		.footer{
			margin-top: 123px;
		}


		.error {
			color: red;
			padding-bottom: 10px;
		}
	</style>

</head>

<body>
	<div class="form">
		<form action="" method="post">

			<div class="imgcontainer">
				<img class="avatar" src="images/avatar.png" alt="Avatar">
			</div>

			<h2>Login</h2>

			<div class="container">
				<b>Enter your Email:</b><br />
				<input type="text" name="email" id="" placeholder="Ex: ****@gmail.com" /> <br />
				<?php
				if (isset($e_error)) echo '<div class="error">' . $e_error . '</div>';
				?>

				<br />
				<b>Enter your Password:</b><br />
				<input type="password" name="pass" id="" placeholder="Ex: ******" />
				<?php
				if (isset($p_error)) echo '<div class="error">' . $p_error . '</div>';
				?>
				<a href="forget_pass_by_user.php">Forget password?</a>
				<a href="user_reg.php">Register Now!</a>

				<input type="submit" name="login" value="Login" />
			</div>
		</form>
	</div>
	<!--
	<h1>User Login</h1>
	<form action="" method = "post">
		Email: 
		<input type="text" name="email" id="" /> <br /><br />
		<?php
		//	if(isset($e_error)) echo '<div class="error">'.$e_error.'</div>';
		?>
		
		Password:
		<input type="password" name="pass" id="" /><br /><br />
		<?php
		//	if(isset($p_error)) echo '<div class="error">'.$p_error.'</div>';
		?>
		
		
		<input type="submit" name = "login" value="Login"  />
		
	</form>
-->

<?php
    include('footer.php');
?>
</body>

</html>