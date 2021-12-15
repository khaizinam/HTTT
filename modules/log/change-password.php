<?php include('../../config/connect.php'); ?>

<?php 
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        if($id != $_SESSION['userID'])
        {
            header('location:../../home.php');
        }
        
        $sql3 = "SELECT * from staff where id = $id";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3 != 1)
        {
            $_SESSION['user-not-found']= "<div class='error'>User not found</div>";
            header('location:../../home.php');
        }
    }
    else
    {
        header('location:../../home.php');
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <title>Change Password</title>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style   style>
            .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        </style>

    
    <!-- Custom styles for this template -->
        <link href="../../assets/css/login.css" rel="stylesheet">
    </head>
    <body class="text-center"  style="background-color: #1A233A;">

<main class="form-signin">
    <form method = "POST">
        <img class="mb-4" src="../../assets/image/logo.png" alt="" width="72" height="57">

        <h1 class="h3 mb-3 fw-normal text-white">Change Password</h1>
        
        <div class="form-floating">
            <input type="password" class="form-control" id="currentPassword" name = "current_password" placeholder="Current password">
            <label for="currentPassword">Current Password</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="New password">
            <label for="newPassword">New Password</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" name="confirm_password" id="confirmPassword" placeholder="Confirm password">
            <label for="confirmPassword">Confirm Password</label>
        </div>

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="w-100 btn btn-lg btn-primary" type="submit" name = "submit">Change Password</button>
        <?php 
            if($_SESSION['roleID'] == 3)
            {
                echo '<a class="w-100 btn btn-lg btn-secondary" role ="button" href="../../admin/staff.php" style="margin-top: 5px;">Cancel</a>';
            }
            else
            {
                echo '<a class="w-100 btn btn-lg btn-secondary" role ="button" href="../../home.php" style="margin-top: 5px;">Cancel</a>';
            }
        ?>
        <?php
        if(isset($_SESSION['not-match']))
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password did not match!</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['not-match']);
        }
        ?>
        <p class="mt-5 mb-3 text-muted">&copy; Create by - <a href ="#">neriJ</a></p>
    </form>
</main>

    
    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $id = $_POST['id'];

    $sql = "SELECT * from staff where id = $id AND password ='$current_password'";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE)
    {
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            if($new_password == $confirm_password)
            {
                $sql1 = "UPDATE staff SET
                    password = '$new_password'
                    WHERE id = $id
                ";

                $res1 = mysqli_query($conn, $sql1);

                if($res1 == TRUE)
                {
                    $_SESSION['change-pwd'] = "<div class ='success'>Changed password Successfully</div>";

                    if($_SESSION['roleID'] == 3)
                    {
                        header('location:../../admin/staff.php');
                    }
                    else
                    {
                        header('location:../../home.php');
                    }
                }
                else
                {
                    $_SESSION['change-pwd-failed'] = "<div class ='error'>Failed to Change Password</div>";

                    if($_SESSION['roleID'] == 3)
                    {
                        header('location:../../admin/staff.php');
                    }
                    else
                    {
                        header('location:../../home.php');
                    }
                }
            }
            else
            {
                $_SESSION['not-match'] = "<div class='error'>Password did not match</div>";

                header('location:change-password.php');
            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div error = 'success'>User not found</div>";

            if($_SESSION['roleID'] == 3)
            {
                header('location:../../admin/staff.php');
            }
            else
            {
                header('location:../../home.php');
            }
        }
    }
}
?>