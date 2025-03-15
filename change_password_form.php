<?php
session_start();
require 'includes/db.php';

date_default_timezone_set("Asia/Kolkata");
$db_time = date("Y-m-d G:i:s");
$q = "DELETE FROM `token1` WHERE `s_time`<'$db_time'";
mysqli_query($conn, $q);

$token = $_SESSION['token'];
$em = $_SESSION['em'];

$q = "select * from token1 WHERE Email='$em' and token='$token'";
$t = mysqli_query($conn, $q);
$count = mysqli_num_rows($t);
if ($count == 0) {
?>
    <script type="text/javascript">
        alert("Password reset token expired.");
        window.location.href = "login.php";
    </script>
    <?php
}

if (isset($_POST['submit'])) {
    $login_id = $_SESSION['em'];
    $token = $_SESSION['token'];
    $passwd = $_POST['npwd'];

    $q = "select * from token1 WHERE Email='$login_id' and token='$token'";
    $t = mysqli_query($conn, $q);
    $count = mysqli_num_rows($t);
    $temp = mysqli_fetch_assoc($t);
    if ($count > 0) {
        $q = "UPDATE `users` SET `password`='$passwd' WHERE email='$login_id'";
        if (mysqli_query($conn, $q)) {
            $q = "DELETE FROM `token1` WHERE email='$login_id'";
            if (mysqli_query($conn, $q)) {
    ?>
                <script type="text/javascript">
                    alert("Password changed successfully.");
                    window.location.href = "login.php";
                </script>
    <?php
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Worklink Dashboard</title>

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
    <?php include 'includes/nav.php'; ?>
<section id="about">
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Change Password</h3>
                        <form action="" method="post" id="passwordForm">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="npwd" id="pass">
                                <p id="passw"></p>
                            </div>

                            <div class="form-group">
                                <label for="Password">Retype New Password:</label>
                                <input type="password" class="form-control" placeholder="Retype New Password" name="rnpwd" id="password1">
                                <p id="passw1"></p>
                            </div>

                            <input type="checkbox" onclick="myFunction()"> Show Password <br><br>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function myFunction() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

    var y = document.getElementById("password1");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#passwordForm').validate({
            rules: {
                npwd: {
                    required: true,
                    minlength: 8,
                    psregex: true
                },
                rnpwd: {
                    required: true,
                    equalTo: "#pass"
                }
            },
            messages: {
                npwd: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long",
                    psregex: "Password must contain capital letters, small letters, numbers, and special characters"
                },
                rnpwd: {
                    required: "Please re-enter your password",
                    equalTo: "Passwords do not match"
                }
            }
        });
    });

    $.validator.addMethod("psregex", function (value2, element2) {
        var psgex1 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return psgex1.test(value2);
    }, "Password must contain capital letters, small letters, numbers, and special characters.");
</script>
<br><br><br><br>

<?php include 'includes/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>

