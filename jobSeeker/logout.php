<?php
session_start();

// Include your database connection
include('connection.php');

// Check if user is logged in
if (isset($_SESSION['fulllname'])) {
    // Update user status to "inactive" in the database
    $fulllname = $_SESSION['fulllname'];
    $sql_update_status = "UPDATE users SET status = 'Inactive' WHERE user_name = '$fulllname'";
    mysqli_query($con, $sql_update_status);
    unset($_SESSION['fulllname']);
}

// Destroy the session
// session_destroy();

// Redirect the user to the login page
header("Location: http://localhost/worklink/login.php");
exit();
?>