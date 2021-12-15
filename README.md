# HTTT
1. Download as as Zip or Clone this project

2. Import Database

Database in database folder

3. Make Changes to settings

Go to 'config' folder and Open 'connect.php' file. Then make changes on following constants
SITEURL:
```php
<?php 
    //Start session
    session_start();

    //Create constants to Store Non-Repeating Values
    define('LOCALHOST','localhost'); //Update your port database
    define('DB_USERNAME','root'); // database name
    define('DB_PASSWORD',''); // password
    define('DB_NAME','db_team');


    $conn = mysqli_connect(LOCALHOST ,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  // Connect to database

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  //Selecting database
            
?>
```

4. Now, Open the project in your browser. It should run perfectly.

