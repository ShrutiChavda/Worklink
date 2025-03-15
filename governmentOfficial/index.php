<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$fullName = $_SESSION['full_name']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Worklink</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include '../includes/nav.php'; ?>

    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($fullName); ?>!</h2>
        <p>You have successfully logged in.</p>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
