<?php include('partials/menu.php'); ?>

<?php
    if(!isset($_GET['id']))
    {
        header('location:'.SITE_URL.'admin/warehouse.php');
    }
    else
    {
        $warehouse_id = $_GET['id'];

        $sql1 = "SELECT * from warehouse WHERE id = $warehouse_id";

        $res1 = mysqli_query($conn, $sql1);

        $count1 = mysqli_num_rows($res1);
        if($count1 == 1)
        {
            $row1 = mysqli_fetch_assoc($res1);
        
            $current_name = $row1['name'];
            $current_address = $row1['address'];
        }
        else
        {
            header('location:'.SITE_URL.'admin/warehouse.php');
        }
    }
?>

<?php
    if(isset($_POST['submit']))
    {
        $warehouse_id = $_POST['warehouse_id'];
        $warehouse_name = $_POST['warehouse_name'];
        $warehouse_address = $_POST['warehouse_address'];

        $sql = "UPDATE warehouse SET
            name = '$warehouse_name',
            address = '$warehouse_address'
            WHERE id = $warehouse_id
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['edit-warehouse-success'] = '<div class="text-success">Add Warehouse Successfully!</div>';

            header('location:'.SITE_URL.'admin/warehouse.php');
        }
        else
        {
            $_SESSION['edit-warehouse-failed'] = '<div class="text-danger">Failed to Add Warehouse!</div>';

            header('location:'.SITE_URL.'admin/warehouse.php');
        }
    }
?>
    <div class="m-auto w-auto py-2">
        <div class="text-center">
            <h3 class="text-xxl-center text-uppercase ">Edit Warehouse</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div class="mb-3">
                <label for="warehouse_name" class="form-label"><strong>Warehouse Name</strong></label>
                <input type="text" class="form-control" name= "warehouse_name" id="warehouse_name" rows="3" value="<?php echo $current_name; ?>"></input>
            </div>
            <div class="mb-3">
                <label for="warehouse_address" class="form-label"><strong>Warehouse Address</strong></label>
                <textarea class="form-control" name="warehouse_address" id="warehouse_address" rows="3"><?php echo $current_address; ?></textarea>
            </div>
            <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>">
            <input class="btn btn-primary" name="submit" type="submit" value="Edit Warehouse">
            <a href="<?php echo SITE_URL; ?>admin/warehouse.php" type="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php include('partials/footer.php'); ?>