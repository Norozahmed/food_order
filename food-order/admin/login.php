<?php  include('../config/constants.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>

        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } 

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
         <br>   Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary">
            <br>
            <br>
        </form>

        <!-- Login Form Starts Here -->


        <p class="text-center">Created By<a href="https://www.facebook.com/profile.php?id=100072241658614" target="_blank"> Noroz Ahmed</a></p>
    </div>
</body>
</html>


<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login
        // Get the Data from login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        //SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";
       
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //user available and login
            $_SESSION['login'] = "<div class='success' text-center>Login Successfull.</div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it
            //redirect to home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available and Lofin Fail
            $_SESSION['login'] = "<div class='error' text-center>Username or Password did not match.</div>";
            //redirect to home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>