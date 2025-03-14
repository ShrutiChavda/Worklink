<?php
require 'includes/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already registered!"]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (user_type, full_name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $userType, $fullName, $email, $phone, $password);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        if ($userType == "jobSeeker") {
            $resume = $_FILES['resume']['name'];
            move_uploaded_file($_FILES['resume']['tmp_name'], "uploads/" . $resume);
            $query = $conn->prepare("INSERT INTO job_seekers (user_id, resume) VALUES (?, ?)");
            $query->bind_param("is", $userId, $resume);
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
    <div class="container">
    <div class="user-type-select">
        <label for="userType" class="form-label">Select User Type</label>
        <select class="form-select" id="userType" name="userType" required>
            <option value="">Select User Type</option>
            <option value="jobSeeker">Job Seeker</option>
            <option value="employer">Employer</option>
            <option value="trainingProvider">Training Provider</option>
            <option value="governmentOfficial">Government Official</option>
        </select>
    </div>
    
    <div class="register-card">
        <form id="registrationForm">
            <h2>User Information</h2>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
                <span class="text-danger" id="fullNameError"></span>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <span class="text-danger" id="emailError"></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="text-danger" id="passwordError"></span>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                <span class="text-danger" id="confirmPasswordError"></span>
            </div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </div>
</div>



<br><br>
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    document.getElementById("emailError").innerText = emailRegex.test(email) ? "" : "Invalid email format";
    document.getElementById("passwordError").innerText = passwordRegex.test(password) ? "" : "Password must be at least 8 characters, include a number and special character";
    document.getElementById("confirmPasswordError").innerText = password === confirmPassword ? "" : "Passwords do not match";

    if (!emailRegex.test(email) || !passwordRegex.test(password) || password !== confirmPassword) {
        event.preventDefault();
    }
});
</script>

<script>
$(document).ready(function () {
    $("#registrationForm").on("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "register.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                    window.location.href = "login.php"; // Redirect after success
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Something went wrong! Please try again.");
            }
        });
    });
});
</script>


<script>
document.querySelectorAll(".input-group-text i").forEach(icon => {
    icon.addEventListener("click", function() {
        let input = this.parentElement.previousElementSibling;
        input.type = input.type === "password" ? "text" : "password";
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
});
</script>
<script>
    $(document).ready(function () {
        $("#userType").on("change", function () {
            let userType = $(this).val();
            $(".register-card").show(); // Ensure the form container is visible

            let jobSeekerFields = `
                <h2>Job Seeker Details</h2>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume Upload</label>
                    <input type="file" class="form-control" id="resume" name="resume">
                </div>
            `;

            let employerFields = `
                <h2>Employer Details</h2>
                <div class="mb-3">
                    <label for="companyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName">
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry</label>
                    <input type="text" class="form-control" id="industry" name="industry">
                </div>
            `;

            let formContent = `
                <h2>User Information</h2>
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
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
            `;

            if (userType === "jobSeeker") {
                formContent += jobSeekerFields;
            } else if (userType === "employer") {
                formContent += employerFields;
            }

            formContent += `
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to the Terms & Conditions</label>
                </div>
                <button type="submit" class="btn btn-success">Register</button>
            `;

            $("#registrationForm").html(formContent);
        });
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>
