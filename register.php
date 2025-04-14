<?php
require 'includes/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
$gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit;
    }
    
    if (!preg_match('/^\d{10}$/', $phone)) {
        echo "<script>alert('Invalid phone number! Only 10 digits allowed.'); window.history.back();</script>";
        exit;
    }

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.history.back();</script>";
        exit;
    }

    $checkPhone = $conn->prepare("SELECT id FROM users WHERE phone = ?");
    $checkPhone->bind_param("s", $phone);
    $checkPhone->execute();
    $checkPhone->store_result();

    if ($checkPhone->num_rows > 0) {
        echo "<script>alert('Phone number already registered!'); window.history.back();</script>";
        exit;
    }

    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(32));

    $stmt = $conn->prepare("INSERT INTO users (user_type, full_name, email, phone, password, birthday, gender, status, token) VALUES (?, ?, ?, ?, ?, ?, ?, 'inactive', ?)");
    $stmt->bind_param("ssssssss", $userType, $fullName, $email, $phone, $password, $birthday, $gender, $token);
    

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        if ($userType == "jobSeeker" && !empty($_FILES['resume']['name'])) {
            $uploadDir = "uploads/resumes/";
            if (!file_exists($uploadDir) && !mkdir($uploadDir, 0755, true)) {
                echo "<script>alert('Failed to create upload directory.'); window.history.back();</script>";
                exit;
            }

            $fileType = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
            $allowedTypes = ['pdf'];
            $fileSize = $_FILES['resume']['size'];

            if (!in_array(strtolower($fileType), $allowedTypes) || $fileSize > 2 * 1024 * 1024) {
                echo "<script>alert('Invalid file! Only PDF allowed, max size 2MB.'); window.history.back();</script>";
                exit;
            }

            $resume = uniqid() . "_" . basename($_FILES['resume']['name']);
            $resumePath = $uploadDir . $resume;

            if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath)) {
                echo "<script>alert('Failed to upload resume.'); window.history.back();</script>";
                exit;
            }

            $query = $conn->prepare("INSERT INTO job_seekers (user_id, resume) VALUES (?, ?)");
            $query->bind_param("is", $userId, $resume);
            $query->execute();
        }

        if ($userType == "governmentOfficial") {
            $department = $_POST['department'];
            $designation = $_POST['designation'];
            $query = $conn->prepare("INSERT INTO government_officials (user_id, department, designation) VALUES (?, ?, ?)");
            $query->bind_param("iss", $userId, $department, $designation);
            $query->execute();
        }

        if ($userType == "trainingProvider") {
            $organization_name = $_POST['organization_name'];
            $head_office_location = $_POST['head_office_location'];
            $training_sectors = $_POST['training_sectors'];
            $query = $conn->prepare("INSERT INTO training_providers (user_id, organization_name, head_office_location, training_sectors) VALUES (?, ?, ?, ?)");
            $query->bind_param("iss", $userId, $organization_name, $head_office_location, $training_sectors);
            $query->execute();
        }

        if ($userType == "employer") {
            $companyName = $_POST['companyName'];
            $industry = $_POST['industry'];
            $query = $conn->prepare("INSERT INTO employers (user_id, company_name, industry) VALUES (?, ?, ?)");
            $query->bind_param("iss", $userId, $companyName, $industry);
            $query->execute();
        }

        // Send Verification Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chavdashruti516@gmail.com';
            $mail->Password = 'ikcm jbpr tcxm rhsz';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('chavdashruti516@gmail.com', 'Shruti Chavda');
            $mail->addAddress($email, $fullName);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification - Worklink Dashboard';
            $mail->Body = "Hello $fullName,<br><br>
                             Thank you for registering on Worklink Dashboard!<br>
                             Please verify your email by clicking the link below:<br><br>
                             <a href='http://localhost/worklink/verify_account.php?email=$email&token=$token' style='padding:10px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px;'>Verify Email</a><br><br>
                             If you did not register, please ignore this email.<br><br>
                             Regards,<br>Worklink Team";

            if ($mail->send()) {
                echo "<script>alert('Registration successful! Check your email to verify your account.'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Registration successful, but email sending failed.'); window.history.back();</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Email could not be sent. Mailer Error: " . $mail->ErrorInfo . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Error registering user.'); window.history.back();</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/pages.css">

</head>

<body>
    <?php include 'includes/nav.php'; ?>


    <div class="hero animate__animated animate__fadeIn">
        <h1>Already have an account?</h1>
        <div class="mt-3">
            <a href="login.php" class="btn btn-primary">Login here</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Register</h2>
        <form action="http://localhost/Worklink/register.php" method="POST" enctype="multipart/form-data">
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
                            <option value="+91" selected>🇮🇳 +91</option>
                        </select>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="mb-1">
                    <label for="birthday" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
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
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            required>
                        <span class="input-group-text"><i class="fa fa-eye" id="toggleConfirmPassword"></i></span>
                    </div>
                </div>

                <input type="text" value="<?php echo uniqid().uniqid(); ?>" id="token1" name="token" hidden>
                <div id="additionalFields"></div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-success btn--radius d-flex" name="register" type="submit" value="Register">
                        Register
                    </button>
                </div>

        </form>
    </div>

    <script>
    $(document).ready(function() {
        function handleUserTypeChange() {
            let userType = $("#userType").val();
            $("#formFields").toggle(userType !== "");
            let additionalFields = "";

            if (userType === "jobSeeker") {
                additionalFields = `
                <div class="mb-3">
                    <label for="resume" class="form-label">Upload Resume (PDF, max 2MB)</label>
                    <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf" required>
                </div>
            `;
            } else if (userType === "employer") {
                additionalFields = `
                <div class="mb-3">
                    <label for="companyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName" required>
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry</label>
                    <input type="text" class="form-control" id="industry" name="industry" required>
                </div>
            `;
            } else if (userType === "trainingProvider") {
                additionalFields = `
            <div class="mb-3">
            <label class="form-label">Organization Name</label>
            <input type="text" class="form-control" id="organization_name" name="organization_name">
            </div>

<div class="mb-3">
    <label class="form-label">Head Office Location</label>
    <input type="text" class="form-control" id="head_office_location" name="head_office_location">
</div>

<div class="mb-3">
    <label class="form-label">Training Sectors</label>
    <select class="form-control" id="training_sectors" name="training_sectors">
        <option value="">Select Sector</option>
        <option value="IT">IT</option>
        <option value="Healthcare">Healthcare</option>
        <option value="Construction">Construction</option>
        <option value="Manufacturing">Manufacturing</option>
        <option value="Retail">Retail</option>
        <option value="Education">Education</option>
        <option value="Hospitality">Hospitality</option>
        <option value="Finance">Finance</option>
    </select>
</div>
            `;
            } else if (userType === "governmentOfficial") {
                additionalFields = `
                <div class="mb-3">
                    <label for="department" class="form-label">Department:</label>
                    <select class="form-select" id="department" name="department" required>
                        <option value="" disabled selected>Select Department</option>
                        <option value="Administrative Services">Administrative Services</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Education">Education</option>
                        <option value="Finance">Finance</option>
                        <option value="Health &amp; Family Welfare">Health &amp; Family Welfare</option>
                        <option value="Home Affairs">Home Affairs</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Labour and Employment">Labour and Employment</option>
                        <option value="Law and Justice">Law and Justice</option>
                        <option value="Public Works Department (PWD)">Public Works Department (PWD)</option>
                        <option value="Railways">Railways</option>
                        <option value="Revenue">Revenue</option>
                        <option value="Rural Development">Rural Development</option>
                        <option value="Skill Development and Entrepreneurship">Skill Development and Entrepreneurship</option>
                        <option value="Social Welfare">Social Welfare</option>
                        <option value="Textiles">Textiles</option>
                        <option value="Tourism">Tourism</option>
                        <option value="Transport">Transport</option>
                        <option value="Urban Development">Urban Development</option>
                        <option value="Water Resources">Water Resources</option>
                        <option value="Women and Child Development">Women and Child Development</option>
                        <option value="Youth Affairs and Sports">Youth Affairs and Sports</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control" id="designation" name="designation" required>
                </div>
            `;
            }

            $("#additionalFields").html(additionalFields);
        }

        $("#userType").on("change", handleUserTypeChange);

        // Trigger change event on page load if value is pre-selected
        handleUserTypeChange();

        // Toggle password visibility
        $(document).on("click", "#togglePassword, #toggleConfirmPassword", function() {
            let input = $(this).closest(".input-group").find("input");
            input.attr("type", input.attr("type") === "password" ? "text" : "password");
            $(this).toggleClass("fa-eye fa-eye-slash");
        });
    });
    </script>

    </div>
    <?php include 'includes/footer.php'; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>