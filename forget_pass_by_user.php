<?php

    include('database.php');
    

    if(isset($_REQUEST['submit'])){

        $email = $_REQUEST['email'];

        $sql2 = 'SELECT * FROM `user_info` WHERE `user_email` = "'.$email.'"';
        
        $que2 = mysqli_query($link, $sql2);

        if(mysqli_num_rows($que2)>0){

            $key = RAND(100000,999999);

            $sub = "Reset Password";

            $message = "<p> <a href='http://localhost/classroom/forget_pass3_by_user.php?id=".$key."'>Click Here</a> to reset your password or use the following reset code for reset your password.</p></br><p>Your reset code is: <h2>".$key."</h2>. This code is being invalid within 24 hours. </br> <h3>Thank you from Bookworm team for being with us.</h3></p> ";

            //$message = 'Sample mesgdfgvdfsfv fdsfsd';

            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            // Create email headers
            $from = 'classroom@gmail.com';
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();


            $sql1 = 'UPDATE `user_info` set `pass_key` = "'.$key.'" WHERE `user_email` = "'.$email.'"   ' ;

            $que1 = mysqli_query($link, $sql1);

        //    $header = NULL;

            mail($email, $sub, $message,$headers);

        //    echo 'Code sent to your email. Check your email inbox(also Spam box) for reset your password.';
            header('Location: forget_pass2_by_user.php?id='.$key.'');
            }

            else{
                echo '<script type="text/javascript">alert("This mail not registered yet.");</script>';
            }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
	
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
		<p>Enter your email address:</p><br /><br />
		<form action="" method="post">
			<input type="text" placeholder="Enter your email" name="email" required/>
			<input type="submit" value="Next" name="submit"/>
		</form>
    </div>
    
    <?php
    include('footer.php');
?>
</body>
</html>