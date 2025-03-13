<?php
session_start();
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
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?digital,login') no-repeat center center/cover;
            text-align: center;
        }

        .login-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .social-login {
            text-align: center;
            margin-top: 20px;
        }

        .social-login a {
            margin: 0 10px;
        }
    </style>
</head>
<body>
<?php include '../includes/nav.php'; ?>


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
                <button class="nav-link active" id="jobSeeker-tab" data-bs-toggle="tab" data-bs-target="#jobSeeker" type="button" role="tab" aria-controls="jobSeeker" aria-selected="true">Job Seeker</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="employer-tab" data-bs-toggle="tab" data-bs-target="#employer" type="button" role="tab" aria-controls="employer" aria-selected="false">Employer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="trainingProvider-tab" data-bs-toggle="tab" data-bs-target="#trainingProvider" type="button" role="tab" aria-controls="trainingProvider" aria-selected="false">Training Provider</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="false">Admin</button>
            </li>
        </ul>
        <div class="tab-content" id="userTypeTabsContent">
            <div class="tab-pane fade show active" id="jobSeeker" role="tabpanel" aria-labelledby="jobSeeker-tab">
                <form>
                    <div class="mb-3">
                        <label for="jobSeekerEmail" class="form-label">Email / Username</label>
                        <input type="text" class="form-control" id="jobSeekerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="jobSeekerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="jobSeekerPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="jobSeekerRemember">
                        <label class="form-check-label" for="jobSeekerRemember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
                </form>
            </div>
            <div class="tab-pane fade" id="employer" role="tabpanel" aria-labelledby="employer-tab">
                <form>
                    <div class="mb-3">
                        <label for="employerEmail" class="form-label">Email / Username</label>
                        <input type="text" class="form-control" id="employerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="employerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="employerPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="employerRemember">
                        <label class="form-check-label" for="employerRemember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="#" class="btn btn-link">Forgot Password?</a>
                </form>
            </div>
            <div class="tab-pane fade" id="trainingProvider" role="tabpanel" aria-labelledby="trainingProvider-tab">
                <form>
                    <div class="mb-3">
                        <label for="trainingProviderEmail" class="form-label">Email / Username</label>
                        <input type="text" class="form-control" id="trainingProviderEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="trainingProviderPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="trainingProviderPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="trainingProviderRemember">
                        <label class="form-check-label" for="trainingProviderRemember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="#" class="btn btn-link">Forgot Password?</a>
                </form>
            </div>
            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <form>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">Email / Username</label>
                        <input type="text" class="form-control" id="adminEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminPassword" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="adminRemember">
                        <label class="form-check-label" for="adminRemember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="#" class="btn btn-link">Forgot Password?</a>
                </form>
            </div>
        </div>
        <div class="social-login">
            <p>Login with your social media accounts:</p>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-social-icon btn-facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-social-icon btn-twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="btn btn-social-icon btn-google">
                    <i class="fab fa-google"></i>
                </a>
            </div>
            <p class="mt-3">Don't have an account? <a href="register.php">Sign up now</a></p>
        </div>
    </div>
    </section>
    </div>
    <?php include '../includes/footer.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="../assets/js/script.js"></script>

</body>

</html>