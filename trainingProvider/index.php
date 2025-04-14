<?php 
    include('session.php'); 
    include('connection.php'); // database connection

    $user_id = $_SESSION['user_id'];

    // Fetch Provider ID from training_providers table based on user_id
    $provider_sql = "SELECT id FROM training_providers WHERE user_id = $user_id";
    $provider_result = mysqli_query($con, $provider_sql);
    $provider = mysqli_fetch_assoc($provider_result);
    $provider_id = $provider['id'];

    // Fetch Ongoing Courses
    $ongoing_sql = "SELECT COUNT(*) AS count FROM training_programs WHERE status = 'Approved' AND provider_id = $user_id";
    $ongoing = mysqli_fetch_assoc(mysqli_query($con, $ongoing_sql))['count'];

    // Fetch Student Enrollments
    $students_sql = "SELECT COUNT(*) AS count FROM enrollments WHERE provider_id = $user_id";
    $students = mysqli_fetch_assoc(mysqli_query($con, $students_sql))['count'];

    // Fetch Certificates Issued
    $cert_sql = "SELECT COUNT(*) AS count FROM certificates WHERE provider_id = $user_id and status='Issued'";
    $certificates = mysqli_fetch_assoc(mysqli_query($con, $cert_sql))['count'];

    // Fetch Training Course Statuses
    $status_sql = "SELECT status, COUNT(*) AS total FROM training_programs WHERE provider_id = $user_id GROUP BY status";
    $status_result = mysqli_query($con, $status_sql);
    $status_data = ['Approved' => 0, 'Pending' => 0, 'Rejected' => 0];
    while ($row = mysqli_fetch_assoc($status_result)) {
        $status_data[$row['status']] = $row['total'];
    }

    // Enrollment Chart Data
    $enrollment_chart_sql = "SELECT tp.course_name, COUNT(e.id) AS total
                            FROM enrollments e
                            JOIN training_programs tp ON e.training_program_id = tp.id
                            WHERE e.provider_id = $user_id
                            GROUP BY tp.course_name";
    $enroll_labels = [];
    $enroll_data = [];
    $enroll_result = mysqli_query($con, $enrollment_chart_sql);
    while ($row = mysqli_fetch_assoc($enroll_result)) {
        $enroll_labels[] = $row['course_name'];
        $enroll_data[] = $row['total'];
    }

    // Certificates Status Chart Data
    $cert_status_sql = "SELECT status, COUNT(*) AS total 
                        FROM certificates 
                        WHERE provider_id = $user_id 
                        GROUP BY status";
    $cert_labels = [];
    $cert_data = [];
    $cert_result = mysqli_query($con, $cert_status_sql);
    while ($row = mysqli_fetch_assoc($cert_result)) {
        $cert_labels[] = $row['status'];
        $cert_data[] = $row['total'];
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
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
<?php include('sidebar.php'); ?>
<?php include('header.php'); ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-primary">Welcome to Skill Development Hub</h1>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ongoing Courses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ongoing; ?></div>
                    </div>
                    <i class="fas fa-book-open fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Student Enrollments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $students; ?></div>
                    </div>
                    <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Certificates Issued</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $certificates; ?></div>
                    </div>
                    <i class="fas fa-certificate fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Status Chart -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-secondary">Training Course Status</h6>
        </div>
        <div class="card-body">
            <canvas id="statusChart" height="100"></canvas>
        </div>
    </div>

    <!-- Enrollment and Certificate Charts -->
    <div class="row">
        <!-- Enrollment Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-secondary">Student Enrollments by Program</h6>
                </div>
                <div class="card-body">
                    <canvas id="enrollChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Certificate Status Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-secondary">Certificates Issued vs Pending</h6>
                </div>
                <div class="card-body">
                    <canvas id="certChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Logout Modal -->
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

<!-- Scripts -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<!-- Chart Scripts -->
<script>
    // Training Course Status Chart
    const ctx = document.getElementById("statusChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Approved", "Pending", "Rejected"],
            datasets: [{
                label: "Approved Courses",
                data: [<?= $status_data['Approved'] ?>, <?= $status_data['Pending'] ?>, <?= $status_data['Rejected'] ?>],
                backgroundColor: ["#28a745", "#ffc107", "#dc3545"]
            }]
            
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Enrollment Pie Chart
    const enrollCtx = document.getElementById("enrollChart").getContext("2d");
    new Chart(enrollCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($enroll_labels) ?>,
            datasets: [{
                data: <?= json_encode($enroll_data) ?>,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Certificate Status Pie Chart
    const certCtx = document.getElementById("certChart").getContext("2d");
    new Chart(certCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($cert_labels) ?>,
            datasets: [{
                data: <?= json_encode($cert_data) ?>,
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

</body>
</html>
