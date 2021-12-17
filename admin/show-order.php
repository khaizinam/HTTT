<?php 
include("partials/menu.php");

if(isset($_GET['id']))
{
    $order_id = $_GET['id'];
    
    $sql = "SELECT * from order_table WHERE id = $order_id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);

        $order_type = $row['order_type'];
        $order_reason = $row['order_reason'];
        $order_details = $row['order_details'];
        $order_address = $row['order_address'];
        $userID = $row['userID'];
        $sql2 = "SELECT * from staff where id = $userID";

        $res2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($res2);

        $userFName = $row2['name'];
        $order_date = $row['order_date'];

    }
    else
    {
        header('location:'.SITE_URL.'admin/staff.php');
    }
}
else
{
    header('location:'.SITE_URL.'admin/staff.php');
}

?>

<style>
    body {
        background-image: url('../public/image/warehouse.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<div class="container-fluid" style="color: #65a2eb;">
    <h3 class='text-center'><?php if($order_type==1){echo "Đơn nhập kho: ".$order_id;}else{echo "Đơn xuất kho: ".$order_id;} ?></h3>
    <h4 class="text-center">Created By: <?php echo $userFName; ?></h4>
    <h4 class="text-center">Order Date: <?php echo $order_date; ?></h4>
    <a href="<?php echo SITE_URL; ?>show-staff.php?id=<?php echo $userID; ?>"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 30px; padding-left: 20px;"></i></a> 
</div>

<div class="container-xl product" style="margin-top: 10px; color: greenyellow; opacity: 80%; font-size: 1.5rem;">
    <div class="mb-3">
        <label for="order_reason" class="form-label"><strong>Order Reason</strong></label>
        <input rows="3" name="order_reason" id="order_reason" class="form-control" readonly value="<?php echo $order_reason; ?>">
    </div>
    <div class="mb-3">
        <label for="order_details" class="form-label"><strong>Order Details</strong></label>
        <input rows="3" name="order_details" id="order_details" class="form-control" readonly value="<?php echo $order_details; ?>">
    </div>
    <div class="mb-3">
        <label for="order_address" class="form-label"><strong>Order Address</strong></label>
        <input rows="3" name="order_address" id="order_address" class="form-control" readonly value="<?php echo $order_address; ?>">
    </div>
</div>

<h4 style="margin-left: 110px; margin-bottom: 20px; color: #29ff00;">Items in Order</h4>
<div class="container-xl border" style="margin-bottom: 50px;">
        <div class='table-responsive-xl'>
            <table class="table" id="result2" style="color: yellow;">
                <thead>
                    <tr>
                        <th scope="col">Item ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warehouse Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql1 = "SELECT * FROM order_items WHERE order_id = $order_id";
                        
                        $res1 = mysqli_query($conn, $sql1);

                        $count1 = mysqli_num_rows($res1);
                        if($count1 > 0)
                        {
                            while($row1=mysqli_fetch_assoc($res1))
                            {
                                $item_id = $row1['item_id'];
                                $quantity = $row1['quantity'];
                                $sql2 = "SELECT * FROM item WHERE id = $item_id";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);

                                if($count2>0)
                                {
                                    $row2 = mysqli_fetch_assoc($res2);
                                    $item_name = $row2['name'];
                                    $sku = $row2['sku'];
                                    $warehouse_id = $row2['warehouse_id'];
                                    $product_id = $row2['product_id'];
                                    $supplier = $row2['supplier'];

                                    $sql4 = "SELECT name from warehouse WHERE id = $warehouse_id";

                                    $res4 = mysqli_query($conn, $sql4);
                                    
                                    $row4 = mysqli_fetch_assoc($res4);
                                
                                    $warehouse_name = $row4['name'];
                                
                                    $sql3 = "SELECT name from product WHERE id = $product_id";
                                
                                    $res3 = mysqli_query($conn, $sql3);
                                    
                                    $row3 = mysqli_fetch_assoc($res3);
                                
                                    $product_name = $row3['name'];

                                    ?>
                                    <tr class="res d-none">
                                        <th scope="row"><?php echo $item_id; ?></th>
                                        <td><?php echo $item_name; ?></td>
                                        <td><?php echo $sku; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $warehouse_name; ?></td>
                                        <td><?php echo $product_name; ?></td>
                                        <td><?php echo $supplier; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <ul id="PageFragment">
                    <?php
                    if(ceil($count1 / 10) >= 2)
                    {
                        echo "<li class='btn btn-primary active' onclick='changePage(1)'>1</li>";
                    for($i = 2; $i <= ceil($count1 / 10) && $i <= 6;$i++){
                        echo "<li class='btn btn-primary' onclick='changePage(".$i.")'>".$i."</li>";
                    }
                    }
                    ?>
            </ul>
        </div>
    </div>
<script src="../public/js/fragment.js"></script>
<?php include('partials/footer.php'); ?>