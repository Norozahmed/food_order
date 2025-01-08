<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>

        <?php
           if(isset($_SESSION['upload']))
           {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
           }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl30">
                <tr>
                        <td>Title:  </td>
                        <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                           
                            <?php
                    //create PHP code to display categories from database
                    //create SQL ro get all active categories from databas
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    
                    //executing query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    //if count is greater than zero, we have categories else we donot have categories
                    if($count>0)
                    {
                        //we have categories
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get the details of categories
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                            <?php
                        }
                    }
                    else
                    {
                        //we do not have category
                        ?>

                        </select>
                    </td>

                        <option value="0">No Category Found</option>
                        <?php
                    }

                    //display on Drpopdown
                    ?>
            
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="NO"> NO
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="NO"> NO
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td></tr>
            </table>
        </form>

        <?php
             
             //check whether the button is clicked or not
             if(isset($_POST['submit']))
             {
               // echo "clicked";
               //add the food in database
               //get the data from form
               $title = $_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $category = $_POST['category'];

               //check whether radio button for featured and activr are clicked or not
               if(isset($_POST['featured']))
               {
                $featured = $_POST['featured'];
               }
               else
               {
                $featured = "NO";
               }
               if(isset($_POST['active']))
               {
                $active = $_POST['active'];
               }
               else
               {
                $active = "NO"; //setting dafuly value
               }
               //upload the image if selected
               //checked whether the slesct image is clickd or not ans upload the imaage only if the image is selected
               if(isset($_FILES['image']['name']))
               {
                   //get the details of hte selected image
                   $image_name = $_FILES['image']['name'];

                   //check whether the imagge is slelected or not and upload image only if selected
                   if($image_name!="")
                   {
                    //image is selected
                    //rename the image
                    //get the extension of seleted image (jpg, jpeg, png, gif, ect...)
                    $ext = end(explode(".", $image_name));

                    //create new name fo image
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Name-657.jpg"

                    //upload the image
                    //get the src path and destination path

                    //source path is the current loactiion of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dst = "../images/food/".$image_name;

                    //finally uplaod tjhe food image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image uploadded or not
                    if($upload==false)
                    {
                        //failed to upload the image
                        //redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();

                    }
                   }
                  
               }
               else
               {
                $image_name = ""; //setting default value as blank
               }
               //insert into database

               //create a SQL query to save or add food
               //gor numeric value dont need to pass value inside '' but for string it is compulsory
               $sql2 = "INSERT INTO tbl_food SET
               title = '$title',
               description = '$description',
               price = $price,
               image_name = '$image_name',
               category_id = '$category',
               featured = '$featured',
               active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == true)
                {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='sucess'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

               //redirect with message to manage food page
             }
        ?>
    </div>
</div>

<?php include ('partials/footer1.php'); ?>