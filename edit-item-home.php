<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_GET['id']))
    {
        $item_id = $_GET['id'];

        $sql = "SELECT * FROM item WHERE id = $item_id";

        $res = mysqli_query($conn ,$sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);

            $item_name =$row['name'];
            $sku = $row['sku'];
            $supplier = $row['supplier'];
            $current_warehouse = $row['warehouse_id'];
            $current_product = $row['product_id'];
            $quantity = $row['quantity'];
        }
        else
        {
            header('location:'.SITE_URL.'home.php');
        }
        
    }
    else
    {
        header('location:'.SITE_URL.'home.php');
    }

    if(isset($_POST['submit']))
    {
        $item_id = $_POST['item_id'];
        $item_name =$_POST['item_name'];
        $sku = $_POST['sku'];
        $supplier = $_POST['supplier'];
        $warehouse = $_POST['warehouse'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        //Insert to database
        //Create a query
        $sql2 = "UPDATE item SET
            name = '$item_name',
            sku = '$sku',
            supplier = '$supplier',
            product_id = $product_id,
            warehouse_id = $warehouse,
            quantity = $quantity
            WHERE id = $item_id
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //Check whether the query is executed
        //Redirect with message
        if($res2 == TRUE)
        {
            $_SESSION['edit-item-success'] = "<div class = 'success'>Added Item Successfully</div>";

            header('location:'.SITE_URL.'show.php?id='.$product_id);
        }
        else
        {
            $_SESSION['edit-item-failed'] = "<div class = 'error'>Failed to Add Item</div>";

            header('location:'.SITE_URL.'show.php?id='.$product_id);
        }
    }
?>

    <div class="m-auto w-auto py-2">
        <div class="text-center" style="color: #65a2eb;">
            <h3 class="text-xxl-center text-uppercase" >Edit item</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div style="color: #29ff00; opacity: 80%;">
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Item Name</strong></label>
                    <input class="form-control" name="item_name" id="name" rows="3" value="<?php echo $item_name; ?>"></input>
                </div>
                <div class="mb-3">
                    <label for="sku" class="form-label"><strong>SKU</strong></label>
                    <input class="form-control" name="sku" id="sku" rows="3" value="<?php echo $sku; ?>"></input>
                </div>
                <div class="mb-3">
                    <label for="supplier" class="form-label"><strong>Supplier</strong></label>
                    <input class="form-control" name="supplier" id="supplier" rows="3" value="<?php echo $supplier; ?>"></input>
                </div>
                <div class="mb-3">
                    <label for="warehouse" class="form-label"><strong>Warehouse</strong></label>
                    <select name="warehouse" class="form-select" id="warehouse" aria-label="Inventory select">
                        <?php 
                            //Create PHP Code to display category from database
                            //Create SQL to get all active categories from database
                            $sql1 = "SELECT * FROM warehouse";
                            //Execute the query
                            $res1 = mysqli_query($conn, $sql1);

                            //Count the number of active categories
                            $count1 = mysqli_num_rows($res1);
                            if($count1 > 0)
                            {  
                                while($row1 = mysqli_fetch_assoc($res1))
                                {
                                    $warehouse_id = $row1['id'];
                                    $warehouse_name =$row1['name'];
                                    ?>

                                    <option <?php if($current_warehouse == $warehouse_id){ echo "selected"; } ?> value="<?php echo $warehouse_id; ?>"><?php echo $warehouse_name; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="1"><strong>No Warehouse Available</strong></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label"><strong>Quantity</strong></label>
                    <input type="number" class="form-control" name="quantity" id="quantity" rows="3" value="<?php echo $quantity; ?>"></input>
                </div>
                <div class="mb-3">
                    <label for="product" class="form-label"><strong>Product</strong></label>
                    <select name="product_id" class="form-select" id="product" aria-label="Inventory select">
                        <?php 
                            //Create PHP Code to display category from database
                            //Create SQL to get all active categories from database
                            $sql3 = "SELECT * FROM product";
                            //Execute the query
                            $res3 = mysqli_query($conn, $sql3);

                            //Count the number of active categories
                            $count3 = mysqli_num_rows($res3);
                            if($count3 > 0)
                            {  
                                while($row3 = mysqli_fetch_assoc($res3))
                                {
                                    $product_id = $row3['id'];
                                    $product_name =$row3['name'];
                                    ?>

                                    <option <?php if($current_product == $product_id){ echo "selected"; } ?> value="<?php echo $product_id; ?>"><?php echo $product_name; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="1"><strong>No Product Available</strong></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                <input class="btn btn-primary" name="submit" type="submit" value="Edit Item">
                <a type="button" href="<?php echo SITE_URL; ?>home.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php include('partials-front/footer.php'); ?>