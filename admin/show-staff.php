<?php 
include("partials/menu.php");

if(isset($_GET['id']))
{
    $staff_id = $_GET['id'];
    
    $sql = "SELECT * from staff WHERE id = $staff_id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $row = mysqli_fetch_assoc($res);

        $staff_roleID = $row['roleID'];
        $staff_username = $row['username'];
        $staff_phone = $row['phone_number'];
        $staff_email = $row['email'];
        $staff_name = $row['name'];
        $staff_address = $row['address'];
    }
    else
    {
        header('location:'.SITE_URL.'staff.php');
    }
}
else
{
    header('location:'.SITE_URL.'staff.php');
}

?>

<style>
    body {
        background-image: url('../public/image/staff.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<div class="container-fluid" style="color: #65a2eb;">
    <h3 class="text-center">Staff Name: <?php echo $staff_name; ?></h3>
    <h3 class="text-center">Staff Role: <?php if($staff_roleID==1){echo "Nhân viên nhập";}else{echo "Nhân viên xuất";} ?></h3>
    <a href="<?php echo SITE_URL; ?>staff.php"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 30px;  padding-left: 20px;"></i></a> 
</div>

<div class="container-xl product" style="margin-top: 10px; color: #29ff00; opacity: 80%;">
    <div class="mb-3">
        <label for="username" class="form-label"><strong>Staff Username</strong></label>
        <input rows="3" name="username" id="username" class="form-control" readonly value="<?php echo $staff_username; ?>">
    </div>
    <div class="mb-3">
        <label for="staff_phone" class="form-label"><strong>Staff Phone</strong></label>
        <input rows="3" name="staff_phone" id="staff_phone" class="form-control" readonly value="<?php echo $staff_phone; ?>">
    </div>
    <div class="mb-3">
        <label for="staff_email" class="form-label"><strong>Staff Email</strong></label>
        <input rows="3" name="staff_email" id="staff_email" class="form-control" readonly value="<?php echo $staff_email; ?>">
    </div>
    <div class="mb-3">
        <label for="staff_address" class="form-label"><strong>Staff Address</strong></label>
        <input rows="3" name="staff_address" id="staff_address" class="form-control" readonly value="<?php echo $staff_address; ?>">
    </div>
</div>

<h4 style="margin-left: 110px; margin-bottom: 20px; color: #29ff00;">Orders by this Staff</h4>
<div class="container-xl border" style="margin-top: 10px; margin-bottom: 50px;">
        <div class='table-responsive-xl'>
            <table class="table" id="result2" style="color: yellow">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Order Type</th>
                        <th scope="col">Order Reason</th>
                        <th scope="col">Order Details</th>
                        <th scope="col">Order Address</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql1 = "SELECT * FROM order_table WHERE userID = $staff_id ORDER BY id DESC";
                        
                        $res1 = mysqli_query($conn, $sql1);

                        $count1 = mysqli_num_rows($res1);
                        if($count1 > 0)
                        {
                            while($row1=mysqli_fetch_assoc($res1))
                            {
                                $order_id = $row1['id'];
                                $order_type = $row1['order_type'];
                                $order_reason = $row1['order_reason'];
                                $order_details = $row1['order_details'];
                                $order_address = $row1['order_address'];
                                $order_date = $row1['order_date'];

                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $order_id; ?></th>
                                    <td><?php if($order_type==1){echo "Đơn nhập kho";}else{echo "Đơn xuất kho";} ?></td>
                                    <td><?php echo $order_reason; ?></td>
                                    <td><?php echo $order_details; ?></td>
                                    <td><?php echo $order_address; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <a type="button" class="btn btn-primary" href="<?php echo SITE_URL; ?>show-order.php?id=<?php echo $order_id; ?>">Details</a>
                                    </td>
                                </tr>
                                <?php
                                
                            }
                        }
                        else
                        {
                            echo "<div class='text-white text-center' style='font-weight: 800; font-size: 2rem;'><a>This Staff haven't create an order</a></div>";
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
<script src="../public/js/fragment.js"></script>
<?php include('partials/footer.php'); ?>