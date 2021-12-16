<?php include('partials-front/menu.php') ?>

<?php 
    if(isset($_GET['id']))
    {
        $product_id = $_GET['id'];

        $sql = "SELECT * FROM product WHERE id = $product_id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $product_name = $row['name'];
            $product_description = $row['description'];
            $product_type = $row['product_type'];
            $quantity = $row['quantity'];
        }
        else
        {
            header('location:'.SITE_URL.'product.php');
        }
    }
    else
    {
        header('location:'.SITE_URL.'product.php');
    }
?>
    <div class="container-fluid">
        <h3 class='text-center'><?php echo $product_name; ?></h3>
        <a href="<?php echo SITE_URL; ?>product.php"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 30px; padding-left: 20px;"></i></a>
    </div>
    
    <div class="container-xl product" style="margin-top: 10px; color: #29ff00;">
        <div class="mb-3">
            <label for="product_description" class="form-label"><strong>Product Description</strong></label>
            <input rows="3" name="product_description" id="product_description" class="form-control" readonly value="<?php echo $product_description; ?>">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label"><strong>Total Quantity</strong></label>
            <input rows="3" name="quantity" id="quantity" class="form-control" readonly value="<?php echo $quantity; ?>">
        </div>
        <div class="mb-3">
            <label for="product_type" class="form-label"><strong>Product Type</strong></label>
            <input rows="3" name="product_type" id="product_type" class="form-control" readonly value="<?php echo $product_type; ?>">
        </div>
    </div>

    <button class="btn btn-success" style="margin-left: 110px; margin-bottom: 20px;"><a href="<?php echo SITE_URL; ?>add-item.php?product_id=<?php echo $product_id; ?>" class="text-decoration-none text-white"><i class="fa fa-plus-circle" style="font-size: 23px; padding-right: 5px;"></i>Add new Item</a></button>
    <div class="container-xl border" style="margin-top: 10px; margin-bottom: 50px;">
        <?php 
            if(isset($_SESSION['add-item-success']))
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Add Item Successfully!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                unset($_SESSION['add-item-success']);
            }

            if(isset($_SESSION['add-item-failed']))
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed to Add Item!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                unset($_SESSION['add-item-failed']);
            }

            if(isset($_SESSION['edit-item-success']))
            {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Edit Item Successfully!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                unset($_SESSION['edit-item-success']);
            }

            if(isset($_SESSION['edit-item-failed']))
            {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed to Edit Item!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                unset($_SESSION['edit-item-failed']);
            }
        ?>
        <div class='table-responsive-xl'>
            <table class="table">
            <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warehouse Name</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql1 = "SELECT * FROM item WHERE product_id = $product_id ORDER BY name ASC";

                        $res1 = mysqli_query($conn, $sql1);

                        $count1 = mysqli_num_rows($res1);

                        if($count1 > 0)
                        {
                            $num = 0;
                            while($row1 = mysqli_fetch_assoc($res1))
                            {
                                $item_id = $row1['id'];
                                $item_name = $row1['name'];
                                $sku = $row1['sku'];
                                $quantity = $row1['quantity'];
                                $warehouse_id = $row1['warehouse_id'];
                                $supplier = $row1['supplier'];

                                $sql2 = "SELECT name from warehouse WHERE id = $warehouse_id";

                                $res2 = mysqli_query($conn, $sql2);
                                
                                $row2 = mysqli_fetch_assoc($res2);

                                $warehouse_name = $row2['name'];
                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $num++; ?></th>
                                    <td><?php echo $item_name; ?></td>
                                    <td><?php echo $sku; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $warehouse_name; ?></td>
                                    <td><?php echo $supplier; ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>edit-item.php?id=<?php echo $item_id; ?>" class="btn btn-primary" type="button">Edit Item</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <strong>No Item Available</strong>
                            <?php
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
<script src="public/js/fragment.js"></script>
<?php include('partials-front/footer.php'); ?>