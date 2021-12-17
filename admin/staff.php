<?php include('partials/menu.php'); ?>

<?php 
    if(isset($_SESSION['login']))
    {
        unset($_SESSION['login']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hello Admin!</strong>
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

<style>
    body {
        background-image: url('../public/image/staff.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body>
<div class="container-fluid">
        <h3 class='text-center' style="color: #65a2eb;">Staff</h3>
        <button class="btn btn-success" style="margin-left: 110px; margin-bottom: 20px;"><a href="<?php echo SITE_URL; ?>add-staff.php" class="text-decoration-none text-white"><i class="fa fa-plus-circle" style="font-size: 23px; padding-right: 5px;"></i>Add new Staff</a></button>
</div>

<div class="container-xl" style="margin-top: 10px; margin-bottom: 50px;">
    <?php
        if(isset($_SESSION['add-staff-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Add staff Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-staff-success']);
        }

        if(isset($_SESSION['add-staff-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Add staff!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['add-staff-failed']);
        }

        if(isset($_SESSION['delete-staff-success']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Delete staff Successfully!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-staff-success']);
        }

        if(isset($_SESSION['delete-staff-failed']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failed to Delete staff!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            unset($_SESSION['delete-staff-failed']);
        }
    ?>
        <div class='table-responsive-xl'>
            <table class="table" style="color: #b6dbff;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Staff Username</th>
                        <th scope="col">Staff Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * from staff WHERE roleID = 1 OR roleID = 2 ORDER BY name";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        if($count > 0)
                        {
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $staff_id = $row['id'];
                                $staff_roleID = $row['roleID'];
                                $staff_username = $row['username'];
                                $staff_name = $row['name'];

                                ?>
                                <tr class="res d-none">
                                    <th scope="row"><?php echo $staff_id; ?></th>
                                    <td><?php echo $staff_name; ?></td>
                                    <td><?php echo $staff_username; ?></td>
                                    <td><?php if($staff_roleID==1){echo "Nhân viên nhập";}else{echo "Nhân viên xuất";} ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>show-staff.php?id=<?php echo $staff_id; ?>" class="btn btn-primary" type="button">Staff Details</a>
                                        <a href="<?php echo SITE_URL; ?>delete-staff.php?id=<?php echo $staff_id; ?>" class="btn btn-danger" type="button">Delete Staff</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "No Staff Available";
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
</body>
<script src="../public/js/fragment.js"></script>
<?php include('partials/footer.php'); ?>