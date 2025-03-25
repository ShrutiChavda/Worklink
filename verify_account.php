<?php
require 'includes/db.php';
$email = $_REQUEST['email'];
$token = $_REQUEST['token'];

// echo $email;
// echo $token;

$q = "select * from users where email='$email' and token='$token'";
$result = mysqli_query($conn, $q);
$count = mysqli_num_rows($result);


if ($count == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $status = $row[6];
        if ($status == "active") {
            echo "<script>alert('Account is already activated.');</script>";
        } else {
            $updt = "update users set `status`='active' where email='$email' and token='$token'";
            if (mysqli_query($conn, $updt)) {
                echo "<script>alert('Account Activation successfull. Please login to continue');</script>";
            } else {
                echo "<script>alert('Error in activating account. Please try again later');</script>";
            }
        }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/pages.css">

</head>

<body>
        <script>
            window.location.href = "login.php";
        </script>
        </body>
        </html>

<?php
    }
} else {
    echo "Either Email is not registered or token is incorrect.";
}
?>
<br><br><br><br><br>
<?php include 'includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>

