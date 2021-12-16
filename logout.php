<?php include('config/constants.php'); ?>

<?php 
    session_destroy();

    header('location:'.SITE_URL.'login.php');
?>