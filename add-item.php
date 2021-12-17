<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_GET['product_id']))
    {
        $product_id = $_GET['product_id'];
    }
    else
    {
        header('location:'.SITE_URL.'product.php');
    }

    if(isset($_POST['submit']))
    {
        $item_name =$_POST['item_name'];
        $sku = $_POST['sku'];
        $supplier = $_POST['supplier'];
        $warehouse = $_POST['warehouse'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        //Insert to database
        //Create a query
        $sql2 = "INSERT INTO item SET
            name = '$item_name',
            sku = '$sku',
            supplier = '$supplier',
            product_id = $product_id,
            warehouse_id = $warehouse,
            quantity = $quantity
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //Check whether the query is executed
        //Redirect with message
        if($res2 == TRUE)
        {
            $_SESSION['add-item-success'] = "<div class = 'text-success'>Added Item Successfully</div>";

            header('location:'.SITE_URL.'show.php?id='.$product_id);
        }
        else
        {
            $_SESSION['add-item-failed'] = "<div class = 'text-error'>Failed to Add Item</div>";

            header('location:'.SITE_URL.'show.php?id='.$product_id);
        }
    }
?>

    <div class="m-auto w-auto py-2">
        <div class="text-center" style="color: #65a2eb;">
            <h3 class="text-xxl-center text-uppercase">Add new item</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div style="color: #29ff00; opacity: 80%;">
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Item Name</strong></label>
                    <input class="form-control" name="item_name" id="name" rows="3" placeholder="Item Name..."></input>
                </div>
                <div class="mb-3">
                    <label for="sku" class="form-label"><strong>SKU</strong></label>
                    <input class="form-control" name="sku" id="sku" rows="3" placeholder="SKU..."></input>
                </div>
                <div class="mb-3">
                    <label for="supplier" class="form-label"><strong>Supplier</strong></label>
                    <input class="form-control" name="supplier" id="supplier" rows="3" placeholder="Supplier..."></input>
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

                                    <option value="<?php echo $warehouse_id; ?>"><?php echo $warehouse_name; ?></option>

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
                    <input type="number" class="form-control" name="quantity" id="quantity" rows="3" placeholder="1"></input>
                </div>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input class="btn btn-success" name="submit" type="submit" value="Add Item">
                <a type="button" href="<?php echo SITE_URL; ?>show.php?id=<?php echo $product_id; ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php include('partials-front/footer.php'); ?>