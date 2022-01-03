<?php include('partials-front/menu.php')?>
    <div class="container-fluid">
        <h3 class='text-center' style='color: #65a2eb;'>Product</h3>
        
    </div>
    

    <div class="container-xl" style="margin-top: 10px; margin-bottom: 50px;">
    <?php
        if(isset($_SESSION['add-product-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Add Product Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-product-success']);
        }

        if(isset($_SESSION['add-product-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Add Product!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-product-failed']);
        }

        if(isset($_SESSION['edit-product-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Edit Product Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['edit-product-success']);
        }

        if(isset($_SESSION['edit-product-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Edit Product!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['edit-product-failed']);
        }

        if(isset($_SESSION['delete-product-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Delete Product Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-product-success']);
        }

        if(isset($_SESSION['delete-product-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Delete Product!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-product-failed']);
        }
    ?>
        <button class="btn btn-success" style="margin-bottom: 10px;"><a href="<?php echo SITE_URL; ?>add-product.php" class="text-decoration-none text-white"><i class="fa fa-plus-circle" style="font-size: 23px; padding-right: 5px;"></i>Add new Product</a></button>
        <div class='table-responsive-xl'>
            <table class="table" style="color: #b6dbff;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Product Type</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * from product ORDER BY name ASC";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        if($count > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $product_id = $row['id'];
                                $product_name = $row['name'];
                                $product_description = $row['description'];
                                $product_type = $row['product_type'];
                                $product_quantity = $row['quantity'];

                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $product_id; ?></th>
                                    <td><a href="<?php echo SITE_URL; ?>show.php?id=<?php echo $product_id; ?>" class="text-decoration-none product-name" style="color: #ff6b81;"><?php echo $product_name; ?></a></td>
                                    <td><?php echo $product_description; ?></td>
                                    <td><?php echo $product_type; ?></td>
                                    <td><?php echo $product_quantity; ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>edit-product.php?id=<?php echo $product_id; ?>" class="btn btn-primary" type="button">Edit</a>
                                        <a href="<?php echo SITE_URL; ?>delete-product.php?id=<?php echo $product_id; ?>" class="btn btn-danger" type="button">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                        }
                    ?>            
                </tbody>
            </table>
            <ul id="PageFragment">
                    <?php
                    if(ceil($count / 10) >= 2)
                    {
                        echo "<li class='btn btn-primary active' onclick='changePage(1)'>1</li>";
                    for($i = 2; $i <= ceil($count / 10) && $i <= 6;$i++){
                        echo "<li class='btn btn-primary' onclick='changePage(".$i.")'>".$i."</li>";
                    }
                    }
                    ?>
            </ul>
        </div>
    </div>
<script src="public/js/fragment.js"></script>
<?php include('partials-front/footer.php'); ?>