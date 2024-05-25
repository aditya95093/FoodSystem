<?php
include ("../connection/connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $hashed_password = md5($password);
        $loginquery = "SELECT * FROM admin WHERE username='$username' AND password='$hashed_password'";
        $result = mysqli_query($db, $loginquery);

        if (!$result) {
            echo "Error in query: " . mysqli_error($db);
        } else {
            $row = mysqli_fetch_array($result);
            if (is_array($row)) {
                $_SESSION["adm_id"] = $row['adm_id'];
                header("refresh:1;url=dashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid Username or Password!');</script>";
            }
        }
    } else {
        echo "<script>alert('Both fields are required!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="info">
            <h1>Admin Panel </h1>
        </div>
    </div>
    <div class="form">
        <div class="thumbnail"><img src="images/manager.png" /></div>
        <form class="login-form" action="index.php" method="post">
            <input type="text" placeholder="Username" name="username" required />
            <input type="password" placeholder="Password" name="password" required />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='js/index.js'></script>
</body>

</html>