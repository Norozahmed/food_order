<?php
    //include constants.php for SITEURL
    include('../config/constants.php');

    // Destry the session
    session_destroy(); //unsets $_SESSION['user]

    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>