<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        .hero {
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?career,signup') no-repeat center center/cover;
            text-align: center;
        }

        .register-card {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
            display: none;
        }
    </style>
</head>
<body>
<?php include '../includes/nav.php'; ?>

<div class="hero animate__animated animate__fadeIn">
    <h1>Join the Worklink Network – Register Today!</h1>
    <div class="mt-3">
        <a href="login.php" class="btn btn-primary">Already have an account? Login Here</a>
    </div>
</div>

<div class="container">
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
    
    <div class="register-card" id="registerFormContainer">
        <form id="registrationForm">
            <div id="formContent"></div>
            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </div>
</div>

<script>
    document.getElementById("userType").addEventListener("change", function() {
        const userType = this.value;
        const formContainer = document.getElementById("registerFormContainer");
        const formContent = document.getElementById("formContent");
        
        if (userType) {
            formContainer.style.display = "block";
            formContent.innerHTML = `
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
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                ${userType === 'jobSeeker' ? `
                <h2>Job Seeker Details</h2>
                <div class="mb-3">
                    <label for="resume" class="form-label">Resume Upload</label>
                    <input type="file" class="form-control" id="resume" name="resume">
                </div>
                ` : ''}
                ${userType === 'employer' ? `
                <h2>Employer Details</h2>
                <div class="mb-3">
                    <label for="companyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="companyName" name="companyName">
                </div>
                <div class="mb-3">
                    <label for="industry" class="form-label">Industry</label>
                    <input type="text" class="form-control" id="industry" name="industry">
                </div>
                ` : ''}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">I agree to the Terms & Conditions</label>
                </div>
            `;
        } else {
            formContainer.style.display = "none";
            formContent.innerHTML = "";
        }
    });
</script>

<?php include '../includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>
</html>
