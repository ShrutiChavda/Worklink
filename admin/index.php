<?php 
include('session.php');
include('connection.php');
$totalUsers = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM users"))['count'];
$activeJobs = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM jobs WHERE status IN ('open', 'approved')"))['count'];
$totalPrograms = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM training_programs"))['count'];
$totalComplaints = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM worker_complaints"))['count'];
$jobSeekerCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE user_type = 'jobSeeker'"))['count'];
$employerCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE user_type = 'employer'"))['count'];
$officialCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE user_type = 'governmentOfficial'"))['count'];
$tpCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS count FROM users WHERE user_type = 'trainingProvider'"))['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link href="img/favicon.png" rel="icon">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .chart-container canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/search.js"></script>
</head>

<body id="page-top">
    <?php include('sidebar.php'); ?>
    <?php include('header.php'); ?>

    <div class="container-fluid py-4">
        <h2 class="text-center mb-4">System Administration Panel</h2>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary p-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text display-6"><?= $totalUsers ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success p-3">
                    <div class="card-body">
                        <h5 class="card-title">Active Jobs</h5>
                        <p class="card-text display-6"><?= $activeJobs ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning p-3">
                    <div class="card-body">
                        <h5 class="card-title">Programs</h5>
                        <p class="card-text display-6"><?= $totalPrograms ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger p-3">
                    <div class="card-body">
                        <h5 class="card-title">Complaints</h5>
                        <p class="card-text display-6"><?= $totalComplaints ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="text-center">User Roles Distribution</h5>
                    <div class="chart-container">
                        <canvas id="userRoleChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-success" href="http://localhost/worklink/admin/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('userRoleChart').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Job Seekers', 'Employers', 'Government Officials', 'Training Providers'],
                datasets: [{
                    data: [<?= $jobSeekerCount ?>, <?= $employerCount ?>, <?= $officialCount ?>, <?= $tpCount ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
