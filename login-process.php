<?php
 $error = array();
$email = validate_input_email($_POST['email']);
if (empty($email)) {
    $error[] = "You forgot to enter your E-mail";
}
$password = validate_input_text($_POST['password']);
if (empty($password)) {
    $error[] = "You forgot to enter your Password";
}
if (empty($error)) {
    //sql query
    $query = "SELECT userID , firstname,lastname, email, password FROM user WHERE email =?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);
    //bind parameter
    mysqli_stmt_bind_param($q, 's', $email);
    //execute
    mysqli_stmt_execute($q); 
    $result = mysqli_stmt_get_result($q);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if (!empty($row)) {
        //verify password
        if (password_verify($password, $row['password'])) {
            header("location: indexx.php");
        }else {
            print "Wrong password or you have not registered";
        }
    }
}else {
    echo "Please fill out email and password to login!";
}

?>