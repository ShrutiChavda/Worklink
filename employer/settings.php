<?php
session_start();
include('connection.php');

// Check if account is deactivated
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $checkStatus = mysqli_query($con, "SELECT status FROM users WHERE id = '$user_id'");
    $statusRow = mysqli_fetch_assoc($checkStatus);

    if ($statusRow && $statusRow['status'] === 'Disabled') {
        echo "<script>
            alert('Your account is deactivated.');
            window.location.href = 'http://localhost/worklink/login.php';
        </script>";
        exit();
    }
}

if (isset($_POST['feedback'])) {
    $user_id = $_SESSION['user_id'];
    $feedback_message = mysqli_real_escape_string($con, $_POST['feedback']);
    $created_at = date('Y-m-d H:i:s');

    $query = "INSERT INTO feedback (user_id, feedback_message, created_at) 
              VALUES ('$user_id', '$feedback_message', '$created_at')";

    if (mysqli_query($con, $query)) {
        $_SESSION['feedback_success'] = "Thank you for your feedback!";
    } else {
        $_SESSION['feedback_error'] = "There was an error submitting your feedback. Please try again.";
    }
}

if (isset($_POST['deactivate_account'])) {
    $user_id = $_SESSION['user_id'];

    $query = "UPDATE users SET status = 'Disabled' WHERE id = '$user_id'";
    if (mysqli_query($con, $query)) {
        session_unset();
        session_destroy();
        echo "<script>
            alert('Your account has been deactivated.');
            window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        $_SESSION['deactivation_error'] = "An error occurred while deactivating your account.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
    <?php include('sidebar.php'); include('header.php'); ?>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Settings</h1>

        <?php
        if (isset($_SESSION['feedback_success'])) {
            echo "<div class='alert alert-success'>{$_SESSION['feedback_success']}</div>";
            unset($_SESSION['feedback_success']);
        }
        if (isset($_SESSION['feedback_error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['feedback_error']}</div>";
            unset($_SESSION['feedback_error']);
        }

        if (isset($_SESSION['deactivation_error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['deactivation_error']}</div>";
            unset($_SESSION['deactivation_error']);
        }
        ?>

        <div class="card shadow mb-4">
            <div class="card-header">
                <i class="fas fa-trash-alt"></i> Account Deactivation
            </div>
            <div class="card-body">
                <p>If you wish to deactivate your account, please click below. This action cannot be undone.</p>
                <form action="settings.php" method="POST">
                    <button type="submit" name="deactivate_account" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to deactivate your account? This action cannot be undone.')">Deactivate
                        Account</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <i class="fas fa-comments"></i> Support and Feedback
            </div>
            <div class="card-body">
                <form action="settings.php" method="POST">
                    <div class="form-group">
                        <label for="feedback">Your Feedback</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="4"
                            placeholder="Share your feedback or issue"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
        </div>

    </div>

    <?php include_once('footer.php'); ?>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
