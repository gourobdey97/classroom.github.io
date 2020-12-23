<?php
    include('database.php');
    if (!isset($_SESSION['id'])) {
        header('Location:user_login.php');
    }

    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    
        if ($status == 'joined_successfully') {
            echo '<script type="text/javascript">alert("Successfully Joined!");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joined Classes</title>
</head>
<body>
    <h1>Joined classes page</h1>

    <?php
    include('footer.php');
?>
</body>
</html>