<?php include('../../assets/inc/header.php'); ?>

<?php

    if(isset($_POST['submit']))
    {
        $product_name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $product_type = $_POST['product_type'];

        $sql = "INSERT INTO product SET
            name = '$product_name',
            description = '$description',
            product_type = '$product_type',
            quantity = 0
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['add-product-success'] = '<div class="text-success">Add Product Successfully!</div>';

            header('location:../page/product.php');
        }
        else
        {
            $_SESSION['add-product-failed'] = '<div class="text-danger">Failed to Add Product!</div>';

            header('location:../page/product.php');
        }
    }
?>
    <div class="m-auto w-auto py-2">
        <div class="text-center">
            <h3 class="text-xxl-center text-uppercase ">Add new Product</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div class="mb-3">
                <label for="product_name" class="form-label"><strong>Product Name</strong></label>
                <input type="text" class="form-control" name= "product_name" id="product_name" rows="3" placeholder="Product Name..."></input>
            </div>
            <div class="mb-3">
                <label for="product_description" class="form-label"><strong>Product Description</strong></label>
                <textarea class="form-control" name="product_description" id="product_description" rows="3" placeholder="Type a brief description..."></textarea>
            </div>
            <div class="mb-3">
                <label for="product_type" class="form-label"><strong>Product Type</strong></label>
                <input type="text" class="form-control" name="product_type" id="product_type" rows="3" placeholder="Product Type..."></input>
            </div>
            <input class="btn btn-success" name="submit" type="submit" value="Add Product">
            <a href="../page/product.php" type="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php include('../../assets/inc/footer.php'); ?>