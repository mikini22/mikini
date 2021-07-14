
<?php
//params to connect to a database 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "register_db";
//connection to database 
$con = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
mysqli_set_charset($con, 'utf8');

if (!$con) {
    die ('Database connection failed');
}
 
?>