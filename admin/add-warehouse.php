<?php include('partials/menu.php'); ?>

<?php

    if(isset($_POST['submit']))
    {
        $warehouse_name = $_POST['warehouse_name'];
        $warehouse_address = $_POST['warehouse_address'];

        $sql = "INSERT INTO warehouse SET
            name = '$warehouse_name',
            address = '$warehouse_address'
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['add-warehouse-success'] = '<div class="text-success">Add Warehouse Successfully!</div>';

            header('location:'.SITE_URL.'admin/warehouse.php');
        }
        else
        {
            $_SESSION['add-warehouse-failed'] = '<div class="text-danger">Failed to Add Warehouse!</div>';

            header('location:'.SITE_URL.'admin/warehouse.php');
        }
    }
?>
    <div class="m-auto w-auto py-2">
        <div class="text-center">
            <h3 class="text-xxl-center text-uppercase ">Add new Warehouse</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div class="mb-3">
                <label for="warehouse_name" class="form-label"><strong>Warehouse Name</strong></label>
                <input type="text" class="form-control" name= "warehouse_name" id="warehouse_name" rows="3" placeholder="Warehouse Name..."></input>
            </div>
            <div class="mb-3">
                <label for="warehouse_address" class="form-label"><strong>Warehouse Address</strong></label>
                <textarea class="form-control" name="warehouse_address" id="warehouse_address" rows="3" placeholder="Warehouse Address..."></textarea>
            </div>
            <input class="btn btn-success" name="submit" type="submit" value="Add Warehouse">
            <a href="<?php echo SITE_URL; ?>admin/warehouse.php" type="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php include('partials/footer.php'); ?>