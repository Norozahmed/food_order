<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br><br>

        <?php 
           if(isset($_SESSION['add'])) //Checking whether the session is set or not
           {
             echo $_SESSION['add']; //Display the session mesage if set
             unset($_SESSION['add']); //remove the session message
           }
        ?>
        <form action="" method="POST">
            <table class="tbl30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer1.php'); ?>

<?php
//process the value from form and save it in database
//check whether the submit button is calicked or not

if(isset($_POST['submit'])) 
{
    //button clicked
   // echo "Button Clicked";
   
   //get the data from form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']); //password Encription with md5
     
     //SQL Query to save the data  into database
     $sql = "INSERT INTO tbl_admin SET
     full_name='$full_name',
     username='$username',
     password='$password'
     ";

    //Executing Query and Saving Data into Database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //Check Whether the Query is executed data is inseted or not and display approriate message
    if($res==TRUE)
    {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else 
    {
        //failed to inset data
       // echo "Failed to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "Failed to Add Admin";
         //redirect page to add admin
         header("location:".SITEURL.'admin/add-admin.php');
    }

}
?>