<?php 
require "connect.php";
if(isset($_POST["submit"])){
$user= $_POST['user'];
$passwd=$_POST['password'];
$sql= "SELECT * FROM `nhanvien` WHERE `emailNV` = '$user' AND `password`= '$passwd' AND `tinhtrangVN` ='Hoạt động'";
$re = $con ->query($sql);
if($re->num_rows>0)
{	
    session_start();
    $_SESSION['username'] = $user; 
    header ('location:index.php');

}
else
{
    header ('location:dn.php');
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="user" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><input class="btn btn-primary btn-block" name="submit" type="submit" value="Log In">
            </div>
        </form>
    </div>
</body>

</html>