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
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match!"]);
        exit();
    }

    if (!preg_match('/^\d{10}$/', $_POST['phone'])) {
        echo json_encode(["status" => "error", "message" => "Invalid phone number! Only 10 digits allowed."]);
        exit();
    }

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
        exit();
    }

    // Hash password and generate a verification token
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(32));

    $stmt = $conn->prepare("INSERT INTO users (user_type, full_name, email, phone, password, status, token) VALUES (?, ?, ?, ?, ?, 'inactive', ?)");
    $stmt->bind_param("ssssss", $userType, $fullName, $email, $phone, $password, $token);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        // Handle additional user data based on user type
        if ($userType == "jobSeeker" && !empty($_FILES['resume']['name'])) {
            $uploadDir = "uploads/resumes/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileType = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
            $allowedTypes = ['pdf'];
            $fileSize = $_FILES['resume']['size'];

            if (!in_array(strtolower($fileType), $allowedTypes) || $fileSize > 2 * 1024 * 1024) {
                echo json_encode(["status" => "error", "message" => "Invalid file! Only PDF allowed, max size 2MB."]);
                exit();
            }

            $resume = uniqid() . "_" . basename($_FILES['resume']['name']);
            $resumePath = $uploadDir . $resume;

            if (!move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath)) {
                echo json_encode(["status" => "error", "message" => "Failed to upload resume."]);
                exit();
            }

            $query = $conn->prepare("INSERT INTO job_seekers (user_id, resume) VALUES (?, ?)");
            $query->bind_param("is", $userId, $resume);
        } elseif ($userType == "employer") {
            $companyName = $_POST['companyName'];
            $industry = $_POST['industry'];

            $query = $conn->prepare("INSERT INTO employers (user_id, company_name, industry) VALUES (?, ?, ?)");
            $query->bind_param("iss", $userId, $companyName, $industry);
        } elseif ($userType == "trainingProvider") {
            $trainingInstituteName = $_POST['trainingInstituteName'];

            $query = $conn->prepare("INSERT INTO training_providers (user_id, institute_name) VALUES (?, ?)");
            $query->bind_param("is", $userId, $trainingInstituteName);
        } elseif ($userType == "governmentOfficial") {
            $department = $_POST['department'];
            $designation = $_POST['designation'];

            $query = $conn->prepare("INSERT INTO government_officials (user_id, department, designation) VALUES (?, ?, ?)");
            $query->bind_param("iss", $userId, $department, $designation);
        }

        if (isset($query) && !$query->execute()) {
            echo json_encode(["status" => "error", "message" => "Error inserting additional user data."]);
            exit();
        }

        // Send Verification Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chavdashruti516@gmail.com'; // Store email in environment variables
            $mail->Password = 'ikcm jbpr tcxm rhsz';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('chavdashruti516@gmail.com', 'Shruti Chavda'); // Sender's email address and name
            $mail->addAddress($email, $fullName);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification - Worklink Dashboard';
            $mail->Body = "Hello $fullName,<br><br>
                            Thank you for registering on Worklink Dashboard!<br>
                            Please verify your email by clicking the link below:<br><br>
                            <a href='http://localhost/worklink/verify_account.php?email=$email&token=$token' style='padding:10px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px;'>Verify Email</a><br><br>
                            If you did not register, please ignore this email.<br><br>
                            Regards,<br>Worklink Team";

            if ($mail->send()) {
                echo json_encode(["status" => "success", "message" => "Registration successful! Check your email to verify your account."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Registration successful, but email sending failed."]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Email could not be sent. Mailer Error: " . $mail->ErrorInfo]);
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
        <form action="http://localhost/Worklink/register.php" method="POST">
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

                <input type="text" name="token" value="<?php echo uniqid().uniqid(); ?>" id="token1" name="token"
                    hidden>
                <div id="additionalFields"></div>

                <button class="btn btn--radius btn-success" name="register" type="submit"
                value="Login">Register</button>         
        </form>
    </div>

<script>
 $(document).ready(function () {
    $("#userType").on("change", function () {
        let userType = $(this).val();
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
        }
        else if (userType === "governmentOfficial") {
            additionalFields = `
                <div class="mb-3">
                  <label for="department" class="form-label">Department:</label>
    <select class="form-select" id="department" name="department" required>
        <option value="">Select Department</option>
        <option value="Labour Department">Labour Department</option>
        <option value="Employment Department">Employment Department</option>
        <option value="Skill Development Department">Skill Development Department</option>
        <option value="Education Department">Education Department</option>
        <option value="Ministry of Finance">Ministry of Finance</option>
    </select>
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation:</label>
                    <input type="text" class="form-control" id="designation" name="designation" required>
                </div>
            `;
        }
                $("#additionalFields").html(additionalFields);
            });

    $("#registrationForm").on("submit", function (event) {

        event.preventDefault();

let email = $("#email").val();
let phone = $("#phone").val();
let userType = $("#userType").val();
let resume = $("#resume")[0]?.files[0];

let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
let phoneRegex = /^\d{10}$/;

if (!emailRegex.test(email)) {
    alert("Invalid email format!");
    return;
}

if (!phoneRegex.test(phone)) {
    alert("Invalid phone number! Only 10 digits allowed.");
    return;
}

// Resume validation for Job Seekers
if (userType === "jobSeeker") {
    if (!resume) {
        alert("Resume field can't be empty!");
        return;
    }

    let fileType = resume.name.split('.').pop().toLowerCase();
    let allowedTypes = ['pdf'];
    let fileSize = resume.size;

    if (!allowedTypes.includes(fileType)) {
        alert("Invalid file type! Only PDF is allowed.");
        return;
    }

    if (fileSize > 2 * 1024 * 1024) {
        alert("File size exceeds 2MB! Please upload a smaller file.");
        return;
    }
}

            
//         let formData = new FormData(this);
      
//         $.ajax({
//     url: "register.php",
//     type: "POST",
//     data: formData,
//     contentType: false,
//     processData: false,
//     dataType: "json",
//     success: function (response) {
//         console.log(response); // Debugging: Check response in console
        
//         if (response.status === "success") {
//             alert("Registration successful! Redirecting to login page...");
//             window.location.href = "login.php";
//         } else {
//             alert(response.message); // Show error message
//         }
//     },
//     error: function () {
//         alert("Registration successful! Redirecting to login page...");
//         window.location.href = "login.php";
//     }
// });

    });


    // Toggle password visibility
    $(document).on("click", "#togglePassword, #toggleConfirmPassword", function () {
        let input = $(this).closest(".input-group").find("input");
        input.attr("type", input.attr("type") === "password" ? "text" : "password");
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
});


</script>

<?php include 'includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="assets/js/script.js"></script>

</body>
</html>