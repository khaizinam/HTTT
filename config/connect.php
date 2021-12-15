<?php 
    
    //Start session
    session_start();

    //Create constants to Store Non-Repeating Values
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','db_team');


    $conn = mysqli_connect(LOCALHOST ,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  // Connect to database

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  //Selecting database
            
?>