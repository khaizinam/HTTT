<?php include('../config/constants.php');?>
    
<?php
    if(isset($_GET['id']))
    {
        $id =$_GET['id'];

        //Create the query
        $sql = "DELETE FROM staff where id = $id";

        //Execute the query
        $res = mysqli_query($conn, $sql);
        
        if($res == TRUE)
        {
            $_SESSION['delete-staff-success'] = "<div class = 'text-success'>Delete staff Successfully</div>";

            header('location:'.SITE_URL.'admin/staff.php');
        }
        else
        {
            $_SESSION['delete-staff-failed'] = "<div class = 'text-danger'>Failed to Delete staff</div>";

            header('location:'.SITE_URL.'admin/staff.php');
        }
    }
    else
    {
        header('location:'.SITE_URL.'admin/staff.php');
    }

?>
