<?php

	include('database.php');

    if(isset($_REQUEST['submit'])){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['pass'];
        $img = $_REQUEST['img'];
        $key = RAND(100000,999999);
    //    $password = $_REQUEST['password'];
        
        
        
        if($name==''){
            $name_error = 'Name is required.';
        }
        if($email == ''){
            $email_error = 'Email is required.';
        }
        if($pass == ''){
            $pass_error = 'Password is required.';
        }
    /*    if($password == ''){
            $password_error = 'Password is required.';
        }*/
        


        $sql1='SELECT * FROM `user_info`WHERE `email`="'.$email.'"';
        $que1 = mysqli_query($link, $sql1);

        if(mysqli_num_rows($que1)>0){
            header('Location:user_login.php?status=already_registered');
        }


        if( $name!='' && $email!='' && $pass!='' && $img!=''){
            
            $sql1 = 'INSERT INTO `user_info`(`user_name`, `user_email`, `user_password`, `user_img_ext`, `pass_key`) VALUES("'.$name.'", "'.$email.'", "'.$pass.'", "'.$img.'", "'. $key.'")';

            mysqli_query($link, $sql1);
            
            header('Location:user_login.php?status=reg_success');
            
        }
        
    }
?>


<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	
	<style type="text/css">
		*{margin:0px;padding:0px}
		
		.form{
			    margin: 0 auto;
    /* float: left; */
    width: 50%;
    background: #ecf1ed;
    padding-top: 15px;;
    margin-top: 50px;
    box-shadow: 0 4px 6px 2px #9c9c9c;
    border-radius: 3px;
    min-height: 300px;
		}
		
		input[type="text"],[type="submit"],[type="reset"],[type="email"],[type="password"]{
			margin-left: 54px;
			margin-top: 5px;
			border-radius: 10px;
			box-sizing: border-box;
			border: 2px solid #d8d4cd;
			padding: 5px 10px;
			background: #ffffff;
			font: normal 14px Arial, Helvetica, sans-serif;
			color: #1F5A9D;
		}
		
		input[type="file"]{
			margin-left:54px;
		}
		
		input[type="submit"]:hover,input[type="reset"]:hover{background:#99c9ff;color:black;cursor:pointer}

	.label{padding-left: 54px;
    color: #6f4801;
    font-size: 16px;}
	</style>
</head>
<body>
	<div class="form">
        <form action="" method="post" enctype="multipart/form-data">
            
                <label class="label">Full Name:</label><br>
                <input type="text" name="name" placeholder="Write your first name">
                    <?php if(isset($name_error)) echo '<div class="error">'.$name_error.'</div>';?>
                
                <br><br>
                
                <label class="label">Email:</label><br>
                <input type="email" name="email" placeholder="Ex: name@gmail.com">
                <?php if(isset($email_error)) echo '<div class="error">'.$email_error.'</div>';?>
                
                <br><br>
                
                <label class="label">Password:</label><br>
                <input type="password" placeholder="Ex: ********" name = "pass">
                <?php if(isset($pass_error)) echo '<div class="error">'.$pass_error.'</div>';?>
                
                <br><br>
				
                <label class="label">Image</label><br>
                <input type="file"  name = "img">
                <?php if(isset($img_error)) echo '<div class="error">'.$img_error.'</div>';?>
                
                
                <br><br>
                
                <input type="submit" name="submit" value="Register">
                <input type="reset">
        </form>
    </div>
    
    <?php
    include('footer.php');
?>
</body>
</html>