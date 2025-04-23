<?php
session_start();
include('connection.php');
if (!isset($_SESSION['username'])) {
    $sql_update_status = "UPDATE admin SET status = 'Inactive'";
    mysqli_query($con, $sql_update_status);
    header("Location: http://localhost/worklink/login.php");
    exit();
}


$user_type = ''; // Initialize user_type variable
if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    // echo $username;

    $status_check = mysqli_query($con, "SELECT status, user_type FROM admin WHERE user_name = '$username'");
if ($status_check && mysqli_num_rows($status_check) > 0) {
    $user_row = mysqli_fetch_assoc($status_check);
    if ($user_row['status'] === 'Disabled') {
        echo "<script>
            alert('Your account is deactivated. Please contact the administrator to restore access.');
            window.location.href = 'http://localhost/worklink/login.php';
        </script>";
        exit();
        

    $sql = "SELECT user_type FROM admin WHERE user_name = '$username'"; 
    $result = mysqli_query($con, $sql);
    $sql_update_status = "UPDATE admin SET status = 'active' WHERE user_name = '$username'";
    mysqli_query($con, $sql_update_status);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_type']=$row['user_type'];
        // echo $_SESSION['user_type'];
}
// else{
//     if(!isset($_SESSION['username'])=="" || !isset($_SESSION['user_type'])=="") {
//     // Redirect the user to the login page
//     header("Location:  http://localhost/Employee%20Management%20System/login.php");
//     exit;
// }
// }
}}}


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

//echo "Welcome, " . $_SESSION['username'];

?>
