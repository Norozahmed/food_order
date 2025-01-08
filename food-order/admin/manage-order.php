<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>
        Manage Order
    </h1>
            <br /><br /> <br />

            <?php 
               if(isset($_SESSION['update']))
               {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
               }
            ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //gwt all the orders from datbase
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //display the latest
                    //execute query
                    $res = mysqli_query($conn, $sql);
                    //count the rows
                    $count = mysqli_num_rows($res);

                    $sn = 1;    //set it as initial value as 1
                    if($count>0)
                    {
                        //order not available
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get al the order details
                            $id = $row['id'];
                            $food  = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>

                           <tr>
                             <td><?php echo $sn++; ?>.</td>
                             <td><?php echo $food; ?></td>
                             <td><?php echo $price; ?></td>
                             <th><?php echo $qty; ?></th>
                             <th><?php echo $total; ?></th>
                             <th><?php echo $order_date; ?></th>
                             <th>
                                <?php
                                //ordered, on delivery, Delivered,cencelled


                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status== "On Delivery")
                                    {
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    elseif($status== "Delivered")
                                    {
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    elseif($status== "Cancelled")
                                    {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                 ?>
                            </th>
                             <th><?php echo $customer_name; ?></th>
                             <th><?php echo $customer_contact; ?></th>
                             <th><?php echo $customer_email; ?></th>
                             <th><?php echo $customer_address; ?></th>
                             <td>
                             <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a> 
                                <!--<a href="#" class="btn-danger">Delete Order</a>-->
                            </td>
                           </tr>

                            <?php

                        }
                    }
                    else{
                        echo "<tr><td colspan='12'>Orders not available</td></tr>";
                    }
                ?>

            

             


            </table>
    </div>
</div>
<?php include('partials/footer1.php'); ?>