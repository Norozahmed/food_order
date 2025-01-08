<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id'])) 
        {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" >
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <input type="submit" name="submit" value="Change Passowrd" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
      //check whether the submit button is clicked or not 
      if(isset($_POST['submit']))
      {
        //echo "clicked";
        
        //get the data from form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether the user with current id and password 
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        
        //execut the query
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            //check whether data is available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //user exists and passowrd can be changed
               // echo "User Found";

                //check whether the new password and confirm match or not
                if($new_password==$confirm_password)
                {
                    //update the password
                    $sql2 = "UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query exucuted or not
                    if($res2==true)
                    {
                        //display success message
                        //redirect to manage admin page with success message
                       $_SESSION['change-pass'] = "<div class='success'>Password changed Successfully.</div>";
                       //redirect the user
                       header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        //display error message
                        //redirect to manage admin page with error message
                       $_SESSION['change-pass'] = "<div class='error'>Failed to Change Password.</div>";
                       //redirect the user
                       header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to manage admin page with error message
                    $_SESSION['pass-not-match'] = "<div class='error'>Password Not Match.</div>";
                //redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else{
                //user does not exists
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                //redirect the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

      }
?>



<?php include('partials/footer1.php') ?>