<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Worklink Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <style>
        .hero {
            height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://source.unsplash.com/1600x900/?password,recovery') no-repeat center center/cover;
            text-align: center;
        }

        .forgot-password-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <?php include 'includes/nav.php'; ?>

    <div class="hero">
        <h1>Forgot Your Password?</h1>
        <p>Enter your email to reset it.</p>
    </div>

    <div class="container">
        <div class="forgot-password-card">
            <form id="forgotPasswordForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </form>
            <div id="message" class="mt-3"></div>
        </div>
    </div>

    <script>
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const messageDiv = document.getElementById('message');

            // Simulate sending a reset link (replace with actual backend logic)
            // In a real application, you would send an email with a unique reset link.
            // For demonstration, we'll just display a message.

            // Simulate a successful reset link send
            messageDiv.innerHTML = '<div class="alert alert-success">A password reset link has been sent to your email.</div>';

            // Simulate a failed reset link send (e.g., email not found)
            // messageDiv.innerHTML = '<div class="alert alert-danger">Email address not found. Please check and try again.</div>';

            // Clear the form
            document.getElementById('email').value = '';
        });
    </script>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="assets/js/script.js"></script> 

</body>
</html>