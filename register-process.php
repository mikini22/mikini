<?php
require('helper.php');
//error variable
$error = array();
$firstname = validate_input_text($_POST['firstname']);
if (empty($firstname)) {
    $error[] = "You forgot to input your firstname";
}

$lastname = validate_input_text($_POST['lastname']);
if (empty($lastname)) {
    $error[] = "You forgot to enter your Last Name";
}
$email = validate_input_email($_POST['email']);
if (empty($email)) {
    $error[] = "You forgot to enter your E-mail";
}
$password = validate_input_text($_POST['password']);
if (empty($password)) {
    $error[] = "You forgot to enter your Password";
}
$confirm_pwd = validate_input_text($_POST['confirm_pwd']);
if (empty($confirm_pwd)) {
    $error[] = "You forgot to confirm your password";
}

if (empty($error)) {
    //register a new user
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    require 'mysqlconnect.php';
    //make query
    $query = "INSERT INTO user(userID,firstname,lastname,email,password,registerdate)"; 
    $query .= "VALUES(' ',?, ? , ? , ? , NOW() )";

    //initialize a statement 
    $q = mysqli_stmt_init($con);

    //prepare a sql statement
    mysqli_stmt_prepare($q , $query); 
    //bind values
    mysqli_stmt_bind_param($q, 'ssss' ,  $firstname,  $lastname ,  $email ,  $hashed_pass);
    //execute statement 
    mysqli_stmt_execute($q);
    if (mysqli_stmt_affected_rows($q)==1) {
        //start a new session
        session_start();
        //create a session variable 
        $_SESSION['userID'] = mysqli_insert_id($con);
        
        header('location:login.php') ;
        exit();

    }else {
        print "Error while registration";
    }
  
    echo  "not validated"; 
}

?>