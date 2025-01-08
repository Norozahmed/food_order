<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

        //check whether id is set or not
        if(isset($_GET['id']))
        {
            //get the id and all the other details
            //echo "Getting the Data";
            $id = $_GET['id'];
            //create SQL Query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //get all the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect to manage category with session message
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else
        {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

         <table class="tbl30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="title" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php 
                       if($current_image != "")
                       {
                        //display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="20%">
                        <?php
                       }
                       else
                       {
                        //display the message
                       }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO"> NO
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="NO"){echo "checked";} ?> type="radio" name="active" id="NO"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
         </table>

        </form>

        <?php 
              
              if(isset($_POST['submit']))
              {
                //echo "Clicked";
                //get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //updating new image if seleted
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check whether the lmage is available or not
                    if($image_name !== "")
                    {
                        //image Available
                        //upload the new image
                         //upload the image 
                //to upload we need, source path and distnation path
                $image_name = $_FILES['image']['name'];
                $souce_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //finally uopload the image
                $upload = move_uploaded_file($souce_path, $destination_path);

                if($upload==false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                    //Redirect to add Category Page
                    header('location:'.SITEURL.'admin/manage-category.php'); 
                    //stop the process
                    die();
                }

                        //remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path = '../images/category/'.$current_image;

                        $remove = unlink($remove_path);

                        //check whether the image is removed ir not
                        //if failed to remove then display message and stop the process
                        if($remove==false)
                        {
                            //failed to remove image
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die(); //stop the process 
                        }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }


                //update the database 
                
                $sql2 = "UPDATE tbl_category SET  
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active' 
                WHERE id=$id
                ";


                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //redirect to manage category with message
                //check whether executed or not
                if($res2==true)
                {
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }



              }
        ?>

    </div>
</div>

<?php include('partials/footer1.php'); ?>