<?php include('session.php'); ?>
<?php
include('connection.php');

$employers_id = $_SESSION['user_id'];
$success = $error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['jd_file'])) {
    $target_dir = "uploads/jds/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $jd_file = $_FILES['jd_file']['name'];
    $target_file = $target_dir . basename($jd_file);

    if (move_uploaded_file($_FILES['jd_file']['tmp_name'], $target_file)) {
        $stmt = $con->prepare("UPDATE employers SET jd_file = ? WHERE user_id = ?");
        $stmt->bind_param("si", $jd_file, $employers_id);
        if ($stmt->execute()) {
            $success = "JD uploaded successfully!";
        } else {
            $error = "Error updating JD!";
        }
    } else {
        $error = "Error uploading file!";
    }
}

// Fetch employers JD
$jd = "";
$res = $con->query("SELECT jd_file FROM employers WHERE user_id = $employers_id");
if ($res->num_rows > 0) {
    $jd = $res->fetch_assoc()['jd_file'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload JD</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Upload Job Description</h1>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload JD (PDF/DOC)</label>
            <input type="file" name="jd_file" class="form-control" required>
        </div>
        <button class="btn btn-success" type="submit">Upload</button>
    </form>

    <hr>

    <h4 class="mt-4">Current JD Preview:</h4>
    <?php if ($jd): ?>
        <iframe src="uploads/jds/<?= $jd ?>" width="100%" height="500px"></iframe>
        <br>
        <a class="btn btn-danger mt-2" href="?delete=1" onclick="return confirm('Are you sure to delete JD?')">Delete JD</a>
    <?php else: ?>
        <p>No JD uploaded yet.</p>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
</body>
</html>

<?php
// Delete JD file
if (isset($_GET['delete'])) {
    $res = $con->query("SELECT jd_file FROM employers WHERE user_id = $employers_id");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $file = "uploads/jds/" . $row['jd_file'];
        if (file_exists($file)) {
            unlink($file);
        }
        $con->query("UPDATE employers SET jd_file = NULL WHERE user_id = $employers_id");
        header("Location: upload_company_documents.php");
        exit;
    }
}
?>
