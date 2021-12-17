<?php include('../config/constants.php'); ?>
<?php 
    if(!isset($_SESSION['userID']) || !isset($_SESSION['roleID']))
    {
        $_SESSION['login'] = "<div class='text-danger'>Please login!</div>";

        header('location:'.SITE_URL.'login.php');
    }
    else
    {
        if($_SESSION['roleID'] != 3)
        {
            header('location:'.SITE_URL.'home.php');
        }
        $userID = $_SESSION['userID'];
        $sql = "SELECT * from staff WHERE id = $userID";

        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) == 1)
        {
            $row = mysqli_fetch_assoc($res);

            $name = $row['name'];
        }
        else
        {
            header('location:'.SITE_URL.'logout.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - HTTT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="../admin/hcmut.php">
                <img src="../public/image/bk.png" alt="logo_BK" width="40" height="40">
                HCMUT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo SITE_URL; ?>staff.php">Staff</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>warehouse.php">Warehouse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITE_URL; ?>../home.php">Staff UI</a>
                </li>
            </ul>
            <li class="dropdown" style="float: right">
                    <a class="nav-link" style="color: whitesmoke" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Hello, <?php echo $name; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>../profile.php?id=<?php echo $_SESSION['userID']; ?>">Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>../change-password.php?id=<?php echo $_SESSION['userID']; ?>">Change password</a></li>
                    </ul>
                </li>
                <a href="<?php echo SITE_URL; ?>../logout.php"><i class="fa fa-sign-out" style="color: cyan" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>