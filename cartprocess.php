<?php
$error= array();
if (empty($error)) {
    $query = ("SELECT*FROM product");
   $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);
    $row = mysqli_fetch_assoc($result, MYSQLI_ASSOC);

}
?>