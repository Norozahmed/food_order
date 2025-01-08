<?php 
     
    //authorization access control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])) //if user section is not set
      {
         //User is not logged in
         //Redirect to loginpage with message
         $_SESSION['no-login-message'] = "<div class='error text-center'>Please Login to access Admin Panel.</div>";
         //redirect to login page
         header('location:'.SITEURL.'admin/login.php');
      }
?>

