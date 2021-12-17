<?php include('config/constants.php'); ?>
<?php 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        if($_SESSION['userID'] != $id){
            
            header('location:'.SITE_URL.'home.php');
        }

        $sql = "SELECT * from staff WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);

            $full_name = $row['name'];
            $username = $row['username'];
            $phone = $row['phone_number'];
            $email = $row['email'];
            $address = $row['address'];
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";

            header('location:'.SITE_URL.'home.php');
        }
    }
    else
    {
        header('location:'.SITE_URL.'home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="public/css/clerk.css">
</head>

<style>
    body{
        background-image: url('public/image/profile.jpg');
        background-size: cover;
    }
</style>

<body>
<?php 
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $full_name = $_POST['fullName'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $sql2 = "UPDATE staff SET
    name = '$full_name',
    username = '$username',
    phone_number = '$phone',
    email = '$email',
    address = '$address'
    WHERE id = $id
    ";

    $res2 = mysqli_query($conn ,$sql2);

    if($res2 == TRUE)
    {
        $_SESSION['update'] = "<div class='text-success'>Update Profile Successfully</div>";

        if($_SESSION['roleID'] == 3)
        {
            header('location:'.SITE_URL.'admin/staff.php');
        }
        else
        {
            header('location:'.SITE_URL.'home.php');
        }
    }
    else
    {
        $_SESSION['update-failed'] = "<div class='text-error'>Failed to Update Profile</div>";

        if($_SESSION['roleID'] == 3)
        {
            header('location:'.SITE_URL.'admin/staff.php');
        }
        else
        {
            header('location:'.SITE_URL.'home.php');
        }
    }
}
?>
<form method="POST">

<div class="container-xl">
    <h2 class="text-center">Profile Page</h2>
<div class="row gutters">
	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
	</div>
	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
		<div class="card h-100">
			<div class="card-body">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<h4 class="mb-3" style="color: greenyellow;">Personal Details</h4>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="fullName">Full Name</label>
							<input type="text" class="form-control" name="fullName" id="fullName" value="<?php echo $full_name; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="eMail">Email</label>
							<input type="email" class="form-control" name="email" id="eMail" value="<?php echo $email; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="tel" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
						</div>
					</div>
				</div>
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<h4 style="color: greenyellow; margin-top: 20px;">Address</h4>
					</div>
                    <textarea name="address" class="form-control" id="address" cols="30" rows="10"><?php echo $address; ?></textarea>
				</div>
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="text-right">
                            <?php 
                                if($_SESSION['roleID'] == 3)
                                {
                                    ?>
                                    <a type="button" href="<?php echo SITE_URL; ?>admin/staff.php" class="btn btn-secondary">Cancel</a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a type="button" href="<?php echo SITE_URL; ?>home.php" class="btn btn-secondary">Cancel</a>
                                    <?php
                                }
                            ?>
							
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" class="btn btn-primary" value="Update">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
	</div>
</div>
</div>
</form>
</body>
</html>