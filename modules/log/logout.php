<?php include('../../assets/inc/header.php'); ?>

<?php 
    session_destroy();

    header('location:login.php');
?>