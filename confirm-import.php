<?php 
include("partials-front/menu.php");
?>

<div class="container-fluid" style="color: #65a2eb;">
    <h3 class='text-center'>Confirm Import</h3>
    <a href="<?php echo SITE_URL; ?>import.php"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 30px; padding-left: 20px;"></i></a> 
</div>

<h4 style="margin-left: 110px; margin-bottom: 20px; color: #29ff00;">Items to be imported</h4>
<div class="container-xl border" style="margin-top: 10px;">
        <div class='table-responsive-xl'>
            <form action="<?php echo SITE_URL; ?>import-order.php" method="POST"> 
            <table class="table" id="result2" style="color: #b6dbff;">
                <thead>
                    <tr>
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
                        if(isset($_COOKIE['cart']))
                        {
                            $cookie_data = stripslashes($_COOKIE["cart"]);
                            $cart_data = json_decode($cookie_data, true);
                            $data_length = 0;
                            foreach($cart_data as $key => $value)
                            {
                                $data_length++;
                                $warehouse_id = $value["warehouse_id"];
                                $product_id = $value["product_id"];

                                $sql4 = "SELECT name from warehouse WHERE id = $warehouse_id";

                                $res4 = mysqli_query($conn, $sql4);
                                
                                $row4 = mysqli_fetch_assoc($res4);
                            
                                $warehouse_name = $row4['name'];
                            
                                $sql3 = "SELECT name from product WHERE id = $product_id";
                            
                                $res3 = mysqli_query($conn, $sql3);
                                
                                $row3 = mysqli_fetch_assoc($res3);
                            
                                $product_name = $row3['name'];
                                ?>
                                <tr class="itemCartremove<?php echo $value['item_id']; ?> res d-none">
                                    <td><?php echo $value["item_name"]; ?></td>
                                    <td><?php echo $value['sku']; ?></td>
                                    <td style="width: 20px;">
                                        <input type="hidden" name="id[]" value="<?php echo $value['item_id']; ?>">
                                        <input readonly type="text" class="form-control quantity-item text-center" value='<?php echo $value["item_quantity"]; ?>' name="quantity[]">
                                    </td>
                                    <td><?php echo $warehouse_name; ?></td>
                                    <td><?php echo $product_name; ?></td>
                                    <td><?php echo $value['supplier']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
            <ul id="PageFragment">
                        <?php
                        if(isset($_COOKIE['cart']))
                        {
                            if(ceil($data_length / 10) >= 2)
                        {
                            echo "<li class='btn btn-primary active' onclick='changePage(1)'>1</li>";
                        for($i = 2; $i <= ceil($data_length / 10) && $i <= 6;$i++){
                            echo "<li class='btn btn-primary' onclick='changePage(".$i.")'>".$i."</li>";
                        }
                        }
                        }
                        ?>
                </ul>
            <div style="color: #29ff00; opacity: 80%;">
                <div class="mb-3">
                    <label for="order_reason" class="form-label"><strong>Order Reason</strong></label>
                    <input type="text" name="order_reason" id="order_reason" class="form-control" placeholder="Type order reason...">
                </div>
                <div class="mb-3">
                    <label for="order_details" class="form-label"><strong>Order Details</strong></label>
                    <input type="text" name="order_details" id="order_details" class="form-control" placeholder="Type order details...">
                </div>
                <div class="mb-3">
                    <label for="order_address" class="form-label"><strong>Order address</strong></label>
                    <input type="text" name="order_address" id="order_address"  class="form-control" placeholder="Type order address...">
                </div>
            </div>
            
            <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
            <input class="btn btn-primary" type="submit" name="submit" style="float: right; margin-bottom: 10px; margin-top: 10px;" value="Confirm Import">
            </form>
        </div>
    </div>
<script src="public/js/fragment.js"></script>
<?php include('partials-front/footer.php'); ?>