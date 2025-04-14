<?php
session_start();

include('connection.php');

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql_update_status = "UPDATE users SET status = 'Inactive' WHERE user_name = '$username'";
    mysqli_query($con, $sql_update_status);
    unset($_SESSION['username']);
}

header("Location: http://localhost/worklink/login.php");
exit();
?>