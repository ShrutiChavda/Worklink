<?php
require 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['countryCode'] . $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match!"]);
        exit();
    }

    // Validate phone number (only digits allowed)
    if (!isset($_POST['phone']) || !preg_match('/^\d+$/', $_POST['phone'])) {
        echo json_encode(["status" => "error", "message" => "Invalid phone number! Only digits allowed."]);
        exit();
    }
    

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
        exit();
    }

    // Insert user details into users table
    $stmt = $conn->prepare("INSERT INTO users (user_type, full_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userType, $fullName, $email, $phone, $hashedPassword);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        if ($userType == "jobSeeker") {
            if (!empty($_FILES['resume']['name'])) {
                $fileType = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
                $allowedTypes = ['pdf'];
                $fileSize = $_FILES['resume']['size'];

                // Check file type and size
                if (!in_array(strtolower($fileType), $allowedTypes) || $fileSize > 2 * 1024 * 1024) {
                    echo json_encode(["status" => "error", "message" => "Invalid file! Only PDF allowed, max size 2MB."]);
                    exit();
                }

                // Save file
                $resume = uniqid() . "_" . $_FILES['resume']['name'];
                if (!move_uploaded_file($_FILES['resume']['tmp_name'], "uploads/" . $resume)) {
                    echo json_encode(["status" => "error", "message" => "Failed to upload resume."]);
                    exit();
                }

                // Insert into job_seekers table
                $query = $conn->prepare("INSERT INTO job_seekers (user_id, resume) VALUES (?, ?)");
                $query->bind_param("is", $userId, $resume);
            }
        } elseif ($userType == "employer") {
            $companyName = $_POST['companyName'];
            $industry = $_POST['industry'];
            $query = $conn->prepare("INSERT INTO employers (user_id, company_name, industry) VALUES (?, ?, ?)");
            $query->bind_param("iss", $userId, $companyName, $industry);
        } elseif ($userType == "trainingProvider") {
            $query = $conn->prepare("INSERT INTO training_providers (user_id) VALUES (?)");
            $query->bind_param("i", $userId);
        } elseif ($userType == "governmentOfficial") {
            $query = $conn->prepare("INSERT INTO government_officials (user_id) VALUES (?)");
            $query->bind_param("i", $userId);
        }

        if ($query->execute()) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error inserting user data."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Error registering user."]);
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="assets/css/pages.css">

</head>
<body>
    <?php include 'includes/nav.php'; ?>

    
    <div class="hero animate__animated animate__fadeIn">
        <h1>Join the Worklink Network – Register Today!</h1>
        <div class="mt-3">
            <a href="login.php" class="btn btn-primary">Already have an account? Login Here</a>
        </div>
    </div>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Worklink Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
        <h2 class="text-center">Register</h2>
        <form id="registrationForm">
            <div class="mb-3">
                <label for="userType" class="form-label">Select User Type</label>
                <select class="form-select" id="userType" name="userType" required>
                    <option value="">Select User Type</option>
                    <option value="jobSeeker">Job Seeker</option>
                    <option value="employer">Employer</option>
                    <option value="trainingProvider">Training Provider</option>
                    <option value="governmentOfficial">Government Official</option>
                </select>
            </div>

            <div id="formFields" style="display: none;">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-1">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <select class="form-select" id="countryCode" name="countryCode">
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+91" selected>🇮🇳 +91</option>
                        </select>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="input-group-text"><i class="fa fa-eye" id="togglePassword"></i></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        <span class="input-group-text"><i class="fa fa-eye" id="toggleConfirmPassword"></i></span>
                    </div>
                </div>

                <div id="additionalFields"></div>

                <button type="submit" class="btn btn-success w-100">Register</button>
            </div>
        </form>
    </div>

<script>$(document).ready(function () {
    $("#userType").on("change", function () {
        let userType = $(this).val();
        $("#formFields").toggle(userType !== "");

        let additionalFields = "";

        if (userType === "jobSeeker") {
            additionalFields = `
                <div class="mb-3">
                    <label for="resume" class="form-label">Upload Resume (PDF, max 2MB)</label>
                    <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf">
                </div>
            `;
        } else if (userType === "employer") {
            additionalFields = `
                <div class="mb-3">
                    <label for="companyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName">
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry</label>
                    <input type="text" class="form-control" id="industry" name="industry">
                </div>
            `;
        }

        $("#additionalFields").html(additionalFields);
    });

    $("#registrationForm").on("submit", function (event) {
        event.preventDefault();

        let formData = new FormData(this);
      
        $.ajax({
            url: "register.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                console.log(response); // Debugging: Check response in console
                alert(response.message);
                if (response.status === "success") {
                    window.location.href = "login.php";
                }
            },
           
        });
    });

    // Toggle password visibility
    $(document).on("click", "#togglePassword, #toggleConfirmPassword", function () {
        let input = $(this).closest(".input-group").find("input");
        input.attr("type", input.attr("type") === "password" ? "text" : "password");
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
});

</script>
</body>
</html>


<br><br>
    <?php include 'includes/footer.php'; ?>


</body>
</html>