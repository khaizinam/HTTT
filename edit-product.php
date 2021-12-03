<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['id']))
    {
        $product_id = $_GET['id'];

        $sql = "SELECT * FROM product WHERE id = $product_id";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
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

    if(isset($_POST['submit']))
    {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $product_type = $_POST['product_type'];
        $quantity = $_POST['quantity'];

        $sql = "UPDATE product SET
            name = '$product_name',
            description = '$description',
            product_type = '$product_type',
            quantity = $quantity
            WHERE id = $product_id
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['edit-product-success'] = '<div class="text-success">Edit Product Successfully!</div>';

            header('location:'.SITE_URL.'product.php');
        }
        else
        {
            $_SESSION['edit-product-failed'] = '<div class="text-danger">Failed to Edit Product!</div>';

            header('location:'.SITE_URL.'product.php');
        }
    }
?>
    <div class="m-auto w-auto py-2">
        <div class="text-center">
            <h3 class="text-xxl-center text-uppercase ">Edit Product</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label"><strong>Product Name</strong></label>
                <input class="form-control" name="product_name" id="name" rows="3" value="<?php echo $product_name; ?>"></input>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label"><strong>Product Desciption</strong></label>
                <textarea class="form-control" name="product_description" id="description" rows="3"><?php echo $product_description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="product_type" class="form-label"><strong>Product Type</strong></label>
                <input class="form-control" name="product_type" id="product_type" rows="3" value="<?php echo $product_type; ?>"></input>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label"><strong>Total Quantity</strong></label>
                <input readonly class="form-control" name="quantity" id="quantity" rows="3" value="<?php echo $quantity; ?>"></input>
            </div>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input class="btn btn-primary" type="submit" name="submit" value="Edit Product">
            <a type="button" href="<?php echo SITE_URL; ?>product.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php include('partials-front/footer.php'); ?>