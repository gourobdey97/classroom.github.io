<?php

    include('database.php');

    if(!isset($_GET['id'])){
        header('Location: user_login.php?');
    }
    echo '<script type="text/javascript">alert("Code sent to your email. Check your email inbox(also Spam box) for reset your password.");</script>';

    if(isset($_REQUEST['submit'])){
        $key = $_REQUEST['code'];

        $sql = 'SELECT * FROM `user_info` WHERE `pass_key` = "'.$key.'"';
        $que = mysqli_query($link, $sql);

        if(mysqli_num_rows($que)>0){
            header('Location: forget_pass3_by_user.php?id='.$key.'');
        }
        else{
            echo "Wrong passcode";
        }


 /*       $sql2 = 'SELECT * FROM `user_info` WHERE `pass_key` = "'.$key.'"';
       $que2 = mysqli_query($link, $sql2);
       $row = mysqli_fetch_array($que2);

        if($row = mysqli_fetch_array($que2)>0){
            header('Location: forget_pass3_by_user.php?id='.$key.'');
        }
        else{
            echo "Wrong passcode";
        }
        
        
        */
        
        
 //       $pass=$_REQUEST['password'];

  //      $sql = 'UPDATE `user_info` SET `password` = "'.$pass.'" WHERE `pass_key` = "'.$key.'" ';
  //      $que = mysqli_query($link, $sql);

  //      $sql2 = 'SELECT * FROM `user_info` WHERE `pass_key` = "'.$key.'"';
   //     $que2 = mysqli_query($link, $sql2);

    //    header('Location: user_login.php');
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	
	<style type="text/css">
	*{
		margin:0px;padding:0px;
	}
	
	body{
		background-color:#ffffff;
	}
	
	.container{
		    width: 39%;
    height: 200px;
    margin: 100px auto;
    background-color: #e0edff;
	border: 2px solid #94b9f7;
	}
	
	.container p{
		padding-top: 35px;
    padding-left: 30%;
    font-weight: bold;
    font-size: 21px;
	
	}
	
	form{margin-left: 20%;}
	
	.container input[type="text"]{    padding: 10px 31px;
    font-size: 14px;}
	
	   .container input[type="submit"]{ padding: 10px 21px;
	   font-size: 14px;}
	   
	   .container input[type="submit"]:hover{
			background: #94b9f7;
			color: black;
		}
	
	</style>
</head>
<body>
	<div class="container">
		<p>Enter reset code</p>
		<form action="" method="post">
			<input type="text" name="code" placeholder="Ex:624891" required>
			<input type="submit" value="Next" name="submit"/>
		</form>
    </div>
    
    <?php
    include('footer.php');
?>
</body>
</html>