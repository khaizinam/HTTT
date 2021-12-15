<?php 
    include('../../config/connect.php');
    $password = md5("admin");
    $sql = "UPDATE staff SET
        password = '$password'
        WHERE id = 1
    ";

    $res = mysqli_query($conn, $sql);
    if($res== TRUE)
    {
        echo "Success";
    }
?>

