<?php
session_start();
require 'includes/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = isset($_POST['userType']) ? $_POST['userType'] : '';
    $loginInput = $_POST['email'];
    $password = $_POST['password'];

    if ($userType === 'admin') {
        $stmt = $conn->prepare("SELECT id, full_name, user_name, gender, pic, status, email, password, user_type, phone, created_at FROM admin WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT id, full_name, password, user_type, email, user_name, gender, birthday, status FROM users WHERE email = ?");
    }

    $stmt->bind_param("s", $loginInput);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo json_encode(["status" => "error", "message" => "Email is incorrect!"]);
        exit();
    }

    if ($userType === 'admin') {
        $stmt->bind_result($userId, $fullname, $username, $gender, $pic, $status, $dbEmail, $dbPassword, $dbUserType, $phone, $created_at);
    } else {
        $stmt->bind_result($userId, $fullname, $dbPassword, $dbUserType, $dbEmail, $username, $dbgender, $dbbirthday, $status);
    }

    $stmt->fetch();
    $stmt->close();

    if ($status === 'inactive') {
        echo json_encode(["status" => "error", "message" => "Your account is not activated. Check your email and activate your account!"]);
        exit();
    }

    if ($userType !== $dbUserType) {
        echo json_encode(["status" => "error", "message" => "Invalid user type selected!"]);
        exit();
    }

    if ($password !== $dbPassword) {
        echo json_encode(["status" => "error", "message" => "Invalid password!"]);
        exit();
    }

    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $userType;
    $_SESSION['email'] = $dbEmail;
    $_SESSION['fullname'] = $fullname;

    if ($userType === 'admin') {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $userType;
        $_SESSION['email'] = $dbEmail;
        $_SESSION['fullname'] = $fullname;
        echo json_encode(["status" => "success", "message" => "Admin Login successful!", "redirect" => "admin/index.php"]);
    } else {
        $_SESSION['gender'] = $dbgender;
        $_SESSION['birthday'] = $dbbirthday;
        echo json_encode(["status" => "success", "message" => "Login successful!", "redirect" => $_SESSION['user_type'] . "/index.php"]);
    }
    exit();
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


    <div class="hero animate__animated animate__fadeIn">
        <h1>Secure Access to Your Worklink Dashboard</h1>
        <div class="mt-3">
            <a href="register.php" class="btn btn-primary">Register Now</a>
        </div>
    </div>

    <div class="container">
        <div class="login-card">
            <ul class="nav nav-tabs" id="userTypeTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="jobSeeker-tab" data-bs-toggle="tab" data-bs-target="#jobSeeker"
                        type="button" role="tab" aria-controls="jobSeeker" aria-selected="true">Job Seeker</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="employer-tab" data-bs-toggle="tab" data-bs-target="#employer"
                        type="button" role="tab" aria-controls="employer" aria-selected="false">Employer</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="governmentOfficial-tab" data-bs-toggle="tab" data-bs-target="#governmentOfficial"
                        type="button" role="tab" aria-controls="governmentOfficial" aria-selected="false">Government
                        Official</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="trainingProvider-tab" data-bs-toggle="tab"
                        data-bs-target="#trainingProvider" type="button" role="tab" aria-controls="trainingProvider"
                        aria-selected="false">Training Provider</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button"
                        role="tab" aria-controls="admin" aria-selected="false">Admin</button>
                </li>
            </ul>
            <div class="tab-content" id="userTypeTabsContent">
    <!-- Job Seeker Tab -->
    <div class="tab-pane fade show active" id="jobSeeker" role="tabpanel" aria-labelledby="jobSeeker-tab">
        <form class="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" id="userType" name="userType">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
        </form>
    </div>

    <!-- Employer Tab -->
    <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer-tab">
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" id="userType" name="userType">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
        </form>
    </div>

    <!-- Government Official Tab -->
    <div class="tab-pane fade" id="governmentOfficial" role="tabpanel" aria-labelledby="governmentOfficial-tab">
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" id="userType" name="userType">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
        </form>
    </div>

    <!-- Training Provider Tab -->
    <div class="tab-pane fade" id="trainingProvider" role="tabpanel" aria-labelledby="trainingProvider-tab">
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" id="userType" name="userType">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
        </form>
    </div>

    <!-- Admin Tab -->
    <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" id="userType" name="userType">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
        </form>
    </div>
</div>


            <p class="mt-3">Don't have an account? <a href="register.php">Sign up now</a></p>
        </div>
    </div>
    </section>
    </div>
    <?php include 'includes/footer.php'; ?>

    <script>
 $(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();

        let activeTab = $(".nav-tabs .nav-link.active").attr("id").replace("-tab", "");
        let form = $(".tab-pane.active form");
        form.find("#userType").val(activeTab);

        $.ajax({
            type: "POST",
            url: "login.php",
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response); 

                if (response.status === "success") {
                    alert(response.message);
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Something went wrong. Please try again!");
            }
        });
    });
});

    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>