<?php include('../config/constants.php');?>
    
<?php
    if(isset($_GET['id']))
    {
        $id =$_GET['id'];

        //Create the query
        $sql = "DELETE FROM warehouse where id = $id";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        if($res == TRUE)
        {
            $_SESSION['delete-warehouse-success'] = "<div class = 'text-success'>Delete Product Successfully</div>";

            header('location:admin/warehouse.php');
        }
        else
        {
            $_SESSION['delete-warehouse-failed'] = "<div class = 'text-danger'>Failed to Delete Product</div>";

            header('location:admin/warehouse.php');
        }
    }
    else
    {
        header('location:admin/warehouse.php');
    }

?>
