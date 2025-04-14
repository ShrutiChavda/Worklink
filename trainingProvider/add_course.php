<?php
include('session.php');
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = mysqli_real_escape_string($con, $_POST['course_name']);
    $duration = (int) $_POST['duration'];
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $user_id = $_SESSION['user_id'];

    $provider_sql = "SELECT id FROM training_providers WHERE user_id = $user_id";
    $provider_result = mysqli_query($con, $provider_sql);
    $provider = mysqli_fetch_assoc($provider_result);
    $training_provider_id = $provider['id'];

    $sql = "INSERT INTO training_programs 
            (provider_id, training_provider_id, course_name, duration, description, category, completion_rate, status, created_at, updated_at) 
            VALUES 
            ('$user_id', '$training_provider_id', '$course_name', '$duration', '$description', '$category', '0.00', 'Pending', NOW(), NOW())";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Course added successfully!'); window.location.href='update_course.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Skill Development Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    .form-section {
        padding: 20px;
    }
    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<body id="page-top">
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid">
        <div class="form-page">
            <div class="form-box">
                <h2>Add New Course</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" id="course_name" name="course_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="duration">Duration (in weeks)</label>
                        <input type="number" id="duration" name="duration" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Construction">Construction</option>
                            <option value="Retail">Retail</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Hospitality">Hospitality</option>
                            <option value="Banking and Finance">Banking and Finance</option>
                            <option value="Textile">Textile</option>
                            <option value="Electronics">Electronics</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Add Course</button>
                </form>
            </div>

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