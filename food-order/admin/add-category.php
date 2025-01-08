<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>


        <!-- Add Category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                    <td>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        Featured: 
                    </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> NO
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        
           //check whether the submit button is clicked or not
           if(isset($_POST['submit']))
           {
              //echo "Clicked";

              //Get the value from cat form
              $title = $_POST['title'];

              //for radio input, we need to check whether the button is selected or not
              if(isset($_POST['featured']))
              {
                  //get the value from form
                  $featured = $_POST['featured'];
              }
              else
              {
                //set the default value
                $featured = "No";
              }
              if(isset($_POST["active"]))
              {
                $active = $_POST["active"];
              }
              else
              {
                $active = "No";
              }

              //check whether the image is selected or not and set the value for image
             // print_r($_FILES['image']);
             // die(); //break the code

             if(isset($_FILES['image']['name']))
             {
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
                    header('location:'.SITEURL.'admin/add-category.php'); 
                    //stop the process
                    die();
                }
             }
             else
             {
                //dont upload image and set the image_name
                $image_name = "";
             }

              //create Sql Query to insert cat into Database
              $sql = "INSERT INTO tbl_category SET
              title='$title',
              image_name='$image_name',
              featured='$featured',
              active='$active'
              ";

              //execute
              $res = mysqli_query($conn, $sql);

              //check whether the query executed or not
              if($res==true)
              {
                //query executed and category added
                $_SESSION['add'] = "<div class='succes' >Category Added Successfully.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
              }
              else
              {
                //failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/add-category.php');
              }
           }
        ?>
    </div>
</div>



<?php include('partials/footer1.php'); ?>