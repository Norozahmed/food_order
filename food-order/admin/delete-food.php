<?php 
   // echo"delete food";
   include('../config/constants.php');

   if(isset($_GET['id']) && isset($_GET['image_name'])) //eaither use '&&' or 'AND'
   {
    //process to delete
    //echo "Process to Delete";
      
    //get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the image if avaialable
    //check whehter the image is avaible or not and delete only if available
    if($image_name != "")
    {
        //it has image and need to remove from folder
        //get the image path
        $path = "../images/food".$image_name;

        //remove image file form folder
        $remove = unlink($path);

        //check whether the image is rmeoved or not
        // if($remove==false)
        // {
        //     //failed to remove image
        //     $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
        //     header('location:'.SITEURL.'admin/manager-food.php');
        //     //stop the process of deleting
        //     die();
        // }
    }
          

    //delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    
    //check whehter the query execute or not and set the session message respectively
    if($res==true)
    {
        //food deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //failed to delete food
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

 

   }


    //redirect to manage food with session message
   else
   {
    //redirect to manage food page
    //echo "redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
   }
?>