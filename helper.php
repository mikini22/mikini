<?php
function validate_input_text($textvalue)
{
    if (!empty($textvalue)) {
        $trim_str = trim($textvalue);
        //remove illegal character
        $sanitize_str = filter_var($trim_str ,FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return "";
}
 
 function validate_input_email($email)
 {
     if (!empty($email)) {
         $trim_text= trim($email);
         //remove illegal character 
         $sanitize_str = filter_var($trim_text , FILTER_SANITIZE_EMAIL);
         return $sanitize_str;
     }
     return ""; 
     
 }
 function get_user_info($con, $userID)
 {
     $query = "SELECT firstname, lastname , email FROM user WHERE userID= ?";
     $q = mysqli_stmt_init($con);
     mysqli_stmt_prepare($q, $query);
     //bind statment
     mysqli_stmt_bind_param($q, 'i' , $userID);
     //execute
     mysqli_stmt_execute($q);
     $result = mysqli_stmt_get_result($q);

     $row = mysqli_fetch_array($result);
     if (empty($row)) {
        return false;
     }else {
       return $row;
     }


 }