<?php include('../../config/connect.php');?>
    
<?php
    if(isset($_GET['id']))
    {
        $id =$_GET['id'];

        //Create the query
        $sql = "DELETE FROM product where id = $id";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        if($res == TRUE)
        {
            $_SESSION['delete-product-success'] = "<div class = 'text-success'>Delete Product Successfully</div>";

            header('location:../page/product.php');
        }
        else
        {
            $_SESSION['delete-product-failed'] = "<div class = 'text-danger'>Failed to Delete Product</div>";

            header('location:../page/product.php');
        }
    }
    else
    {
        header('location:../page/product.php');
    }

?>
