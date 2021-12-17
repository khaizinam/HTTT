<?php include('partials-front/menu.php'); ?>

<?php 
    if(isset($_SESSION['login']))
    {
        unset($_SESSION['login']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Login Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_SESSION['update']))
    {
        unset($_SESSION['update']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Update Profile Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_SESSION['update-failed']))
    {
        unset($_SESSION['update-failed']);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Update Profile!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_SESSION['user-not-found']))
    {
        unset($_SESSION['user-not-found']);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>User not found!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if(isset($_SESSION['change-pwd']))
    {
        unset($_SESSION['change-pwd']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Change Password Successfully!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }

    if(isset($_SESSION['change-pwd-failed']))
    {
        unset($_SESSION['change-pwd-failed']);
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Failed to Change Password!</strong>Something went wrong...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

    }
?>
    <h3 class='text-center' style='color: #65a2eb;'>Inventory Management</h3>

    <div class="container-xl product">
            <div class='w-100'>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Item" id='keyword' autocomplete="off">
                    <div class="input-group-append">
                        <span class="input-group-text" id='search-bar' style='cursor: pointer; height: 100%;'>
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
    </div>
    <div class="container-xl border" style="margin-top: 10px; margin-bottom: 50px;">
        <div class='table-responsive-xl' id="result2">
            <table class="table" style="color: #b6dbff;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Warehouse Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql1 = "SELECT * FROM item ORDER BY name ASC";

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
                                $product_id = $row1['product_id'];
                                $warehouse_id = $row1['warehouse_id'];
                                $supplier = $row1['supplier'];

                                $sql2 = "SELECT name from warehouse WHERE id = $warehouse_id";

                                $res2 = mysqli_query($conn, $sql2);
                                
                                $row2 = mysqli_fetch_assoc($res2);

                                $warehouse_name = $row2['name'];

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
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>edit-item-home.php?id=<?php echo $item_id; ?>" class="btn btn-primary" type="button">Edit Item</a>
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
<script src="public/js/home-search.js"></script>
<?php include('partials-front/footer.php'); ?>