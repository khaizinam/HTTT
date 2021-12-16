<?php include('config/constants.php'); ?>
<?php
    if(isset($_SESSION['userID']))
    {
        if($_SESSION['roleID'] == 3)
        {
            header('location:'.SITE_URL.'admin/hcmut.php');
        }
        else
        {
            header('location:'.SITE_URL.'hcmut.php');
        }

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
    <title>Staff Login</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="public/css/login.css" rel="stylesheet">
    <style>
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

</head>
<body class="text-center">

<main class="form-signin">
<form method = "POST">
    <img class="mb-4" src="public/image/bk.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 fw-normal" id="greeting">Hello clerk, please login</h1>
    <?php 
    if(isset($_SESSION['login']))
    {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>You have to login first!.</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['login-failed']))
    {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Wrong password or username!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['login-failed']);
    }
    ?>
    <div class="form-floating">
    <input type="text" style="background: #91f1e5; color: #0010ec;" class="form-control" id="floatingInput" name = "username" placeholder="Username">
    <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating" style="margin-top: 5px;">
    <input type="password" style="background: #91f1e5; color: #0010ec;" class="form-control" name="password" id="floatingPassword" placeholder="Password">
    <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name = "submit">Login</button>
</form>
</main>
</body>

<script type="text/javascript">
    var currentTime = new Date().getHours();
    if (document.body) {
        const h1 = document.getElementById("greeting");
        if (7 < currentTime && currentTime <= 18) {
            document.body.background = "public/image/background_day.gif";
            h1.style.color = "green";
        }
        else {
            document.body.background = "public/image/background_night.gif";
            h1.style.color = "greenyellow";}
    }
</script>

</html>

<?php
if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $password = md5($_POST['password']);

    $sql = "SELECT * from staff where username = '$username' AND password ='$password'";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE)
    {
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['login'] = "<div class = 'success'>Login Successfully</div>";
            $_SESSION['userID'] = $row['id'];
            $_SESSION['roleID'] = $row['roleID'];

            if($_SESSION['roleID'] == 3)
            {
                header('location:'.SITE_URL.'admin/hcmut.php');
            }
            else
            {
                header('location:'.SITE_URL.'hcmut.php');
            }
        }
        else
        {
            $_SESSION['login-failed'] = "<div error = 'success'>Failed to Login</div>";

            header('location:'.SITE_URL.'login.php');
        }
    }
}
?>