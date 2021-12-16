<?php include('partials/menu.php'); ?>

<?php

    if(isset($_POST['submit']))
    {
        $staff_name = $_POST['staff_name'];
        $staff_roleID = $_POST['staff_roleID'];
        $staff_phone = $_POST['staff_phone'];
        $staff_email = $_POST['staff_email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $staff_address = $_POST['staff_address'];

        $sql = "INSERT INTO staff SET
            name = '$staff_name',
            roleID = '$staff_roleID',
            phone_number = '$staff_phone',
            email = '$staff_email',
            username = '$username',
            password = '$password',
            address = '$staff_address'
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE)
        {
            $_SESSION['add-staff-success'] = '<div class="text-success">Add Staff Successfully!</div>';

            header('location:admin/staff.php');
        }
        else
        {
            $_SESSION['add-staff-failed'] = '<div class="text-danger">Failed to Add Staff!</div>';

            header('location:admin/staff.php');
        }
    }
?>
    <div class="m-auto w-auto py-2">
        <div class="text-center">
            <h3 class="text-xxl-center text-uppercase ">Add new Staff</h3>
        </div>
    </div>
    <div class="container-xl product">
        <form method="POST">
            <div class="mb-3">
                <label for="staff_name" class="form-label"><strong>Staff Name</strong></label>
                <input type="text" class="form-control" name= "staff_name" id="staff_name" rows="3" placeholder="Staff Name..."></input>
            </div>
            <div class="mb-3">
                <label for="staff_roleID" class="form-label"><strong>Staff Role</strong></label>
                <select class="form-select" name="staff_roleID" id="staff_roleID" aria-label="Role select">
                    <option value="1" selected>Nhân viên nhập</option>
                    <option value="2">Nhân viên xuất</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="staff_phone" class="form-label"><strong>Staff Phone</strong></label>
                <input type="text" class="form-control" name= "staff_phone" id="staff_phone" rows="3" placeholder="Staff Phone..."></input>
            </div>
            <div class="mb-3">
                <label for="staff_email" class="form-label"><strong>Staff Email</strong></label>
                <input type="email" class="form-control" name= "staff_email" id="staff_email" rows="3" placeholder="Staff Email..."></input>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label"><strong>Username</strong></label>
                <input type="text" class="form-control" name= "username" id="username" rows="3" placeholder="Username..."></input>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><strong>Password</strong></label>
                <input type="password" class="form-control" name= "password" id="password" rows="3" placeholder="Password..."></input>
            </div>
            <div class="mb-3">
                <label for="staff_address" class="form-label"><strong>Staff Address</strong></label>
                <textarea class="form-control" name="staff_address" id="staff_address" rows="3" placeholder="Staff Address..."></textarea>
            </div>
            <input class="btn btn-success" name="submit" type="submit" value="Add Staff">
            <a href="admin/staff.php" type="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php include('partials/footer.php'); ?>