<?php 

    //Include constants.php file here
    include('../config/constants.php');
    
    //get the ID of Admin to be deleted
    $id = $_GET['id'];

    //Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res==true)
    {
        //Query Executed Successfully and admin deleted
        //echo "Admin Deleted";
        //create Session variable to display message 
        $_SESSION ["delete"] = "<div>Admin Deleted Succesfully</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Deleted Admin
       // echo "Failed to Delete Amdin";
       $_SESSION ['delete']= "<div class='error'>Failed to Delete Admin. Try Again Letter.</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //Redirect to Manage Admin page with page(success/error)
?>