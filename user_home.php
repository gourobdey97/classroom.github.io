<?php

if (!isset($_SESSION['id'])) {
    header('Location:user_login.php');
}
?>


<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		body{
			font-family: "Lato", sans-serif;
		}
		
		.nav{
			box-shadow: -2px 2px 5px 5px #c7c1c1;
		}
		
		.sidenav{
			height:100%;
			width:0;
			position:fixed;
			z-index:1;
			top:0;
			left:0;
			background-color:#111;
			overflow-x:hidden;
			transition:0.5s;
			padding-top:60px;
		}
		
		.sidenav a{
			padding: 8px 8px 8px 32px;
			text-decoration:none;
			font-size:25px;
			color:#818181;
			display:block;
			transition: 0.3s;
		}
		
		.sidenav a:hover{
			color:#f1f1f1;
		}
		
		.sidenav .closebtn{
			position:absolute;
			top:0;
			right:25px;
			font-size:36px;
			margin-left:50px;
		}
		
		@media screen and (max-height:450px){
			.sidenav{padding-top:15px;}
			.sidenav a{font-size:18px;}
		}
		
		
		* {
			margin: 0px;
			padding: 0px;
		}

		.header {
			height: 70px;
			width: 1340px;
			/* background-color: orange; */
			margin-top: 33px;
			font-family: cursive;
			font-weight: bold;
		}

		.header a {
			width: 200px;
			height: 0px;
			text-decoration: none;
			border: 2px solid gray;
			font-size: 34px;
			padding: 6px;
			border-radius: 38px;
			margin: 0px auto;
			margin-left: 1115px;

		}

		.container {
			min-height: 498px;
			width: 1000px;
			margin: 0px auto;
		}

		.links {
			height: 179px;
			width: 179px;
			/* background-color: orange; */
			border: 5px solid #909090;
			border-radius: 10px;
			float: left;
			margin-left: 112px;
			text-align: center;
			margin-top: 26px;
			margin-bottom: 43px;
			text-decoration: none;
			font-size: 24px;
			font-family: cursive;
			font-style: italic;
		}

		.links img {
			height: 89px;
			width: 85px;
			padding: 7px;
		}

		.links p {
			font-family: cursive;
			color: darkred;
		}
	</style>
</head>

<body>
<div class="nav">
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="create_class_by_user.php">Create a Class</a>
		<a href="created_class_by_user.php">My Created Classes</a>
		<a href="join_class_by_user.php">Join a class</a>
		<a href="joined_class_by_user.php">My Joined Class</a>
		<a href="view_user_profile.php">My Profile</a>
		<a href="user_logout.php">Logout</a>
	</div>
	
	<h2 style="font-size: 35px;padding-left: 10px;color:darkslategrey">Classroom</h2>
	<span style="font-size:32px;padding-left: 10px;cursor:pointer" onclick="openNav()">&#9776;</span>
	</div>
	<script type="text/javascript">
		function openNav(){
			document.getElementById("mySidenav").style.width="250px";
		}
		
		function closeNav(){
			document.getElementById("mySidenav").style.width="0";
		}
		
	</script>

</body>

</html>