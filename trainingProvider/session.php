<?php
session_start();
include('connection.php');

if (!isset($_SESSION['username'])) {
    $sql_update_status = "UPDATE users SET status = 'Inactive'";
    mysqli_query($con, $sql_update_status);
    header("Location: http://localhost/worklink/login.php");
    exit();
}

$user_type = ''; // Initialize user_type variable
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT user_type, status FROM users WHERE user_name = '$username'"; 
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Check if account is disabled
        if ($row['status'] === 'Disabled') {
            echo "<script>alert('Your account has been deactivated.');</script>";
            echo "<script>window.location.href='http://localhost/worklink/login.php';</script>";
            exit();
        }

        $_SESSION['user_type'] = $row['user_type'];

        // Set user status to active
        $sql_update_status = "UPDATE users SET status = 'active' WHERE user_name = '$username'";
        mysqli_query($con, $sql_update_status);
    }
}

//After 60 minutes the user will automatically get destroyed
if (isset($_SESSION['timeout']) && $_SESSION['timeout'] < time()) {
    session_destroy();
    echo "<script>alert('Session Expired!');</script>";
    echo "<script>window.location.replace('http://localhost/worklink/login.php');</script>"; 
    $sql_update_status = "UPDATE admin SET status = 'Inactive'";
    mysqli_query($con, $sql_update_status);
    exit();
}
$_SESSION['timeout'] = time() + (60 * 60);
?>
